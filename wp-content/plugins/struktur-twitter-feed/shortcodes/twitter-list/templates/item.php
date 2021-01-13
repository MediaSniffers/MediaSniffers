<li class="qodef-tl-item qodef-item-space">
    <div class="qodef-tli-inner">
        <div class="qodef-tli-content">
            <div class="qodef-twitter-content-top">
                <div class="qodef-twitter-user clearfix">
                    <div class="qodef-twitter-image">
                        <img src="<?php echo esc_url( $twitter_api->getHelper()->getTweetProfileImage( $tweet ) ); ?>" alt="<?php esc_attr_e( $twitter_api->getHelper()->getTweetProfileName( $tweet ) ); ?>"/>
                    </div>
                    <div class="qodef-twitter-name">
                        <div class="qodef-twitter-autor">
                            <h5><?php echo esc_html( $twitter_api->getHelper()->getTweetProfileName( $tweet ) ); ?></h5>
                        </div>
                        <div class="qodef-twitter-profile">
                            <a href="<?php echo esc_url( $twitter_api->getHelper()->getTweetProfileURL( $tweet ) ); ?>" target="_blank" itemprop="url">
                                <?php echo esc_html( $twitter_api->getHelper()->getTweetProfileScreenName( $tweet ) ); ?>
                            </a>
                        </div>
                    </div>
                </div>
                <i class="qodef-twitter-icon social_twitter"></i>
            </div>
            <div class="qodef-twitter-content-bottom">
                <div class="qodef-tweet-text">
                    <?php echo wp_kses_post( $twitter_api->getHelper()->getTweetText( $tweet ) ); ?>
                </div>
            </div>
            <a class="qodef-twitter-link-over" href="<?php echo esc_url( $twitter_api->getHelper()->getTweetProfileURL( $tweet ) ); ?>" target="_blank" itemprop="url"></a>
        </div>
    </div>
</li>