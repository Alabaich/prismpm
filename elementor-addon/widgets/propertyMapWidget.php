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
                flex-wrap: nowrap;
                gap: 20px;
                padding: 25px 5%;
                width: 100%;
            }
    
            .property-links {
                width: 30%;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }
    
            .property-links button {
                padding: 10px;
                background-color: #08405F;
                color: white;
                border: none;
                cursor: pointer;
                text-align: left;
            }
    
            .property-links button:hover {
                background-color: #062D42;
            }
    
            .map-container {
                width: 70%;
                height: 400px;
                border: 1px solid #ccc;
            }
        </style>
    
        <div class="property-map-container">
            <div class="property-links">
                <?php foreach ($settings['property_list'] as $index => $property) : ?>
                    <button class="property-link" data-lat="<?php echo esc_attr($property['property_lat']); ?>" data-lng="<?php echo esc_attr($property['property_lng']); ?>">
                        <?php echo esc_html($property['property_name']); ?>
                    </button>
                <?php endforeach; ?>
            </div>
            <div id="property-map" class="map-container"></div>
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
    
                // Add a single marker and reuse it for smooth transition
                const marker = L.marker([0, 0]).addTo(map);
    
                const buttons = document.querySelectorAll(".property-link");
                buttons.forEach(button => {
                    button.addEventListener("click", function () {
                        const lat = parseFloat(this.getAttribute("data-lat"));
                        const lng = parseFloat(this.getAttribute("data-lng"));
                        
                        // Smooth panning to the new position
                        map.flyTo([lat, lng], 15, {
                            animate: true,
                            duration: 1.5, // Duration of the animation
                        });
    
                        // Update marker position without re-adding it
                        marker.setLatLng([lat, lng]);
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

