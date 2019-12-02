<?php
/**
 * Main Blog Page
 */

get_header();
?>


    <div class="container-fluid mw-xl">

        <div class="row main-content">

            <div class="col-12 col-sm-8">

				<?php

				// Featured Post
				$args = array(
					'post_type'      => 'post',
					'posts_per_page' => 6,
					'order'          => 'DESC',
					'orderby'        => 'date',
					'meta_query'     => array(
						array(
							'key'     => 'featured_post',
							'value'   => '1',
							'compare' => '=',
						),
					),
				);

				$featured_posts = new WP_Query( $args );
				?>

				<?php if ( $featured_posts->have_posts() ) : ?>
                    <div class="row mb-5">
						<?php
						while ( $featured_posts->have_posts() ) :
							$featured_posts->the_post();
							get_template_part( 'partials/post/blog-entry' );
						endwhile;
						?>
                    </div>
					<?php
				endif;
				wp_reset_postdata();
				?>


				<?php if ( have_posts() ) : ?>
                    <div class="row py-3">
						<?php
						while ( have_posts() ) :
							the_post();
							get_template_part( 'partials/post/blog-entry' );
						endwhile;
						?>
                    </div>
					<?php

				else :
					get_template_part( 'partials/post/no-entries' );
				endif;

				//ptheme_pagination();
				?>
            </div>

			<?php
			if ( is_active_sidebar( 'main-sidebar' ) ) {
				get_sidebar();
			}
			?>

        </div>
    </div>


<?php
get_footer();
