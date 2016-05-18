<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Peanut Butter 2015
 */
?>


    <!-- Begin pattern: footer //--> 

    <footer>

      <?php 
        $options = get_option('pb2015_theme_options');

        if ($options['footer_type'] == 'large'):
      ?>
      <div id="website-footer">
        <div class="container">
          <div class="row">
            <div class="col-sm-4" id="footer-tools">
            
                <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                    <div id="footer-widgets-1" class=" widget-area" role="complementary">
                        <?php dynamic_sidebar( 'footer-1' ); ?>
                    </div><!-- #footer-widgets-1 -->
                <?php endif; ?>
                </div>

            <div class="col-sm-4" id="footer-navigation">
            
                <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                    <div id="footer-widgets-1" class=" widget-area" role="complementary">
                        <?php dynamic_sidebar( 'footer-2' ); ?>
                    </div><!-- #footer-widgets-1 -->
                <?php endif; ?>
            
            </div>

            <div class="col-sm-4" id="footer-contact">
            
              <h3>Contact us</h3>
              <address>
              <strong><?php print $options['unit_name']?></strong><br>
              <?php print nl2br($options['street_address']) ?><br><br>
              <?php if ($options['phone_number']): ?>
              <strong>Phone:</strong> <?php print $options['phone_number']?><br>
              <?php endif; ?>
              <?php if ($options['email']): ?>
              <strong>Email:</strong> <a href="mailto:<?php print $options['email']?>"><?php print $options['email']?></a><br>
              <?php endif; ?>
              </address>
            
            </div>
          </div> <!-- End .row -->
        </div> <!-- End .container -->
      </div> <!-- End #website-footer -->
      <?php endif;?>

      <div id="university-footer">
        <div class="container">
          <div class="row">

            <div class="col-lg-8">
              <p id="footer-charity" role="contentinfo">© <?php echo date("Y"); ?> University of St Andrews is a charity registered in Scotland, No SC013532.</p>
              <ul id="footer-links">
                <li><a href="//www.st-andrews.ac.uk/terms/cookies/">Privacy and cookies</a></li>
                <li><a href="//www.st-andrews.ac.uk/help/">Website help</a></li>
              </ul>
            </div>
            
            <div class="col-lg-4">
              <ul id="social">
                <li><a href="https://www.facebook.com/uniofsta"><img src="<?php print dpl_url("images/furniture/facebook-logo-svg.svg");?>" alt="Facebook"></a></li>
                <li><a href="https://twitter.com/univofstandrews/"><img src="<?php print dpl_url("images/furniture/twitter-logo-svg.svg");?>" alt="Twitter"></a></li>
              </ul>
            </div>

          </div> <!-- End .row //-->
        </div> <!-- End .container //-->
      </div> <!-- End #university-footer //-->

    </footer>

    <!-- End pattern: footer //--> 

<?php wp_footer(); ?>

</body>
</html>
