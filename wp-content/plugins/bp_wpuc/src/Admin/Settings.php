<?php

namespace BPExtensions\WPUC\Admin;

use BPExtensions\WPUC\Plugin;

/**
 * Register and manage plugin settings.
 */
class Settings
{

    /**
     * Register plugin settings menu item.
     *
     * @return void
     */
    public static function registerMenuItem(): void
    {
        $page_title = __('Under Construction Settings', 'bpwpuc');
        $menu_title = __('Under Construction Page', 'bpwpuc');

        add_options_page($page_title, $menu_title, 'manage_options', Plugin::NAME . '-settings',
            [self::class, 'display']);
    }

    /**
     * Display settings page.
     *
     * @return void
     */
    public static function display(): void
    {
        require PATH_BPWPUC . '/parts/settings.php';
    }

    /**
     * Register plugin settings fields.
     *
     * @return void
     */
    public static function registerSettingsFields(): void
    {

        // Register plugin setting
        register_setting(Plugin::NAME . '-settings', Plugin::NAME, [self::class, 'validateSettings']);

        // Add section
        add_settings_section('bpwpuc_setings', __('Translation strings', 'bpwpuc'),
            [self::class, 'displaySettingsSectionInfo'], Plugin::NAME . '-settings');

        // Add setting fields
        add_settings_field('meta_title', __('Meta Title', 'bpwpuc'), [self::class, 'renderMetaTitleField'],
            Plugin::NAME . '-settings', 'bpwpuc_setings');
        add_settings_field('first_line', __('First line (heading)', 'bpwpuc'), [self::class, 'renderFirstLineField'],
            Plugin::NAME . '-settings', 'bpwpuc_setings');
        add_settings_field('second_line', __('Second line', 'bpwpuc'), [self::class, 'renderSecondLineField'],
            Plugin::NAME . '-settings', 'bpwpuc_setings');
    }

    /**
     * Display plugins setting section info.
     *
     * @return void
     */
    public static function displaySettingsSectionInfo(): void
    {

    }

    /**
     * Render pos_id setting field.
     *
     * @return void
     */
    public static function renderMetaTitleField(): void
    {
        ?>
        <input id="<?php echo Plugin::NAME ?>_meta_title" name='<?php echo Plugin::NAME ?>[meta_title]' type="text"
               value="<?php echo esc_attr(self::getOption('meta_title')) ?>"/>
        <?php
    }

    /**
     * Get plugin settings option.
     *
     * @param   string  $name     Name of the option to return.
     * @param   string  $default  Default value to return.
     *
     * @return string
     */
    public static function getOption(string $name, string $default = ''): string
    {
        static $options = [];
        if ($options === []) {
            $options = get_option(Plugin::NAME, []);
        }

        if (array_key_exists($name, $options) && $options[$name] !== '') {
            return $options[$name];
        }

        return $default;
    }

    /**
     * Render second_key setting field.
     *
     * @return void
     */
    public static function renderFirstLineField(): void
    {
        ?>
        <input id="<?php echo Plugin::NAME ?>_first_line" name='<?php echo Plugin::NAME ?>[first_line]' type="text"
               value="<?php echo esc_attr(self::getOption('first_line')) ?>"/>
        <?php
    }

    /**
     * Render client_secret setting field.
     *
     * @return void
     */
    public static function renderSecondLineField(): void
    {
        ?>
        <input id="<?php echo Plugin::NAME ?>_second_line" name='<?php echo Plugin::NAME ?>[second_line]' type="text"
               value="<?php echo esc_attr(self::getOption('second_line')) ?>"/>
        <?php
    }

    /**
     * Validate settings input.
     *
     * @param   array  $input  Array containing settings input.
     *
     * @return array
     */
    public static function validateSettings(array $input): array
    {
        $sanitized = $input;

        $sanitized['meta_title']  = sanitize_text_field($input['meta_title']);
        $sanitized['first_line']  = sanitize_text_field($input['first_line']);
        $sanitized['second_line'] = sanitize_text_field($input['second_line']);

        return $sanitized;
    }

    /**
     * Add settings page link in plugins list.
     *
     * @param   array  $links  Current list of links.
     *
     * @return array
     */
    public static function addSettingsLink(array $links): array
    {
        // Build and escape the URL.
        $url = esc_url(add_query_arg(
            'page',
            'bpwpuc-settings',
            get_admin_url() . 'admin.php'
        ));

        // Create the link.
        $settings_link = "<a href='$url'>" . __('Settings') . '</a>';

        // Adds the link to the end of the array.
        $links[] = $settings_link;

        return $links;
    }
}