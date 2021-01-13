<?php if( struktur_select_is_plugin_installed( 'core' ) ) { ?>
    <div class="qodef-blog-like">
        <?php if( function_exists('struktur_core_get_like') ) struktur_core_get_like(); ?>
    </div>
<?php } ?>