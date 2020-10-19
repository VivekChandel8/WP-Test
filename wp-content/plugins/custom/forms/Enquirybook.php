<?php /* Template Name: EnquiryPage */ 
global $wpdb;
wp_head();
?>

<form action="<?= esc_url( $_SERVER['REQUEST_URI'] ); ?>" method="post">
<p>
First Name (required) <br />
    <input type="text" name="first_name" pattern="[a-zA-Z0-9 ]+" size="40" />
</p>
<p>
Last Name (required) <br />
    <input type="text" name="last_name"   pattern="[a-zA-Z0-9 ]+" size="40"  required/>
</p>
Vehicle Type  <br />
<?php 
$categories = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC'
) );
$cathtml='<div class="col-md-6">
<select name="vehicle_type_id" id="vehicle_type_id">';

$cathtml .='<option value="">Choose Vehicle Type</option>';
        foreach( $categories as $category ) {
               
            $cathtml .='<option value="' .$category->term_id. '">' . $category->name . '</option>';
                  
        } 

        $cathtml .='</select></div>'; 
    echo $cathtml;     
?>
</p>
Vehicle   <br />
<div id="loading-animation" style="display: none;"><img src="<?php echo admin_url ( 'images/loading-publish.gif' ); ?>"/></div>
<div id="category-post-content"></div>
<p>

<p>
Email <br />
    <input type="email" name="email"  id="email" placeholder="Enter Email" required/>
</p>

<p>
Phone <br />
    <input type="text" name="phone"  id="phone" placeholder="Enter phone number" required/>
</p>

<p>
Message <br />
    <Textarea name="message"  id="message" >
    </textarea>
</p>

<input type="submit" name="bookenquirysub" value="Send"/></p>
</form>
<?php wp_footer();
 ?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script>
$('body').on('change','#vehicle_type_id', function(e){
  var catID =$(this).val();
    console.log(catID);
  if(catID !='') {
    $("#loading-animation").show();
    var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' );  ?>';
    $.ajax({
        type: 'POST',
        url: ajaxurl,
        data: {"action": "load-filter", cat: catID },
        success: function(response) {
            $("#category-post-content").html(response);
            $("#loading-animation").hide();
            return false;
        }
    });

  }
    
});
</script>