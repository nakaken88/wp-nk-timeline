<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,viewport-fit=cover">
        <meta name="description" content="<?php bloginfo( 'description' ); ?>">
        <link rel="stylesheet" href="https://cdn.rawgit.com/filipelinhares/ress/master/dist/ress.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns"
            crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php wp_head(); ?>
    </head>
    <body <?php body_class( $class ); ?>>
        <header>
            <h1>
                <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
            </h1>
        </header>
        <main>
<?php
            if ( is_archive() ) {
                echo '<h2>' . get_the_archive_title() . '</h2>';
            }
?>
            <ul id="timeline">
<?php 
                if (have_posts()) : while (have_posts()) : the_post(); 
?>
                <li class="timeline-item <?php echo get_post_status( get_the_ID() );?>">
                    <div class="timeline-item-time">
                        <a href="<?php echo get_year_link( get_the_time('Y') ); ?>">
                            <span class="yyyy"><?php the_time('Y'); ?></span>
                        </a>
                        <a href="<?php echo get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ); ?>">
                            <span class="mm"><?php echo get_post_time('M'); ?></span>
                        </a>
                        <a href="<?php echo get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ); ?>">
                            <span class="dd"><?php the_time('d'); ?></span>
                        </a>
                        <a href="<?php the_permalink(); ?>">
                            <span class="hhmm"><?php the_time('H:i'); ?></span>
                        </a>
                        <?php edit_post_link( '[Edit]', '<br />' ); ?>
                    </div>
                    <div class="timeline-item-body">
                        <?php the_content(); ?>
                    </div>
                    <div class="timeline-item-tag">
                        <?php the_tags(""," "); ?>
                    </div>
                    <div class="timeline-item-category">
<?php 
                        $categories = get_the_category();
                        $separator = '<br />';
                        $output = '';

                        if ( $categories ) {
                            foreach( $categories as $category ) {
                                $teg_fa = get_term_meta( $category->term_id, 'tag-fa', true );
                                if ( $teg_fa == "" ) {
                                    $teg_fa = '<i class="fas fa-comment-alt"></i>';
                                }
                                $output .= '<a href="' . get_category_link( $category->term_id )
                                    . '" title="' . $category->cat_name . '">'
                                    . $teg_fa . '</a>' . $separator;
                            }
                            echo substr( $output, 0, -1 * strlen( $separator ) );
                        }
?>
                    </div>
                </li>
<?php endwhile; else : ?>
                <li><?php _e( 'Sorry, no posts matched your criteria.' ); ?></li>
<?php endif; ?>
            </ul>
            <nav class="pagination">
<?php
                echo paginate_links( array(
                    'prev_next' => false,
                ) );
?>
            </nav>
        </main>
        <?php wp_footer(); ?>
    </body>
</html>
