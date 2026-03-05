<?php

use BPExtensions\WPUC\Admin\Settings;

global $wp_version;

$default_meta_title  = __('We are under construction', 'bpwpuc');
$default_first_line  = __('We\'re building something awesome!', 'bpwpuc');
$default_second_line = __('Our website is under major reconstruction.<br>Come back soon.', 'bpwpuc');
?>
<!DOCTYPE html>
<html lang="<?php echo get_locale() ?>">
<head>
    <meta charset="utf-8">
    <title><?php echo Settings::getOption('meta_title', $default_meta_title) ?></title>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <meta name="robots" content="noindex"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
          rel="stylesheet"/>
    <link rel="stylesheet"
          href="<?php echo get_site_url() ?>/wp-content/plugins/bp_wpuc/themes/default/assets/build/theme.css?<?php echo $wp_version ?>"/>
</head>

<body>
<div id="particles-js"></div>
<div class="content">
    <div class="wrapper">
        <h1><?php echo Settings::getOption('first_line', $default_first_line) ?></h1>
        <p><?php echo Settings::getOption('second_line', $default_second_line) ?></p>
    </div>
</div>

<div id="loader-overlay">
    <div id="loader"></div>
</div>

<script
    src="<?php echo get_site_url() ?>/wp-content/plugins/bp_wpuc/themes/default/assets/build/theme.js?<?php echo $wp_version ?>"></script>

</body>
</html>