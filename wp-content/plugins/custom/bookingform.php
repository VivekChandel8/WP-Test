<?php
/*
Plugin Name: Booking Vehicle
Plugin URI: 
Description: Simple Booking vehicle  Add short code for Booking enquiry form [wp_booking_form]
Version: 1.0
Author: dev
Author URI: 
*/

 /*
 * Get Post By category id 
 */

function prefix_load_cat_posts () {
    global $post;

    $cat_id = $_POST[ 'cat' ];

         $args = array (
        'cat' => $cat_id,
        //'posts_per_page' => 10,
        'order' => 'DESC'

    );

    $posts = get_posts( $args );

    ob_start ();

    foreach ( $posts as $post ) {
    setup_postdata( $post ); 
    
    //print_r($post);die;
    ?>
    <select name="vehicle_id" id="vehicle_id">
    <option value="<?php echo $post->ID; ?>"><?php the_title(); ?></option>
    </select>

   <?php } wp_reset_postdata();

   $response = ob_get_contents();
   ob_end_clean();

   echo $response;
   die(1);
   }


    function html_frontend_form() {
        include( plugin_dir_path( __FILE__ ) . 'forms/Enquirybook.php'); 
    }

    function deliver_mail() {

        global $wpdb;


        // if the submit button is clicked, send the email
        if ( isset( $_POST['bookenquirysub'] ) ) {
    
            // sanitize form values
            $firstname    = sanitize_text_field( $_POST["first_name"] );
            $lastname   = sanitize_text_field( $_POST["last_name"] );
            $phone = sanitize_text_field( $_POST["phone"] );
            $message = esc_textarea( $_POST["message"] );
            $vehicle_type_id    = sanitize_text_field( $_POST["vehicle_type_id"] );
            $email   = sanitize_email( $_POST["email"] );
            $vehicle_id = sanitize_text_field( $_POST["vehicle_id"] );

            $insertarry =array( 'first_name' => $firstname, 'last_name' => $lastname, 'phone' => $phone, 'email' => $email, 'message' => $message, 'vehicle_type_id' => $vehicle_type_id, 'vehicle_post_id' => $vehicle_id );
            //print_r($insertarry);die;
            $rows_affected = $wpdb->insert('wp_vehicle_booking', $insertarry);
    
            // get the blog administrator's email address
            $to = get_option( 'admin_email' );
    
            $headers = "From: $name <$email>" . "\r\n";
    
            // If email has been process for sending, display a success message
            if ( wp_mail( $to, $subject, $message, $headers ) ) {
                echo '<div>';
                echo '<p>Thanks for contacting me, expect a response soon.</p>';
                echo '</div>';
            } else {
                echo 'An unexpected error occurred';
            }
        }
    }

        //Create table function 

        function create_plugin_database_table()
        {
            global $table_prefix, $wpdb;
        
            $tblname = 'vehicle_booking';
            $wp_track_table = $table_prefix . "$tblname";
        
            #Check to see if the table exists already, if not, then create it
        
            if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) 
            {
        
                $sql = "CREATE TABLE `".$wp_track_table."` ( ";
                $sql .= "  `id`  int(11)   NOT NULL auto_increment, ";
                $sql .= "  `first_name`  VARCHAR(100)   DEFAULT NULL, ";
                $sql .= "  `last_name`  VARCHAR(100)   DEFAULT NULL, ";
                $sql .= "  `email`  VARCHAR(100)   DEFAULT NULL, ";
                $sql .= "  `phone`  VARCHAR(100)   DEFAULT NULL, ";
                $sql .= "  `vehicle_type_id`  int(11)   DEFAULT NULL, ";
                $sql .= "  `vehicle_post_id`  int(11)   DEFAULT NULL, ";     
                $sql .= "  `message`  VARCHAR(255)   DEFAULT NULL, ";
                $sql .= "  `status`  int(11)   DEFAULT 1, "; //1 pending 2 approved 3 rejected
                $sql .= "  `created_at`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, ";
                $sql .= "  `updated_at`  TIMESTAMP NULL , ";
                $sql .= "  PRIMARY KEY (`id`) "; 
                $sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ";
               // echo $sql ; die;
                require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
                dbDelta($sql);
            }
        }

        //Deactivate Function

        function my_plugin_remove_database() {
            global $wpdb;
            $table_name = $wpdb->prefix . 'vehicle_booking';
            $sql = "DROP TABLE IF EXISTS $table_name";
            $wpdb->query($sql);
            delete_option("my_plugin_db_version");
        }   



    function cf_shortcode() {
        ob_start();
        deliver_mail();
        html_frontend_form();
    
        return ob_get_clean();
    }


    	
function custom_post_type() {
 
    // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'Vehicle', 'Post Type General Name', 'twentythirteen' ),
            'singular_name'       => _x( 'Vehicle', 'Post Type Singular Name', 'twentythirteen' ),
            'menu_name'           => __( 'Vehicles', 'twentythirteen' ),
            'parent_item_colon'   => __( 'Parent Movie', 'twentythirteen' ),
            'all_items'           => __( 'All Vehicles', 'twentythirteen' ),
            'view_item'           => __( 'View Vehicle', 'twentythirteen' ),
            'add_new_item'        => __( 'Add New Vehicle', 'twentythirteen' ),
            'add_new'             => __( 'Add Vehicle', 'twentythirteen' ),
            'edit_item'           => __( 'Edit Vehicle', 'twentythirteen' ),
            'update_item'         => __( 'Update Vehicle', 'twentythirteen' ),
            'search_items'        => __( 'Search Vehicle', 'twentythirteen' ),
            'not_found'           => __( 'Not Found', 'twentythirteen' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
        );
         
    // Set other options for Custom Post Type
         
        $args = array(
            'label'               => __( 'vehicle', 'twentythirteen' ),
            'description'         => __( 'Vehicle news and reviews', 'twentythirteen' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
             
            // This is where we add taxonomies to our CPT
            'taxonomies'          => array( 'category' ),
        );
         
        // Registering your Custom Post Type
        register_post_type( 'movies', $args );
     
    }


    function enquiry_list_page() {

        include( plugin_dir_path( __FILE__ ) . 'forms/booklisting.php');

    }

    
     
    /* Hook into the 'init' action so that the function
    * Containing our post type registration is not 
    * unnecessarily executed. 
    */
     
    add_action( 'init', 'custom_post_type', 0 );


    //Activation hook for creating table in db while activating
    register_activation_hook( __FILE__, 'create_plugin_database_table' );

    //Deactivation hook for droping table in db while Deactivating
    register_deactivation_hook( __FILE__, 'my_plugin_remove_database' );


    // Frontend Form shortr code
    add_shortcode( 'wp_booking_form', 'cf_shortcode' );

    //hook
    add_action( 'wp_ajax_load-filter', 'prefix_load_cat_posts' );
    
    
    //admin menu
    add_action( 'admin_menu', 'VehicleBooking' );  
    function VehicleBooking(){   
            $page_title = 'VehicleBooking Post Info';  
            $menu_title = 'VehicleBooking Page Info'; 
            $capability = 'manage_options';   
            $menu_slug  = 'enquiry-list';  
            $function   = 'enquiry_list_page';  
            $icon_url   = 'dashicons-media-code'; 
            $position   = 6;    
    add_menu_page( $page_title,$menu_title,$capability, $menu_slug, $function, $icon_url,$position ); 

}
?>