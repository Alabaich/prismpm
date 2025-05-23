<?php
/*
Template Name: Units
*/

get_header();

function custom_add_query_arg($key, $value)
{
    $current_url = home_url($_SERVER['REQUEST_URI']);
    return add_query_arg($key, $value, $current_url);
}

function custom_remove_query_arg($key)
{
    $current_url = home_url($_SERVER['REQUEST_URI']);
    return remove_query_arg($key, $current_url);
}

$current_url = home_url(add_query_arg([]));
$parsed_url = wp_parse_url($current_url);
parse_str($parsed_url['query'] ?? '', $query_params);

$building_ids_allowed = [1, 2, 3, 8];
$building_id_filter = $query_params['building'] ?? null;
$city = $query_params['city'] ?? null;
$baths = $query_params['baths'] ?? null;
$beds = $query_params['beds'] ?? null;
$price_order = $query_params['price_order'] ?? null;

$conn = new mysqli("5.161.90.110", "readonly", "pass", "prismpm");

$sql = "SELECT units.*, building.*, units.id as unit_id, units.unit_of_area as area_sq_ft
        FROM units
        JOIN building ON building.id = units.building_id
        WHERE units.unit_status = 1
        AND units.building_id IN (" . implode(',', $building_ids_allowed) . ")";

$params = [];
$types = "";

if ($building_id_filter) {
    $sql .= " AND units.building_id = ?";
    $params[] = $building_id_filter;
    $types .= "i";
}

if ($city) {
    $sql .= " AND building.city = ?";
    $params[] = $city;
    $types .= "s";
}

if ($baths) {
    $sql .= " AND units.bath = ?";
    $params[] = $baths;
    $types .= "i";
}

if ($beds) {
    $sql .= " AND units.bed = ?";
    $params[] = $beds;
    $types .= "i";
}

if ($price_order === 'asc') {
    $sql .= " ORDER BY units.market_rent ASC";
} elseif ($price_order === 'desc') {
    $sql .= " ORDER BY units.market_rent DESC";
}

if (!empty($params)) {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $res = $stmt->get_result();
    $data = $res->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    $res = $conn->query($sql);
    $data = $res->fetch_all(MYSQLI_ASSOC);
}

foreach ($data as &$unit) {
    $media_sql = "SELECT media.gallery as m_gallery, media.share_unit
                 FROM media
                 WHERE media.building_id = ?
                 AND (
                     JSON_CONTAINS(media.share_unit, JSON_QUOTE(?))
                     OR JSON_LENGTH(media.share_unit) = 0
                 )
                 ORDER BY JSON_LENGTH(media.share_unit) DESC
                 LIMIT 1";
    
    $stmt = $conn->prepare($media_sql);
    $stmt->bind_param("is", $unit['building_id'], $unit['floorplan']);
    $stmt->execute();
    $media_res = $stmt->get_result();
    $media_row = $media_res->fetch_assoc();
    $stmt->close();
    
    $imgs = [];
    $folder = $unit['filename'];
    
    if ($media_row && !empty($media_row['m_gallery'])) {
        foreach (json_decode($media_row['m_gallery'], true) as $gallery) {
            $imgs[] = "https://floorplan.atriadevelopment.ca/$folder/gallery/$gallery";
        }
    }
    
    $unit['img'] = empty($imgs) ? 
        "https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png" : 
        $imgs[0];
}

$res_build = $conn->query("SELECT * FROM building WHERE id IN (" . implode(',', $building_ids_allowed) . ")");
$data_build = [];
while ($row_build = $res_build->fetch_assoc()) {
    $data_build[] = $row_build;
}
$data_build_filtered = [];
$seen_building_ids = [];

foreach ($data as $item) {
    if (!in_array($item['building_id'], $seen_building_ids)) {
        $data_build_filtered[] = [
            'id' => $item['building_id'],
            'name' => $item['name']
        ];
        $seen_building_ids[] = $item['building_id'];
    }
}

