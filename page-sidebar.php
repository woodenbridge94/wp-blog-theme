<?php
/*
 * Template Name: Page with sidebar
 *
 * This page shows a standard 9 grid column for content and a 3 grid column
 * for sidebar content.
 *
 * @package Peanut Butter 2015
 */

get_header(); ?>


<div class="container">        
  <div class="row">
    <div class="col-md-9">
      <section class="content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>
        
     
      </section>
    </div>
    <div class="col-md-3">
        <?php get_sidebar(); ?>
    </div>
  </div>
</div>


<?php get_footer(); ?>
