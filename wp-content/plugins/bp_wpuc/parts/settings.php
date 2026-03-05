<?php

use BPExtensions\WPUC\Plugin;

?>
<div class="wrap">
    <h2><?php echo __('Under Construction Settings', 'bpwpuc') ?></h2>
    <?php settings_errors(); ?>

    <form method="post" action="options.php">
        <?php
        settings_fields(Plugin::NAME . '-settings');
        do_settings_sections(Plugin::NAME . '-settings');
        submit_button();
        ?>
    </form>
</div>