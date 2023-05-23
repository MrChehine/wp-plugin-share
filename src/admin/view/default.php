<form action="options.php" method="post">
    <?php

        settings_fields('mahdx-social-share');
        do_settings_sections('mahdx-social-share');
        submit_button();

    ?>
</form>