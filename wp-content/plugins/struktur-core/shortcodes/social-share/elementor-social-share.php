<?php

class StrukturCoreElementorElementorSocialShare extends \Elementor\Widget_Base {

    public function get_name() {
        return 'qodef_social_share';
    }

    public function get_title() {
        return esc_html__( 'Social Share', 'struktur-core' );
    }

    public function get_icon() {
        return 'struktur-elementor-custom-icon struktur-elementor-social-share';
    }

    public function get_categories() {
        return [ 'struktur' ];
    }

    public function getSocialNetworks() {
        $socialNetworks = array(
            'facebook',
            'twitter',
            'google_plus',
            'linkedin',
            'tumblr',
            'pinterest',
            'vk'
        );

        return $socialNetworks;
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'struktur-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'type',
            [
                'label'   => esc_html__( 'Type', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'list'     => esc_html__( 'List', 'struktur-core' ),
                    'dropdown' => esc_html__( 'Dropdown', 'struktur-core' ),
                    'text'     => esc_html__( 'Text', 'struktur-core' )
                ],
                'default' => 'list'
            ]
        );

        $this->add_control(
            'dropdown_behavior',
            [
                'label'   => esc_html__( 'DropDown Hover Behavior', 'struktur-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'bottom'   => esc_html__( 'On Bottom Animation', 'struktur-core' ),
                    'right'    => esc_html__( 'On Right Animation', 'struktur-core' ),
                    'left'     => esc_html__( 'On Left Animation', 'struktur-core' )
                ],
                'default' => 'bottom',
                'condition' => [
                    'type' => array( 'dropdown' )
                ]
            ]
        );

        $this->add_control(
            'icon_type',
            [
                'label'     => esc_html__( 'Icons Type', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    'font-awesome' => esc_html__( 'Font Awesome', 'struktur-core' ),
                    'font-elegant' => esc_html__( 'Font Elegant', 'struktur-core' ),
                ],
                'condition' => [
                    'type' => array( 'list', 'dropdown' )
                ],
                'default'   => 'font-awesome'
            ]
        );

