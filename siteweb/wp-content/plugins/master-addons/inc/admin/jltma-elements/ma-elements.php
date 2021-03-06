<?php

namespace MasterAddons\Admin\Dashboard\Addons\Elements;

if (!class_exists('JLTMA_Addon_Elements')) {
    class JLTMA_Addon_Elements
    {
        private static $instance = null;
        public static $jltma_elements;

        public function __construct()
        {
            self::$jltma_elements = [
                'jltma-addons'      => [
                    'title'             => esc_html__('Content Elements', JLTMA_TD),
                    'elements'          => [
                        [
                            'key'      => 'ma-animated-headlines',
                            'title'    => esc_html__('Animated Headlines', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Animated_Headlines',
                            'demo_url' => 'https://master-addons.com/demos/animated-headline/',
                            'docs_url' => 'https://master-addons.com/docs/addons/animated-headline-elementor/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=09QIUPdUQnM',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-call-to-action',
                            'title'    => esc_html__('Call to Action', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Call_to_Action',
                            'demo_url' => 'https://master-addons.com/demos/call-to-action/',
                            'docs_url' => 'https://master-addons.com/docs/addons/call-to-action/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=iY2q1jtSV5o',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-dual-heading',
                            'title'    => esc_html__('Dual Heading', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Dual_Heading',
                            'demo_url' => 'https://master-addons.com/demos/dual-heading/',
                            'docs_url' => 'https://master-addons.com/docs/addons/dual-heading/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=kXyvNe6l0Sg',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-accordion',
                            'title'    => esc_html__('Advanced Accordion', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Advanced_Accordion',
                            'demo_url' => 'https://master-addons.com/demos/advanced-accordion/',
                            'docs_url' => 'https://master-addons.com/docs/addons/elementor-accordion-widget/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=rdrqWa-tf6Q',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-tabs',
                            'title'    => esc_html__('Tabs', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Tabs',
                            'demo_url' => 'https://master-addons.com/demos/tabs/',
                            'docs_url' => 'https://master-addons.com/docs/addons/tabs-element/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=lsqGmIrdahw',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-tooltip',
                            'title'    => esc_html__('Tooltip', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Tooltip',
                            'demo_url' => 'https://master-addons.com/demos/tooltip/',
                            'docs_url' => 'https://master-addons.com/docs/addons/adding-tooltip-in-elementor-editor/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=Av3eTae9vaE',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-progressbar',
                            'title'    => esc_html__('Progress Bar', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Progress_Bar',
                            'demo_url' => 'https://master-addons.com/demos/progress-bar/',
                            'docs_url' => 'https://master-addons.com/docs/addons/how-to-create-and-customize-progressbar-in-elementor/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=77-b1moRE8M',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-progressbars',
                            'title'    => esc_html__('Progress Bars', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Progress_Bars',
                            'demo_url' => 'https://master-addons.com/demos/multiple-progress-bars/',
                            'docs_url' => 'https://master-addons.com/docs/addons/progress-bars-element/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=Mc9uDWJQMIY',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-team-members',
                            'title'    => esc_html__('Team Member', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Team_Member',
                            'demo_url' => 'https://master-addons.com/demos/team-member/',
                            'docs_url' => 'https://master-addons.com/docs/addons/adding-team-members-in-elementor-page-builder/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=wXPEl93_UBw',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-team-members-slider',
                            'title'    => esc_html__('Team Slider', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Team_Slider',
                            'demo_url' => 'https://master-addons.com/demos/team-carousel/',
                            'docs_url' => 'https://master-addons.com/docs/addons/team-members-carousel/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=ubP_h86bP-c',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-creative-buttons',
                            'title'    => esc_html__('Creative Button', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Creative_Button',
                            'demo_url' => 'https://master-addons.com/demos/creative-button/',
                            'docs_url' => 'https://master-addons.com/docs/addons/creative-button/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=kFq8l6wp1iI',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-changelog',
                            'title'    => esc_html__('Changelogs', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Changelogs',
                            'demo_url' => 'https://master-addons.com/changelogs/',
                            'docs_url' => 'https://master-addons.com/docs/addons/changelog-element/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=qWRgJkFfBow',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-infobox',
                            'title'    => esc_html__('Infobox', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Infobox',
                            'demo_url' => 'https://master-addons.com/demos/infobox/',
                            'docs_url' => 'https://master-addons.com/docs/addons/infobox-element/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=2-ymXAZfrF0',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-flipbox',
                            'title'    => esc_html__('Flipbox', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Flipbox',
                            'demo_url' => 'https://master-addons.com/demos/flipbox/',
                            'docs_url' => 'https://master-addons.com/docs/addons/how-to-configure-flipbox-element/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=f-B35-xWqF0',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-creative-links',
                            'title'    => esc_html__('Creative Links', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Creative_Links',
                            'demo_url' => 'https://master-addons.com/demos/creative-link/',
                            'docs_url' => 'https://master-addons.com/docs/addons/how-to-add-creative-links/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=o6SmdwMJPyA',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-image-hover-effects',
                            'title'    => esc_html__('Image Hover Effects', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Image_Hover_Effects',
                            'demo_url' => 'https://master-addons.com/demos/image-hover-effects/',
                            'docs_url' => 'https://master-addons.com/docs/addons/image-hover-effects-element/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=vWGWzuRKIss',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-blog',
                            'title'    => esc_html__('Blog', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Blog',
                            'demo_url' => 'https://master-addons.com/demos/blog-element/',
                            'docs_url' => 'https://master-addons.com/docs/addons/blog-element-customization/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=03AcgVEsTaA',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-news-ticker',
                            'title'    => esc_html__('News Ticker', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_News_Ticker',
                            'demo_url' => 'https://master-addons.com/demos/news-ticker/',
                            'docs_url' => 'https://master-addons.com/docs/addons/news-ticker-element/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=jkrBCzebQ-E',
                            'is_pro'   => true
                        ],
                        [
                            'key'      => 'ma-timeline',
                            'title'    => esc_html__('Timeline', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Timeline',
                            'demo_url' => 'https://master-addons.com/demos/timeline/',
                            'docs_url' => 'https://master-addons.com/docs/addons/timeline-element/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=0mcDMKrH1A0',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-business-hours',
                            'title'    => esc_html__('Business Hours', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Business_Hours',
                            'demo_url' => 'https://master-addons.com/demos/business-hours/',
                            'docs_url' => 'https://master-addons.com/docs/addons/business-hours-elementor/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=x0_HY9uYgog',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-table-of-contents',
                            'title'    => esc_html__('Table of Contents', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Table_of_Contents',
                            'demo_url' => 'https://master-addons.com/100-best-elementor-addons/',
                            'docs_url' => '',
                            'tuts_url' => '',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-image-hotspot',
                            'title'    => esc_html__('Image Hotspot', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Image_Hotspot',
                            'demo_url' => 'https://master-addons.com/demos/image-hotspot/',
                            'docs_url' => 'https://master-addons.com/docs/addons/image-hotspot/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=IDAd_d986Hg',
                            'is_pro'   => true
                        ],
                        [
                            'key'      => 'ma-image-filter-gallery',
                            'title'    => esc_html__('Filterable Image Gallery', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Filterable_Image_Gallery',
                            'demo_url' => 'https://master-addons.com/demos/image-gallery/',
                            'docs_url' => 'https://master-addons.com/docs/addons/filterable-image-gallery/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=h7egsnX4Ewc',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-pricing-table',
                            'title'    => esc_html__('Pricing Table', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Pricing_Table',
                            'demo_url' => 'https://master-addons.com/demos/pricing-table/',
                            'docs_url' => 'https://master-addons.com/docs/addons/pricing-table-elementor-free-widget/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=_FUk1EfLBUs',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-image-comparison',
                            'title'    => esc_html__('Image Comparison', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Image_Comparison',
                            'demo_url' => 'https://master-addons.com/demos/image-comparison/',
                            'docs_url' => 'https://master-addons.com/docs/addons/image-comparison-element/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=3nqRRXSGk3M',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-restrict-content',
                            'title'    => esc_html__('Restrict Content', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Restrict_Content',
                            'demo_url' => 'https://master-addons.com/demos/restrict-content-for-elementor/',
                            'docs_url' => 'https://master-addons.com/docs/addons/restrict-content-for-elementor/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=Alc1R_W5_Z8',
                            'is_pro'   => true
                        ],
                        [
                            'key'      => 'ma-current-time',
                            'title'    => esc_html__('Current Time', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Current_Time',
                            'demo_url' => 'https://master-addons.com/demos/current-time/',
                            'docs_url' => 'https://master-addons.com/docs/addons/current-time/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=Icwi5ynmzkQ',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-domain-checker',
                            'title'    => esc_html__('Domain Search', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Domain_Search',
                            'demo_url' => 'https://master-addons.com/demos/domain-search/',
                            'docs_url' => 'https://master-addons.com/docs/addons/how-ma-domain-checker-works/',
                            'tuts_url' => '',
                            'is_pro'   => true
                        ],
                        [
                            'key'      => 'ma-table',
                            'title'    => esc_html__('Dynamic Table', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Dynamic_Table',
                            'demo_url' => 'https://master-addons.com/demos/dynamic-table/',
                            'docs_url' => 'https://master-addons.com/docs/addons/dynamic-table-element/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=bn0TvaGf9l8',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-navmenu',
                            'title'    => esc_html__('Nav Menu', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Nav_Menu',
                            'demo_url' => 'https://master-addons.com/elementor-mega-menu/',
                            'docs_url' => 'https://master-addons.com/docs/addons/navigation-menu/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=WhA5YnE4yJg',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-search',
                            'title'    => esc_html__('Search', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Search',
                            'demo_url' => 'https://master-addons.com/demos/search-element/',
                            'docs_url' => 'https://master-addons.com/docs/addons/search-element/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=Uk6nnoN5AJ4',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-blockquote',
                            'title'    => esc_html__('Blockquote', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Blockquote',
                            'demo_url' => 'https://master-addons.com/demos/blockquote-element/',
                            'docs_url' => 'https://master-addons.com/docs/addons/blockquote-element/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=sSCULgPFSHU',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-counter-up',
                            'title'    => esc_html__('Counter Up', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Counter_Up',
                            'demo_url' => 'https://master-addons.com/demos/counter-up/',
                            'docs_url' => 'https://master-addons.com/docs/addons/counter-up-for-elementor/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=9amvO6p9kpM',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-countdown-timer',
                            'title'    => esc_html__('Countdown Timer', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Countdown_Timer',
                            'demo_url' => 'https://master-addons.com/demos/countdown-timer/',
                            'docs_url' => 'https://master-addons.com/docs/addons/count-down-timer/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=1lIbOLM9C1I',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-toggle-content',
                            'title'    => esc_html__('Toggle Content', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Toggle_Content',
                            'demo_url' => 'https://master-addons.com/demos/toggle-content/',
                            'docs_url' => 'https://master-addons.com/docs/addons/toggle-content/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=TH6wbVuWdTA',
                            'is_pro'   => true
                        ],
                        [
                            'key'      => 'ma-gallery-slider',
                            'title'    => esc_html__('Gallery Slider', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Gallery_Slider',
                            'demo_url' => 'https://master-addons.com/demos/gallery-slider/',
                            'docs_url' => 'https://master-addons.com/docs/addons/gallery-slider/',
                            'tuts_url' => '',
                            'is_pro'   => true
                        ],
                        [
                            'key'      => 'ma-gradient-headline',
                            'title'    => esc_html__('Gradient Headline', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Gradient_Headline',
                            'demo_url' => 'https://master-addons.com/demos/gradient-headline/',
                            'docs_url' => 'https://master-addons.com/docs/addons/how-to-add-gradient-headline-in-elementor/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=NgayEI4CthU',
                            'is_pro'   => false
                        ],
                        [
                            'key'      => 'ma-advanced-image',
                            'title'    => esc_html__('Advanced Image', JLTMA_TD),
                            'class'    => 'MasterAddons\Addons\JLTMA_Advanced_Image',
                            'demo_url' => 'https://master-addons.com/demos/advanced-image/',
                            'docs_url' => 'https://master-addons.com/docs/addons/advanced-image-element/',
                            'tuts_url' => 'https://www.youtube.com/watch?v=fhdwiiy7JiE',
                            'is_pro'   => false
                        ],
                        // [
                        //     'key'      => 'ma-image-carousel',
                        //     'title'    => esc_html__('Image Carousel', JLTMA_TD),
                        //     'class'    => 'MasterAddons\Addons\JLTMA_Image_Carousel',
                        //     'demo_url' => '',
                        //     'docs_url' => '',
                        //     'tuts_url' => '',
                        //     'is_pro'   => false
                        // ],
                        // [
                        //     'key'      => 'ma-logo-slider',
                        //     'title'    => esc_html__('Logo Slider', JLTMA_TD),
                        //     'class'    => 'MasterAddons\Addons\JLTMA_Logo_Slider',
                        //     'demo_url' => '',
                        //     'docs_url' => '',
                        //     'tuts_url' => '',
                        //     'is_pro'   => false
                        // ],
                        // [
                        //     'key'      => 'ma-twitter-slider',
                        //     'title'    => esc_html__('Twitter Slider', JLTMA_TD),
                        //     'class'    => 'MasterAddons\Addons\JLTMA_Twitter_Slider',
                        //     'demo_url' => '',
                        //     'docs_url' => '',
                        //     'tuts_url' => '',
                        //     'is_pro'   => false
                        // ],
                        // [
                        //     'key'      => 'ma-offcanvas-menu',
                        //     'title'    => esc_html__('Offcanvas Menu', JLTMA_TD),
                        //     'class'    => 'MasterAddons\Addons\JLTMA_Offcanvas_Menu',
                        //     'demo_url' => '',
                        //     'docs_url' => '',
                        //     'tuts_url' => '',
                        //     'is_pro'   => true
                        // ],

                        // [
                        //     'key'                => 'ma-image-cascading',
                        //     'title'              => esc_html__('Cascading Image', JLTMA_TD),
                        //     'demo_url'           => '',
                        //     'docs_url'           => '',
                        //     'tuts_url'           => '',
                        // 'is_pro'            => false
                        // ],

                        // [
                        //     'key'      => 'ma-morphing-blob',
                        //     'title'    => esc_html__('Morphing Blob', JLTMA_TD),
                        //     'class'    => 'MasterAddons\Addons\JLTMA_Morphing_Blob',
                        //     'demo_url' => '',
                        //     'docs_url' => '',
                        //     'tuts_url' => '',
                        //     'is_pro'   => false
                        // ],

                        // [
                        //     'key'      => 'ma-link-navigation',
                        //     'title'    => esc_html__('Link Navigation', JLTMA_TD),
                        //     'class'    => 'MasterAddons\Addons\JLTMA_Link_Navigation',
                        //     'demo_url' => '',
                        //     'docs_url' => '',
                        //     'tuts_url' => '',
                        //     'is_pro'   => false
                        // ],

                        // [
                        //     'key'      => 'ma-audio-playlist',
                        //     'title'    => esc_html__('Audio Playlist', JLTMA_TD),
                        //     'class'    => 'MasterAddons\Addons\JLTMA_Audio_Playlist',
                        //     'demo_url' => '',
                        //     'docs_url' => '',
                        //     'tuts_url' => '',
                        //     'is_pro'   => false
                        // ],


                    ]
                ]
            ];
        }

        public static function get_instance()
        {
            if (!self::$instance) {
                self::$instance = new self;
            }
            return self::$instance;
        }
    }
    JLTMA_Addon_Elements::get_instance();
}
