<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<html style="background-color:#f1f4f2;">
<body class="skin-blue layout-top-nav" style="background-color:#f1f4f2;">
<div class="wrapper" style="background-color:#f1f4f2;">

    <?php include 'includes/navbar.php'; ?>
    
    <div class="content-wrapper" style="background-color:#f1f4f2;">
        <div class="container">

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-sm-9">
                        <h1 class="page-header"><?php echo "The Recommendations"; ?></h1>
                        <div class="row">
                            <?php
                                // Database connection using PDO
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "ecomm";

                                try {
                                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $stmt = $conn->prepare("SELECT * FROM recom");
                                    $stmt->execute();

                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        if (isset($row['Id'])) {
                                            $imageURL = $row['Image_URL']; // Assuming 'Image_URL' is the column name in the 'recom' table
                                            echo "
                                                    <div class='col-sm-4' style='margin-bottom: 20px;'>
                                                        <div class='box box-solid' style='border: 1px solid #ccc;'>
                                                            <div class='box-body prod-body'>
                                                                <img src='".$imageURL."' width='100%' height='150px' class='thumbnail'>
                                                                <h5><a href='recompro.php?recom=" . $row['Id'] . "' style='color: black; font-size:small; text-decoration: none;'>" . $row['Name_1'] . "</a></h5>
                                                            </div>
                                                            <div class='box-footer' style='background-color: #f9f9f9; padding: 10px;'>
                                                                <b style='color: rgb(62, 62, 62); font-size: 16px;'>EG " . number_format($row['Price'], 2) . "</b>
                                                            </div>
                                                        </div>
                                                    </div>
                                                ";
                                        }
                                    }
                                } catch(PDOException $e) {
                                    echo "There is some problem in connection: " . $e->getMessage();
                                }

                                $conn = null;
                            ?> 
                        </div>
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
<?php include 'includes/remove.php';?>
<?php include 'includes/scripts.php'; ?>

</body>
</html>
