<?php
class Elementor_propertyMapWidgetNew extends \Elementor\Widget_Base {

    public function get_name() {
        return 'propertyMapWidgetNew';
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

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Section Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Discover Our Rental Properties', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'section_subtitle',
            [
                'label' => esc_html__('Section Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'elementor-addon'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'number_icon',
            [
                'label' => esc_html__('Number Icon', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'media_types' => ['svg', 'png', 'jpg'],
                'default' => [
                    'url' => '',
                ],
            ]
        );

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
            ]
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
                padding: 100px 80px;
                width: 100%;
            }
            
            .property-link-icon {
                width: 40px;
                height: 40px;
                flex-shrink: 0;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .property-link-icon img {
                width: 100%;
                height: 100%;
                object-fit: contain;
            }

            .propertiesContainer h3 {
                font-size: 52px;
                font-weight: 600;
                color: #2A2A2A;
                margin: 0px;
                font-family: "Playfair Display", serif;
            }

            .property-map-container {
                display: flex;
                flex-wrap: wrap;
                gap: 1.25rem;
                width: 100%;
                position: relative;
            }

            .property-links {
                width: 39%;
                display: flex;
                flex-direction: column;
                gap: 0.625rem;
            }

            .property-link {
                padding: 0.625rem;
                cursor: pointer;
                background-color: transparent;
                border: 0.0625rem solid transparent;
                border-radius: 0.3125rem;
                text-align: left;
                transition: background-color 0.3s, border-color 0.3s;
                display: block;
            }

            .property-link:hover {
                background-color: rgba(0, 68, 255, 0.05);
                border-color: transparent;
            }

            .property-link-inner {
                display: flex;
                flex-direction: row;
                align-items: center;
                gap: 1.25rem;
            }

            .property-link-icon {
                width: 2.5rem;
                height: 2.5rem;
                flex-shrink: 0;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .property-link-text {
                display: flex;
                flex-direction: column;
                flex-grow: 1;
            }

            .property-link-text h6 {
                font-family: "Darker Grotesque", sans-serif;
                color: #2A2A2A;
                font-size: 32px;
                margin: 0;
            }

            .property-link-text p {
                margin: 0.3125rem 0 0;
                font-size: 1.3em;
                color: #2A2A2A;
            }

            .property-description {
                margin-top: 0.625rem;
                font-size: 1rem;
                font-family: "Inter Tight", sans-serif;
                color: #2A2A2A;
                display: none;
            }

            .property-description.visible {
                display: block;
            }

            .toggle-icon {
                cursor: pointer;
                font-size: 2.5em;
                color: #2A2A2A;
                transition: transform 0.3s;
            }

            .toggle-icon.active {
                transform: rotate(180deg);
            }

            .mapContainer {
                width: 59%;
                position: relative;
                z-index: 2;
            }

            .map-container {
                width: 100%;
                height: 25rem;
                border: 0.0625rem solid #ccc;
                margin-bottom: 0.9375rem;
            }

            .property-info-block {
                position: absolute;
                top: 1.25rem;
                right: 1.25rem;
                width: 15.625rem;
                background: white;
                border: 0.0625rem solid #ccc;
                border-radius: 0.3125rem;
                box-shadow: 0 0.25rem 0.375rem rgba(0, 0, 0, 0.1);
                padding: 0.625rem;
                z-index: 1000;
                font-family: Arial, sans-serif;
            }

            .property-info-block .property-info-title {
                font-size: 1rem;
                font-weight: bold;
                margin-bottom: 0.3125rem;
            }

            .property-info-block .property-info-address {
                font-size: 0.875rem;
                color: #666;
                margin-bottom: 0.625rem;
            }

            .property-info-block .property-info-image img {
                width: 100%;
                border-radius: 0.3125rem;
            }

            .property-info .property-images {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 10px;
            }

            .property-info .property-images img {
                display: none;
                width: 100%;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            .hidden {
                display: none;
            }

            .qwe {
                width: 100%;
                background: #093D5F;
                display: flex;
                align-items: center;
                justify-content: space-between;
                border: #093D5F;
                padding: 0.625rem 1rem;
                border-radius: 90px;
                color: white;
                cursor: pointer;
                margin-top: 0.625rem;
            }

            .qwe:hover {
                background: #093D5F;
            }

            .qwe i {
                color: white;
            }

            .ffffwqdsad {
                margin: 0px;
                font-family: "Inter Tight", sans-serif;
                font-size: 1rem;
                color: #52525B;
                max-width: 436px;
                margin: auto;
                text-align: center;
            }

            .property-number-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #093D5F;
            color: white;
            border-radius: 50%;
            font-family: "Inter Tight", sans-serif;
            font-weight: bold;
            font-size: 18px;
        }

            @media (max-width: 64rem) {

                .property-links,
                .mapContainer {
                    width: 100%;
                }

                .property-link-text h6 {
                    font-size: 28px;
                }

                .property-link-text p {
                    font-size: 1.1em;
                }

                .property-info-block {
                    display: none;
                }

                .property-info-block .property-info-title {
                    font-size: 0.875rem;
                }

                .property-info-block .property-info-address {
                    font-size: 0.75rem;
                }
            }

            @media (max-width: 48rem) {
                .propertiesContainer {
                    padding: 3.125rem 5%;
                }

                .propertiesContainer h3 {
                    font-weight: 600;
                    font-size: 28px;
                    line-height: 90%;
                    letter-spacing: 0%;
                    text-align: center;
                    vertical-align: middle;
                    color: #2a2a2a;
                }

                .property-link-text h6 {
                    font-size: 26px;
                }

                .property-link-text p {
                    font-size: 1em;
                }

                .property-info-block {
                    display: none;
                }

                .property-info-block .property-info-title {
                    font-size: 0.75rem;
                }

                .property-info-block .property-info-address {
                    font-size: 0.625rem;
                }
            }

            @media (max-width: 30rem) {
                .propertiesContainer {
                    padding: 1.875rem 5%;
                }

                .propertiesContainer h3 {
                    font-size: 1.875rem;
                    text-align: center;
                }

                .property-link-text h6 {
                    font-size: 22px;
                }

                .property-link-text p {
                    font-size: 0.9em;
                }

                .property-info-block {
                    display: none;
                }

                .property-info-block .property-info-title {
                    font-size: 0.625rem;
                }

                .property-info-block .property-info-address {
                    font-size: 0.5rem;
                }

                .property-info .property-images img {
                    display: block;
                }
            }
        </style>

        <div class="propertiesContainer">
            <h3><?php echo esc_html($settings['section_title']); ?></h3>
            <p class='ffffwqdsad'><?php echo esc_html($settings['section_subtitle']); ?></p>
            <div class="property-map-container">
                <div class="property-links">
                    <?php foreach ($settings['property_list'] as $index => $property) : ?>
                        <span class="property-link"
                            data-lat="<?php echo esc_attr($property['property_lat']); ?>"
                            data-lng="<?php echo esc_attr($property['property_lng']); ?>"
                            data-description="<?php echo esc_attr($property['property_description']); ?>"
                            data-address="<?php echo esc_attr($property['property_address']); ?>"
                            data-url="<?php echo esc_attr($property['property_url']); ?>"
                            data-images='<?php echo json_encode($property['property_images']); ?>'
                            <?php echo $index === 0 ? 'data-active="true"' : ''; ?>>

                            <div class="property-link-inner">
                            <div class="property-link-icon">
                                    <?php if (!empty($property['number_icon']['url'])) : ?>
                                        <img src="<?php echo esc_url($property['number_icon']['url']); ?>" 
                                            alt="Property <?php echo $index + 1; ?>"
                                            loading="lazy">
                                    <?php endif; ?>
                                </div>

                                <div class="property-link-text">
                                    <h6 class="elementor-heading-title elementor-size-default"><?php echo esc_html($property['property_name']); ?></h6>
                                    <div class="property-description"><?php echo esc_html($property['property_description']); ?></div>
                                </div>
                                <div class="toggle-icon">+</div>
                            </div>
                        </span>
                    <?php endforeach; ?>
                </div>

                <div class="mapContainer">
                    <div id="property-map" class="map-container"></div>
                    <div class="property-info-block">
                        <div class="property-info-title hidden"></div>
                        <div class="property-info-image"></div>
                        <div class="property-info-address"></div>
                        <button class="qwe">
                            <a href="#" target="_blank" rel="noopener noreferrer" class="property-info-link" style="display: none; color: white;">View Property</a>
                            <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                    <div class="property-info">
                        <div class="property-images"></div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const map = L.map('property-map', {
                    zoom: 13,
                    center: [0, 0],
                    scrollWheelZoom: false,
                    fadeAnimation: true,
                });

                L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                    attribution: '© OpenStreetMap contributors © <a href="https://carto.com/">CARTO</a>',
                    subdomains: 'abcd',
                    maxZoom: 19,
                }).addTo(map);

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
                const activeLink = document.querySelector(".property-info-link");
                const propertyImagesContainer = document.querySelector(".property-images");
                const buttons = document.querySelectorAll(".property-link");
                const markers = [];

                const updatePropertyInfo = (title, address, imageUrl, linkUrl, images) => {
                    activeTitle.textContent = title;
                    activeAddress.textContent = address;
                    activeImage.innerHTML = imageUrl ?
                        `<img src="${imageUrl}" alt="Property Image" loading="lazy">` :
                        '<p>No Image Available</p>';

                    if (activeLink) {
                        activeLink.href = linkUrl || '#';
                        activeLink.style.display = linkUrl ? 'inline-block' : 'none';
                    }

                    propertyImagesContainer.innerHTML = '';
                    if (images && images.length > 0) {
                        images.forEach(image => {
                            const imgElement = document.createElement('img');
                            imgElement.src = image.url;
                            imgElement.alt = 'Property Image';
                            imgElement.style.width = '100%';
                            imgElement.style.border = '1px solid #ccc';
                            imgElement.style.borderRadius = '5px';
                            propertyImagesContainer.appendChild(imgElement);
                        });
                    }
                };

                // Function to close all property descriptions
                const closeAllDescriptions = () => {
                    document.querySelectorAll('.property-description').forEach(desc => {
                        desc.classList.remove('visible');
                    });
                    document.querySelectorAll('.toggle-icon').forEach(icon => {
                        icon.classList.remove('active');
                        icon.textContent = '+';
                    });
                };

                buttons.forEach((button, index) => {
                    const lat = parseFloat(button.getAttribute("data-lat"));
                    const lng = parseFloat(button.getAttribute("data-lng"));
                    const title = button.querySelector("h6").textContent;
                    const address = button.getAttribute("data-address");
                    const images = JSON.parse(button.getAttribute("data-images"));
                    const firstImage = images && images[0] ? images[0].url : null;
                    const linkUrl = button.getAttribute("data-url");
                    const description = button.querySelector(".property-description");
                    const toggleIcon = button.querySelector(".toggle-icon");

                    const toggleDescription = () => {
                        // Close all descriptions first
                        closeAllDescriptions();

                        // Then open the clicked one
                        description.classList.add('visible');
                        toggleIcon.classList.add('active');
                        toggleIcon.textContent = '−';
                    };

                    button.addEventListener("click", () => {
                        map.flyTo([lat, lng], 15, {
                            animate: true,
                            duration: 1.5
                        });
                        updatePropertyInfo(title, address, firstImage, linkUrl, images);
                        markers.forEach((m, i) => m.setIcon(i === index ? activeIcon : inactiveIcon));
                        toggleDescription();
                    });

                    const marker = L.marker([lat, lng], {
                        icon: index === 0 ? activeIcon : inactiveIcon,
                    }).addTo(map);

                    marker.on("click", () => {
                        map.flyTo([lat, lng], 15, {
                            animate: true,
                            duration: 1.5
                        });
                        updatePropertyInfo(title, address, firstImage, linkUrl, images);
                        markers.forEach((m, i) => m.setIcon(i === index ? activeIcon : inactiveIcon));
                        toggleDescription();
                    });

                    markers.push(marker);

                    if (index === 0) {
                        map.flyTo([lat, lng], 15, {
                            animate: true,
                            duration: 1.5
                        });
                        updatePropertyInfo(title, address, firstImage, linkUrl, images);
                        description.classList.add('visible');
                        toggleIcon.classList.add('active');
                        toggleIcon.textContent = '−';
                    }
                });
            });
        </script>

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
<?php
    }
}