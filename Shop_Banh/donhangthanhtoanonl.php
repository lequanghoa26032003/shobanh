<?php
include 'inc/header.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-order'])) {
    $order = $cart->Orders($_POST);
    if ($order) {
        echo '<script>
                setTimeout(function(){
                    window.location.href = "shop.php"; 
                }, 1000);
              </script>';
    }
}
?>

<!-- Breadcrumb Section Begin-->
<div class="breacrub-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="index.php"><i class="fa fa-home">Trang chủ</i></a>
                    <a href="shop.php">Cửa hàng</a>
                    <span>Thủ tục thanh toán</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End-->
<!-- -->
<!-- Shopping Cart Section Begin -->
<div class="checkout-section spad">
    <div class="container">
        <form action="congthanhtoan.php" method="post" class="checkout-form">
            <div class="row">
                <div class="col-lg-6">
                    <div class="checkout-content">
                        <a href="login.php" class="content-btn">Tới trang login</a>
                    </div>
                    <h4>Biiling Details</h4>
                    <div class="row">
                        <?php $list = $cart->get_product_cart();
                        $tongphu = 0;
                        $tong = 0;
                        if ($list) {
                            while ($result = $list->fetch_assoc()) {
                                ?>

                                <?php $tong += $result['selling_price'] * $result['prod_qty'];
                            }
                        } ?>
                        <input type="hidden" name="id" id="id" value="<? $_SESSION['id'] ?>">

                        <input type="hidden" name="total_price" value="<?= $tong ?>">
                        <div class="col-lg-6">
                            <label for="name">Tên <span>*</span></label>
                            <input type="text" name="name" id="name" placeholder="Họ và tên">
                        </div>
                        <div class="col-lg-6">
                            <label for="phone">Số điện thoại<span>*</span></label>
                            <input type="text" name="phone" id="phone" placeholder="Số điện thoại">
                        </div>
                        <div class="col-lg-12">
                            <label for="email">Email<span>*</span></label>
                            <input type="text" name="email" id="email" placeholder="Địa chỉ email">
                        </div>

                        <div class="col-lg-12">
                            <label for="street">Địa chỉ<span>*</span></label>
                            <input type="text" name="address" id="street" class="street-first"
                                placeholder="Tỉnh/Thành phố, Quận/Huyện, Phường/Xã, Tên đường, Tòa nhà, Số nhà">
                        </div>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="checkout-content">
                        <a href="my-order.php" class="content-btn">Lịch sử đặt hàng</a>
                    </div>
                    <div class="place-order">
                        <h4>Đơn hàng của bạn</h4>

                        <div class="order-total">

                            <ul class="order-table">

                                <li>Product<span>Total</span></li>
                                <?php $list = $cart->get_product_cart();
                                $tongphu = 0;
                                $tong = 0;
                                if ($list) {
                                    while ($result = $list->fetch_assoc()) { ?>
                                        <li class="fw-normal" style="margin: -20px 0 0 0"><img
                                                style="width:40px;height:40px;   " src="uploads/<?= $result['image'] ?>" alt="">
                                            <?= $result['name'] . " x " . $result['prod_qty'] ?><span><?= "₫" . $fm->format_currency($tongphu = $result['selling_price']) ?></span>
                                        </li>
                                        <?php $tong += $tongphu * $result['prod_qty'];
                                    }
                                } ?>
                                <li class="fw-normal">
                                    Subtotal<span><?= "₫" . $fm->format_currency($tong) ?></span>
                                </li>
                                <li class="total-price">Total<span><?= "₫" . $fm->format_currency($tong) ?></span></li>
                            </ul>

                            <div class="payment-check">
                                <div class="pc-item">
                                    <label for="pc-check">
                                        Thanh toán bằng VNPAY
                                        <input type="checkbox" name="payment_mode" id="pc-check" value="VNPAY" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                            </div>
                        </div>
                        <div class="order-btn">
                            <button onclick="location.href='congthanhtoan.php'" type="submit" name="btn-order"
                                class="site-btn place-btn">Đặt đơn hàng</button>
                        </div>
                    </div>

                </div>
            </div>
    </div>
    </form>
</div>
</div>
<!-- Shopping Cart Section End -->




<!-- Partner Logo Section End -->
<?php
include 'inc/footer.php';

?>

<!-- <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script> -->