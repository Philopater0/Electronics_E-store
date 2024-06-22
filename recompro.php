<?php include 'includes/session.php'; ?>
<?php
    $conn = $pdo->open();

    $product_id = 1; // Assuming the product ID you want to fetch is 1

    try {
        $stmt = $conn->prepare("SELECT * FROM recom WHERE Id = :id");
        $stmt->execute(['id' => $product_id]);
        $product = $stmt->fetch();
        
        if (!$product) {
            echo "Product not found.";
            exit(); // Stop further execution
        }

    } catch (PDOException $e) {
        echo "There is some problem in connection: " . $e->getMessage();
    }
?>
<?php include 'includes/header.php'; ?>
<html style="background-color:#f1f4f2;">
<body class="skin-blue layout-top-nav" style="background-color:#f1f4f2;">
<script>
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
   
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<div class="wrapper" style="background-color:#f1f4f2;">

    <?php include 'includes/navbar.php'; ?>
    
    <div class="content-wrapper" style="background-color:#f1f4f2;">
        <div class="container">

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="callout" id="callout" style="display:none">
                            <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
                            <span class="message"></span>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <?php if (isset($product['Image_URL'])): ?>
                                <img style="border-radius:15px" src="<?php echo $product['Image_URL']; ?>" width="100%" class="zoom" data-magnify-src="<?php echo $product['Image_URL']; ?>">
                                <br><br>
                                <form class="form-inline" id="productForm">
                                    <div class="form-group">
                                        <div class="input-group col-sm-5">
                                            <span class="input-group-btn">
                                                <button type="button" id="minus" class="btn btn-default btn-flat btn-lg"><i class="fa fa-minus"></i></button>
                                            </span>
                                            <input type="text" name="quantity" id="quantity" class="form-control input-lg" value="1">
                                            <span class="input-group-btn">
                                                <button type="button" id="add" class="btn btn-default btn-flat btn-lg"><i class="fa fa-plus"></i></button>
                                            </span>
                                            <input type="hidden" value="<?php echo $product['Id']; ?>" name="id">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg btn-flat" style="background-color:black;border-radius:7px;"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    </div>
                                </form>
                                <?php else: ?>
                                <p>Product Image not available.</p>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-6">
                                <h1 class="page-header"><?php echo isset($product['Name_1']) ? $product['Name_1'] : 'Product Name'; ?></h1>
                                <h3><b>&#36; <?php echo isset($product['Price']) ? number_format($product['Price'], 2) : '0.00'; ?></b></h3>
                                <!-- Description can be added here if available -->
                            </div>
                        </div>
                        <br>
                        <div class="fb-comments" data-href="http://localhost/ecommerce/product.php" data-numposts="10" width="100%"></div> 
                    </div>
                    <div class="col-sm-3">
                        <?php include 'includes/sidebar.php'; ?>
                    </div>
                </div>
            </section>
        
        </div>
    </div>
    <?php $pdo->close(); ?>
    <?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
    $('#add').click(function(e){
        e.preventDefault();
        var quantity = $('#quantity').val();
        quantity++;
        $('#quantity').val(quantity);
    });
    $('#minus').click(function(e){
        e.preventDefault();
        var quantity = $('#quantity').val();
        if(quantity > 1){
            quantity--;
        }
        $('#quantity').val(quantity);
    });

});
</script>

</body>
</html>
