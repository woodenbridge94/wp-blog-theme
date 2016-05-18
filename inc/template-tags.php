<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Peanut Butter 2015
 */

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'pb2015' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'pb2015' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'pb2015' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'pb2015' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'pb2015_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function pb2015_entry_meta() {


	// FORMAT TYPE
	// Prepare the format type for non-standard post types.

	$format_type = get_post_format(); // 'standard' format returns FALSE here.

	if ($format_type) {
		$format = '<span class="post-format-type">'.$format_type.'</span>';
	}
	else {
		$format = '';
	}

	// WHEN PUBLISHED
	// Prepare output of when the post was published.

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);
	
	$posted_on = sprintf(
		_x( '%s', 'post date', 'pb2015' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	// POST AUTHOR
	// Prepare output of post author and avatar.

	$avatar = get_avatar(get_the_author_meta( 'ID' ), 16, null, 'get_the_author()');

	$author = sprintf( _x( '%s', 'post author', 'pb2015' ),
		'<span class="author vcard">'.$avatar .'<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);


	print $format . '<span class="posted-on">' . $posted_on . '</span>' . $author;
}
endif;

if ( ! function_exists( 'pb2015_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function pb2015_entry_footer() {
	
	// Show categories and tags for Posts that are standard format on in any location.
	// And show cats and tags for Posts of any type when shown on a single page.
	if ('post' == get_post_type() && ( is_single() || get_post_format() == false) ) {

		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'pb2015' ) );
		if ( $categories_list && pb2015_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( '%1$s', 'pb2015' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'pb2015' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( '%1$s', 'pb2015' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'pb2015' ), __( '1 Comment', 'pb2015' ), __( '% Comments', 'pb2015' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'pb2015' ), '<span class="edit-link">', '</span>' );
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( 'Category: %s', 'pb2015' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag: %s', 'pb2015' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'pb2015' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', 'pb2015' ), get_the_date( _x( 'Y', 'yearly archives date format', 'pb2015' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', 'pb2015' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'pb2015' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', 'pb2015' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'pb2015' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'pb2015' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'pb2015' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'pb2015' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'pb2015' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'pb2015' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'pb2015' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'pb2015' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'pb2015' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'pb2015' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'pb2015' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'pb2015' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'pb2015' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function pb2015_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'pb2015_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'pb2015_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so pb2015_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so pb2015_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in pb2015_categorized_blog.
 */
function pb2015_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'pb2015_categories' );
}
add_action( 'edit_category', 'pb2015_category_transient_flusher' );
add_action( 'save_post',     'pb2015_category_transient_flusher' );



if ( ! function_exists( 'pb2015_post_thumbnail' ) ) :
/**
 * Display a featured image for a post if present.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * Adapted from Twenty Fifteen's twentyfifteen_post_thumbnail()
 */
function pb2015_post_featured_image() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail()  ) {
		return;
	}

	// On a single post (is_singular) we show a div with the background image
	// so that we can use background-size: cover
	// In other situations we output a <img>


	if (is_singular()): 
		$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
	?>

	<div class="featured-image-section" style="background-image: url(<?=$image_url[0]?>);">
	</div>

	<?php else: ?> 

	<div class="featured-image">
		<?php // the_post_thumbnail( 'large' ); ?>
	</div>


	<?php endif; // end is_singular()
}
endif;




/**
 * Fallback to the default audience menu.
 *
 */
function pb2015_audience_nav_fallback($params) {
	$options = get_option('pb2015_theme_options');
	$students_link = $options['logo_link'] . 'students/';
	$staff_link = $options['logo_link'] . 'staff/';
	$alumni_link = $options['logo_link'] . 'alumni/';
	?>
	<ul id="header-nav-menu" class="list-inline"><li><a href="<?php print $students_link; ?>">Students</a></li><li><a href="<?php print $staff_link; ?>">Staff</a></li><li><a href="<?php print $alumni_link; ?>">Alumni</a></li></ul>
	<?php 
}

