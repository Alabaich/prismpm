<?php
class Elementor_communityLifeSection extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'communityLifeSection';
    }

    public function get_title()
    {
        return esc_html__('Community & Lifestyle', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-info';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'main_title',
            [
                'label' => esc_html__('Main Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Community & Lifestyle',
            ]
        );

        $this->add_control(
            'main_description',
            [
                'label' => esc_html__('Main Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Experience the vibrant community spirit that makes Oshawa a truly special place to live.',
            ]
        );

        $this->add_control(
            'intro_text',
            [
                'label' => esc_html__('Intro Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'A City of Celebration. Throughout the year, Oshawa comes alive with festivals, events, and gatherings that bring our community together. From cultural celebrations to seasonal festivities, there\'s always something happening to showcase our city\'s spirit and diversity. Our strong community bonds, the supportive local businesses, and the warm residents come together to support important causes and initiatives.',
            ]
        );

        $this->add_control(
            'intro_subtitle',
            [
                'label' => esc_html__('Intro Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Celebrating Oshawa\'s Spirit',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'event_title',
            [
                'label' => esc_html__('Event Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Fiesta Week',
            ]
        );

        $repeater->add_control(
            'event_description',
            [
                'label' => esc_html__('Event Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'With 370 beautiful suites and a wide range of amenities, 80 Bond has fast become the premier address in downtown Oshawa.',
            ]
        );

        $repeater->add_control(
            'season',
            [
                'label' => esc_html__('Season', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Summer',
            ]
        );

        $repeater->add_control(
            'image1',
            [
                'label' => esc_html__('Image 1', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [],
                'description' => 'Upload the first image for this event.',
            ]
        );

        $repeater->add_control(
            'image2',
            [
                'label' => esc_html__('Image 2', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [],
                'description' => 'Upload the second image for this event.',
            ]
        );

        $repeater->add_control(
            'image3',
            [
                'label' => esc_html__('Image 3', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [],
                'description' => 'Upload the third image for this event.',
            ]
        );

        $repeater->add_control(
            'image4',
            [
                'label' => esc_html__('Image 4', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [],
                'description' => 'Upload the fourth image for this event.',
            ]
        );

        $this->add_control(
            'events',
            [
                'label' => esc_html__('Events', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'event_title' => 'Fiesta Week',
                        'event_description' => 'With 370 beautiful suites and a wide range of amenities, 80 Bond has fast become the premier address in downtown Oshawa.',
                        'season' => 'Summer',
                        'image1' => [],
                        'image2' => [],
                        'image3' => [],
                        'image4' => [],
                    ],
                    [
                        'event_title' => 'Fiesta Week',
                        'event_description' => '',
                        'season' => 'Spring',
                        'image1' => [],
                        'image2' => [],
                        'image3' => [],
                        'image4' => [],
                    ],
                    [
                        'event_title' => 'Winter Festival Of Lights',
                        'event_description' => '',
                        'season' => 'Winter',
                        'image1' => [],
                        'image2' => [],
                        'image3' => [],
                        'image4' => [],
                    ],
                    [
                        'event_title' => 'Autofest',
                        'event_description' => '',
                        'season' => 'Summer',
                        'image1' => [],
                        'image2' => [],
                        'image3' => [],
                        'image4' => [],
                    ],
                ],
                'title_field' => '{{{ event_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <section class="community-lifestyle-section pageWidth">
            <div class="community-lifestyle__container">
                <h2 class="community-lifestyle__main-title"><?php echo esc_html($settings['main_title']); ?></h2>
                <p class="community-lifestyle__main-description"><?php echo esc_html($settings['main_description']); ?></p>
                <div class="community-lifestyle__layout">
                    <div class="community-lifestyle__left-column">
                        <div class="community-lifestyle__intro">
                            <h5 class="community-lifestyle__intro-text"><?php echo esc_html($settings['intro_text']); ?></h5>
                            <p class="community-lifestyle__intro-subtitle"><?php echo esc_html($settings['intro_subtitle']); ?></p>
                        </div>
                        <div class="community-lifestyle__menu">
                            <?php foreach ($settings['events'] as $index => $event) : ?>
                                <div class="community-lifestyle__menu-item" data-index="<?php echo esc_attr($index); ?>">
                                    <span class="community-lifestyle__number"><?php echo esc_html(sprintf('%02d', $index + 1)); ?></span>
                                    <div class="community-lifestyle__menu-content">
                                        <h3 class="community-lifestyle__event-title"><?php echo esc_html($event['event_title']); ?></h3>
                                        <span class="community-lifestyle__season"><?php echo esc_html($event['season']); ?></span>
                                    </div>
                                    <div class="community-lifestyle__toggle-icon">+</div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="community-lifestyle__right-column">
                        <div class="community-lifestyle__images-container">
                            <div class="community-lifestyle__images"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Hidden script tag with event data -->
        <script id="community-lifestyle-data" type="application/json">
            <?php echo wp_json_encode($settings['events']); ?>
        </script>

        <style>
            .pageWidth{
    width: 100%;
    padding: 25px 10%;
}
@media screen and (max-width: 1600px) {
 .pageWidth{
  width: 100%;
  padding: 25px;
}
}
@media screen and (max-width: 768px) {
 .pageWidth{
  width: 100%;
  padding: 15px;
}
}
            .community-lifestyle-section {
                text-align: center;
                position: relative;
            }

            .community-lifestyle__container {
                position: relative;
            }

            .community-lifestyle__main-title {
                margin-bottom: 1rem;
                font-family: "Playfair Display", serif;
                color: #2A2A2A;
            }

            .community-lifestyle__main-description {
                font-size: 1rem;
                margin-bottom: 2rem;
                color: #6B7280;
            }

            .community-lifestyle__layout {
                display: flex;
                width: 100%;
                gap: 2rem;
                margin-top: 0;
            }

            .community-lifestyle__left-column {
                flex: 1;
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .community-lifestyle__intro {
                text-align: left;
                margin-bottom: 0;
            }

            .community-lifestyle__intro-text {
                margin: 0;
                padding-bottom:1.125rem;
                color: #000000;
            }

            .community-lifestyle__intro-subtitle {
                color: #52525B;
                margin: 0;
            }

            .community-lifestyle__menu {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .community-lifestyle__menu-item {
                background-color: #F5F7FA;
                padding: 15px;
                display: flex;
                align-items: center;
                gap: 10px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            .community-lifestyle__menu-item:hover {
                background-color: #e0e7ff;
            }

            .community-lifestyle__number {
                font-size: 1.5rem;
                color: #093D5F;
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
            }

            .community-lifestyle__menu-content {
                flex-grow: 1;
                display:flex;
                align-items:center;
                gap:10px;
                justify-content:center;
            }

            .community-lifestyle__event-title {
                margin: 0;
                font-family: "Darker Grotesque", sans-serif;
                color: #2A2A2A;
            }

            .community-lifestyle__season {
                font-size: 1rem;
                font-weight:500;
                color: white;
                background:#093D5F;
                padding:2px 16px;
                border-radius:9999px;
            }

            .community-lifestyle__toggle-icon {
                font-size: 2.5rem;
                cursor: pointer;
                transition: transform 0.3s;
            }

            .community-lifestyle__toggle-icon.active {
                transform: rotate(180deg);
            }

            .community-lifestyle__right-column {
                flex: 1;
            }

            .community-lifestyle__images-container {
                background-color: #F5F7FA;
                padding: 0; /* Remove all padding */
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100%; /* Match the height of the left column */
            }

            .community-lifestyle__images {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                grid-template-rows: repeat(2, auto);
                gap: 2%; /* Only gap between images, no top/bottom padding */
                width: 100%;
                height: 100%; /* Fill the container */
                overflow: hidden; /* Prevent overflow */
            }

            .community-lifestyle__images img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 8px; /* Rounded corners for all images */
                border: 1px solid #e0e0e0;
            }

            @media (max-width: 991px) {
                .community-lifestyle__layout {
                    flex-direction: column;
                }
                .community-lifestyle__left-column,
                .community-lifestyle__right-column {
                    width: 100%;
                }
                .community-lifestyle__intro {
                    max-width: 100%;
                }
                .community-lifestyle__images-container {
                    margin-top: 2rem;
                }
                .community-lifestyle__images {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 768px) {
                .community-lifestyle__main-title {
                }
                .community-lifestyle__event-title {
                }
                .community-lifestyle__images {
                    grid-template-columns: 1fr;
                    grid-template-rows: repeat(4, auto);
                    gap: 2%;
                }
                .community-lifestyle__menu-item {
                    flex-direction: column;
                    align-items: flex-start;
                }
                .community-lifestyle__toggle-icon {
                    align-self: flex-end;
                }
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const menuItems = document.querySelectorAll('.community-lifestyle__menu-item');
                const imagesContainer = document.querySelector('.community-lifestyle__images');
                const imagesWrapper = document.querySelector('.community-lifestyle__images-container');
                const leftColumn = document.querySelector('.community-lifestyle__left-column');
                let activeItem = null;

                // Set the height of the images container to match the left column height
                function updateImageContainerHeight() {
                    const leftColumnHeight = leftColumn.offsetHeight;
                    imagesWrapper.style.height = `${leftColumnHeight}px`;
                }

                updateImageContainerHeight();
                window.addEventListener('resize', updateImageContainerHeight);

                // Load event data from the hidden script tag
                const eventData = JSON.parse(document.getElementById('community-lifestyle-data').textContent);

                menuItems.forEach(item => {
                    const toggleIcon = item.querySelector('.community-lifestyle__toggle-icon');
                    const index = parseInt(item.getAttribute('data-index'));

                    item.addEventListener('click', function() {
                        if (activeItem && activeItem !== item) {
                            activeItem.querySelector('.community-lifestyle__toggle-icon').classList.remove('active');
                            activeItem.querySelector('.community-lifestyle__toggle-icon').textContent = '+';
                            imagesContainer.innerHTML = '';
                        }

                        const isActive = toggleIcon.classList.contains('active');
                        toggleIcon.classList.toggle('active');
                        toggleIcon.textContent = isActive ? '+' : '−';

                        if (!isActive || !activeItem) {
                            imagesContainer.innerHTML = '';
                            const images = eventData[index];
                            ['image1', 'image2', 'image3', 'image4'].forEach((key, i) => {
                                if (images[key]?.url) {
                                    const imgDiv = document.createElement('div');
                                    const img = document.createElement('img');
                                    img.src = images[key].url;
                                    img.alt = `${item.querySelector('.community-lifestyle__event-title').textContent} Image ${i + 1}`;
                                    img.onload = () => console.log(`Image loaded: ${img.src}`);
                                    img.onerror = () => console.error(`Image failed to load: ${img.src}`);
                                    imgDiv.appendChild(img);
                                    imagesContainer.appendChild(imgDiv);
                                }
                            });
                            activeItem = item;
                        } else {
                            imagesContainer.innerHTML = '';
                            activeItem = null;
                        }
                    });
                });

                if (menuItems.length > 0) {
                    menuItems[0].click();
                }
            });
        </script>
<?php
    }
}