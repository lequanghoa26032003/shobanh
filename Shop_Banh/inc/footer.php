<!-- Partner Logo Section Begin -->
<div class="partner-logo">
	<div class="container">
		<div class="logo-carousel owl-carousel">
			<div class="logo-item">
				<div class="tablecell-inner">
					<img src="img/logo-carousel/logo-1.png" alt="">
				</div>
			</div>
			<div class="logo-item">
				<div class="tablecell-inner">
					<img src="img/logo-carousel/logo-2.png" alt="">
				</div>
			</div>
			<div class="logo-item">
				<div class="tablecell-inner">
					<img src="img/logo-carousel/logo-3.png" alt="">
				</div>
			</div>
			<div class="logo-item">
				<div class="tablecell-inner">
					<img src="img/logo-carousel/logo-4.png" alt="">
				</div>
			</div>
			<div class="logo-item">
				<div class="tablecell-inner">
					<img src="img/logo-carousel/logo-5.png" alt="">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Partner Logo Section End -->
<!-- Footer Section Begin -->
<footer class="footer-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<div class="footer-left">
					<div class="footer-logo">
						<a href="index.php">
							<img src="img/_footer-logo.png" height="25" alt="">
						</a>
					</div>
					<ul>
						<li>Dai hoc Vinh </li>
						<li>Dai hoc Vinh </li>
						<li>Dai hoc Vinh </li>
					</ul>
					<div class="footer-social">
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-instagram"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-pinterest"></i></a>
					</div>
				</div>
			</div>
			<div class="col-lg-2 offset-lg-1">
				<div class="footer-widget">
					<h5>Information</h5>
					<ul>
						<li><a href="">About Us</a></li>
						<li><a href="">Checkout</a></li>
						<li><a href="">Contact</a></li>
						<li><a href="">Serivius</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-2">
				<div class="footer-widget">
					<h5>Information</h5>
					<ul>
						<li><a href="">My Account</a></li>
						<li><a href="">Contact</a></li>
						<li><a href="">Shopping Cart</a></li>
						<li><a href="">Shop</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="newslatter-item">
					<h5>Join Our Newsletter Now</h5>
					<p>Get E-mail update about our</p>
					<form action="#" class="subscribe-form">
						<input type="text" placeholder="Enter Your Mail">
						<button type="button">Subscribe</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="copyright-reserved">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="coppyright-Text">
						Coppyright @ Hoa_Shop
					</div>
					<div class="payment-pic">
						<img src="img/payment-method.png" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- Footer Section End -->
<!-- Js Plugins -->
<script src="js/jquery-3.3.1.min.js"></script>

<script src="js/bootstrap.min.js"></script>

<script src="js/jquery-ui.min.js"></script>

<script src="js/jquery.countdown.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.zoom.min.js"></script>
<script src="js/jquery.dd.min.js"></script>
<script src="js/jquery.slicknav.js"></script>

<script src="js/owl.carousel.min.js"></script>

<script src="js/main.js"></script>
<script src="js/cart.js"></script>

<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>
	alertify.set('notifier', 'position', 'top-right');

	<?php if (isset($_SESSION['alert'])) { ?>
		alertify.success('<?= $_SESSION['alert']; ?>');
		<?php unset($_SESSION['alert']); ?>
	<?php } ?>

	<?php if (isset($_SESSION['error'])) { ?>
		alertify.error('<?= $_SESSION['error']; ?>');
		<?php unset($_SESSION['error']); ?>
	<?php } ?>
</script>
<script>
	function remove_background(product_id) {
		for (var count = 1; count <= 5; count++) {
			$('#' + product_id + '-' + count).css('color', '#999591');
		}
	}
	//hover chuột đánh giá sao
	$(document).on('click', '.rating', function () {
		var index = $(this).data("index"); //3
		var product_id = $(this).data('product_id'); //13

		// alert(index);
		// alert(product_id);
		remove_background(product_id);
		for (var count = 1; count <= index; count++) {
			$('#' + product_id + '-' + count).css('color', '#FAC451');
		}
	});


</script>
<script>
	// $('.rating').click(function () {
	// 	var index = $(this).data("index"); //3
	// 	var product_id = $(this).data('product_id');
	// 	var customer_id = $(this).data('customer_id');
	// 	$.ajax(
	// 		{
	// 			url: 'classes/product.php',
	// 			data: { index: index, product_id: product_id, customer_id: customer_id },
	// 			type: 'POST',
	// 			success: function (data) {

	// 				alert('Đánh giá ' + index + ' sao thành công');



	// 			}
	// 		});
	// })
	// $(document).on('mouseenter', '.rating_login', function () {
	// 	alert('Làm ơn đăng nhập để đánh giá sao.');
	// })
</script>
</body>

</html>