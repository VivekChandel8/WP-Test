<?php /* Template Name: Booking list */ 
global $wpdb;
wp_head();

$Bookings = $wpdb->get_results( "SELECT * FROM wp_vehicle_booking INNER JOIN wp_posts ON wp_vehicle_booking.vehicle_post_id = wp_posts.ID  order by created_at DESC" );
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<div class="container">
  <h2>Booking List</h2>
           
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Vehicle</th>
        <th>status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($Bookings as $row){ ?>
      <tr>
        <td> <?=$row->first_name.' '.$row->last_name ?> </td>
    
        <td><?=$row->email ?> </td>
        <td><?=$row->post_title ?></td>
        <td><?php if($row->status == 1){ echo "Pending";} elseif($row->status == 2 ){ echo "Approved";}else{ echo "rejected"; } ?></td>
        <td><select name="getstatus" ><option value="1">Approved</option><option value="2">Pending</option><option value="3">Rejected</option></select></td>
      </tr>
    <?php } ?>
      
    </tbody>
  </table>
</div>