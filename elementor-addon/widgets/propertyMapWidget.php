<?php

class Elementor_PropertyMapWidget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'property_map_widget';
    }

    public function get_title() {
        return esc_html__('Property Map', 'elementor-addon');
    }

    public function get_icon() {
        return 'eicon-map-pin';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'properties_section',
            [
                'label' => esc_html__('Properties', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Control: Property List
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'property_name',
            [
                'label' => esc_html__('Property Name', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Property Name', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'property_description',
            [
                'label' => esc_html__('Property Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Description of the property.', 'elementor-addon'),
            ]
        );
    
        $repeater->add_control(
            'property_images',
            [
                'label' => esc_html__('Property Images', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::GALLERY,
                'default' => [],
            ]
        );

        $repeater->add_control(
            'property_lat',
            [
                'label' => esc_html__('Latitude', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '0',
            ]
        );

        $repeater->add_control(
            'property_lng',
            [
                'label' => esc_html__('Longitude', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '0',
            ]
        );

        $this->add_control(
            'property_list',
            [
                'label' => esc_html__('Properties', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ property_name }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <style>
            .property-map-container {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                padding: 25px 5%;
                width: 100%;
            }
    
            .property-links {
                width: 49%;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }
    
            .property-links .property-link {
                display: block;
                padding: 10px;
                cursor: pointer;
                background-color: transparent;
                border: 1px solid transparent;
                border-radius: 5px;
                text-align: left;
                transition: background-color 0.3s, border-color 0.3s;
            }
    
            .property-links .property-link:hover {
                background-color: rgba(0, 0, 0, 0.05);
                border-color: #ccc;
            }
    
            .property-links .property-link strong {
                font-size: 16px;
                font-weight: bold;
            }
    
            .property-links .property-link p {
                margin: 5px 0 0;
                font-size: 14px;
                color: #666;
            }
    
            .mapContainer {
                width: 49%;
            }
    
            .map-container {
                width: 100%;
                height: 400px;
                border: 1px solid #ccc;
                margin-bottom: 15px;
            }
    
            .property-info .property-images {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 3 equal columns */
    gap: 10px; /* Gap between images */
}

.property-info .property-images img {
    width: 100%; /* Images fill their grid cell */
    border: 1px solid #ccc;
    border-radius: 5px;
}

        </style>
    
        <div class="property-map-container">
            <div class="property-links">
                <h3>Discover Our Rental Properties</h3>
                <?php foreach ($settings['property_list'] as $index => $property) : ?>
                    <span class="property-link" 
                          data-lat="<?php echo esc_attr($property['property_lat']); ?>" 
                          data-lng="<?php echo esc_attr($property['property_lng']); ?>" 
                          data-description="<?php echo esc_attr($property['property_description']); ?>" 
                          data-images='<?php echo json_encode($property['property_images']); ?>'
                          <?php echo $index === 0 ? 'data-active="true"' : ''; ?>>
                        <strong><?php echo esc_html($property['property_name']); ?></strong>
                        <p><?php echo esc_html($property['property_description']); ?></p>
                    </span>
                <?php endforeach; ?>
            </div>
            <div class="mapContainer">
                <div id="property-map" class="map-container"></div>
                <div class="property-info">
                    <div class="property-images"></div>
                </div>
            </div>
        </div>
    
        <script>
    document.addEventListener("DOMContentLoaded", function () {
        const map = L.map('property-map', {
            zoom: 13,
            center: [0, 0],
            scrollWheelZoom: false,
            fadeAnimation: true,
        });

        // Use Carto Positron tile layer
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; OpenStreetMap contributors &copy; <a href="https://carto.com/">CARTO</a>',
            subdomains: 'abcd',
            maxZoom: 19,
        }).addTo(map);

        // Custom marker icons
        const activeIcon = L.divIcon({
            html: `
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="40" viewBox="0 0 30 40" fill="none">
                    <g clip-path="url(#clip0_57_2)">
                        <path d="M30 0H0V30.1838H30V0Z" fill="#083E5F"/>
                        <path d="M15 40L10.4079 31.9974L5.81516 23.9948H15H24.1848L19.5921 31.9974L15 40Z" fill="#083E5F"/>
                        <path d="M14.9926 21.6994H8.54079L15.0532 17.48L21.324 20.556H24.4033L20.6092 13.9428L14.9926 4.16359L9.38349 13.9428L3.77434 23.722H13.9383L15.9412 21.7068H14.9926V21.6994ZM18.9753 14.7912L21.2413 18.7379L15.7906 16.0713V9.23882L18.9679 14.7759L18.9753 14.7912ZM11.0248 14.7764L14.202 9.23939V16.1322L7.90805 20.2075L11.0248 14.7764Z" fill="white"/>
                        <path d="M25.0581 21.6994L22.9426 21.7068H17.4393L15.4364 23.722H26.2251L25.0581 21.6994Z" fill="white"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_57_2">
                            <rect width="30" height="40" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>
            `,
            className: '',
            iconSize: [30, 40],
            iconAnchor: [15, 40],
        });

        const inactiveIcon = L.divIcon({
            html: `
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="40" viewBox="0 0 30 40" fill="none">
                    <g clip-path="url(#clip0_57_2)">
                        <path d="M30 0H0V30.1838H30V0Z" fill="#CCCCCC"/>
                        <path d="M15 40L10.4079 31.9974L5.81516 23.9948H15H24.1848L19.5921 31.9974L15 40Z" fill="#CCCCCC"/>
                        <path d="M14.9926 21.6994H8.54079L15.0532 17.48L21.324 20.556H24.4033L20.6092 13.9428L14.9926 4.16359L9.38349 13.9428L3.77434 23.722H13.9383L15.9412 21.7068H14.9926V21.6994ZM18.9753 14.7912L21.2413 18.7379L15.7906 16.0713V9.23882L18.9679 14.7759L18.9753 14.7912ZM11.0248 14.7764L14.202 9.23939V16.1322L7.90805 20.2075L11.0248 14.7764Z" fill="white"/>
                        <path d="M25.0581 21.6994L22.9426 21.7068H17.4393L15.4364 23.722H26.2251L25.0581 21.6994Z" fill="white"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_57_2">
                            <rect width="30" height="40" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>
            `,
            className: '',
            iconSize: [30, 40],
            iconAnchor: [15, 40],
        });

        const propertyImages = document.querySelector(".property-images");
        const buttons = document.querySelectorAll(".property-link");

        // Store markers to avoid duplicates
        const markers = [];

        // Helper function to update map and images
        const updateProperty = (lat, lng, images, markerIndex) => {
            // Center map on active property
            map.flyTo([lat, lng], 15, { animate: true, duration: 1.5 });

            // Set active icon for the selected property
            markers.forEach((marker, index) => {
                marker.setIcon(index === markerIndex ? activeIcon : inactiveIcon);
            });

            // Update images
            propertyImages.innerHTML = "";
            if (Array.isArray(images)) {
                images.forEach(image => {
                    if (image && image.url) {
                        const img = document.createElement("img");
                        img.src = image.url;
                        img.alt = "Property Image";
                        img.loading = "lazy"; // Lazy loading
                        img.srcset = `
                            ${image.sizes ? image.sizes.medium || image.url : image.url} 1x,
                            ${image.sizes ? image.sizes.large || image.url : image.url} 2x
                        `;
                        propertyImages.appendChild(img);
                    }
                });
            }
        };

        // Add markers for all properties
        buttons.forEach((button, index) => {
            const lat = parseFloat(button.getAttribute("data-lat"));
            const lng = parseFloat(button.getAttribute("data-lng"));
            const images = JSON.parse(button.getAttribute("data-images"));

            // Add marker to the map
            const marker = L.marker([lat, lng], {
                icon: index === 0 ? activeIcon : inactiveIcon, // Active for the first property
            }).addTo(map);

            // Add click event for marker
            marker.on("click", () => {
                updateProperty(lat, lng, images, index);
            });

            // Store marker
            markers.push(marker);

            // Select the first property by default
            if (index === 0) {
                updateProperty(lat, lng, images, index);
            }

            // Add click event for property link
            button.addEventListener("click", function () {
                updateProperty(lat, lng, images, index);
            });
        });
    });
</script>

    
        <link
            rel="stylesheet"
            href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        />
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
        <?php
    }
    
    
}

