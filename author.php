<?php
/**
 * The template for displaying author pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Peanut Butter 2015
 */

get_header(); ?>

	<!-- Begin pattern: author.php 2016-03-22 content-full //-->

	<div class="container" id="[id]">
	  <div class="row">
	    <div class="col-sm-8 col-sm-offset-2">
	      <section class="content" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<div class="author-bio">
				<?php echo get_avatar( get_the_author_meta('email'), '90' ); ?>
				<div class="author-info">
					<p class="author-description"><?php the_author_meta('description'); ?></p>
				</div>
			</div>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>


	      </section>
	    </div>
	  </div>
	</div>

	<!-- End pattern: content-full //-->


<?php get_sidebar(); ?>
<?php get_footer(); ?>
