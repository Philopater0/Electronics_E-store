<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav" style="background-color:#f1f4f2;">
<div class="wrapper" style="background-color:#f1f4f2;">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper" style="background-color:#f1f4f2;">
	    <div class="container" style="background-color:#f1f4f2;">

	      <!-- Main content -->
	      <section class="content" style="background-color:#f1f4f2;">
	        <div class="row">
	        	<div class="col-sm-9">
	            <?php
	       			
	       			$conn = $pdo->open();

	       			$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM products WHERE name LIKE :keyword");
	       			$stmt->execute(['keyword' => '%'.$_POST['keyword'].'%']);
	       			$row = $stmt->fetch();
	       			if($row['numrows'] < 1){
	       				echo '<h1 class="page-header">No results found for <i>'.$_POST['keyword'].'</i></h1>';
	       			}
	       			else{
	       				echo '<h1 class="page-header">Search results for <i>'.$_POST['keyword'].'</i></h1>';
		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE :keyword");
						    $stmt->execute(['keyword' => '%'.$_POST['keyword'].'%']);
					 
							foreach ($stmt as $row) {
						    	$imageURL = $row['photo'];
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
								   <div class='col-sm-4' style='margin-bottom: 20px;'>
								   <div class='box box-solid' style='border: 1px solid #ccc; border-radius: 10px;'>
									   <div class='box-body prod-body'>
										   <img src='".$imageURL."' width='100%' height='180px' class='thumbnail' style='border-radius: 5px;'>
										   <h5><a href='product.php?product=".$row['slug']."' style='color: black; font-size:medium; text-decoration: none;'>" . $row['name'] . "</a></h5>
									   </div>
									   <div class='box-footer' style='background-color: #f9f9f9; padding: 10px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;'>
									   <b style='color: rgb(62, 62, 62); font-size: 18px;'>EG " . number_format($row['price'], 2) . "</b>
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
<?php include 'includes/remove.php'; ?>
</body>
</html>
