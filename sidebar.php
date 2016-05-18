<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Peanut Butter 2015
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>



<!-- Begin pattern: content-full //-->

<div class="container" id="[id]">        
  <div class="row">
    <div class="col-sm-12">
      <section class="content" role="main">

        <div id="secondary" class="widget-area" role="complementary">
        	<?php dynamic_sidebar( 'sidebar-1' ); ?>
        </div><!-- #secondary -->

      </section>
    </div>
  </div>
</div>

<!-- End pattern: content-full //-->