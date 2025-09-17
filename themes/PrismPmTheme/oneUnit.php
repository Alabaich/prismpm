<?php
/* Template Name: Single Property */

get_header();

// Get the current URL and parse the 'arg' parameter
$current_url = home_url(add_query_arg([]));
$parsed_url = wp_parse_url($current_url);
parse_str($parsed_url['query'] ?? '', $query_params);
$arg = $query_params['arg'] ?? null;

if ($arg) {
    // Database connection
    $conn = new mysqli("5.161.90.110", "readonly", "pass", "prismpm");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch unit and building data for the current unit with media using CTE
    $stmt = $conn->prepare("
        WITH RankedMedia AS (
            SELECT 
                media.building_id,
                media.gallery AS m_gallery,
                media.virtual_tour AS m_virtual_tour,
                media.share_unit,
                ROW_NUMBER() OVER (
                    PARTITION BY media.building_id 
                    ORDER BY JSON_LENGTH(media.share_unit) DESC
                ) AS rn
            FROM media
            WHERE media.building_id IN (
                SELECT building_id 
                FROM units 
                WHERE id = ?
            )
            AND (
                JSON_CONTAINS(media.share_unit, JSON_QUOTE((
                    SELECT floorplan 
                    FROM units 
                    WHERE id = ?
                )))
                OR JSON_LENGTH(media.share_unit) = 0
            )
        )
        SELECT 
            units.*, 
            building.*, 
            units.id AS unit_id, 
            units.unit_of_area AS area_sq_ft,
            RankedMedia.m_gallery,
            RankedMedia.m_virtual_tour,
            RankedMedia.share_unit
        FROM units
        JOIN building ON building.id = units.building_id
        LEFT JOIN RankedMedia ON RankedMedia.building_id = units.building_id AND RankedMedia.rn = 1
        WHERE units.unit_status = 1
        AND units.id = ?
        LIMIT 1
    ");
    $stmt->bind_param("iii", $arg, $arg, $arg);
    $stmt->execute();
    $res = $stmt->get_result();
    $data = [];

    while ($row = $res->fetch_assoc()) {
        // Parse gallery images
        $imgs = [];
        $folder = $row['filename'];
        if ($row && !empty($row['m_gallery'])) {
            $gallery = json_decode($row['m_gallery'], true);
            if (is_array($gallery)) {
                foreach ($gallery as $item) {
                    $img_url = "https://floorplan.atriadevelopment.ca/$folder/gallery/" . htmlspecialchars($item);
                    $imgs[] = $img_url;
                    error_log("Checking item: $item");
                }
            }
        } else {
            error_log("No gallery data for unit_id $arg");
        }
        $row['gallery_images'] = $imgs;
        $row['virtual_tour'] = !empty($row['m_virtual_tour']) ? $row['m_virtual_tour'] : '';  // Используем m_virtual_tour напрямую

        // Set floorplan URL
        $row['floorplan_url'] = '';
        if (!empty($row['floorplan'])) {
            $extension = preg_match('/\.(pdf|svg|png)$/', $row['floorplan']) ? '' : '.pdf';
            $row['floorplan_url'] = "https://floorplan.atriadevelopment.ca/$folder/{$row['floorplan']}$extension";
        }

        // Fetch amenities for this building
        $building_id = $row['building_id'];
        $amenity_stmt = $conn->prepare("SELECT amenities FROM amenities WHERE building_id = ?");
        $amenity_stmt->bind_param("i", $building_id);
        $amenity_stmt->execute();
        $amenity_result = $amenity_stmt->get_result();
        $amenities_data = [];

        while ($amenity_row = $amenity_result->fetch_assoc()) {
            $amenities = json_decode($amenity_row['amenities'], true);
            $amenities_data = is_array($amenities) ? $amenities : explode(',', str_replace(['[', ']', '"'], '', $amenity_row['amenities']));
            $amenities_data = array_map('trim', $amenities_data);
        }
        $row['amenities_data'] = $amenities_data;
        $amenity_stmt->close();

        // Set default coordinates
        $row['lat'] = 43.6532;
        $row['lng'] = -79.3832;
        if (!empty($row['coordinates'])) {
            $coords = json_decode($row['coordinates'], true);
            if (is_array($coords) && isset($coords[0]) && isset($coords[1])) {
                $row['lng'] = floatval($coords[0]);
                $row['lat'] = floatval($coords[1]);
            }
        }

        $data[] = $row;
    }
    $stmt->close();

    // Define known building IDs and fetch other units
    $known_building_ids = [1, 2, 3, 8];
    $current_building_id = $data[0]['building_id'];
    $other_building_ids = array_diff($known_building_ids, [$current_building_id]);

    // Fetch one random unit from each of the remaining buildings
    $other_units = [];
    if (count($other_building_ids) >= 3) {
        $selected_ids = array_slice(array_values($other_building_ids), 0, 3);
        foreach ($selected_ids as $id) {
            $unit_stmt = $conn->prepare("
                WITH RankedMedia AS (
                    SELECT 
                        media.building_id,
                        media.gallery AS m_gallery,
                        ROW_NUMBER() OVER (
                            PARTITION BY media.building_id 
                            ORDER BY JSON_LENGTH(media.share_unit) DESC
                        ) AS rn
                    FROM media
                    WHERE media.building_id = ?
                    AND (
                        JSON_CONTAINS(media.share_unit, JSON_QUOTE((
                            SELECT floorplan 
                            FROM units 
                            WHERE building_id = ? 
                            LIMIT 1
                        )))
                        OR JSON_LENGTH(media.share_unit) = 0
                    )
                )
                SELECT 
                    units.*, 
                    building.*, 
                    units.id AS unit_id, 
                    units.unit_of_area AS area_sq_ft,
                    RankedMedia.m_gallery
                FROM units
                JOIN building ON building.id = units.building_id
                LEFT JOIN RankedMedia ON RankedMedia.building_id = units.building_id AND RankedMedia.rn = 1
                WHERE units.unit_status = 1
                AND building.id = ?
                ORDER BY RAND()
                LIMIT 1
            ");
            $unit_stmt->bind_param("iii", $id, $id, $id);
            $unit_stmt->execute();
            $unit_result = $unit_stmt->get_result();

            while ($unit_row = $unit_result->fetch_assoc()) {
                $imgs = [];
                $folder = $unit_row['filename'];
                if (!empty($unit_row['m_gallery'])) {
                    foreach (json_decode($unit_row['m_gallery'], true) as $gallery) {
                        $imgs[] = "https://floorplan.atriadevelopment.ca/$folder/gallery/$gallery";
                    }
                }
                $unit_row['gallery_images'] = $imgs;
                $other_units[] = $unit_row;
            }
            $unit_stmt->close();
        }
    }

    $conn->close();
} else {
    echo "No unit ID provided in the URL.<br>";
}
?>

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />

<style>
    .container {
        width: 100%;
        margin: 0;
        padding: 25px 10%;
    }

    .swiper-slide img{
            min-height: 700px;
            max-height: 700px; 
    }
    @media screen and (max-width: 1600px) {
        .container {
            width: 100%;
            margin: 0;
            padding: 25px;
        }
    }
    @media screen and (max-width: 768px) {
        .container {
            width: 100%;
            margin: 0;
            padding: 15px;
        }
        .image-placeholder .gallery div {
            height: 100px;
            width: 33%;
        }
        .swiper-slide img{
            min-height: 240px;
            max-height: 240px; 
        }
    }


    .main-content {
        display: flex;
        gap: 0 50px;
    }
    @media screen and (max-width: 768px) {
        .main-content {
            flex-direction: column;
            gap: 20px;
        }
        .image-section,
        .details {
            width: 100%;
        }
    }

    .image-section {
        width: 60%;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    @media screen and (max-width: 768px) {
        .image-section {
            width: 100%;
        }
    }
    .swiper-container {
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        position: relative;
        margin-bottom: 10px;
    }
    .swiper-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .image-placeholder {
        width: 100%;
    }
    .image-placeholder .gallery {
        display: flex;
        gap: 10px;
        margin-top: 16px;
    }
    .image-placeholder .gallery div {
        height: 168px;
        width: 33%;
        background-color: #e5e7eb;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
    }
    @media screen and (max-width: 768px) {
        .image-placeholder .gallery div {
            height: 100px;
            width: 33%;
        }
    }
    .image-placeholder .gallery div img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Tabbed Section Styles (Moved to image-section on desktop) */
    .tab-section {
        width: 100%;
        margin-top: 20px;
    }
    @media screen and (max-width: 768px) {
        .tab-section {
            margin-top: 0;
        }
    }
    .tab-buttons {
        display: flex;
        gap: 10px;
        margin-bottom: 30px;
        overflow-x: auto;
        white-space: nowrap;
        width: 100%;
    }
    @media screen and (max-width: 768px) {
        .tab-buttons {
            margin-top: 20px;
            margin-bottom: 20px;
        }
    }
    .tab-button {
        padding: 10px 20px;
        cursor: pointer;
        background-color: #093D5F0D;
        border: 1px solid #CACACA;
        border-radius: 999px;
        font-family: "Inter Tight", sans-serif;
        color: #2A2A2A;
        transition: background-color 0.3s;
    }
    .tab-button.active {
        background-color: #093D5F;
        color: white;
    }
    @media screen and (max-width: 768px) {
        .tab-button {
            padding: 8px 16px;
            font-size: 0.9rem;
        }
    }
    .tab-content {
        display: none;
        width: 100%;
    }
    .tab-content.active {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .tab-link {
        color: #2563eb;
        text-decoration: underline;
        font-family: "Inter Tight", sans-serif;
    }
    @media screen and (max-width: 768px) {
        .tab-link {
            font-size: 0.9rem;
        }
    }
    .map-container {
        width: 100%;
        height: 340px;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        z-index: 1;
    }
    @media screen and (max-width: 768px) {
        .map-container {
            height: 300px;
        }
    }

    .details {
        width: 40%;
        display: flex;
        flex-direction: column;
    }
    @media screen and (max-width: 768px) {
        .details {
            width: 100%;
        }
    }
    .title {
        font-size: 52px;
        font-weight: 500;
        color: #1f2937;
        margin-bottom: 20px;
        font-family: "Playful Despair", serif;
    }
    @media screen and (max-width: 768px) {
        .title {
            font-size: 36px;
            margin-bottom: 15px;
        }
    }
    .tags {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
    }
    .tag-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: #093D5F0D;
        padding: 0.5rem 1rem;
        border-radius: 999px;
        border: 1px solid #CACACA;
        font-size: 1rem;
        color: #2A2A2A;
        font-family: "Inter Tight", sans-serif;
    }
    .tag-item svg {
        width: 24px;
        height: 24px;
    }
    .tags span {
        background-color: transparent;
        color: #2A2A2A;
        font-family: "Inter Tight", sans-serif;
        font-size: 16px;
        font-weight: 500;
        padding: 10px 6px;
        border-radius: 9999px;
    }
    @media screen and (max-width: 768px) {
        .tag-item {
            padding: 0.4rem 0.8rem;
            font-size: 0.9rem;
        }
        .tags span {
            font-size: 14px;
        }
    }
    .price-section {
        margin-bottom: 20px;
    }
    .price {
        font-size: 30px;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 10px;
    }
    .price small {
        font-size: 14px;
        font-weight: normal;
        color: #6b7280;
    }
    @media screen and (max-width: 768px) {
        .price {
            font-size: 24px;
        }
        .price small {
            font-size: 12px;
        }
    }
    .amenities {
        flex-grow: 1;
    }
    .amenities-table {
        background-color: #093D5F0D;
        padding: 16px;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .amenities-table div {
        display: flex;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid #e5e7eb;
    }
    .amenities-table div:last-child {
        border-bottom: none;
    }
    .amenities-table p {
        color: #2A2A2A;
        margin: 0;
        font-family: "Inter Tight", sans-serif;
    }
    .amenity-item {
        display: flex;
        align-items: center;
        gap: 8px;
        justify-content: space-between;
        width: 100%;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.8);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }
    .modal-content {
        position: relative;
        width: 90%;
        height: 90%;
    }
    .modal-swiper {
        height: 100%;
    }
    .modal-swiper .swiper-slide img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    .close-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 30px;
        color: #fff;
        cursor: pointer;
        z-index: 1001;
    }
    .modal .swiper-button-next,
    .modal .swiper-button-prev {
        color: #fff;
    }

    /* Styles for Available Suites section */
    .full-width-suites {
        font-family: "Inter Tight", sans-serif;
        margin: 0 auto;
        padding: 2rem 0rem;
    }
    .buttonWrapper .btn {
        border: 1px solid white;
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        gap: 0.75rem;
        background: #093D5F;
        color: white;
        border-radius: 100px;
        font-size: 1rem;
        text-decoration: none;
        transition: background 0.3s ease;
        transition: all 0.3s ease;
    }
    .buttonWrapper .btn:hover {
        background: transparent;
        transition: all 0.3s ease;
        border: 1px solid black;
        color: #2A2A2A;
        gap: 2rem;
    }
    .buttonWrapper:hover {
        background: transparent;
        color: #2A2A2A;
        border: black;
        transition: all 0.3s ease;
    }
    .buttonWrapper .btn svg {
        transition: all 0.3s ease;
        rotate: -45deg;
        width: 24px;
        height: 24px;
    }
        .buttonWrapper .btnf {
        border: 1px solid white;
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        gap: 0.75rem;
        background: #093D5F;
        color: white;
        border-radius: 100px;
        font-size: 1rem;
        text-decoration: none;
        transition: background 0.3s ease;
        transition: all 0.3s ease;
    }
        .buttonWrapper .btnf:hover {
        background: transparent;
        transition: all 0.3s ease;
        border: 1px solid black;
        color: #2A2A2A;
        gap: 2rem;
    }
        .buttonWrapper .btnf svg {
        transition: all 0.3s ease;
        rotate: 90deg;
        width: 24px;
        height: 24px;
    }
    .section-title {
        font-size: 2.5rem;
        margin-bottom: 2rem;
        color: #2A2A2A;
        font-family: "Playful Despair", serif;
        text-align: center;
    }
    @media screen and (max-width: 768px) {
        .section-title {
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }
    }
    .suites-list {
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }
    @media screen and (max-width: 768px) {
        .suites-list {
            flex-direction: column;
            gap: 15px;
        }
    }
    .suite-item {
        display: flex;
        flex-direction: column;
        border: 1px solid #e0e0e0;
        border-radius: 0.5rem;
        background: #093D5F0D;
        transition: box-shadow 0.2s ease;
        overflow: hidden;
        max-width: 32.5%;
        min-width: 32.5%;
    }
    @media screen and (max-width: 768px) {
        .suite-item {
            max-width: 100%;
            min-width: 100%;
            width: 100%;
        }
    }
    .suite-item:hover {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    .suite-image {
        width: 100%;
        height: 300px;
        flex-shrink: 0;
        padding: 10px;
    }
    @media screen and (max-width: 768px) {
        .suite-image {
            height: 200px;
            padding: 8px;
        }
    }
    .suite-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 0.5rem;
    }
    .suite-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 1.5rem;
        justify-content: space-between;
    }
    @media screen and (max-width: 768px) {
        .suite-content {
            padding: 1rem;
        }
    }
    .suite-info {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    .suite-title {
        font-size: 28px;
        font-family: "Playful Despair", serif;
        margin: 0;
        color: #2A2A2A;
        font-weight: 500;
        max-width: 310px;
    }
    @media screen and (max-width: 768px) {
        .suite-title {
            font-size: 22px;
            max-width: 100%;
        }
    }
    .suite-availability {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .availability-dot {
        color: #10B981;
        font-size: 1.2rem;
    }
    .availability-text {
        color: #2A2A2A;
        font-weight: 500;
    }
    .suite-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .suite-tags .tag-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: white;
        padding: 0.5rem 1rem;
        border-radius: 999px;
        border: 1px solid #e0e0e0;
        font-size: 0.9rem;
    }
    @media screen and (max-width: 768px) {
        .suite-tags .tag-item {
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
        }
    }
    .suite-tags .tag-item svg {
        width: 18px;
        height: 18px;
    }
    .hasd {
        display: flex;
        align-content: center;
        align-items: center;
        justify-items: space-between;
        justify-content: space-between;
    }
    .suite-price-section {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: space-between;
        padding-top: 50px;
        gap: 1rem;
    }
    @media screen and (max-width: 768px) {
        .suite-price-section {
            padding-top: 20px;
            flex-direction: row;
            align-items: center;
        }
    }
    .suite-price {
        text-align: right;
    }
    @media screen and (max-width: 768px) {
        .suite-price {
            text-align: left;
        }
    }
    .price-amount {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2A2A2A;
    }
    @media screen and (max-width: 768px) {
        .price-amount {
            font-size: 1.2rem;
        }
    }
    .price-period {
        color: #6B7280;
        font-size: 0.8rem;
    }
    .wishlist {
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #2A2A2A;
        cursor: pointer;
        padding: 0;
        line-height: 1;
    }
    .wishlist:hover {
        color: red;
    }
    .view-details-btn {
        background-color: #2563eb;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        width: fit-content;
        border: none;
        font-family: "Inter Tight", sans-serif;
        font-size: 0.9rem;
    }
    .view-details-btn:hover {
        background-color: #1d4ed8;
    }
    @media (max-width: 768px) {
        .suite-item {
            flex-direction: column;
        }
        .suite-price {
            text-align: left;
        }
        .suite-image {
            width: 100%;
            height: 200px;
        }
        .suite-content {
            flex-direction: column;
            gap: 1.5rem;
        }
        .suite-price-section {
            flex-direction: row;
            align-items: center;
            gap: 1rem;
        }
    }
</style>

<?php foreach ($data as $item): ?>
    <div class="container">
        <!-- Main Content -->
        <div class="main-content">
            <!-- Image Section (Left) -->
            <div class="image-section">
                <div class="image-placeholder">
                    <!-- Swiper Slider -->
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php 
                            $images_to_show = array_slice($item['gallery_images'], 0, 4); 
                            $first = true;
                            foreach ($images_to_show as $index => $image): ?>
                                <div class="swiper-slide" data-index="<?php echo $index; ?>">
                                    <img src="<?php echo htmlspecialchars($image); ?>" alt="Property Image">
                                </div>
                            <?php 
                                if ($first) {
                                    echo '<style>.swiper-slide:first-child {  }</style>';
                                    $first = false;
                                }
                            endforeach; ?>
                        </div>
                    </div>
                    <!-- Thumbnails -->
                    <div class="gallery">
                        <?php for ($i = 0; $i < 3 && $i < count($item['gallery_images']); $i++): ?>
                            <div class="thumbnail" data-index="<?php echo $i; ?>">
                                <img src="<?php echo htmlspecialchars($item['gallery_images'][$i]); ?>" alt="Gallery Image">
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>

                <!-- Tabbed Section (Moved to image-section on desktop) -->
                <div class="tab-section">
                    <div class="tab-buttons">
                        <div class="tab-button active" data-tab="map">Map</div>
                        <div class="tab-button" data-tab="virtual-tour">Virtual Tour</div>
                        <div class="tab-button" data-tab="floorplan">Floorplan</div>
                    </div>
                    <div class="tab-content active" id="map">
                        <div class="map-container" id="tab-map"></div>
                    </div>
                    <div class="tab-content" id="virtual-tour">
                        <?php if (!empty($item['virtual_tour'])): ?>
                            <div class="buttonWrapper">
                                <a href="<?php echo htmlspecialchars($item['virtual_tour']); ?>" class="btn" target="_blank">
                                    <span>Virtual Walkthrough</span>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                            </div>
                        <?php else: ?>
                            <p style="font-family: Inter Tight, sans-serif;">No virtual tour available.</p>
                        <?php endif; ?>
                    </div>
                    <div class="tab-content" id="floorplan">
                        <?php if (!empty($item['floorplan_url'])): ?>
                            <div class="buttonWrapper">
                                <a href="<?php echo htmlspecialchars($item['floorplan_url']); ?>" class="btnf"  target="_blank">
                                    <span>Download Floorplan</span>
<svg width="48" height="48" viewBox="0 0 48 48" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
<path d="M30 6H38C39.0609 6 40.0783 6.42143 40.8284 7.17157C41.5786 7.92172 42 8.93913 42 10V38C42 39.0609 41.5786 40.0783 40.8284 40.8284C40.0783 41.5786 39.0609 42 38 42H30M20 34L30 24M30 24L20 14M30 24H6" stroke="" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

                                </a>
                            </div>
                        <?php else: ?>
                            <p style="font-family: Inter Tight, sans-serif;">No floorplan available.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Details Section (Right) -->
            <div class="details">
                <!-- Title -->
                <div class="title">
                    <?php echo htmlspecialchars($item['bed'] . ' Bed - ' . $item['address'] . ', ' . $item['province'] . ', ' . $item['city'] . ' ' . $item['postal_code']); ?>
                </div>

                <!-- Property Tags -->
                <div class="tags">
                    <div class="tag-item">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.75 4.58325V17.4166M2.75 14.6666H19.25M19.25 17.4166V12.0999C19.25 11.0732 19.25 10.5597 19.0502 10.1676C18.8744 9.82264 18.5939 9.54214 18.249 9.36642C17.8569 9.16659 17.3434 9.16659 16.3167 9.16659H10.0833V14.4166M6.41667 10.9999H6.42583M7.33333 10.9999C7.33333 11.5062 6.92292 11.9166 6.41667 11.9166C5.91041 11.9166 5.5 11.5062 5.5 10.9999C5.5 10.4936 5.91041 10.0833 6.41667 10.0833C6.92292 10.0833 7.33333 10.4936 7.33333 10.9999Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span><?php echo htmlspecialchars($item['bed']); ?> Bedroom</span>
                    </div>
                    <div class="tag-item">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.7572 5.56968C10.5359 5.85004 9.625 6.94364 9.625 8.25V8.9375H15.125V8.25C15.125 7.01287 14.3081 5.96653 13.1842 5.621C13.4001 5.1442 13.8801 4.8125 14.4375 4.8125C15.1969 4.8125 15.8125 5.42811 15.8125 6.1875V11.6875H4.125V13.0625H4.8125V16.5C4.8125 17.6391 5.73591 18.5625 6.875 18.5625H15.125C16.264 18.5625 17.1875 17.6391 17.1875 16.5V13.0625H17.875V11.6875H17.1875V6.1875C17.1875 4.66872 15.9563 3.4375 14.4375 3.4375C13.1312 3.4375 12.0376 4.34839 11.7572 5.56968ZM6.1875 13.0625H15.8125V16.5C15.8125 16.8797 15.5047 17.1875 15.125 17.1875H6.875C6.49531 17.1875 6.1875 16.8797 6.1875 16.5V13.0625ZM12.375 6.875C12.8839 6.875 13.3283 7.15151 13.566 7.5625H11.184C11.4217 7.15151 11.8661 6.875 12.375 6.875Z" fill="black" />
                        </svg>
                        <span><?php echo htmlspecialchars($item['bath']); ?> Bathroom</span>
                    </div>
                    <div class="tag-item">
                        <svg width="22" height="22" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2H6C4.93913 2 3.92172 2.42143 3.17157 3.17157C2.42143 3.92172 2 4.93913 2 6V12M38 12V6C38 4.93913 37.5786 3.92172 36.8284 3.17157C36.0783 2.42143 35.0609 2 34 2H28M28 38H34C35.0609 38 36.0783 37.5786 36.8284 36.8284C37.5786 36.0783 38 35.0609 38 34V28M2 28V34C2 35.0609 2.42143 36.0783 3.17157 36.8284C3.92172 37.5786 4.93913 38 6 38H12" stroke="#1E1E1E" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span><?php echo htmlspecialchars($item['area_sq_ft']); ?> sqFeet</span>
                    </div>
                    <div class="tag-item">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_195_4555)">
                                <path d="M-0.166992 18.8334H1.66634M1.66634 18.8334H11.7497M1.66634 18.8334V13.6709C1.66634 13.1893 1.66634 12.9484 1.72409 12.7238C1.77527 12.5247 1.85951 12.3359 1.97339 12.1648C2.1018 11.9719 2.28155 11.8103 2.6394 11.4888L4.74918 9.59339C5.44103 8.97184 5.78721 8.66083 6.17862 8.54285C6.5237 8.43883 6.89198 8.43883 7.23701 8.54285C7.6288 8.66093 7.97548 8.9721 8.66848 9.59469L10.7768 11.4888C11.135 11.8106 11.3138 11.9718 11.4423 12.1648C11.5562 12.3359 11.6403 12.5247 11.6915 12.7238C11.7492 12.9484 11.7497 13.1893 11.7497 13.6709V18.8334M11.7497 18.8334H16.333M16.333 18.8334H18.1663M16.333 18.8334V7.09725C16.333 6.07249 16.333 5.55935 16.1334 5.16756C15.9576 4.8226 15.6764 4.54233 15.3315 4.36657C14.9393 4.16675 14.4266 4.16675 13.3999 4.16675H7.34986C6.32309 4.16675 5.80932 4.16675 5.41716 4.36657C5.07219 4.54233 4.79193 4.8226 4.61616 5.16756C4.41634 5.55973 4.41634 6.0735 4.41634 7.10026V9.66693" stroke="#2A2A2A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_195_4555">
                                    <rect width="22" height="22" fill="white" transform="translate(0 0.5)"/>
                                </clipPath>
                            </defs>
                        </svg>
                        <span>Apartment Building</span>
                    </div>
                    <div class="tag-item">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.04293 15.3542C3.82293 18.0034 5.82126 20.1667 8.47959 20.1667H12.8704C15.8587 20.1667 17.9121 17.7559 17.4171 14.8042C16.8946 11.7059 13.9062 9.16675 10.7621 9.16675C7.35209 9.16675 4.32709 11.9534 4.04293 15.3542Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9.59736 6.87508C10.863 6.87508 11.889 5.84907 11.889 4.58341C11.889 3.31776 10.863 2.29175 9.59736 2.29175C8.33168 2.29175 7.30566 3.31776 7.30566 4.58341C7.30566 5.84907 8.33168 6.87508 9.59736 6.87508Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M15.8587 7.97502C16.8713 7.97502 17.6921 7.15421 17.6921 6.14168C17.6921 5.12916 16.8713 4.30835 15.8587 4.30835C14.8463 4.30835 14.0254 5.12916 14.0254 6.14168C14.0254 7.15421 14.8463 7.97502 15.8587 7.97502Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M19.25 11.6416C20.0094 11.6416 20.625 11.026 20.625 10.2666C20.625 9.50719 20.0094 8.8916 19.25 8.8916C18.4906 8.8916 17.875 9.50719 17.875 10.2666C17.875 11.026 18.4906 11.6416 19.25 11.6416Z" stroke="black" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M3.639 9.80831C4.65152 9.80831 5.47233 8.98746 5.47233 7.97493C5.47233 6.96241 4.65152 6.1416 3.639 6.1416C2.62647 6.1416 1.80566 6.96241 1.80566 7.97493C1.80566 8.98746 2.62647 9.80831 3.639 9.80831Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>Pet friendly</span>
                    </div>
                </div>

                <!-- Rent Price -->
                <div class="price-section">
                    <p class="price">$<?php echo number_format($item['market_rent'], 2); ?><small>/month</small></p>
                    <div class="book-btn buttonWrapper">
                        <a href="<?php echo home_url('/oneUnit?arg=' . $item['unit_id']); ?>" class="btn">
                            <span>Book A View</span>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Amenities Section -->
                <div class="amenities">
                    <h2 style="font-size: 22px; font-weight: 500; color: #2A2A2A; margin-bottom: 16px; font-family: Playful Despair, serif;">Amenities</h2>
                    <div class="amenities-table">
                        <?php foreach ($item['amenities_data'] as $amenity): ?>
                            <div class="amenity-item">
                                <p style="font-family: Inter Tight, sans-serif;"><?php echo htmlspecialchars($amenity); ?></p>
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2A2A2A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Available Suites Section -->
        <section class="full-width-suites">
            <h2 class="section-title">Similar Ads</h2>
            <div class="suites-list">
                <?php foreach ($other_units as $unit): ?>
                    <div class="suite-item">
                        <div class="suite-image">
                            <?php if (!empty($unit['gallery_images']) && isset($unit['gallery_images'][0])): ?>
                                <img src="<?php echo htmlspecialchars($unit['gallery_images'][0]); ?>" alt="Suite Image">
                            <?php endif; ?>
                        </div>
                        <div class="suite-content">
                            <div class="suite-info">
                                <div class="hasd">
                                    <h3 class="suite-title">
                                        <?php echo htmlspecialchars($unit['bed'] . ' Bed - ' . $unit['address']); ?>
                                    </h3>
                                    <div class="suite-price">
                                        <div class="price-amount">$<?php echo number_format($unit['market_rent'], 2); ?></div>
                                        <div class="price-period">month</div>
                                    </div>
                                </div>
                                <div class="suite-availability">
                                    <span class="availability-dot">●</span>
                                    <span class="availability-text">Available</span>
                                </div>
                                <div class="suite-tags">
                                    <div class="tag-item">
                                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.75 4.58325V17.4166M2.75 14.6666H19.25M19.25 17.4166V12.0999C19.25 11.0732 19.25 10.5597 19.0502 10.1676C18.8744 9.82264 18.5939 9.54214 18.249 9.36642C17.8569 9.16659 17.3434 9.16659 16.3167 9.16659H10.0833V14.4166M6.41667 10.9999H6.42583M7.33333 10.9999C7.33333 11.5062 6.92292 11.9166 6.41667 11.9166C5.91041 11.9166 5.5 11.5062 5.5 10.9999C5.5 10.4936 5.91041 10.0833 6.41667 10.0833C6.92292 10.0833 7.33333 10.4936 7.33333 10.9999Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <span><?php echo htmlspecialchars($unit['bed']); ?> Bedroom</span>
                                    </div>
                                    <div class="tag-item">
                                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.7572 5.56968C10.5359 5.85004 9.625 6.94364 9.625 8.25V8.9375H15.125V8.25C15.125 7.01287 14.3081 5.96653 13.1842 5.621C13.4001 5.1442 13.8801 4.8125 14.4375 4.8125C15.1969 4.8125 15.8125 5.42811 15.8125 6.1875V11.6875H4.125V13.0625H4.8125V16.5C4.8125 17.6391 5.73591 18.5625 6.875 18.5625H15.125C16.264 18.5625 17.1875 17.6391 17.1875 16.5V13.0625H17.875V11.6875H17.1875V6.1875C17.1875 4.66872 15.9563 3.4375 14.4375 3.4375C13.1312 3.4375 12.0376 4.34839 11.7572 5.56968ZM6.1875 13.0625H15.8125V16.5C15.8125 16.8797 15.5047 17.1875 15.125 17.1875H6.875C6.49531 17.1875 6.1875 16.8797 6.1875 16.5V13.0625ZM12.375 6.875C12.8839 6.875 13.3283 7.15151 13.566 7.5625H11.184C11.4217 7.15151 11.8661 6.875 12.375 6.875Z" fill="black" />
                                        </svg>
                                        <span><?php echo htmlspecialchars($unit['bath']); ?> Bathroom</span>
                                    </div>
                                    <div class="tag-item">
                                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.04293 15.3542C3.82293 18.0034 5.82126 20.1667 8.47959 20.1667H12.8704C15.8587 20.1667 17.9121 17.7559 17.4171 14.8042C16.8946 11.7059 13.9062 9.16675 10.7621 9.16675C7.35209 9.16675 4.32709 11.9534 4.04293 15.3542Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M9.59736 6.87508C10.863 6.87508 11.889 5.84907 11.889 4.58341C11.889 3.31776 10.863 2.29175 9.59736 2.29175C8.33168 2.29175 7.30566 3.31776 7.30566 4.58341C7.30566 5.84907 8.33168 6.87508 9.59736 6.87508Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M15.8587 7.97502C16.8713 7.97502 17.6921 7.15421 17.6921 6.14168C17.6921 5.12916 16.8713 4.30835 15.8587 4.30835C14.8463 4.30835 14.0254 5.12916 14.0254 6.14168C14.0254 7.15421 14.8463 7.97502 15.8587 7.97502Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M19.25 11.6416C20.0094 11.6416 20.625 11.026 20.625 10.2666C20.625 9.50719 20.0094 8.8916 19.25 8.8916C18.4906 8.8916 17.875 9.50719 17.875 10.2666C17.875 11.026 18.4906 11.6416 19.25 11.6416Z" stroke="black" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M3.639 9.80831C4.65152 9.80831 5.47233 8.98746 5.47233 7.97493C5.47233 6.96241 4.65152 6.1416 3.639 6.1416C2.62647 6.1416 1.80566 6.96241 1.80566 7.97493C1.80566 8.98746 2.62647 9.80831 3.639 9.80831Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <span>Pet friendly</span>
                                    </div>
                                    <div class="tag-item">
                        <svg width="22" height="22" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2H6C4.93913 2 3.92172 2.42143 3.17157 3.17157C2.42143 3.92172 2 4.93913 2 6V12M38 12V6C38 4.93913 37.5786 3.92172 36.8284 3.17157C36.0783 2.42143 35.0609 2 34 2H28M28 38H34C35.0609 38 36.0783 37.5786 36.8284 36.8284C37.5786 36.0783 38 35.0609 38 34V28M2 28V34C2 35.0609 2.42143 36.0783 3.17157 36.8284C3.92172 37.5786 4.93913 38 6 38H12" stroke="#1E1E1E" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span><?php echo htmlspecialchars($unit['area_sq_ft']); ?> sqFeet</span>
                    </div>
                                </div>
                            </div>
                            <div class="suite-price-section buttonWrapper">
                                <a href="<?php echo home_url('/oneUnit?arg=' . $unit['unit_id']); ?>" class="btn">
                                    <span>View Details</span>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>

    <!-- Modal for Fullscreen Slider -->
    <div class="modal" id="imageModal">
        <span class="close-btn" id="closeModal">×</span>
        <div class="modal-content">
            <div class="swiper-container modal-swiper">
                <div class="swiper-wrapper">
                    <?php 
                    $images_to_show = array_slice($item['gallery_images'], 0, 4); 
                    foreach ($images_to_show as $index => $image): ?>
                        <div class="swiper-slide" data-index="<?php echo $index; ?>">
                            <img src="<?php echo htmlspecialchars($image); ?>" alt="Property Image">
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Add Navigation -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize Swiper for main slider
            const mainSwiper = new Swiper('.swiper-container', {
                loop: true,
            });

            // Initialize Swiper for modal slider
            const modalSwiper = new Swiper('.modal-swiper', {
                loop: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });

            // Modal functionality
            const modal = document.getElementById('imageModal');
            const closeModal = document.getElementById('closeModal');
            const swiperContainer = document.querySelector('.swiper-container');
            const thumbnails = document.querySelectorAll('.thumbnail');

            // Open modal when clicking on main swiper
            swiperContainer.addEventListener('click', function() {
                const activeIndex = mainSwiper.realIndex;
                modal.style.display = 'flex';
                modalSwiper.slideToLoop(activeIndex);
                modalSwiper.update();
            });

            // Open modal and jump to specific slide when clicking on thumbnail
            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    const index = parseInt(this.getAttribute('data-index'));
                    modal.style.display = 'flex';
                    modalSwiper.slideToLoop(index);
                    modalSwiper.update();
                });
            });

            // Close modal
            closeModal.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            // Close modal when clicking outside the swiper
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
            });

            // Map initialization for the "Map" tab only
            let map = null;

            function initializeMap() {
                if (!map) {
                    const mapElement = document.getElementById('tab-map');
                    if (mapElement) {
                        map = L.map('tab-map', {
                            center: [<?php echo $item['lat']; ?>, <?php echo $item['lng']; ?>],
                            zoom: 15,
                            scrollWheelZoom: false,
                            fadeAnimation: true,
                        });

                        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                            attribution: '© OpenStreetMap contributors © <a href="https://carto.com/">CARTO</a>',
                            subdomains: 'abcd',
                            maxZoom: 19,
                        }).addTo(map);

                        L.marker([<?php echo $item['lat']; ?>, <?php echo $item['lng']; ?>]).addTo(map);
                    }
                } else {
                    map.invalidateSize();
                }
            }

            // Tab switching functionality
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Remove active class from all buttons and contents
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));

                    // Add active class to the clicked button and corresponding content
                    button.classList.add('active');
                    const tabId = button.getAttribute('data-tab');
                    const targetContent = document.getElementById(tabId);
                    if (targetContent) {
                        targetContent.classList.add('active');
                        // Only initialize the map if the "Map" tab is active
                        if (tabId === 'map') {
                            initializeMap();
                        }
                    }
                });
            });

            // Initialize the map for the default active tab ("Map")
            initializeMap();
        });
    </script>
<?php endforeach ?>

<?php get_footer(); ?>