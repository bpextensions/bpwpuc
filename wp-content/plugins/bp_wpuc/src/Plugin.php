<?php

namespace BPExtensions\WPUC;

/**
 * A plugin front-end functionalities.
 */
class Plugin
{

    /**
     * Plugin name.
     */
    public const NAME = 'bpwpuc';

    /**
     * Perform all the required tasks for plugin front-end.
     *
     * @return void
     */
    public static function frontend(): void
    {
        // Check if user should see Under Construction page
        $user = wp_get_current_user();
        if (!$user || array_intersect(['editor', 'administrator'], $user->roles) === []) {

            // Get Under Construction template
            $template = self::renderTemplate();

            // Send proper status
            add_action('wp', static function () {
                status_header(503);
            });

            // Replace buffer with the template
            ob_start(static function () use ($template) {
                return $template;
            });

            // Show page output
            add_action('shutdown', static function () {
                ob_get_flush();
            }, 0);
        }
    }

    /**
     * Render and return under construction page template.
     *
     * @return string
     */
    public static function renderTemplate(): string
    {
        ob_start();
        include PATH_BPWPUC . '/themes/default/index.php';

        return ob_get_clean();
    }

    /**
     * Is this an admin request.
     *
     * @return bool
     */
    public static function isAdmin(): bool
    {
        $ABSPATH_MY = str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, ABSPATH);

        return
            (
                (
                    in_array($ABSPATH_MY . 'wp-login.php', get_included_files()) ||
                    in_array($ABSPATH_MY . 'wp-register.php', get_included_files())
                ) ||
                (
                    isset($_GLOBALS['pagenow']) && $GLOBALS['pagenow'] === 'wp-login.php'
                ) || $_SERVER['PHP_SELF'] === '/wp-login.php'
            );
    }

    /**
     * Load plugin translation domain.
     *
     * @return void
     */
    public static function loadTranslationDomain(): void
    {
        load_plugin_textdomain('bpwpuc', false, basename(PATH_BPWPUC) . '/languages');
    }
}