$res_cities = $conn->query("SELECT DISTINCT city FROM building WHERE id IN (" . implode(',', $building_ids_allowed) . ")");
$data_cities = [];
while ($row_city = $res_cities->fetch_assoc()) {
    if (!empty(trim($row_city['city']))) {
        $data_cities[] = $row_city['city'];
    }
}
$data_cities_filtered = array_unique(array_column($data, 'city'));

$res_baths = $conn->query("SELECT DISTINCT bath FROM units WHERE building_id IN (" . implode(',', $building_ids_allowed) . ") ORDER BY bath ASC");
$data_baths = [];
while ($row_bath = $res_baths->fetch_assoc()) {
    $data_baths[] = $row_bath['bath'];
}
$data_baths_filtered = array_unique(array_column($data, 'bath'));
sort($data_baths_filtered);

$res_beds = $conn->query("SELECT DISTINCT bed FROM units WHERE building_id IN (" . implode(',', $building_ids_allowed) . ") ORDER BY bed ASC");
$data_beds = [];
while ($row_bed = $res_beds->fetch_assoc()) {
    $data_beds[] = $row_bed['bed'];
}
$data_beds_filtered = [];
foreach ($data as $unit) {
    if (isset($unit['bed']) && $unit['bed'] > 0 && !in_array($unit['bed'], $data_beds_filtered)) {
        $data_beds_filtered[] = $unit['bed'];
    }
}
sort($data_beds_filtered);

$total_units = count($data);
?>

