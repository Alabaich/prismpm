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
            'property_address',
            [
                'label' => esc_html__('Property Address', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Enter the property address', 'elementor-addon'),
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
            ],
        );

        $repeater->add_control(
            'property_url',
            [
                'label' => esc_html__('Property URL', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('https://example.com', 'elementor-addon'),
                'default' => '',
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
            .propertiesContainer {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                gap: 25px;
                padding: 100px 5%;
                width: 100%;
            }

            .propertiesContainer h3{
                font-family: "Graphik Light", Sans-serif;
    font-size: 50px;
    font-weight: normal;
    color: #093D5F;
            }
            
            .property-map-container {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                width: 100%;
                position: relative;
            }
            
            .property-links {
                width: 39%;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }
            
            /* Each clickable property span */
            .property-link {
                padding: 10px;
                cursor: pointer;
                background-color: transparent;
                border: 1px solid transparent;
                border-radius: 5px;
                text-align: left;
                transition: background-color 0.3s, border-color 0.3s;
                
                /* We use a child container for icon + text in a row or column */
                display: block; /* keep as block so the entire row is clickable */
            }
            
            .property-link:hover {
                background-color: rgba(0, 68, 255, 0.05);
                border-color: transparent;
            }
    
            /* Inner container to hold icon and text side by side (or stacked) */
            .property-link-inner {
                display: flex;
                flex-direction: row; /* or column if you prefer vertical stacking */
                align-items: center;
                gap: 20px;
            }
    
            /* The icon (circle with number) */
            .property-link-icon {
                width: 40px;
                height: 40px;
                flex-shrink: 0;
                display: flex;
                align-items: center;
                justify-content: center;
            }
    
            /* The text (h6 + p) */
            .property-link-text {
                display: flex;
                flex-direction: column;
            }
            
            /* The title is now an H6 */
            .property-link-text h6 {
                color: #093D5F;
                font-size: 1.8em;
                font-weight: bold;
                margin: 0;
            }
            
            .property-link-text p {
                margin: 5px 0 0;
                font-size: 1.3em;
                color: #093D5F;
            }
            
            .mapContainer {
                width: 59%;
                position: relative;
            }
            
            .map-container {
                width: 100%;
                height: 400px;
                border: 1px solid #ccc;
                margin-bottom: 15px;
            }
            
            .property-info-block {
                position: absolute;
                top: 20px;
                right: 20px;
                width: 250px;
                background: white;
                border: 1px solid #ccc;
                border-radius: 5px;
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                padding: 10px;
                z-index: 1000;
                font-family: Arial, sans-serif;
            }
            
            .property-info-block .property-info-title {
                font-size: 16px;
                font-weight: bold;
                margin-bottom: 5px;
            }
            
            .property-info-block .property-info-address {
                font-size: 14px;
                color: #666;
                margin-bottom: 10px;
            }
            
            .property-info-block .property-info-image img {
                width: 100%;
                border-radius: 5px;
            }
            
            .property-info .property-images {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 10px;
            }
            
            .property-info .property-images img {
                width: 100%;
                border: 1px solid #ccc;
                border-radius: 5px;
            }
        </style>
    
        <div class="propertiesContainer">
            <h3>Discover Our Rental Properties</h3>
            <div class="property-map-container">
                <div class="property-links">
                    <?php foreach ($settings['property_list'] as $index => $property) : ?>
                        <span class="property-link" 
                              data-lat="<?php echo esc_attr($property['property_lat']); ?>" 
                              data-lng="<?php echo esc_attr($property['property_lng']); ?>" 
                              data-description="<?php echo esc_attr($property['property_description']); ?>" 
                              data-address="<?php echo esc_attr($property['property_address']); ?>" 
                              data-images='<?php echo json_encode($property['property_images']); ?>'
                              data-url="<?php echo esc_attr($property['property_url']); ?>"
                              <?php echo $index === 0 ? 'data-active="true"' : ''; ?>>
                            
                            <!-- Inner container to hold icon + text -->
                            <div class="property-link-inner">
                                <!-- Icon with a circle and property number -->
                                <div class="property-link-icon">
                                <svg 
                                    xmlns="http://www.w3.org/2000/svg" 
                                    xmlns:xlink="http://www.w3.org/1999/xlink" 
                                    id="Layer_1" 
                                    x="0px" y="0px" 
                                    width="92.088px" 
                                    height="122.036px" 
                                    viewBox="0 0 92.088 122.036" 
                                    style="enable-background:new 0 0 92.088 122.036;" 
                                    xml:space="preserve">
                                    
                                    <style type="text/css"> 
                                        .st0 { fill:#083E5F; }
                                    </style>
                                    <g>
                                        <rect class="st0" width="92.088" height="92.088"/>
                                        <polygon class="st0" points="46.044,122.036 31.947,97.621 17.851,73.205 46.044,73.205 74.237,73.205 60.14,97.621"/>
                                    </g>
                                    <text
                                        x="50%"
                                        y="40%"
                                        text-anchor="middle"
                                        dominant-baseline="middle"
                                        fill="#FFFFFF"
                                        font-size="48"
                                        font-family="inherit">
                                        <?php echo $index + 1; ?>
                                    </text>
                                </svg>
                                </div>
    
                                <!-- Text container -->
                                <div class="property-link-text">
                                    <h6 class="elementor-heading-title elementor-size-default"><?php echo esc_html($property['property_name']); ?></h6>
                                    <p><?php echo esc_html($property['property_description']); ?></p>
                                </div>
                            </div>
                        </span>
                    <?php endforeach; ?>
                </div>
    
                <div class="mapContainer">
                    <div id="property-map" class="map-container"></div>
                    <div class="property-info-block">
    <div class="property-info-title"></div>
    <div class="property-info-address"></div>
    <div class="property-info-image"></div>
    <a href="#" target="_blank" rel="noopener noreferrer" class="property-info-link" style="display: none; color: #093D5F; text-decoration: underline; font-weight: bold; margin-top: 10px;">View Property</a>
</div>

                    <div class="property-info">
                        <div class="property-images"></div>
                    </div>
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
    
                const activeTitle = document.querySelector(".property-info-title");
                const activeAddress = document.querySelector(".property-info-address");
                const activeImage = document.querySelector(".property-info-image");
                const buttons = document.querySelectorAll(".property-link");
                const markers = [];
    
                const updatePropertyInfo = (title, address, imageUrl, url) => {
    const activeTitle = document.querySelector(".property-info-title");
    const activeAddress = document.querySelector(".property-info-address");
    const activeImage = document.querySelector(".property-info-image");
    const activeLink = document.querySelector(".property-info-link");

    // Update title, address, and image
    activeTitle.textContent = title;
    activeAddress.textContent = address;
    activeImage.innerHTML = imageUrl
        ? `<img src="${imageUrl}" alt="Property Image" loading="lazy">`
        : '<p>No Image Available</p>';

    // Update link
    if (activeLink) {
        activeLink.href = url || '#';
        activeLink.style.display = url ? 'block' : 'none';
    }
};


    
                buttons.forEach((button, index) => {
                    const lat = parseFloat(button.getAttribute("data-lat"));
                    const lng = parseFloat(button.getAttribute("data-lng"));
                    // Now we look for <h6> instead of <strong>
                    const title = button.querySelector("h6").textContent;
                    const address = button.getAttribute("data-address");
                    const images = JSON.parse(button.getAttribute("data-images"));
                    const firstImage = images && images[0] ? images[0].url : null;

                    const url = button.getAttribute("data-url");

button.addEventListener("click", () => {
    updatePropertyInfo(title, address, firstImage, url);
});
    
                    const marker = L.marker([lat, lng], {
                        icon: index === 0 ? activeIcon : inactiveIcon,
                    }).addTo(map);
    
                    marker.on("click", () => {
                        map.flyTo([lat, lng], 15, { animate: true, duration: 1.5 });
                        updatePropertyInfo(title, address, firstImage, images);
                        markers.forEach((m, i) => m.setIcon(i === index ? activeIcon : inactiveIcon));
                    });
    
                    markers.push(marker);
    
                    if (index === 0) {
                        map.flyTo([lat, lng], 15, { animate: true, duration: 1.5 });
                        updatePropertyInfo(title, address, firstImage, images);
                    }
    
                    button.addEventListener("click", () => {
                        map.flyTo([lat, lng], 15, { animate: true, duration: 1.5 });
                        updatePropertyInfo(title, address, firstImage, images);
                        markers.forEach((m, i) => m.setIcon(i === index ? activeIcon : inactiveIcon));
                    });
                });
            });
        </script>
    
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
        <?php
    }

}
