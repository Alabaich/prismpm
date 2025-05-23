<?php

class Elementor_showCaseSection extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'showCaseSection';
    }

    public function get_title()
    {
        return esc_html__('Show Case', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-editor-align-center';
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
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Land Acknowledgement',
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'We respectfully acknowledge that we are gathered on the traditional territories of the Mississauga Anishinaabeg.',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'city',
            [
                'label' => esc_html__('City', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Oshawa',
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Oshawa, one of Canada’s fastest-growing cities...',
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'cities',
            [
                'label' => esc_html__('Cities', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $cities_to_display = array_slice($settings['cities'], 0, 2);
?>
        <style>
            .land-acknowledgement-section-wrapper {
                margin: 3rem 5rem;
            }

            .land-acknowledgement-section {
                width: 100%;
                padding: 1rem 1rem;
                background: #f9f9f9;
            }

            .land-acknowledgement-section .section-heading {
                text-align: center;
                margin-bottom: 50px;
                margin: auto;
            }

            .land-acknowledgement-section .section-heading h1.customTitle {
                line-height: 1.1;
                letter-spacing: 0em;
                text-transform: capitalize;
                margin: 0 0 0.75rem 0;
            }

            .land-acknowledgement-section .section-heading p.customSubtitle {
                color: #6B7280;
                margin: 0 auto 3rem;
                line-height: 1.6;
                max-width: 488px;
            }

            .city-columns {
                display: flex;
                flex-wrap: nowrap;
                justify-content: space-between;
                gap: 35px;
            }

            .city-block {
                display: flex;
                flex-direction: row;
                width: calc(50% - 17.5px);
                border-radius: 0.5rem;
                overflow: hidden;
                align-items: flex-start;
                gap: 1.5rem;
            }

            .city-block img {
                width: 377px;
                height: 426px;
                object-fit: fit-content;
                border-radius: 0.5rem 0 0 0.5rem;
            }

            .city-block-text {
                width: 55%;
                padding-top: 1rem;
                padding-bottom: 1rem;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                height: 100%;
                box-sizing: border-box;
            }

            .city-block-text h4 {
                margin-bottom: 1rem;
                color: #111827;
                font-size: 30px;
                margin: 0 0 0.5rem 0;
                line-height: 1.2;
            }

            .city-block-text p {
                font-family: "Inter Tight", sans-serif;
                font-weight: 400;
                font-size: 1rem;
                letter-spacing: -0.01em;
                color: #52525B;
                margin: 0;
                line-height: 1.6;
                padding-right: 10px;
            }

            @media (max-width: 767px) { /* Изменен breakpoint с 768px на 767px */
                .land-acknowledgement-section-wrapper {
                    margin: 0rem 5%;
                }

                .city-columns {
                    flex-direction: column;
                    align-items: center;
                    gap: 2rem;
                }

                .land-acknowledgement-section {
                    padding: 3rem 1rem;
                    background: transparent;
                }

                .land-acknowledgement-section .section-heading h1.customTitle {
                    line-height: 90%;
                    letter-spacing: 0%;
                    text-align: center;
                    vertical-align: middle;
                    color: #2a2a2a;
                }

                .land-acknowledgement-section .section-heading p.customSubtitle {
                    max-width: 100%;
                }

                .city-block {
                    width: 100%;
                    flex-direction: column;
                    align-items: center;
                    text-align: center;
                    gap: 1rem;
                    padding-top: 10px;
                }

                .city-block img {
                    height: 200px;
                    object-fit: cover;
                    border-radius: 0.5rem;
                    width: 100%; /* Добавлено для мобильных, чтобы изображение не было фиксированной ширины */
                }

                .city-block-text {
                    width: 100%;
                    padding: 1rem 0;
                    text-align: center;
                    display: flex;
                    flex-direction: column;
                    gap: 15px;
                    height: auto; /* Сброс высоты для мобильных */
                    justify-content: flex-start; /* Сброс justify-content */
                }

                .city-block-text h4 {
                    font-size: 1.5rem;
                }

                .city-block-text p {
                    font-size: 1rem;
                    padding-right: 0; /* Сброс padding-right для мобильных */
                }
            }

            /* Стили ТОЛЬКО для iPad (портретная и альбомная ориентация) */
            @media (min-width: 768px) and (max-width: 1024px) {
                .land-acknowledgement-section-wrapper {
                    margin: 4rem 2rem; /* Небольшая коррекция отступов для iPad */
                }
                .land-acknowledgement-section {
                    padding: 2rem; /* Небольшая коррекция отступов для iPad */
                }
                 .city-columns {
                    gap: 2rem; /* Отступ между двумя блоками городов на iPad */
                }
                .city-block {
                    flex-direction: column; /* Изображение и текст теперь друг под другом */
                    align-items: stretch;   /* Дочерние элементы растягиваются на всю ширину .city-block */
                    width: calc(50% - 1rem); /* Каждый блок города занимает почти половину, учитывая gap */
                    gap: 0; /* Убираем gap между img и text-block, т.к. они теперь один над другим */
                    /* background-color и box-shadow не добавляем, оставляем как в вашем коде */
                }
                .city-block img {
                    width: 100%; /* Изображение на всю ширину карточки .city-block */
                    height: 280px; /* Примерная высота для изображения на iPad, можно настроить */
                    object-fit: cover; /* Чтобы изображение красиво заполняло область */
                    border-radius: 0.5rem 0.5rem 0 0; /* Закругляем только верхние углы изображения */
                }
                .city-block-text {
                    width: 100%; /* Текстовый блок на всю ширину под изображением */
                    height: auto; /* Высота по контенту */
                    padding: 1.5rem; /* Добавляем отступы вокруг текста для читабельности */
                    justify-content: flex-start; /* Текст начинается сверху */
                     /* font-family, font-weight, font-size, letter-spacing, color, line-height остаются из ваших базовых стилей */
                }
                .city-block-text h4 {
                    /* font-size, color, line-height остаются из ваших базовых стилей, можно переопределить при необходимости */
                     margin: 0 0 0.75rem 0; /* Отступ под заголовком города */
                }
                 .city-block-text p {
                    padding-right: 0; /* Сбрасываем spezifischen padding-right, т.к. текст теперь на всю ширину */
                }
            }
        </style>

        <div class="land-acknowledgement-section-wrapper">
            <div class="land-acknowledgement-section">
                <div class="section-heading">
                    <?php if (!empty($settings['main_title'])) : ?>
                        <h1 class="customTitle"><?php echo esc_html($settings['main_title']); ?></h1>
                    <?php endif; ?>

                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p class="customSubtitle"><?php echo esc_html($settings['subtitle']); ?></p>
                    <?php endif; ?>
                </div>

                <?php if (!empty($cities_to_display)) : ?>
                <div class="city-columns">
                    <?php foreach ($cities_to_display as $city): ?>
                        <div class="city-block">
                            <?php if (!empty($city['image']['url'])) : ?>
                            <img src="<?php echo esc_url($city['image']['url']); ?>" alt="<?php echo esc_attr($city['city']); ?>">
                            <?php endif; ?>
                            <div class="city-block-text">
                                <h4><?php echo esc_html($city['city']); ?></h4>
                                <p><?php echo esc_html($city['description']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

<?php
    }
}