<?php

if ( ! function_exists( 'struktur_select_sidearea_options_map' ) ) {
	function struktur_select_sidearea_options_map() {

        struktur_select_add_admin_page(
            array(
                'slug'  => '_side_area_page',
                'title' => esc_html__('Side Area', 'struktur'),
                'icon'  => 'fa fa-indent'
            )
        );

        $side_area_panel = struktur_select_add_admin_panel(
            array(
                'title' => esc_html__('Side Area', 'struktur'),
                'name'  => 'side_area',
                'page'  => '_side_area_page'
            )
        );

        struktur_select_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_type',
                'default_value' => 'side-menu-slide-from-right',
                'label'         => esc_html__('Side Area Type', 'struktur'),
                'description'   => esc_html__('Choose a type of Side Area', 'struktur'),
                'options'       => array(
                    'side-menu-slide-from-right'       => esc_html__('Slide from Right Over Content', 'struktur'),
                    'side-menu-slide-with-content'     => esc_html__('Slide from Right With Content', 'struktur'),
                    'side-area-uncovered-from-content' => esc_html__('Side Area Uncovered from Content', 'struktur'),
                ),
            )
        );

        struktur_select_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'text',
                'name'          => 'side_area_width',
                'default_value' => '',
                'label'         => esc_html__('Side Area Width', 'struktur'),
                'description'   => esc_html__('Enter a width for Side Area (px or %). Default width: 405px.', 'struktur'),
                'args'          => array(
                    'col_width' => 3,
                )
            )
        );

        $side_area_width_container = struktur_select_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_width_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_type' => 'side-menu-slide-from-right',
                    )
                )
            )
        );

        struktur_select_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'color',
                'name'          => 'side_area_content_overlay_color',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Color', 'struktur'),
                'description'   => esc_html__('Choose a background color for a content overlay', 'struktur'),
            )
        );

        struktur_select_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'text',
                'name'          => 'side_area_content_overlay_opacity',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Transparency', 'struktur'),
                'description'   => esc_html__('Choose a transparency for the content overlay background color (0 = fully transparent, 1 = opaque)', 'struktur'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        struktur_select_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_icon_source',
                'default_value' => 'icon_pack',
                'label'         => esc_html__('Select Side Area Icon Source', 'struktur'),
                'description'   => esc_html__('Choose whether you would like to use icons from an icon pack or SVG icons', 'struktur'),
                'options'       => struktur_select_get_icon_sources_array()
            )
        );

        $side_area_icon_pack_container = struktur_select_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_icon_pack_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'icon_pack'
                    )
                )
            )
        );

        struktur_select_add_admin_field(
            array(
                'parent'        => $side_area_icon_pack_container,
                'type'          => 'select',
                'name'          => 'side_area_icon_pack',
                'default_value' => 'font_elegant',
                'label'         => esc_html__('Side Area Icon Pack', 'struktur'),
                'description'   => esc_html__('Choose icon pack for Side Area icon', 'struktur'),
                'options'       => struktur_select_icon_collections()->getIconCollectionsExclude(array('linea_icons', 'dripicons', 'simple_line_icons'))
            )
        );

        $side_area_svg_icons_container = struktur_select_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_svg_icons_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'svg_path'
                    )
                )
            )
        );

        struktur_select_add_admin_field(
            array(
                'parent'      => $side_area_svg_icons_container,
                'type'        => 'textarea',
                'name'        => 'side_area_icon_svg_path',
                'label'       => esc_html__('Side Area Icon SVG Path', 'struktur'),
                'description' => esc_html__('Enter your Side Area icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'struktur'),
            )
        );

        struktur_select_add_admin_field(
            array(
                'parent'      => $side_area_svg_icons_container,
                'type'        => 'textarea',
                'name'        => 'side_area_close_icon_svg_path',
                'label'       => esc_html__('Side Area Close Icon SVG Path', 'struktur'),
                'description' => esc_html__('Enter your Side Area close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'struktur'),
            )
        );

        $side_area_icon_style_group = struktur_select_add_admin_group(
            array(
                'parent'      => $side_area_panel,
                'name'        => 'side_area_icon_style_group',
                'title'       => esc_html__('Side Area Icon Style', 'struktur'),
                'description' => esc_html__('Define styles for Side Area icon', 'struktur')
            )
        );

        $side_area_icon_style_row1 = struktur_select_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row1'
            )
        );

        struktur_select_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_color',
                'label'  => esc_html__('Color', 'struktur')
            )
        );

        struktur_select_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_hover_color',
                'label'  => esc_html__('Hover Color', 'struktur')
            )
        );

        $side_area_icon_style_row2 = struktur_select_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row2',
                'next'   => true
            )
        );

        struktur_select_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row2,
                'type'   => 'colorsimple',
                'name'   => 'side_area_close_icon_color',
                'label'  => esc_html__('Close Icon Color', 'struktur')
            )
        );

        struktur_select_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row2,
                'type'   => 'colorsimple',
                'name'   => 'side_area_close_icon_hover_color',
                'label'  => esc_html__('Close Icon Hover Color', 'struktur')
            )
        );

        struktur_select_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'color',
                'name'        => 'side_area_background_color',
                'label'       => esc_html__('Background Color', 'struktur'),
                'description' => esc_html__('Choose a background color for Side Area', 'struktur')
            )
        );

        struktur_select_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'text',
                'name'        => 'side_area_padding',
                'label'       => esc_html__('Padding', 'struktur'),
                'description' => esc_html__('Define padding for Side Area in format top right bottom left', 'struktur'),
                'args'        => array(
                    'col_width' => 3
                )
            )
        );

        struktur_select_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'selectblank',
                'name'          => 'side_area_aligment',
                'default_value' => '',
                'label'         => esc_html__('Text Alignment', 'struktur'),
                'description'   => esc_html__('Choose text alignment for side area', 'struktur'),
                'options'       => array(
                    ''       => esc_html__('Default', 'struktur'),
                    'left'   => esc_html__('Left', 'struktur'),
                    'center' => esc_html__('Center', 'struktur'),
                    'right'  => esc_html__('Right', 'struktur')
                )
            )
        );
    }

    add_action('struktur_select_action_options_map', 'struktur_select_sidearea_options_map', struktur_select_set_options_map_position( 'sidearea' ) );
}