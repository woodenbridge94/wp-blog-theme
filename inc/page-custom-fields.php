<?php
/**
 * Add custom fields for pages.
 * Based on code from Stephanie Leary: http://stephanieleary.com/books/wordpress-for-web-developers/
 *
 * @package Peanut Butter 2015
 */


add_action('add_meta_boxes_page','page_custom_meta_boxes');

function page_custom_meta_boxes() {
    add_meta_box( 'page_custom_css', __('Custom CSS'), 'page_custom_css_meta_box', 'page', 'normal', 'high' );
}



function page_custom_css_meta_box() {
    if ( function_exists('wp_nonce_field') ) 
        wp_nonce_field('page_custom_css_nonce', '_page_custom_css_nonce'); 
?>
    <p><label for="_page_custom_css">Enter page-specific CSS</label><br>
    <textarea name="_page_custom_css" style="width: 100%; height:20em; " class="wp-editor-area"><?php echo esc_html( get_post_meta( get_the_ID(), '_page_custom_css', true ), 1 ); ?></textarea>

    <p><small>Note: Custom CSS is only output when using the <em>Blank canvas</em> page template. </small></p>
        
<?php
}


add_action( 'save_post', 'save_page_meta_data' );


function save_page_meta_data( $post_id ) {
    // ignore autosaves
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return $post_id;
        
    // check post type
    if ( 'page' != $_POST['post_type'] )
        return $post_id;
        
    // check capabilites
    if ( 'page' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
        return $post_id;
        
    // check nonces
    check_admin_referer( 'page_custom_css_nonce', '_page_custom_css_nonce' );
    
    // Still here? Then save the fields
    if ( empty( $_POST['_page_custom_css'] ) ) {
        $storedcode = get_post_meta( $post_id, '_page_custom_css', true );
        delete_post_meta( $post_id, '_page_custom_css', $storedcode );
    }
    else 
        update_post_meta( $post_id, '_page_custom_css', $_POST['_page_custom_css'] );

}



