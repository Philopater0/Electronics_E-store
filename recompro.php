<?php include 'includes/session.php'; ?>
<?php
    $conn = $pdo->open();

    $recom_id = $_GET['recom'];

    try {
        $stmt = $conn->prepare("SELECT *, products.name AS prodname, category.name AS catname, products.id AS prodid 
                                FROM products 
                                LEFT JOIN category ON category.id=products.category_id 
                                WHERE products.id = :recom_id");
        $stmt->execute(['recom_id' => $recom_id]);
        $product = $stmt->fetch();
    } catch (PDOException $e) {
        echo "There is some problem in connection: " . $e->getMessage();
    }

    // page view
    $now = date('Y-m-d');
    if ($product['date_view'] == $now) {
        $stmt = $conn->prepare("UPDATE products SET counter=counter+1 WHERE id=:id");
        $stmt->execute(['id' => $product['prodid']]);
    } else {
        $stmt = $conn->prepare("UPDATE products SET counter=1, date_view=:now WHERE id=:id");
        $stmt->execute(['id' => $product['prodid'], 'now' => $now]);
    }
?>
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
                        <div class="callout" id="callout" style="display:none">
                            <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
                            <span class="message"></span>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <img style="border-radius:15px" src="<?php echo $product['photo']; ?>" width="100%" height="250px" class="zoom" data-magnify-src="<?php echo $product['photo']; ?>">
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
                                            <input type="hidden" value="<?php echo $product['prodid']; ?>" name="id">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg btn-flat" style="background-color:black;border-radius:7px;"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-6">
                                <h1 class="page-header"><?php echo $product['prodname']; ?></h1>
                                <h3><b>EG <?php echo number_format($product['price'], 2); ?></b></h3>
                                <p><b>Category:</b> <a href="category.php?category=<?php echo $product['cat_slug']; ?>"><?php echo $product['catname']; ?></a></p>
                                <p><b>Description:</b></p>
                                <p><?php echo $product['description']; ?></p>
                            </div>
                        </div>
                        <br>
                        <div class="fb-comments" data-href="http://localhost/ecommerce/recompro.php?recom=<?php echo $recom_id; ?>" data-numposts="10" width="100%"></div> 
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
