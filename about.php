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
  
                        <div><h1>About Us</h1></div>
                        <br />
                        
                        <div style="display:flex;" class="container">
                            <div class="col-sm-8">
                                <p style="color: black;">
                                    Welcome to our company! We are dedicated to providing the best products and services to our customers. 
                                    Our team works tirelessly to ensure customer satisfaction and to constantly improve and innovate in our field. 
                                    Thank you for choosing us!
                                </p>
                                <br />
                                <h3 style="color: black;">Our Mission</h3>
                                <p style="color: black;">
                                    Our mission is to deliver top-quality products and unparalleled service to our customers. 
                                    We strive to exceed expectations and continuously improve our offerings.
                                </p>
                                <br />
                                <h3 style="color: black;">Our Values</h3>
                                <ul style="color: black;">
                                    <li>Customer Satisfaction</li>
                                    <li>Innovation</li>
                                    <li>Integrity</li>
                                    <li>Teamwork</li>
                                </ul>
                            </div>
                            <div class="col-sm-3" style="margin-left: 6.4rem; bottom: 10.6rem;">
                                <?php include 'includes/sidebar.php'; ?>
                            </div>
                        </div>
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