<style>
    .full-width-suites {
        font-family: "Inter Tight", sans-serif;
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .section-title {
        font-size: 2.5rem;
        margin-bottom: 2rem;
        color: #2A2A2A;
        text-align: center;
    }

    .full-width-suites .section-title {
        font-family: Playfair Display;
        font-weight: 600;
        font-size: 48px;
        color: #000000;
        text-align: center;
        margin: 0;
    }

    .full-width-suites .section-subtitle {
        font-family: Inter Tight;
        font-weight: 400;
        font-size: 16px;
        text-align: center;
        color: #6D6D6D;
    }

    .suites-list {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .suite-item {
        display: flex;
        border: 1px solid #e0e0e0;
        border-radius: 0.5rem;
        background: white;
        transition: box-shadow 0.2s ease;
        overflow: hidden;
    }

    .suite-item:hover {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .suite-image {
        width: 300px;
        min-height: 100%;
        flex-shrink: 0;
        padding: 1rem;
        background-color: #093D5F0D;
    }

    .suite-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
    }

    .suite-content {
        flex: 1;
        display: flex;
        padding: 1.5rem;
        justify-content: space-between;
        background: #093D5F0D;
    }

    .suite-info {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .suite-info .upperBuildingInfo {
        display: flex;
        align-items: start;
        flex-direction: column;
        gap: 1rem;
    }

    .suite-title {
        font-size: 1.5rem;
        margin: 0;
        color: #2A2A2A;
        font-weight: 600;
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

    .tag-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: white;
        padding: 0.5rem 1rem;
        border-radius: 999px;
        border: 1px solid #e0e0e0;
        font-size: 0.9rem;
    }

    .tag-item span {
        color: #000000;
    }

    .tag-item svg {
        width: 18px;
        height: 18px;
    }

    .suite-price-section {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: space-between;
    }

    .suite-price {
        text-align: right;
    }

    .price-amount {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2A2A2A;
    }

    .price-period {
        color: #6B7280;
        font-size: 0.8rem;
    }

    .wishlist {
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        transition: transform 0.3s ease;
    }

    .wishlist:hover {
        background-color: transparent;
    }

    .heart-icon {
        width: 24px;
        height: 24px;
        color: gray;
        transition: color 0.3s ease;
    }

    .wishlist:hover .heart-icon {
        color: #ff0000;
    }

    .wishlist:hover {
        transform: scale(1.1);
    }

    .wishlist:active {
        transform: scale(0.9);
    }

    .wishlist-notification {
        position: fixed;
        left: 50%;
        transform: translateX(-50%);
        top: 50px;
        background-color: #81C784;
        color: white;
        padding: 15px 20px;
        border-radius: 8px;
        z-index: 1000;
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        font-size: 1rem;
    }

    .wishlist-notification.show {
        opacity: 1;
    }

    .filters-container {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 2rem;
        margin-top: 2rem;
        align-items: flex-end;
    }

    .suite-price-section button:focus {
        background-color: transparent;
    }

    .suite-price-section button {
        color: transparent;
    }

    .filter-group {
        flex: 1;
        min-width: 150px;
    }

    .filter-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        color: #2A2A2A;
        font-weight: 500;
    }

    .custom-select {
        position: relative;
        width: 100%;
    }

    .custom-select select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        width: 100%;
        padding: 10px 16px;
        font-size: 0.9rem;
        border: 1px solid #ddd;
        border-radius: 6px;
        background-color: white;
        color: #2A2A2A;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: "Inter Tight", sans-serif;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .custom-select select:focus {
        outline: none;
        border-color: #093D5F;
        box-shadow: 0 0 0 2px rgba(9, 61, 95, 0.2);
    }

    .custom-arrow {
        position: absolute;
        top: 50%;
        right: 12px;
        transform: translateY(-50%);
        pointer-events: none;
        color: transparent;
        font-size: 0;
        width: 13px;
        height: 7px;
        background-image: url('data:image/svg+xml;utf8,<svg width="13" height="7" viewBox="0 0 13 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.6676 0.832926L6.33431 6.16626L1.00098 0.832926" stroke="%232A2A2A" stroke-width="1.52381" stroke-linecap="round" stroke-linejoin="round"/></svg>');
        background-repeat: no-repeat;
        background-position: center;
        transition: transform 0.2s ease, background-image 0.2s ease;
    }

    .custom-select:hover .custom-arrow {
        background-image: url('data:image/svg+xml;utf8,<svg width="13" height="7" viewBox="0 0 13 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.6676 0.832926L6.33431 6.16626L1.00098 0.832926" stroke="%23093D5F" stroke-width="1.52381" stroke-linecap="round" stroke-linejoin="round"/></svg>');
    }

    .custom-select select:focus+.custom-arrow {
        transform: translateY(-50%) rotate(180deg);
        background-image: url('data:image/svg+xml;utf8,<svg width="13" height="7" viewBox="0 0 13 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.6676 0.832926L6.33431 6.16626L1.00098 0.832926" stroke="%23093D5F" stroke-width="1.52381" stroke-linecap="round" stroke-linejoin="round"/></svg>');
    }

    .heart-icon path.filled {
        fill: #ff0000;
        stroke: #ff0000;
    }

    @media (max-width: 768px) {
        .suite-item {
            flex-direction: column;
        }

        .full-width-suites .section-title {
            font-size: 32px;
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
        }

        .suite-price {
            text-align: left;
        }

        .filters-container {
            flex-direction: column;
            gap: 1.5rem;
        }

        .filter-group {
            min-width: 100%;
            max-width: 100%;
        }

        .suites-list .suite-content {
            padding: 1rem;
        }

        .suites-list .suite-content .suite-info {
            gap: 1rem;
        }

        .suites-list .suite-content .suite-tags {
            gap: 0.5rem;
        }
    }
</style>

<section class="full-width-suites">
    <h2 class="section-title">Available Units</h2>
    <p class="section-subtitle">Beautiful apartments with modern appliances, in-suite laundry, quality finishes, and state-of-the-art technologies.</p>

    <div class="filters-container">
        <?php
        function render_filter($id, $label, $options, $selected_value, $query_key)
        {
        ?>
            <div class="filter-group">
                <label for="<?= $id ?>"><?= $label ?></label>
                <div class="custom-select">
                    <select id="<?= $id ?>" onchange="location.href=this.value">
                        <option value="<?= esc_url(custom_remove_query_arg($query_key)) ?>">All <?= $label ?></option>
                        <?php foreach ($options as $value) :
                            $display = is_array($value) ? $value['name'] : $value;
                            $val = is_array($value) ? $value['id'] : $value;
                        ?>
                            <option value="<?= esc_url(custom_add_query_arg($query_key, $val)) ?>" <?= $selected_value == $val ? 'selected' : '' ?>>
                                <?= esc_html($display) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="custom-arrow"></span>
                </div>
            </div>
        <?php
        }


        if ($building_id_filter) {
            render_filter("building-filter", "Building", $data_build, $building_id_filter, "building");
        } else {
            render_filter("building-filter", "Building", $data_build_filtered, $building_id_filter, "building");
        }

        if ($city) {
            render_filter("city-filter", "City", $data_cities, $city, "city");
        } else {
            render_filter("city-filter", "City", $data_cities_filtered, $city, "city");
        }

        if ($baths) {
            render_filter("baths-filter", "Bath(s)", $data_baths, $baths, "baths");
        } else {
            render_filter("baths-filter", "Bath(s)", $data_baths_filtered, $baths, "baths");
        }

        if ($beds) {
            render_filter("beds-filter", "Bedroom(s)", $data_beds, $beds, "beds");
        } else {
            render_filter("beds-filter", "Bedroom(s)", $data_beds_filtered, $beds, "beds");
        }

        ?>
        <div class="filter-group">
            <label for="price-filter">Price</label>
            <div class="custom-select">
                <select id="price-filter" onchange="location.href=this.value">
                    <option value="<?= esc_url(custom_remove_query_arg('price_order')) ?>">Default</option>
                    <option value="<?= esc_url(custom_add_query_arg('price_order', 'asc')) ?>" <?= $price_order === 'asc' ? 'selected' : '' ?>>Low to High</option>
                    <option value="<?= esc_url(custom_add_query_arg('price_order', 'desc')) ?>" <?= $price_order === 'desc' ? 'selected' : '' ?>>High to Low</option>
                </select>
                <span class="custom-arrow">▼</span>
            </div>
        </div>
    </div>

    <p style="color: #888; font-size: 14px; margin-top: 10px;">
        Showing <?= $total_units ?> rental suite<?= $total_units === 1 ? '' : 's' ?>.
    </p>

    <div class="suites-list">
        <?php foreach ($data as $item) :

        ?>
            <a href='/oneUnit?arg=<?= $item['unit_id'] ?>' class="suite-item">

                <div class="suite-image">
                    <img src="<?= $item['img'] ?>" />
                </div>

                <div class="suite-content">
                    <div class="suite-info">
                        <div class="upperBuildingInfo">
                            <h3 class="suite-title">
                                <?php
                                $bedrooms = isset($item['bed']) ? intval($item['bed']) : 0;
                                $bedroom_text = '';
                                if ($bedrooms > 0) {
                                    $bedroom_text = $bedrooms . ' Bed';
                                }
                                $unit_info_parts = [];
                                if ($bedrooms > 0) {
                                    $unit_info_parts[] = $bedroom_text;
                                }
                                if (isset($item['unit'])) {
                                    $unit_info_parts[] = $item['unit'];
                                }
                                if (isset($item['address'])) {
                                    $unit_info_parts[] = $item['address'];
                                }
                                if (isset($item['city'])) {
                                    $unit_info_parts[] = $item['city'];
                                }
                                if (isset($item['province'])) {
                                    $unit_info_parts[] = $item['province'];
                                }
                                if (isset($item['postal_code'])) {
                                    $unit_info_parts[] = $item['postal_code'];
                                }

                                echo implode(', ', array_filter($unit_info_parts));
                                ?>
                            </h3>
                            <div class="suite-availability">
                                <span class="availability-dot">●</span>
                                <span class="availability-text">Available</span>
                            </div>
                        </div>
                        <div class="suite-tags">
                            <?php if ($item['bed'] > 0) : ?>
                                <div class="tag-item">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.75 4.58325V17.4166M2.75 14.6666H19.25M19.25 17.4166V12.0999C19.25 11.0732 19.25 10.5597 19.0502 10.1676C18.8744 9.82264 18.5939 9.54214 18.249 9.36642C17.8569 9.16659 17.3434 9.16659 16.3167 9.16659H10.0833V14.4166M6.41667 10.9999H6.42583M7.33333 10.9999C7.33333 11.5062 6.92292 11.9166 6.41667 11.9166C5.91041 11.9166 5.5 11.5062 5.5 10.9999C5.5 10.4936 5.91041 10.0833 6.41667 10.0833C6.92292 10.0833 7.33333 10.4936 7.33333 10.9999Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span><?php echo $item['bed']; ?> Bedroom</span>
                                </div>
                            <?php endif; ?>

                            <?php if ($item['bath'] > 0) : ?>
                                <div class="tag-item">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.7572 5.56968C10.5359 5.85004 9.625 6.94364 9.625 8.25V8.9375H15.125V8.25C15.125 7.01287 14.3081 5.96653 13.1842 5.621C13.4001 5.1442 13.8801 4.8125 14.4375 4.8125C15.1969 4.8125 15.8125 5.42811 15.8125 6.1875V11.6875H4.125V13.0625H4.8125V16.5C4.8125 17.6391 5.73591 18.5625 6.875 18.5625H15.125C16.264 18.5625 17.1875 17.6391 17.1875 16.5V13.0625H17.875V11.6875H17.1875V6.1875C17.1875 4.66872 15.9563 3.4375 14.4375 3.4375C13.1312 3.4375 12.0376 4.34839 11.7572 5.56968ZM6.1875 13.0625H15.8125V16.5C15.8125 16.8797 15.5047 17.1875 15.125 17.1875H6.875C6.49531 17.1875 6.1875 16.8797 6.1875 16.5V13.0625ZM12.375 6.875C12.8839 6.875 13.3283 7.15151 13.566 7.5625H11.184C11.4217 7.15151 11.8661 6.875 12.375 6.875Z" fill="black" />
                                    </svg>
                                    <span><?php echo $item['bath']; ?> Bathroom</span>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($item['unit_of_area']) && $item['unit_of_area'] > 0) : ?>
                                <div class="tag-item">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.33333 2.75H4.58333C4.0971 2.75 3.63079 2.94315 3.28697 3.28697C2.94315 3.63079 2.75 4.0971 2.75 4.58333V7.33333M19.25 7.33333V4.58333C19.25 4.0971 19.0568 3.63079 18.713 3.28697C18.3692 2.94315 17.9029 2.75 17.4167 2.75H14.6667M14.6667 19.25H17.4167C17.9029 19.25 18.3692 19.0568 18.713 18.713C19.0568 18.3692 19.25 17.9029 19.25 17.4167V14.6667M2.75 14.6667V17.4167C2.75 17.9029 2.94315 18.3692 3.28697 18.713C3.63079 19.0568 4.0971 19.25 4.58333 19.25H7.33333" stroke="#1E1E1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span><?php echo $item['unit_of_area']; ?> sq ft</span>
                                </div>
                            <?php endif; ?>

                            <div class="tag-item">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.04293 15.3542C3.82293 18.0034 5.82126 20.1667 8.47959 20.1667H12.8704C15.8587 20.1667 17.9121 17.7559 17.4171 14.8042C16.8946 11.7059 13.9062 9.16675 10.7621 9.16675C7.35209 9.16675 4.32709 11.9534 4.04293 15.3542Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9.59736 6.87508C10.863 6.87508 11.889 5.84907 11.889 4.58341C11.889 3.31776 10.863 2.29175 9.59736 2.29175C8.33168 2.29175 7.30566 3.31776 7.30566 4.58341C7.30566 5.84907 8.33168 6.87508 9.59736 6.87508Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M15.8587 7.97502C16.8713 7.97502 17.6921 7.15421 17.6921 6.14168C17.6921 5.12916 15.8587 4.30835 15.8587 4.30835C14.8463 4.30835 14.0254 5.12916 14.0254 6.14168C14.0254 7.15421 14.8463 7.97502 15.8587 7.97502Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M19.25 11.6416C20.0094 11.6416 20.625 11.026 20.625 10.2666C20.625 9.50719 20.0094 8.8916 19.25 8.8916C18.4906 8.8916 17.875 9.50719 17.875 10.2666C17.875 11.026 18.4906 11.6416 19.25 11.6416Z" stroke="black" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M3.639 9.80831C4.65152 9.80831 5.47233 8.98746 5.47233 7.97493C5.47233 6.96241 4.65152 6.1416 3.639 6.1416C2.62647 6.1416 1.80566 6.96241 1.80566 7.97493C1.80566 8.98746 2.62647 9.80831 3.639 9.80831Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span>Pet friendly</span>
                            </div>
                        </div>
                    </div>

                    <div class="suite-price-section">
                        <div class="suite-price">
                            <div class="price-amount">$<?= esc_html($item['market_rent']) ?></div>
                            <div class="price-period">month</div>
                        </div>

                        <button class="wishlist">
                            <svg class="heart-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 21.35L10.55 20.03C5.4 15.36 2 12.28 2 8.5C2 5.42 4.42 3 7.5 3C9.24 3 10.91 3.81 12 5.09C13.09 3.81 14.76 3 16.5 3C19.58 3 22 5.42 22 8.5C22 12.28 18.6 15.36 13.45 20.03L12 21.35Z"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2" />
                            </svg>
                        </button>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>

    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const wishlistButtons = document.querySelectorAll('.wishlist');

        function toggleWishlistItem(unitId) {
            const wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
            const index = wishlist.indexOf(unitId);
            let added = false;

            if (index === -1) {
                wishlist.push(unitId);
                showWishlistMessage(unitId, 'added to', 'green');
                added = true;
            } else {
                wishlist.splice(index, 1);
                showWishlistMessage(unitId, 'removed from', 'red');
                added = false;
            }

            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            return added;
        }

        function isInWishlist(unitId) {
            const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
            return wishlist.includes(unitId);
        }

        function showWishlistMessage(unitId, action, color) {
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('wishlist-notification');
            messageDiv.textContent = `Suite ${unitId} ${action} favorites!`;
            messageDiv.style.backgroundColor = color;
            document.body.appendChild(messageDiv);

            setTimeout(() => {
                messageDiv.classList.add('show');
            }, 10);

            setTimeout(() => {
                messageDiv.classList.remove('show');
                setTimeout(() => {
                    messageDiv.remove();
                }, 500);
            }, 2000);
        }

        function markWishlistItems() {
            const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
            const links = document.querySelectorAll('.suite-item');

            links.forEach(link => {
                const href = link.getAttribute('href');
                const unitId = extractUnitIdFromHref(href);
                const heartIconPath = link.querySelector('.wishlist .heart-icon path');

                if (unitId && wishlist.includes(unitId)) {
                    if (heartIconPath) {
                        heartIconPath.classList.add('filled');
                    }
                } else {
                    if (heartIconPath) {
                        heartIconPath.classList.remove('filled');
                    }
                }
            });
        }

        function extractUnitIdFromHref(href) {
            const argIndex = href.indexOf('arg=');
            if (argIndex !== -1) {
                let unitId = href.substring(argIndex + 4);
                const ampersandIndex = unitId.indexOf('&');
                if (ampersandIndex !== -1) {
                    unitId = unitId.substring(0, ampersandIndex);
                }
                return unitId;
            }
            return null;
        }

        wishlistButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                event.stopPropagation();

                const link = this.closest('.suite-item');
                if (link) {
                    const href = link.getAttribute('href');
                    const unitId = extractUnitIdFromHref(href);
                    const heartIconPath = this.querySelector('.heart-icon path');

                    if (unitId) {
                        const wasAdded = toggleWishlistItem(unitId);
                        if (heartIconPath) {
                            if (wasAdded) {
                                heartIconPath.classList.add('filled');
                            } else {
                                heartIconPath.classList.remove('filled');
                            }
                        }
                        markWishlistItems();
                    }
                }
            });
        });

        markWishlistItems();
    });
</script>

<?php
get_footer();
?>