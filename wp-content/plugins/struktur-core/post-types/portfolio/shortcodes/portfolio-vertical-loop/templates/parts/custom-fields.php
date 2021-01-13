<?php
$custom_fields = get_post_meta(get_the_ID(), 'qodef_portfolio_properties', true);

if(is_array($custom_fields) && count($custom_fields)) :
    foreach($custom_fields as $custom_field) : ?>
        <div class="qodef-pvl-info-item qodef-pvl-custom-field">
            <?php if(!empty($custom_field['item_title'])) {
            echo struktur_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-vertical-loop', 'parts/info-title', 'standard', array( 'title' => $custom_field['item_title'] ));
            } ?>
            <p>
                <?php if(!empty($custom_field['item_url'])) : ?><a itemprop="url" href="<?php echo esc_url($custom_field['item_url']); ?>"><?php endif; ?>
                    <?php echo esc_html($custom_field['item_text']); ?>
                <?php if(!empty($custom_field['item_url'])) : ?></a><?php endif; ?>
            </p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>