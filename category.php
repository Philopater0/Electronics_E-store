<?php include 'includes/session.php'; ?>
<?php
	$slug = $_GET['category'];

	$conn = $pdo->open();

	try{
		$stmt = $conn->prepare("SELECT * FROM category WHERE cat_slug = :slug");
		$stmt->execute(['slug' => $slug]);
		$cat = $stmt->fetch();
		$catid = $cat['id'];
	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}

	$pdo->close();

?>
<?php include 'includes/header.php'; ?>
<html style="background-color:#f1f4f2;">
<body class=" skin-blue layout-top-nav" style="background-color:#f1f4f2;">
<div class="wrapper" style="background-color:#f1f4f2;">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper" style="background-color:#f1f4f2;">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
		            <h1 class="page-header"><?php echo $cat['name']; ?></h1>
		       		<?php
		       			
		       			$conn = $pdo->open();

		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = :catid");
						    $stmt->execute(['catid' => $catid]);
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
								   <div class='col-sm-4' style='margin-bottom: 20px;'>
								   <div class='box box-solid' style='border: 1px solid #ccc; border-radius: 10px;'>
									   <div class='box-body prod-body'>
										   <img src='".$image."' width='100%' height='230px' class='thumbnail' style='border-radius: 5px;'>
										   <h5><a href='product.php?product=".$row['slug']."' style='color: black; font-size:medium; text-decoration: none;'>" . $row['name'] . "</a></h5>
									   </div>
									   <div class='box-footer' style='background-color: #f9f9f9; padding: 10px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;'>
									   <b style='color: rgb(62, 62, 62); font-size: 18px;'>&#36; " . number_format($row['price'], 2) . "</b>
									   </div>
								   </div>
							   </div>
							   
	       						";
	       						if($inc == 3) echo "</div>";
						    }
						    if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-4'></div></div>";
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> 
	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
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