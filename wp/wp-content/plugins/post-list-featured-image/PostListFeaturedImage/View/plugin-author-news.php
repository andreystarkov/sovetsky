<?php
if ( !defined( 'ABSPATH' ) || preg_match(
		'#' . basename( __FILE__ ) . '#',
		$_SERVER['PHP_SELF']
	)
) {
	die( "You are not allowed to call this page directly." );
}
?>
<div class="plugin-author-news">
    <?php
    $feed = @fetch_feed( trailingslashit( $plugin->AuthorURI ) . 'feed' );

    if ( is_object( $feed ) ) {
        if ( is_wp_error( $feed ) ) {
            ?>
            <p><?php printf(
                    __(
                        'An error occurred while retrieving latest news feed. Check %s site directly for the latest news.',
                        'post-list-featured-image'
                    ),
                    '<a href="' . trailingslashit( $plugin->AuthorURI ) . '">' . $plugin->Author . '</a>'
                ); ?>
            </p>
            <?php
            return;
        }
        $items = $feed->get_items( 0, 5 );
        if ( !empty( $items ) ) {
            echo '<ul>';
            foreach ( $items as $item ) {
                $permalink = esc_url( strip_tags( $item->get_permalink() ) );
                $desc      = str_replace(
                    array( "\n", "\r" ),
                    ' ',
                    esc_attr(
                        strip_tags(
                            @html_entity_decode(
                                $item->get_description(),
                                ENT_QUOTES,
                                get_option( 'blog_charset' )
                            )
                        )
                    )
                );
                $desc      = wp_html_excerpt( $desc, 360 );
                $desc      = preg_replace(
                    '/Read More &gt;&gt;.+/',
                    '<a href="' . $permalink . '">' . __( 'Read More', 'post-list-featured-image' ) . '</a>',
                    $desc
                );
                echo
                    '<li><a href="' .
                    $permalink .
                    '" target="_blank">' .
                    esc_html( strip_tags( $item->get_title() ) ) .
                    '</a><br>' .
                    $desc .
                    '</li>';
            }
            echo '</ul>';
        }
    } else {
        ?>
        <p><?php printf(
                __(
                    'Unable to fetch latest news from %s. Check %s site directly for the latest news.',
                    'post-list-featured-image'
                ),
                $plugin->Author,
                '<a href="' . trailingslashit( $plugin->AuthorURI ) . '">' . $plugin->Author . '</a>'
            ); ?>
        </p>
    <?php
    }
    ?>
</div>
