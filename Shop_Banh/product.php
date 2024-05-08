<?php
include 'inc/header.php';
if (isset($_GET['product'])) {
    $id = $_GET['product'];


}

$userid = Session::get('id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['whishlist'])) {
    $status = $_POST['status'];
    $id = $_GET['product'];
    // Lấy trạng thái từ biểu mẫu
    $insertWhishlist = $product->insertWishlist($userid, $status, $id);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitcmt'])) {
    $prod_id = $_POST['prod_id'];
    $cmt = $_POST['cmt'];
    // Lấy trạng thái từ biểu mẫu
    $insertWhishlist = $us->insert_comment($userid, $prod_id, $cmt);
}
?>
<style>
    .red-heart {
        color: red;
    }

    .grey-heart {
        color: gray;
    }
</style>
<!-- -->

<!-- Breadcrumb Section Begin-->
<div class="breacrub-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="index.php"><i class="fa fa-home">Trang chủ</i></a>
                    <a href="shop.php">Cửa hàng</a>
                    <span>Chi tiết</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End-->

<!-- Product Shop Section Begin-->
<section class="product-shop spad page-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="filter-widget">
                    <h4 class="fw-title">Categories</h4>
                    <ul class="filter-catagories">
                        <li><a href="">Men</a></li>
                        <li><a href="">Women</a></li>
                        <li><a href="">Kids</a></li>
                    </ul>
                </div>
                <div class="filter-widget">
                    <h4 class="fw-title">Brand</h4>
                    <div class="fw-brand-check">
                        <div class="bc-item">
                            <label for="bc-calvin">Calvin Klein
                                <input type="checkbox" id="bc-calvin">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="bc-item">
                            <label for="bc-calvin1">Calvin Klein
                                <input type="checkbox" id="bc-calvin1">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="bc-item">
                            <label for="bc-calvin2">Calvin Klein
                                <input type="checkbox" id="bc-calvin2">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="bc-item">
                            <label for="bc-calvin3">Calvin Klein
                                <input type="checkbox" id="bc-calvin3">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="filter-widget">
                    <h4 class="fw-title">Price</h4>
                    <div class="filter-range-wrap">
                        <div class="range-slider">
                            <div class="price-input">
                                <input type="text" id="minamount">
                                <input type="text" id="maxamount">
                            </div>
                        </div>
                        <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                            data-min="33" data-max="98">
                            <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                        </div>
                    </div>
                    <a href="#" class="filter-btn">Filter</a>
                </div>
            </div>
            <div class="col-lg-9">
                <?php $list = $product->getproductbyId($id);

                if ($list) {
                    while ($result = $list->fetch_assoc()) { ?>
                        <div class="row product_data ">
                            <div class="col-lg-6">
                                <div class="product-pic-zoom">
                                    <img src="uploads/<?= $result['image'] ?>" alt="" class="product-big-img">
                                    <div class="zoom-icon"><i class="fa fa-search-plus"></i></div>
                                </div>
                                <div class="product-thumbs">
                                    <div class="product-thumbs-track ps-slider owl-carousel">
                                        <div class="pt active" data-imgbigurl="uploads/<?= $result['image'] ?>">
                                            <img src="uploads/<?= $result['image'] ?>" alt="">
                                        </div>
                                        <div class="pt" data-imgbigurl="uploads/<?= $result['image'] ?>">
                                            <img src="uploads/<?= $result['image'] ?>" alt="">
                                        </div>
                                        <div class="pt" data-imgbigurl="uploads/<?= $result['image'] ?>">
                                            <img src="uploads/<?= $result['image'] ?>" alt="">
                                        </div>
                                        <div class="pt" data-imgbigurl="uploads/<?= $result['image'] ?>">
                                            <img src="uploads/<?= $result['image'] ?>" alt="">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="product-details">
                                    <form action="" method="POST">
                                        <input type="hidden" name="prod_id" value="<?= $result['id'] ?>">
                                        <!-- Thêm trường ẩn để lưu trạng thái của yêu thích -->
                                        <input type="hidden" name="status" value="<?= $whishlist_status ?>">
                                        <div class="pd-title">
                                            <span><?= $result['slug'] ?></span>
                                            <h3><?= $result['name'] ?></h3>
                                            <!-- Kiểm tra nếu trạng thái của yêu thích là 1, thêm class "clicked" -->
                                            <?php
                                            $status = $product->show_product_whishlist($id);
                                            if (Session::get('auth') && $status !== false) {
                                                if ($status1 = $status->fetch_assoc()) {
                                                    ?>
                                                    <button type="submit" name="whishlist"
                                                        class="heart-icon <?= $whishlist_status == 1 ? 'clicked' : '' ?>">
                                                        <i
                                                            class="icon_heart_alt <?= $status1['status'] == 1 ? ' red-heart' : 'grey-heart' ?>"></i>
                                                    </button>

                                                    <?php
                                                }
                                            } else { ?>
                                                <button type="submit" name="whishlist" class="heart-icon">
                                                    <i class="icon_heart_alt"></i>
                                                </button>
                                                <?php
                                            } ?>
                                        </div>
                                    </form>
                                    <div class="pd-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <div class="pd-desc">
                                        <p><?= $result['description'] ?></p>
                                        <h4> <?= $fm->format_currency($result['selling_price']) . "." . "VNĐ" ?>

                                            <span><?= $fm->format_currency($result['original_price']) . "." . "VNĐ" ?></span>
                                        </h4>
                                    </div>
                                    <div class="pd-size-choose">
                                        <div class="sc-item">
                                            <input type="text" id="sm-size">
                                            <label for="sm-size">s</label>
                                        </div>
                                        <div class="sc-item">
                                            <input type="text" id="md-size">
                                            <label for="md-size">m</label>
                                        </div>
                                        <div class="sc-item">
                                            <input type="text" id="lg-size">
                                            <label for="lg-size">l</label>
                                        </div>
                                        <div class="sc-item">
                                            <input type="text" id="xl-size">
                                            <label for="xl-size">xs</label>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group mb-3" style="width:130px">
                                                <button class="input-group-text decrement-btn">-</button>
                                                <input type="text" class=" form-control text-center input-qty" value="1"
                                                    disabled>
                                                <button class="input-group-text increment-btn">+</button>
                                            </div>

                                        </div>
                                        <?php
                                        $qty = $product->show_product_qty($id);
                                        if ($result = $qty->fetch_assoc()) {
                                            if ($result['qty'] <= 0) {
                                                ?>
                                                <div class="col-md-6">
                                                    <button class="primary-btn px-2 pd-cart "
                                                        style="opacity: 0.5; pointer-events: none;" disabled>
                                                        <i class="fa fa-shopping-cart"></i> Sản phẩm đã hết
                                                    </button>
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div class="col-md-6">
                                                    <button class="primary-btn px-2 pd-cart addToCartBtn" value="<?= $result['id'] ?>">
                                                        <i class="fa fa-shopping-cart mg-2"></i>Thêm vào giỏ hàng
                                                    </button>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <ul class="pd-tags">
                                        <li><span>CATEGORIES</span>: More Accessories, Wallet &Cases</li>
                                        <li><span>TAGS</span>: Clothing, T-shirt, Woman</li>
                                    </ul>
                                    <div class="pd-share">
                                        <div class="p-code">Sku : 00012</div>
                                        <div class="pd-social">
                                            <a href=""><i class="ti-facebook"></i></a>
                                            <a href=""><i class="ti-twitter"></i></a>
                                            <a href=""><i class="ti-linkedin"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
                <div class="product-tab">
                    <div class="customer-review-option">
                        <h4>2 Comments</h4>
                        <div class="comment-option">
                            <div class="co-item">
                                <div class="avatar-pic">
                                    <img src="img/product-single/avatar-1.png" alt="">
                                </div>
                                <div class="avatar-text">
                                    <div class="at-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <h5>Brandon Kelley<span>27 May 2024</span></h5>
                                    <div class="at-reply">Nice !</div>
                                </div>
                                <div class="co-item">
                                    <div class="avatar-pic">
                                        <img src="img/product-single/avatar-1.png" alt="">
                                    </div>
                                    <div class="avatar-text">
                                        <div class="at-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <h5>Brandon Kelley<span>27 May 2024</span></h5>
                                        <div class="at-reply">Nice !</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="personal-rating">
                                    <h6>Your Rating</h6>
                                    <?php $list = $product->getproductbyId($id);

if ($list) {
    while ($result = $list->fetch_assoc()) { ?>
                                    <form action="" method="POST">
                                        <div class="pd-rating">
                                            <?php for ($count = 1; $count <= 5; $count++) {
                                                if ($count <= 0) {
                                                    $color = 'color:#FAC451';
                                                } else {
                                                    $color = 'color:#999591';
                                                }
                                                ?>
                                                <li class="rating fa fa-star " style="cursor:pointer;<?= $color ?> "
                                                    id="<?= $result['id'] ?>-<?= $count ?>" data-product_id="<?= $result['id'] ?>"
                                                    data-rating="<?= $count ?>" data-index="<?= $count ?>"
                                                    data-customer_id="<?= Session::get('id') ?>">
                                                </li>
                                            <?php } ?>
                                        </div>
                                    </form>
                                    <?php }
                } ?>
                                </div>
                                <div class="leave-comment">
                                    <h4>Leave A Comment</h4>
                                    <form action="product.php?product=<?= $id ?>" method="POST" class="comment-form">
                                        <input type="hidden" name="prod_id" value="<?= $id ?>" id="">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <textarea name="cmt" placeholder="Messages"></textarea>
                                                <button type="submit" name="submitcmt" class="site-btn"
                                                    value="<?= $id ?>">Send
                                                    message</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- Product Shop Section End-->

<!-- Related Products Section Begin-->
<div class="related-products spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Related Products</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="product-item">
                    <div class="pi-pic">
                        <img src="img/products/product-1.jpg" alt="">
                        <div class="sale pp-sale">Sale</div>
                        <div class="icon">
                            <i class="icon_heart_alt"></i>
                        </div>
                        <ul>
                            <li class="w-icon active"><a href=""><i class="icon_bag_alt"></i></a></li>
                            <li class="quick-view"><a href="product.php">+ Quick-View</a></li>
                            <li class="w-icon"><a href=""> <i class="fa fa-random"></i></a></li>
                        </ul>
                    </div>
                    <div class="pi-text">
                        <div class="catagory-name">Towel
                        </div>
                        <a href="">
                            <h5>Pure Pineapple</h5>
                        </a>
                        <div class="product-price">
                            $14.00
                            <span>$35.00</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="product-item">
                    <div class="pi-pic">
                        <img src="img/products/product-2.jpg" alt="">
                        <div class="sale pp-sale">Sale</div>
                        <div class="icon">
                            <i class="icon_heart_alt"></i>
                        </div>
                        <ul>
                            <li class="w-icon active"><a href=""><i class="icon_bag_alt"></i></a></li>
                            <li class="quick-view"><a href="product.php">+ Quick-View</a></li>
                            <li class="w-icon"><a href=""> <i class="fa fa-random"></i></a></li>
                        </ul>
                    </div>
                    <div class="pi-text">
                        <div class="catagory-name">Towel
                        </div>
                        <a href="">
                            <h5>Pure Pineapple</h5>
                        </a>
                        <div class="product-price">
                            $14.00
                            <span>$35.00</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="product-item">
                    <div class="pi-pic">
                        <img src="img/products/product-3.jpg" alt="">
                        <div class="sale pp-sale">Sale</div>
                        <div class="icon">
                            <i class="icon_heart_alt"></i>
                        </div>
                        <ul>
                            <li class="w-icon active"><a href=""><i class="icon_bag_alt"></i></a></li>
                            <li class="quick-view"><a href="product.php">+ Quick-View</a></li>
                            <li class="w-icon"><a href=""> <i class="fa fa-random"></i></a></li>
                        </ul>
                    </div>
                    <div class="pi-text">
                        <div class="catagory-name">Towel
                        </div>
                        <a href="">
                            <h5>Pure Pineapple</h5>
                        </a>
                        <div class="product-price">
                            $14.00
                            <span>$35.00</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="product-item">
                    <div class="pi-pic">
                        <img src="img/products/product-4.jpg" alt="">
                        <div class="sale pp-sale">Sale</div>
                        <div class="icon">
                            <i class="icon_heart_alt"></i>
                        </div>
                        <ul>
                            <li class="w-icon active"><a href=""><i class="icon_bag_alt"></i></a></li>
                            <li class="quick-view"><a href="product.php">+ Quick-View</a></li>
                            <li class="w-icon"><a href=""> <i class="fa fa-random"></i></a></li>
                        </ul>
                    </div>
                    <div class="pi-text">
                        <div class="catagory-name">Towel
                        </div>
                        <a href="">
                            <h5>Pure Pineapple</h5>
                        </a>
                        <div class="product-price">
                            $14.00
                            <span>$35.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Related Products Section End-->
<?php
include 'inc/footer.php';
?>