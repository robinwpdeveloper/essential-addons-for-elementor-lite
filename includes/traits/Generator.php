<?php

namespace Essential_Addons_Elementor\Traits;

use MatthiasMullie\Minify;

trait Generator
{

    public $dependencies = array(
        'fancy-text' => array(
            'assets/front-end/js/vendor/fancy-text/fancy-text.js',
        ),
        'countdown' => array(
            'assets/front-end/js/vendor/countdown/countdown.min.js',
        ),
        'filterable-gallery' => array(
            'assets/front-end/js/vendor/isotope/isotope.pkgd.min.js',
            'assets/front-end/js/vendor/magnific-popup/jquery.magnific-popup.min.js',
        ),
        'post-timeline' => array(
            'assets/front-end/js/vendor/load-more/load-more.js',
        ),
        'pricing-table' => array(
            'assets/front-end/js/vendor/tooltipster/tooltipster.bundle.min.js',
        ),
        'progress-bar' => array(
            'assets/front-end/js/vendor/progress-bar/progress-bar.js',
            'assets/front-end/js/vendor/inview/inview.min.js',
        ),
        'twitter-feed' => array(
            'assets/front-end/js/vendor/isotope/isotope.pkgd.min.js',
            'assets/front-end/social-feeds/codebird.js',
            'assets/front-end/social-feeds/doT.min.js',
            'assets/front-end/social-feeds/moment.js',
            'assets/front-end/social-feeds/jquery.socialfeed.js',
        ),
        'post-grid' => array(
            'assets/front-end/js/vendor/isotope/isotope.pkgd.min.js',
            'assets/front-end/js/vendor/load-more/load-more.js',
        ),
    );

    public function add_dependency(array $elements, array $paths)
    {
        if ($this->dependencies) {
            foreach ($elements as $element) {
                if (isset($this->dependencies[$element])) {
                    if (\is_array($this->dependencies[$element])) {
                        foreach ($this->dependencies[$element] as $path) {
                            $paths[] = EAEL_PLUGIN_PATH . $path;
                        }
                    } else {
                        $paths[] = EAEL_PLUGIN_PATH . $this->dependencies[$element];
                    }
                }
            }
        }
        return array_unique($paths);
    }

    public function generate_scripts($elements, $output = null)
    {
        $js_paths = array();
        $css_paths = array(
            'general' => EAEL_PLUGIN_PATH . "assets/front-end/css/general.css",
        );

        if (!file_exists(EAEL_ASSET_PATH)) {
            wp_mkdir_p(EAEL_ASSET_PATH);
        }

        if ($this->add_dependency($elements, $js_paths)) {
            $js_paths[] = $this->add_dependency($elements, $js_paths);
        }

        foreach ((array) $elements as $element) {
            $js_file = EAEL_PLUGIN_PATH . 'assets/front-end/js/' . $element . '/index.js';
            $js_paths[] = EAEL_PLUGIN_PATH . 'assets/front-end/js/base.js';
            if (file_exists($js_file)) {
                $js_paths[] = $js_file;
            }

            $css_file = EAEL_PLUGIN_PATH . "assets/front-end/css/$element.css";
            if (file_exists($css_file)) {
                $css_paths[] = $css_file;
            }

        }

        $minifier = new Minify\JS($js_paths);
        file_put_contents(EAEL_ASSET_PATH . DIRECTORY_SEPARATOR . ($output ? $output : 'eael') . '.min.js', $minifier->minify());

        $minifier = new Minify\CSS($css_paths);
        file_put_contents(EAEL_ASSET_PATH . DIRECTORY_SEPARATOR . ($output ? $output : 'eael') . '.min.css', $minifier->minify());
    }

    public function generate_post_scripts($post_id)
    {
        $post_data = get_metadata('post', $post_id, '_elementor_data');
        $elements = array();

        if (!empty($post_data)) {
            $sections = json_decode($post_data[0]);

            foreach ((array) $sections as $section) {
                foreach ((array) $section->elements as $element) {
                    foreach ((array) $element->elements as $widget) {
                        if (@$widget->widgetType) {
                            $elements[] = $widget->widgetType;
                        } else {
                            foreach ((array) $widget as $inner_section) {
                                foreach ((array) $inner_section as $inner_elements) {
                                    foreach ((array) $inner_elements->elements as $inner_widget) {
                                        if ($inner_widget->widgetType) {
                                            $elements[] = $inner_widget->widgetType;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            $elements = array_intersect($this->registered_elements, array_map(function ($val) {
                return preg_replace('/^eael-/', '', $val);
            }, $elements));

            error_log(print_r($elements, 1));

            if ($elements) {
                $this->generate_scripts($elements, $post_id);
            }
        }
    }
}
