<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<html style="background-color:#f1f4f2;">
<body class=" login-page" style="background-color:#f1f4f2;">
<div class="login-box">
  	<?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='callout callout-danger text-center'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }
      if(isset($_SESSION['success'])){
        echo "
          <div class='callout callout-success text-center'>
            <p>".$_SESSION['success']."</p> 
          </div>
        ";
        unset($_SESSION['success']);
      }
    ?>
  	<div class="login-box-body" style="border-radius: 10px;">
    	<p class="login-box-msg">Enter email associated with account</p>

    	<form action="reset.php" method="POST">
      		<div class="form-group has-feedback">
        		<input type="email" class="form-control" name="email" placeholder="Email" required>
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      		</div>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="reset" style="background-color:black;"><i class="fa fa-envelope"></i> Send</button>
        		</div>
      		</div>
    	</form>
      <br>
      <a href="login.php" style="color:black;">I remembered my password</a><br>
      <a href="index.php" style="color:black;"><i class="fa fa-home"></i> Home</a>
  	</div>
</div>
	
<?php include 'includes/scripts.php' ?>
</body>
</html>
