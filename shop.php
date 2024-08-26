<?php
include "shared/head.php";
include "shared/nav.php";
include "app/function.php";
include "app/config.php";


if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    path('login.php');
}

$select1 =  "SELECT * FROM Categories";
$s1 = mysqli_query($conn, $select1);
$row1 = mysqli_fetch_assoc($s1);

$select = "SELECT * FROM products";
$s = mysqli_query($conn, $select);

if(isset($_GET['color'])){
    $color = $_GET['color'];
    $select = "SELECT * FROM products WHERE color = $color";
    $s = mysqli_query($conn, $select);
}

if (isset($_GET['size'])) {
    $size = $_GET['size'];
    $select = "SELECT * FROM products WHERE size = $size";
    $s = mysqli_query($conn, $select);
}

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $select = "SELECT * FROM products WHERE cat_id = $category_id";
    $s = mysqli_query($conn, $select);
}

// Initialize filtering
if (isset($_GET['min_price']) || isset($_GET['max_price'])) {
    $min_price = isset($_GET['min_price']) ? (int)$_GET['min_price'] : 0;
    $max_price = isset($_GET['max_price']) ? (int)$_GET['max_price'] : PHP_INT_MAX;

    // Fetch products based on price range
    $select = "SELECT * FROM products WHERE price >= $min_price";
    if ($max_price !== PHP_INT_MAX) {
        $select .= " AND price <= $max_price";
    }
    $s = mysqli_query($conn, $select);
}

?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shop</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form action="#">
                            <input type="text" placeholder="Search...">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll">
                                                <li><a href="shop.php">All Categories</a></li>
                                                <?php foreach ($s1 as $item) { ?>
                                                    <li><a href="shop.php?category_id=<?= $item['id'] ?>"><?= $item['name'] ?></a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                </div>
                                <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__price">
                                            <ul>
                                                <li><a href="shop.php">All Products</a></li>
                                                <li><a href="shop.php?min_price=500&max_price=1000">500 SAR - 1000 SAR</a></li>
                                                <li><a href="shop.php?min_price=1000&max_price=1500">1000 SAR - 1500 SAR</a></li>
                                                <li><a href="shop.php?min_price=1500&max_price=2000">1500 SAR - 2000 SAR</a></li>
                                                <li><a href="shop.php?min_price=2000&max_price=2500">2000 SAR - 2500 SAR</a></li>
                                                <li><a href="shop.php?min_price=2500&max_price=3500">2500 SAR - 3500 SAR</a></li>
                                                <li><a href="shop.php?min_price=3500&max_price=5000">3500 SAR - 5000 SAR</a></li>
                                                <li><a href="shop.php?min_price=5000">5000 SAR +</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                                </div>
                                <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__size">
                                            <a href="shop.php?size='S'"><label>S
                                                </label></a>
                                            <a href="shop.php?size='M'"><label>M
                                                </label></a>
                                            <a href="shop.php?size='L'"><label>L
                                                </label></a>
                                            <a href="shop.php?size='XL'"><label>XL
                                                </label></a>
                                            <a href="shop.php?size='2XL'"><label>2XL
                                                </label></a>
                                            <a href="shop.php?size='3XL'"><label>3XL
                                                </label></a>
                                            <a href="shop.php?size='4XL'"><label>4XL
                                                </label></a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseFive">Colors</a>
                                </div>
                                <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__color">
                                            <a href="shop.php?color='Black'">
                                                <label class="c-1">
                                                </label>
                                            </a>
                                            <a href="shop.php?color='Blue'">
                                                <label class="c-2">
                                                </label>
                                            </a>
                                            <a href="shop.php?color='Orange'">
                                                <label class="c-3">
                                                </label>
                                            </a>
                                            <a href="shop.php?color='Purple'">
                                                <label class="c-4">
                                                </label>
                                            </a>
                                            <a href="shop.php?color='Gray'">
                                                <label class="c-5">
                                                </label>
                                            </a>
                                            <a href="shop.php?color='Pink'">
                                                <label class="c-6">
                                                </label>
                                            </a>

                                            <a href="shop.php?color='Red'">
                                                <label class="c-8">
                                                </label>
                                            </a>
                                            <a href="shop.php?color='White'">
                                                <label class="c-9">
                                                </label>
                                            </a>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <p>Showing 1–12 of 126 results</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <?php foreach ($s as $item) { ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="<?= $item['image'] ?>">
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                        </li>
                                        <li><a href="./shop-details.html?id=<?= $item['id'] ?>"><img src="img/icon/search.png" alt=""></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><?= $item['name'] ?></h6>
                                    <a href="#" class="add-cart">+ Add To Cart</a>
                                    <div class="rating">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <div class="">
                                        <h5>Price : <?= $item['price'] ?> SAR</h5>
                                        <h5>Size : <?= $item['size'] ?></h5>
                                        <h5>Color : <?= $item['color'] ?></h5>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__pagination">
                            <a class="active" href="#">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <span>...</span>
                            <a href="#">21</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->
<!-- Footer Section Begin -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__logo">
                        <h3> <a href="https://www.instagram.com/awabid_collection/">Awabid Collection .</a></h3>
                    </div>
                    <p>The customer is at the heart of our unique business model, which includes design.</p>
                    <a href="#"><img src="img/payment.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Shopping</h6>
                    <ul>
                        <li><a href="#">Clothing Store</a></li>
                        <li><a href="#">Trending Abayas</a></li>
                        <li><a href="#">Abayas Accessories</a></li>
                        <li><a href="#">Big Sale</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Shopping</h6>
                    <ul>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Payment Methods</a></li>
                        <li><a href="#">Delivary</a></li>
                        <li><a href="#">Return & Exchanges</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <h6>NewLetter</h6>
                    <div class="footer__newslatter">
                        <p>Be the first to know about new arrivals, look books, sales & promos!</p>
                        <form action="#">
                            <input type="text" placeholder="Your email">
                            <button type="submit"><span class="icon_mail_alt"></span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="footer__copyright__text">
                    <p>Copyright ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        All rights reserved to <i class="fa fa-heart-o" aria-hidden="true"></i> by <a
                            href="https://www.instagram.com/awabid_collection/" target="_blank">Awabid
                            Collection</a>
                    </p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Js Plugins -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
</body>

</html>