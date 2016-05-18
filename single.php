<?php
/**
 * The template for displaying all single posts.
 *
 * @package Peanut Butter 2015
 */

get_header(); ?>

<!-- Begin pattern: single.php content-full //-->

<?php
		// Featured image for a post
		pb2015_post_featured_image();
?>



<div class="container" id="[id]">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <section class="content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php the_post_navigation(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>


      </section>
    </div>
  </div>
</div>

<!-- End pattern: content-full //-->


<?php get_sidebar(); ?>
<?php get_footer(); ?>
