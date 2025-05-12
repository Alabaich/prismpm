<?php
/* Template Name: Single Property */

get_header();

// Get the current URL
$current_url = home_url(add_query_arg([]));

// Parse the URL
$parsed_url = wp_parse_url($current_url);

// Parse query string
parse_str($parsed_url['query'] ?? '', $query_params);

// Get 'arg'
$arg = $query_params['arg'] ?? null;

if ($arg) {
    $conn = new mysqli("5.161.90.110", "root", "exampleqi", "prismpm");

    // Fetch unit, building, and media data
    $stmt = $conn->prepare("SELECT DISTINCT u.*, b.city, b.address, b.province, b.coordinates, b.filename AS foldername, m.gallery, u.floorplan 
                           FROM units u 
                           JOIN building b ON b.id = u.building_id 
                           LEFT JOIN media m ON m.building_id = b.id 
                           WHERE u.id = ? LIMIT 1");
    $stmt->bind_param("i", $arg);

    $stmt->execute();
    $res = $stmt->get_result();
    $data = [];


    while ($row = $res->fetch_assoc()) {
        // Parse the coordinates field, which is a JSON array like [lng, lat] (e.g., [-78.95943, 43.89701])
        if (!empty($row['coordinates']) && is_string($row['coordinates'])) {
            $coords = json_decode($row['coordinates'], true);
            $row['lng'] = isset($coords[0]) && is_numeric($coords[0]) ? floatval($coords[0]) : -79.3832;
            $row['lat'] = isset($coords[1]) && is_numeric($coords[1]) ? floatval($coords[1]) : 43.6532;
        } else {
            $row['lat'] = 43.6532;
            $row['lng'] = -79.3832;
        }

        // Parse gallery JSON
        $row['gallery_images'] = !empty($row['gallery']) && is_string($row['gallery']) ? json_decode($row['gallery'], true) : [];

        // Fetch all amenities for this building
        $building_id = $row['building_id'];
        $amenity_stmt = $conn->prepare("SELECT id, building_id, share_unit, text FROM amenities WHERE building_id = ?");
        $amenity_stmt->bind_param("i", $building_id);
        $amenity_stmt->execute();
        $amenity_result = $amenity_stmt->get_result();
        $amenities_data = [];
        while ($amenity_row = $amenity_result->fetch_assoc()) {
            $amenities_data[] = $amenity_row;
        }
        $row['amenities_data'] = $amenities_data;

        $data[] = $row;
        $amenity_stmt->close();
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No unit ID provided in the URL.<br>";
}

?>


    <style>
        body { background-color: #f3f4f6; font-family: Arial, sans-serif; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .main-content { display: flex; gap: 20px; }
        .image-section { width: 50%; }
        .image-placeholder .main-img { height: 256px; background-color: #e5e7eb; border-radius: 8px; margin-bottom: 16px; overflow: hidden; }
        .image-placeholder .main-img img { width: 100%; height: 100%; object-fit: cover; }
        .image-placeholder .gallery { display: flex; gap: 10px; }
        .image-placeholder .gallery div { height: 96px; width: 33%; background-color: #e5e7eb; border-radius: 8px; overflow: hidden; }
        .image-placeholder .gallery div img { width: 100%; height: 100%; object-fit: cover; }
        .floorplan { margin-top: 16px; }
        .floorplan img { max-width: 100%; border-radius: 8px; }
        .map-container { width: 100%; height: 300px; border-radius: 8px; margin-top: 16px; }
        .details { width: 50%; display: flex; flex-direction: column; }
        .title { font-size: 24px; font-weight: bold; color: #1f2937; text-transform: uppercase; margin-bottom: 20px; }
        .tags { display: flex; gap: 10px; margin-bottom: 20px; }
        .tags span { background-color: #e5e7eb; color: #4b5563; font-size: 12px; font-weight: bold; padding: 4px 10px; border-radius: 9999px; }
        .price-section { margin-bottom: 20px; }
        .price { font-size: 30px; font-weight: bold; color: #1f2937; margin-bottom: 10px; }
        .price small { font-size: 14px; font-weight: normal; color: #6b7280; }
        .book-btn { background-color: #2563eb; color: white; padding: 8px 16px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; gap: 8px; width: fit-content; }
        .book-btn:hover { background-color: #1d4ed8; }
        .amenities { flex-grow: 1; }
        .amenities-table { background-color: white; padding: 16px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .amenities-table div { padding: 8px 0; border-bottom: 1px solid #e5e7eb; }
        .amenities-table div:last-child { border-bottom: none; }
        .amenities-table p { color: #4b5563; margin: 0; }
    </style>


    <?php foreach ($data as $item): ?>
        <div class="container">
            <!-- Main Content -->
            <div class="main-content">
                <!-- Image Section (Left) -->
                <div class="image-section">
                    <div class="image-placeholder">
                        <?php if (!empty($item['gallery_images']) && is_array($item['gallery_images'])): ?>
                            <?php $main_image = $item['gallery_images'][0] ?? null; ?>
                            <?php if ($main_image): ?>
                                <div class="main-img">
                                    <img src="https://floorplan.atriadevelopment.ca/<?php echo $item['foldername']; ?>/gallery/<?php echo $main_image; ?>" alt="Main Image">
                                </div>
                            <?php endif; ?>
                            <div class="gallery">
                                <?php for ($i = 0; $i < 3 && $i < count($item['gallery_images']); $i++): ?>
                                    <div><img src="https://floorplan.atriadevelopment.ca/<?php echo $item['foldername']; ?>/gallery/<?php echo $item['gallery_images'][$i]; ?>" alt="Gallery Image"></div>
                                <?php endfor; ?>
                            </div>
                        <?php else: ?>
                            <div class="main-img"></div>
                            <div class="gallery">
                                <div></div><div></div><div></div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- Map Section -->
                    <div class="map-container" id="property-map"></div>
                </div>

                <!-- Details Section (Right) -->
                <div class="details">
                    <!-- Title -->
                    <div class="title">
                        <?php echo (isset($item['bed']) ? $item['bed'] : '') . ' - ' . (isset($item['unit']) ? $item['unit'] : '') . ', ' . (isset($item['address']) ? $item['address'] : '') . ', ' . (isset($item['province']) ? $item['province'] : '') . ', ' . (isset($item['city']) ? $item['city'] : '') . ' ' . (isset($item['postal_code']) ? $item['postal_code'] : ''); ?>
                    </div>

                    <!-- Property Tags -->
                    <div class="tags">
                        <span><?php echo $item['bed']; ?> Bedroom</span>
                        <span><?php echo $item['bath']; ?> Bathroom</span>
                        <span>Apartment Building</span>
                        <span>Pet-Friendly</span>
                    </div>

                    <!-- Rent Price -->
                    <div class="price-section">
                        <p class="price">$<?php echo number_format($item['market_rent'], 2); ?><small>/month</small></p>
                        <button class="book-btn">Book A View <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5l7 7-7 7"></path></svg></button>
                    </div>

                    <!-- Amenities Section -->
                    <div class="amenities">
                        <h2 style="font-size: 18px; font-weight: bold; color: #1f2937; margin-bottom: 16px;">Amenities</h2>
                        <div class="amenities-table">
                            <?php if (!empty($item['amenities_data'])): ?>
                                <?php foreach ($item['amenities_data'] as $amenity): ?>
                                    <div>
                                        <p><?php echo nl2br(htmlspecialchars($amenity['text'])); ?></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div><p>No amenities available</p></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Leaflet Setup -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const lat = <?php echo json_encode($item['lat']); ?>;
                const lng = <?php echo json_encode($item['lng']); ?>;

                console.log("Latitude:", lat, "Longitude:", lng);

                const map = L.map('property-map', {
                    center: [lat, lng],
                    zoom: 15,
                    scrollWheelZoom: false,
                    fadeAnimation: true,
                });

                L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                    attribution: '© OpenStreetMap contributors © <a href="https://carto.com/">CARTO</a>',
                    subdomains: 'abcd',
                    maxZoom: 19,
                }).addTo(map);

                L.marker([lat, lng]).addTo(map);
            });
        </script>
    <?php endforeach ?>



<?php get_footer(); ?>