<?php
include 'inc/header.php';
$id = null;
if (isset($_GET['category'])) {
    $slug = $_GET['category'];
    $idcat = $cat->show_slug_id($slug);

    $cid = $idcat->fetch_assoc();
    $id = $cid['id'];
}
?>

<!-- -->

<!-- Breadcrumb Section Begin-->
<div class="breacrub-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="index.php"><i class="fa fa-home">Trang chủ</i></a>
                    <span>Cửa hàng</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End-->

<!-- Product Shop Section Begin-->
<section class="product-shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-8 order-lg-1 products-sidebar-filter">
                <div class="filter-widget">

                    <h4 class="fw-title">Categories</h4>
                    <ul class="filter-catagories">
                        <?php $slugcat = $cat->show_category();
                        if (isset($slugcat)) {
                            while ($result = $slugcat->fetch_assoc()) { ?>

                                <li><a href="shop.php?category=<?= $result['slug']; ?>"><?= $result['slug'] ?></a></li>
                            <?php }
                        } else {
                            echo '';
                        }

                        ?>
                    </ul>

                </div>
                <div class="filter-widget">
                    <h4 class="fw-title">Brand</h4>
                    <div class="fw-brand-check">
                        <?php $brand = $cat->show_category();
                        if ($brand) {
                            while ($result = $brand->fetch_assoc()) {
                                ?>

                                <div class="bc-item">
                                    <label for="bc-calvin"><?= $result['name'] ?>
                                        <input type="checkbox" id="bc-calvin">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            <?php }
                        } ?>
                    </div>
                </div>
                <div class="filter-widget">
                    <h4 class="fw-title">Khoảng giá</h4>
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
            <div class="col-lg-9 order-1 order-lg-2 ">
                <div class="product-show-option">
                    <div class="row">
                        <div class="col-lg-7 col-md-7">
                            <div class="select-option">
                                <select name="" id="" class="sorting">
                                    <option value="">Default Sorting</option>
                                </select>
                                <select name="" id="" class="p-show">
                                    <option value="">Show:</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lq-5 col-md-5 text-right">
                            <p>Show 01-09 Of 36 Product</p>
                        </div>
                    </div>
                </div>
                <div class="product-list">
                    <div class="row">
                        <?php
                        $list = (($id !== null) ? $product->show_product_user($id) : $product->show_product());
                        if (
                            isset($list)
                        ) {
                            while ($result = $list->fetch_assoc()) {
                                ?>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item">
                                        <div class="pi-pic">
                                            <img style="height:265px; width:265px;" src="uploads/<?= $result['image'] ?>"
                                                alt="">
                                            <div class="sale pp-sale">Sale</div>
                                            <div class="icon">
                                                <i class="icon_heart_alt"></i>
                                            </div>
                                            <ul>
                                                <li class="w-icon active"><a href=""><i class="icon_bag_alt"></i></a></li>
                                                <li class="quick-view"><a href="product.php?product=<?= $result['id'] ?>">+
                                                        Quick-View</a></li>
                                                <li class="w-icon"><a href=""> <i class="fa fa-random"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="pi-text">
                                            <div class="catagory-name">Towel
                                            </div>
                                            <a href="">
                                                <h5><?= $result['name'] ?></h5>
                                            </a>
                                            <div class="product-price">
                                                <?= "₫" . $fm->format_currency($result['selling_price']) ?>
                                                <span><?= "₫" . $fm->format_currency($result['original_price']) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "Cửa hàng trống";
                        }
                        ?>
                    </div>
                    <div class="loading-more"><i class="icon_loading"></i><a href="">Loading More</a></div>
                </div>
            </div>
        </div>
</section>

<!-- Product Section End-->
<?php
include 'inc/footer.php';
?>