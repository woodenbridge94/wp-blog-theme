<?php
/*
 * Template Name: Homepage 
 *
 * Homepage template
 *
 * @package Peanut Butter 2015
 */

get_header();?>

		<div id="primary" class="homepage">
			<div id="content" role="main">

			<!-- Top story //-->
			<div id="featured-story" class="chunk">
			    <div class="container">

			        <div class="row">
			              <div class="col-md-7">
			              <?php
								$featured_query = new WP_Query('posts_per_page=1&category_name=featured');
								while ( $featured_query->have_posts() ) : $featured_query->the_post();
								$do_not_duplicate[] = $post->ID; 
							?>

			                <h2><a href="<?php the_permalink(); ?>"><?php the_title();/*3*/ ?></a></h2>
			                <p><?php echo custom_excerpt(54); ?></p>
			                <p><?php the_time( get_option( 'date_format' ) ); ?> | <?php $categories = get_the_category();
								if ( ! empty( $categories ) ) {
								    echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
								} ?></p>

			              </div><!-- .col-md-7 //-->

			              	<div class="col-md-5">

			                	<a href="http://standrewsdigital.org.uk/stories/story-long/"><?php if ( has_post_thumbnail() ) {
									the_post_thumbnail(); } else { ?> <img src="<?php bloginfo('template_directory'); ?>/images/the-town.jpg" alt="<?php the_title(); ?>" /> <?php } ?></a>
			                
			            	</div><!-- .col-md-5 //-->
			            	<?php endwhile; wp_reset_postdata();?>
			        </div> <!-- .row //-->
			    </div> <!-- .container //-->
			</div><!-- #top-story //-->


			<!-- Tile grid : Top Stories -->
			<div class="tile-grid" style="background-color: #f0f0f0;">

			    <div class="container">

			        <div class="row">
			            <div class="col-md-12">

			                <h2>Top stories</h2>

			            </div>
			        </div>

			        <div class="row">

				        <?php 
					        $cat_id = get_cat_ID('featured');
					        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
					        $my_query = new WP_Query('posts_per_page=3&cat=-'.$cat_id.'&paged='.$paged);
							while ( $my_query->have_posts() ) : $my_query->the_post();
							if ( in_array( $post->ID, $do_not_duplicate ) ) continue;										 
						?>
						<?php $do_not_duplicate[] = $post->ID; ?>
			            <!-- navigation object : Related tiles -->
			            <div class="col-sm-6 col-md-4 big-target-click-zone">

			                <!-- Begin pattern: tile //-->

			                <article class="tile ">

			                    <div class="tile-image-title">

			                        <?php if ( has_post_thumbnail() ) {
									the_post_thumbnail(); } else { ?> <img src="<?php bloginfo('template_directory'); ?>/images/the-town.jpg" alt="<?php the_title(); ?>" /> <?php } ?>

			                        <h3 id="line1"><a href="<?php the_permalink(); ?>" class="big-target-anchor"><?php the_title();?></a></h3>
			                    </div>

			                    <p><?php echo custom_excerpt(30); ?></p>

			                    <div class="tile-date"><?php the_time( get_option( 'date_format' ) ); ?></div>

			                    <div class="tile-type"><?php $categories = get_the_category();
								if ( ! empty( $categories ) ) {
								    echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
								} ?></div>

			                    <div class="clear"></div>

			                </article>

			                <!-- End pattern: tile //-->

			            </div>
			            

						<?php endwhile; 
						wp_reset_postdata();?>

			        </div>
			        <!-- // End .row -->

			        <div class="read-more read-more-container-alt"></div>

			    </div>
			    <!-- // End .container -->

			</div>
			<!--  END Top Stories -->

			<!-- SEARCH -->
			<!-- News search //-->

			<div class="" id="course-search" style="background-color: #fafafa; padding: 50px 0;">
			    <div class="container">

			        <form action="http://standrewsdigital.org.uk/stories/archive" method="get">

			            <div class="input-group input-group-lg">
			                <span class="input-group-addon" style="border: none; background-color: transparent; padding-left: 0;">Search stories</span>
			                <input class="form-control" type="text" title="q" maxlength="256" name="q" placeholder="Search..." value="">
			                <span class="input-group-btn">
			                    <button class="btn btn-primary" type="submit" value="Search" name="btnG" id="header-search-submit">
			                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
			                    </button>
			                </span>
			            </div>

			        </form>

			    </div>
			</div>
			<!-- END SEARCH -->

			<!-- More stories //-->

			<div id="more-stories" class="chunk">
			    <div class="container">
			        <div class="row">
			            <div class="col-md-9">

			                <h2>More stories</h2>

			                <!-- Begin pattern: More stories //-->
			                <?php 

			                	$more_query = new WP_Query( array( 'posts_per_page' => '3','post__not_in'=>$do_not_duplicate) );
			                	while ( $more_query->have_posts() ) : $more_query->the_post();
							?>
							<?php $do_not_duplicate[] = $post->ID; ?>

			                <div class="col-md-9">

			                    <h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
			                    <p><?php echo custom_excerpt(40); ?></p>
			                    <p><?php the_time( get_option( 'date_format' ) ); ?> | <?php $categories = get_the_category();
								if ( ! empty( $categories ) ) {
								    echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
								} ?>
			                    </p>

			                </div>

			                <div class="col-md-3 news-image">
			                    <?php if ( has_post_thumbnail() ) {
									the_post_thumbnail(); } else { ?> <img src="<?php bloginfo('template_directory'); ?>/images/the-town.jpg" alt="<?php the_title(); ?>" /> <?php } ?>
			                </div>

			                <hr>

			                <?php endwhile; ?>

			                <!-- End pattern: tabs-container //-->

			            </div>
			            

			            <div class="col-md-3">

			                <!-- Begin pattern: tabs-container //-->


			                <div id="tabs-container">

			                    <ul class="nav nav-tabs">
			                        <li class="active"><a href="#read" data-toggle="tab" aria-expanded="true">Read</a>
			                        </li>
			                        <li class=""><a href="#shared" data-toggle="tab" aria-expanded="false">Shared</a>
			                        </li>
			                    </ul>


			                    <div id="tabs" class="tab-content">

			                        <div class="tab-pane fade active in" id="read" style="margin-top: 35px;">
			                            <ul>
			                            	<?php 

							                	$read_query = new WP_Query( array( 'posts_per_page' => '5','post__not_in'=>$do_not_duplicate) );
							                	while ( $read_query->have_posts() ) : $read_query->the_post();
											?>
											<?php $do_not_duplicate[] = $post->ID; ?>

			                                <li style="list-style-type: lower-hexadecimal;"><a href="<?php the_permalink(); ?>"><?php the_title();?></a>
			                                </li>
			                                <hr class="tab-hr">

			                                <?php endwhile; ?>
			                            </ul>
			                        </div>

			                        <div class="tab-pane fade" id="shared" style="margin-top: 35px;">
			                            <ul>

			                            	<?php 

							                	$shared_query = new WP_Query( array( 'posts_per_page' => '5','post__not_in'=>$do_not_duplicate) );
							                	while ( $shared_query->have_posts() ) : $shared_query->the_post();
											?>
											<?php $do_not_duplicate[] = $post->ID; ?>

			                                <li style="list-style-type: lower-hexadecimal;"><a href="<?php the_permalink(); ?>"><?php the_title();?></a>
			                                </li>
			                                <hr class="tab-hr">

	                                		<?php endwhile; ?>
			                            </ul>
			                        </div>

			                    </div>
			                    <!-- #tabs  .tab-content //-->

			                </div>
			                <!-- #tabs-container //-->

			                <!-- End pattern: tabs-container //-->

			            </div>
			            <!-- .col-md-3 //-->


			        </div>
			        <!-- .row //-->
			    </div>
			    <!-- .container //-->
			</div>
			<!-- #more-stories //-->


			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
