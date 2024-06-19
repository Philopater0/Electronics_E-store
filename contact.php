<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en" style="background-color:#f1f4f2;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="bower_components/jquery/dist/jquery.min.js"></script>


</head>

<body style="background-color: rgb(236, 239, 244);background-color:#f1f4f2;"class="hold-transition skin-blue layout-top-nav">
<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper"style="background-color: rgb(236, 239, 244);background-color:#f1f4f2;">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
  
        <div><h1>Contact Us</h1></div>
        <br />
        
        <div style="display:flex;" class="container">
        <div class="col-sm-4">
                <div id="googlemap" style="width:100%; height:350px;"></div>
            </div>
            <br />
            <div class="col-sm-4">
                <form class="my-form">
                    <div class="form-group">
                        <label for="form-name" style="color: black;">Name</label>
                        <input type="email" class="form-control" id="form-name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="form-email" style="color: black;">Email Address</label>
                        <input type="email" class="form-control" id="form-email" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <label for="form-subject" style="color: black;">Telephone</label>
                        <input type="text" class="form-control" id="form-subject" placeholder="Subject">
                    </div>
                    <div class="form-group">
                        <label for="form-message" style="color: black;">Email your Message</label>
                        <textarea class="form-control" id="form-message" placeholder="Message"></textarea>
                    </div>
                    <button class="btn btn-default" type="submit" style="background-color: black;">Contact Us</button>                
                </form>
                
            </div>
            <div class="col-sm-3" style="margin-left: 6.4rem; bottom: 10.6rem;">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
           
                </div>
      
        
                 
    
    
    <style>
        .my-form {
            color: #305896;
        }
        .my-form .btn-default {
            background-color: #305896;
            color: #fff;
            border-radius: 0;
        }
        .my-form .btn-default:hover {
            background-color: #4498C6;
            color: #fff;
        }
        .my-form .form-control {
            border-radius: 0;
        }
    </style>
    
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script type="text/javascript">
        jQuery(function ($) {
            // Google Maps setup
            var googlemap = new google.maps.Map(
                document.getElementById('googlemap'),
                {
                    center: new google.maps.LatLng(44.5403, -78.5463),
                    zoom: 8,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
            );
        });
    </script>
   <div class="col-sm-3">
	        
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>