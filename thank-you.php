<?php
	require_once("functions.php");
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Grocery Store</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Grocery Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet" type="text/css" media="all" /> 
<!-- //font-awesome icons -->
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
</head>
<script type="text/javascript">
	$(document).ready(function(){
 function load_data(search_prod)
 {
  $.ajax({
   url:"functions.php",
   method:"POST",
   data:{search_prod:search_prod},
   beforeSend: function(){
      // Show image container
      $("#loader").show();
    },
   success:function(data)
   {
    $("#result").show();
    $('#result').html(data);
   },
   complete:function(data){
      // Hide image container
      $("#loader").hide();
    }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != ''){
   load_data(search);
  }
  else if(search == ''){
    $("#result").hide();
  }
 });
});
</script>
<body>
<!-- header -->
	<div class="agileits_header">
		<div class="w3l_offers">
			<a style="color: #212121; background-color: #212121;">Grocery Store</a>
		</div>
		<div class="w3l_search">
			<form action="products.php" method="post">
				<input type="text" id="search_text" name="SearchProduct" value="Search a product..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search a product...';}" required="">
				<input type="submit" value=" " name="submit_search">
			</form>
		</div>
		<div class="product_list_header">  
			<form action="checkout.php" method="post" class="last">
                <fieldset>
                    <input type="hidden" name="cmd" value="_cart" />
                    <input type="hidden" name="display" value="1" />
                    <input type="submit" name="submit" value="View your cart" class="button" />
                </fieldset>
            </form>
		</div>
		<div class="w3l_header_right1">
					<h2><a href="mail.php">Contact Us</a></h2>
		</div>
		<div class="w3l_header_right">
			<ul>
				<li class="dropdown profile_details_drop">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i><span class="caret"></span></a>
					<div class="mega-dropdown-menu">
						<div class="w3ls_vegetables">
							<ul class="dropdown-menu drp-mnu">
								<?php
									if (!isset($_SESSION['c_id'])) {
										echo '<li><a href="login.php">Login</a></li>';
									}
									if (isset($_SESSION['c_id'])) {
										echo '<li><a href="logout.php">Logout</a></li>';
									}
								?>
							</ul>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<?php
			if (isset($_SESSION['c_id'])) {
				echo '<div class="w3l_header_right" style="color: white; padding-left: 2em;">';
				echo "Welcome<br>{$_SESSION['c_name']}";
				echo "</div>";
			}
		?>
		<div class="clearfix"> </div>
	</div>
<!-- script-for sticky-nav -->
	<script>
	$(document).ready(function() {
		 var navoffeset=$(".agileits_header").offset().top;
		 $(window).scroll(function(){
			var scrollpos=$(window).scrollTop(); 
			if(scrollpos >=navoffeset){
				$(".agileits_header").addClass("fixed");
			}else{
				$(".agileits_header").removeClass("fixed");
			}
		 });
	});
	</script>
<!-- //script-for sticky-nav -->
	<div class="logo_products">
		<div class="container">
			<div class="col-md-4" style="margin: -10px">
				<img src="images/img_groc_store.png" width="150px" height="150px">
			</div>
			<div class="w3ls_logo_products_left1">
				<ul class="phone_email">
					<li><i class="fa fa-phone" aria-hidden="true"></i>(+91) 9999999999 </li>
					<li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:store@grocery.com">store@grocery.com</a></li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<div class="products-breadcrumb">
		<div class="container">
			<ul>
				<li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Home</a><span>|</span></li>
				<li>Order Placed</li>
			</ul>
		</div>
	</div>
	<?php
		$query = "SELECT * from orders where c_id = {$_SESSION['c_id']} ORDER BY o_id DESC LIMIT 1";
		$query_result = query($query);
		$row = fetch_array($query_result);
		
		$query1 = "SELECT * from address where a_id = {$row['a_id']}";
		$query_result1 = query($query1);
		$row1 = fetch_array($query_result1);
		$address = $row1['line_1'].", ".$row1['line_2'].", ".$row1['city'].", ".$row1['zip_code'].", ".$row1['landmark'];

		$query2 = "SELECT * from order_item where o_id = {$row['o_id']}";
		$query_result2 = query($query2);

		$query3 = "SELECT sum(quantity) as total_item from order_item where o_id = {$row['o_id']}";
		$query_result3 = query($query3);
		$row5 = fetch_array($query_result3);

	?>
	<h1 class="text-center" style="margin-bottom: 20px; margin-top: 10px;">Thank You For Shopping With Us. Your Order has been placed.</h1>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-6">Order Date & Time</div>
				<div class="col-md-6"><?php echo $row['o_datetime']; ?></div>
			</div>
			<div class="row">
				<div class="col-md-6">Delivery Location</div>
				<div class="col-md-6"><?php echo $address; ?></div>
			</div>
			<div class="row">
				<div class="col-md-6">Total Amount</div>
				<div class="col-md-6"><?php echo $row['total_amt']; ?></div>
			</div>
			<div class="row">
				<div class="col-md-6">Total Item</div>
				<div class="col-md-6"><?php echo $row5['total_item']; ?></div>
			</div>
		</div>
	</div>
	<h3 class="text-center" style="margin-bottom: 20px; margin-top: 10px;">Order Details</h3>
	<?php
		while($row2 = fetch_array($query_result2)){
			$query3 = "SELECT * from product where p_id = {$row2['p_id']}";
			$query_result3 = query($query3);
			$row3 = fetch_array($query_result3);
			$ordered_prod =<<<DELIMETER
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-2"><img src="images/product/{$row3['p_image']}"></div>
					<div class="col-md-2">
						<div class="row">{$row3['p_name']}</div>
						<div class="row">Price - ₹{$row3['p_price']}</div>
						<div class="row">Quantity - {$row2['quantity']}</div>
					</div>
				</div>
				<hr>
DELIMETER;
			echo $ordered_prod;
		}
	?>

	<br><br>
	<div class="footer">
		<div class="container">
			<div class="col-md-4 w3_footer_grid">
				<h3>Information</h3>
				<ul class="w3_footer_grid_list">
					<li><a href="">Products</a></li>
					<li><a href="">About Us</a></li>
				</ul>
			</div>
			<div class="col-md-4 w3_footer_grid">
				<h3>policy info</h3>
				<ul class="w3_footer_grid_list">
					<li><a href="">FAQ</a></li>
					<li><a href="">privacy policy</a></li>
					<li><a href="">terms of use</a></li>
				</ul>
			</div>
			<div class="col-md-4 w3_footer_grid">
				<h3>what in stores</h3>
				<ul class="w3_footer_grid_list">
					<li><a href="">Pet Food</a></li>
					<li><a href="">Snacks</a></li>
					<li><a href="">Kitchen</a></li>
					<li><a href="">Branded Foods</a></li>
					<li><a href="">Households</a></li>
				</ul>
			</div>
			<div class="clearfix"> </div>
			<div class="wthree_footer_copy">
				<p>© 2019 Grocery Store. All rights reserved</a></p>
			</div>
		</div>
	</div>
<!-- //footer -->
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
<script src="js/minicart.js"></script>
<script>
		paypal.minicart.render();
		paypal.minicart.cart.destroy()
		// paypal.minicart.cart.on('checkout', function (evt) {
		// 	var items = this.items(),
		// 		len = items.length,
		// 		total = 0,
		// 		i;

		// 	// Count the number of each item in the cart
		// 	for (i = 0; i < len; i++) {
		// 		total += items[i].get('quantity');
		// 	}
		// });

	</script>
</body>
</html>
