<?php

namespace Essential_Addons_Elementor\Traits;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

use \Elementor\Plugin;

trait Enqueue
{

    public function enqueue_template_scripts($css_file)
    {
        if (!Plugin::$instance->db->is_built_with_elementor($css_file->get_post_id())) {
            return;
        }

        if (Plugin::$instance->editor->is_edit_mode()) {
            return;
        }

        if ($this->is_preview_mode()) {
            return;
        }

        // generate post script
        $widgets = $this->generate_post_scripts($css_file->get_post_id());

        // if no widget in page, return
        if (empty($widgets)) {
            return;
        }

        // enqueue
        wp_enqueue_style(
            'eael-post-' . $css_file->get_post_id(),
            $this->safe_protocol(EAEL_ASSET_URL . '/eael-post-' . $css_file->get_post_id() . '.min.css'),
            false,
            time()
        );

        wp_enqueue_script(
            'eael-post-' . $css_file->get_post_id(),
            $this->safe_protocol(EAEL_ASSET_URL . '/eael-post-' . $css_file->get_post_id() . '.min.js'),
            ['jquery'],
            time(),
            true
        );

        // localize script
        wp_localize_script('eael-post-' . $css_file->get_post_id(), 'localize', $this->localize_objects);
    }

    public function enqueue_scripts()
    {
        if (is_singular() && !Plugin::$instance->db->is_built_with_elementor(get_the_ID())) {
            return;
        }

        if ($this->is_preview_mode()) {
            return;
        }

        // register fontawesome as fallback
        wp_register_style(
            'font-awesome-5-all',
            ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/all.min.css',
            false,
            EAEL_PLUGIN_VERSION
        );

        wp_register_style(
            'font-awesome-4-shim',
            ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/v4-shims.min.css',
            false,
            EAEL_PLUGIN_VERSION
        );

        wp_register_script(
            'font-awesome-4-shim',
            ELEMENTOR_ASSETS_URL . 'lib/font-awesome/js/v4-shims.min.js',
            false,
            EAEL_PLUGIN_VERSION
        );

        // admin bar
        if (is_admin_bar_showing()) {
            wp_enqueue_style(
                'ea-admin-bar',
                EAEL_PLUGIN_URL . 'assets/admin/css/admin-bar.css',
                false,
                EAEL_PLUGIN_VERSION
            );

            wp_enqueue_script(
                'ea-admin-bar',
                EAEL_PLUGIN_URL . 'assets/admin/js/admin-bar.js',
                ['jquery'],
                EAEL_PLUGIN_VERSION
            );
        }

        // localize object
        $this->localize_objects = apply_filters('eael/localize_objects', [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('essential-addons-elementor'),
        ]);

        // enqueue
        if (Plugin::$instance->editor->is_edit_mode()) {
            // generate post script
            $this->generate_scripts($this->get_settings(), null, 'edit');

            // enqueue
            wp_enqueue_style(
                'eael-edit',
                $this->safe_protocol(EAEL_ASSET_URL . '/eael.min.css'),
                false,
                EAEL_PLUGIN_VERSION
            );

            wp_enqueue_script(
                'eael-edit',
                $this->safe_protocol(EAEL_ASSET_URL . '/eael.min.js'),
                ['jquery'],
                EAEL_PLUGIN_VERSION,
                true
            );

            // localize
            wp_localize_script('eael-edit', 'localize', $this->localize_objects);
        }

        //     // Gravity forms Compatibility
        //     if (class_exists('GFCommon')) {
        //         foreach ($this->eael_select_gravity_form() as $form_id => $form_name) {
        //             if ($form_id != '0') {
        //                 gravity_form_enqueue_scripts($form_id);
        //             }
        //         }
        //     }

        //     // WPforms compatibility
        //     if (function_exists('wpforms')) {
        //         wpforms()->frontend->assets_css();
        //     }

        //     // Caldera forms compatibility
        //     if (class_exists('Caldera_Forms')) {
        //         add_filter('caldera_forms_force_enqueue_styles_early', '__return_true');
        //     }

        //     // Fluent forms compatibility
        //     if (defined('FLUENTFORM')) {
        //         wp_register_style(
        //             'fluent-form-styles',
        //             WP_PLUGIN_URL . '/fluentform/public/css/fluent-forms-public.css',
        //             array(),
        //             FLUENTFORM_VERSION
        //         );

        //         wp_register_style(
        //             'fluentform-public-default',
        //             WP_PLUGIN_URL . '/fluentform/public/css/fluentform-public-default.css',
        //             array(),
        //             FLUENTFORM_VERSION
        //         );
        //     }

        //     if (class_exists('\Ninja_Forms') && class_exists('\NF_Display_Render')) {
        //         add_action('elementor/preview/enqueue_styles', function () {
        //             ob_start();
        //             \NF_Display_Render::localize(0);
        //             ob_clean();

        //             wp_add_inline_script('nf-front-end', 'var nfForms = nfForms || [];');
        //         });
        //     }
    }

    // editor styles
    public function editor_enqueue_scripts()
    {
        wp_enqueue_style(
            'eael-editor-css',
            $this->safe_protocol(EAEL_PLUGIN_URL . 'assets/admin/css/editor.css'),
            false
        );

        // ea icon font
        wp_enqueue_style(
            'ea-icon',
            $this->safe_protocol(EAEL_PLUGIN_URL . 'assets/admin/css/eaicon.css'),
            false
        );
    }
}