        $this->add_control(
            'title',
            [
                'label'     => esc_html__( 'Social Share Title', 'struktur-core' ),
                'type'      => \Elementor\Controls_Manager::TEXT
            ]
        );
    }

    public function render() {
        $params = $this->get_settings_for_display();

        $args   = array(
            'type'              => 'list',
            'dropdown_behavior' => 'bottom',
            'icon_type'         => 'font-awesome',
            'title'             => ''
        );

        $params = shortcode_atts( $args, $params );

        //Is social share enabled
        $params['enable_social_share'] = ( struktur_select_options()->getOptionValue( 'enable_social_share' ) == 'yes' ) ? true : false;

        //Is social share enabled for post type
        $post_type         = str_replace( '-', '_', get_post_type() );
        $params['enabled'] = ( struktur_select_options()->getOptionValue( 'enable_social_share_on_' . $post_type ) == 'yes' ) ? true : false;

        //Social Networks Data
        $params['networks'] = $this->getSocialNetworksParams( $params );

        $params['dropdown_class'] = ! empty( $params['dropdown_behavior'] ) ? 'qodef-' . $params['dropdown_behavior'] : 'qodef-' . $args['dropdown_behavior'];

        $html = '';

        if ( $params['enable_social_share'] ) {
            if ( $params['enabled'] ) {
                echo struktur_core_get_shortcode_module_template_part( 'templates/' . $params['type'], 'social-share', '', $params );
            }
        }
    }

    /**
     * Get Social Networks data to display
     * @return array
     */
    private function getSocialNetworksParams( $params ) {
        $networks   = array();
        $icons_type = $params['icon_type'];
        $type       = $params['type'];
        $socialNetworks = $this->getSocialNetworks();

        foreach ( $socialNetworks as $net ) {
            $html = '';

            if ( struktur_select_options()->getOptionValue( 'enable_' . $net . '_share' ) == 'yes' ) {
                $image                 = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                $params                = array(
                    'name' => $net,
                    'type' => $type
                );

                $params['link']        = $this->getSocialNetworkShareLink( $net, $image );

                if ($type == 'text') {
                    $params['text']    = $this->getSocialNetworkText( $net );
                } else {
                    $params['icon']    = $this->getSocialNetworkIcon( $net, $icons_type );
                }

                $params['custom_icon'] = ( struktur_select_options()->getOptionValue( $net . '_icon' ) ) ? struktur_select_options()->getOptionValue( $net . '_icon' ) : '';

                $html = struktur_core_get_shortcode_module_template_part( 'templates/parts/network', 'social-share', '', $params );
            }

            $networks[ $net ] = $html;
        }

        return $networks;
    }

    /**
     * Get share link for networks
     *
     * @param $net
     * @param $image
     * @return string
     */
    private function getSocialNetworkShareLink($net, $image) {
        switch ($net) {
            case 'facebook':
                if (wp_is_mobile()) {
                    $link = 'window.open(\'https://m.facebook.com/sharer.php?u=' . urlencode(get_permalink()) . '\');';
                } else {
                    $link = 'window.open(\'https://www.facebook.com/sharer.php?u=' . urlencode(get_permalink()) . '\', \'sharer\', \'toolbar=0,status=0,width=620,height=280\');';
                }
                break;
            case 'twitter':
                $count_char = (isset($_SERVER['https'])) ? 23 : 22;
                $twitter_via = (struktur_select_options()->getOptionValue('twitter_via') !== '') ? esc_attr__( ' via ', 'struktur-core' ) . struktur_select_options()->getOptionValue('twitter_via') . ' ' : '';
                if (wp_is_mobile()) {
                    $link = 'window.open(\'https://twitter.com/share?text=' . urlencode(struktur_select_the_excerpt_max_charlength($count_char) . $twitter_via)  . '&url='. get_permalink() .'\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');';
                } else {
                    $link = 'window.open(\'https://twitter.com/home?status=' . urlencode(struktur_select_the_excerpt_max_charlength($count_char) . $twitter_via) . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');';
                }
                break;
            case 'linkedin':
                $link = 'popUp=window.open(\'https://linkedin.com/shareArticle?mini=true&amp;url=' . urlencode(get_permalink()) . '&amp;title=' . urlencode(get_the_title()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'tumblr':
                $link = 'popUp=window.open(\'https://www.tumblr.com/share/link?url=' . urlencode(get_permalink()) . '&amp;name=' . urlencode(get_the_title()) . '&amp;description=' . urlencode(get_the_excerpt()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'pinterest':
                $link = 'popUp=window.open(\'https://pinterest.com/pin/create/button/?url=' . urlencode(get_permalink()) . '&amp;description=' . struktur_select_addslashes(get_the_title()) . '&amp;media=' . urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'vk':
                $link = 'popUp=window.open(\'https://vkontakte.ru/share.php?url=' . urlencode(get_permalink()) . '&amp;title=' . urlencode(get_the_title()) . '&amp;description=' . urlencode(get_the_excerpt()) . '&amp;image=' . urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            default:
                $link = '';
        }

        return $link;
    }

    private function getSocialNetworkIcon( $net, $type ) {

        switch ( $net ) {
            case 'facebook':
                $icon = ( $type == 'font-elegant' ) ? 'social_facebook' : 'fab fa-facebook-f';
                break;
            case 'twitter':
                $icon = ( $type == 'font-elegant' ) ? 'social_twitter' : 'fab fa-twitter';
                break;
            case 'linkedin':
                $icon = ( $type == 'font-elegant' ) ? 'social_linkedin' : 'fab fa-linkedin';
                break;
            case 'tumblr':
                $icon = ( $type == 'font-elegant' ) ? 'social_tumblr' : 'fab fa-tumblr';
                break;
            case 'pinterest':
                $icon = ( $type == 'font-elegant' ) ? 'social_pinterest' : 'fab fa-pinterest';
                break;
            case 'vk':
                $icon = 'fab fa-vk';
                break;
            default:
                $icon = '';
        }

        return $icon;
    }

    private function getSocialNetworkText( $net ) {
        switch ( $net ) {
            case 'facebook':
                $text = esc_html__( 'fb', 'struktur-core');
                break;
            case 'twitter':
                $text = esc_html__( 'tw', 'struktur-core');
                break;
            case 'linkedin':
                $text = esc_html__( 'lnkd', 'struktur-core');
                break;
            case 'tumblr':
                $text = esc_html__( 'tmb', 'struktur-core');
                break;
            case 'pinterest':
                $text = esc_html__( 'pin', 'struktur-core');
                break;
            case 'vk':
                $text = esc_html__( 'vk', 'struktur-core');
                break;
            default:
                $text = '';
        }

        return $text;
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StrukturCoreElementorElementorSocialShare() );