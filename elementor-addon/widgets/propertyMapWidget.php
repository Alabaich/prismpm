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
                width: 50%;
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
                width: 50%;
            }
    
            .map-container {
                width: 100%;
                height: 400px;
                border: 1px solid #ccc;
                margin-bottom: 15px;
            }
    
            .property-info .property-images {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
            }
    
            .property-info .property-images img {
                max-width: 150px;
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
                          data-images='<?php echo json_encode($property['property_images']); ?>'>
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
    
                const marker = L.marker([0, 0]).addTo(map);
    
                const propertyImages = document.querySelector(".property-images");
    
                const buttons = document.querySelectorAll(".property-link");
                buttons.forEach(button => {
                    button.addEventListener("click", function () {
                        const lat = parseFloat(this.getAttribute("data-lat"));
                        const lng = parseFloat(this.getAttribute("data-lng"));
                        const images = JSON.parse(this.getAttribute("data-images"));
    
                        // Update map view
                        map.flyTo([lat, lng], 15, { animate: true, duration: 1.5 });
                        marker.setLatLng([lat, lng]);
    
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

