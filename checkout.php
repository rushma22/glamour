<?php
session_start();
require "connection.php";

if(isset($_SESSION["u"])) {
    $user = $_SESSION["u"]["email"];

    $total = 0;
    $subtotal = 0;
    $shipping = 0;

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `users_email`='".$user."'");
    $cart_num = $cart_rs->num_rows;

    if($cart_num > 0) {
        while($cart_data = $cart_rs->fetch_assoc()) {
            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$cart_data["product_id"]."'");
            $product_data = $product_rs->fetch_assoc();
            $total += $product_data['price'] * $cart_data["qty"];

            $address_rs = Database::search("SELECT district.district_id AS `did` FROM users_has_address INNER JOIN `city` ON users_has_address.city_city_id = city.city_id INNER JOIN `district` ON city.district_district_id = district.district_id WHERE `users_email`='".$user."'");
            $address_data = $address_rs->fetch_assoc();

            $shipping += ($address_data["did"] == 2) ? $product_data["delivery_fee_colombo"] : $product_data["delivery_fee_other"];
            
        }

        $order_id = uniqid();
        $amount = $total + $shipping;

        // User details
        $fname = $_SESSION["u"]["fname"];
        $lname = $_SESSION["u"]["lname"];
        $email = $_SESSION["u"]["email"];
        $mobile = $_SESSION["u"]["mobile"];
        $address = "Main Street Colombo";
        $city = "Colombo";
        $country = "Sri Lanka";

        // Generate hash
        $merchant_id = "1224457";
        $merchant_secret = "MTYzOTQzMzI0MjE4NzQ0NDM0MjczOTE5NzYwMTQxMTgxMTAzODU0MQ==";
        $currency = "LKR";

        $hash = strtoupper(
            md5(
                $merchant_id . 
                $order_id . 
                number_format($amount, 2, '.', '') . 
                $currency .  
                strtoupper(md5($merchant_secret)) 
            ) 
        );

    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout | Glamour</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resources/logo.svg" />
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php include "header.php"; ?>
            <div class="col-12 pt-2 mb-3">
                <div class="col-12 text-center" style="background-image: linear-gradient(to right, rgb(174, 0, 174), rgba(64, 0, 109, 0.353));">
                    <label class="form-label fs-1 fw-bolder text-light">CHECKOUT</label>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="row">
                    <div class="col-12">
                        <hr />
                    </div>
                    <?php if($cart_num > 0) { ?>
                    <div class="col-md-5 offset-lg-1" style="margin-right:200px;">
                        <div class="p-3 py-5 text-dark">
                            <div class="d-flex align-items-center mb-3">
                                <h4 class="fw-bold">BILLING DETAILS</h4>
                            </div>
                            <div class="row mt-4 text-light">
                                <div class="col-6 mb-3">
                                    <input type="text" class="form-control" id="fname" value="<?php echo $fname; ?>" placeholder="First Name">
                                </div>
                                <div class="col-6 mb-3">
                                    <input type="text" class="form-control" id="lname" value="<?php echo $lname; ?>" placeholder="Last Name">
                                </div>
                                <div class="col-6 mb-3">
                                    <input type="text" class="form-control" id="mobile" value="<?php echo $mobile; ?>" placeholder="Phone">
                                </div>
                                <div class="col-6">
                                    <input type="text" id="email" class="form-control" value="<?php echo $email; ?>" placeholder="Email">
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="text" id="line1" class="form-control" value="<?php echo $address; ?>" placeholder="Address Line 01">
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="text" id="line2" class="form-control" placeholder="Address Line 02">
                                </div>
                                <div class="col-6 mb-3">
                                    <select name="" id="province" class="form-select">
                                        <option value="0">Select Province</option>
                                        <?php
                                        $province_rs = Database::search("SELECT * FROM `province`");
                                        while($province_data = $province_rs->fetch_assoc()) {
                                            $selected = (!empty($address_data["province_province_id"]) && $province_data["province_id"] == $address_data["province_province_id"]) ? 'selected' : '';
                                            echo "<option value='{$province_data["province_id"]}' $selected>{$province_data["province_name"]}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-6 mb-3">
                                    <select name="" id="district" class="form-select">
                                        <option value="0">Select District</option>
                                        <?php
                                        $district_rs = Database::search("SELECT * FROM `district`");
                                        while($district_data = $district_rs->fetch_assoc()) {
                                            $selected = (!empty($address_data["district_district_id"]) && $district_data["district_id"] == $address_data["district_district_id"]) ? 'selected' : '';
                                            echo "<option value='{$district_data["district_id"]}' $selected>{$district_data["district_name"]}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-6 mb-3">
                                    <select name="" id="city" class="form-select">
                                        <option value="0">Select City</option>
                                        <?php
                                        $city_rs = Database::search("SELECT * FROM `city`");
                                        while($city_data = $city_rs->fetch_assoc()) {
                                            $selected = (!empty($address_data["city_city_id"]) && $city_data["city_id"] == $address_data["city_city_id"]) ? 'selected' : '';
                                            echo "<option value='{$city_data["city_id"]}' $selected>{$city_data["city_name"]}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="pc" class="form-control" placeholder="Postal code">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } else { ?>
                        <div class="col-12 text-center">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label fs-5 fw-bold">Your cart is currently empty</label>
                                </div>
                                <div class="offset-lg-5 col-12 col-lg-2 d-grid mb-3">
                                    <a href="home.php" class="text-light btn fs-5 fw-bold" style="background-image: linear-gradient(to left, rgb(174, 0, 174), rgba(64, 0, 109, 100));">Return to shop</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-12 col-lg-3 border border-2 ms-5">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label fs-3 fw-bold">Summary</label>
                            </div>
                            <div class="col-12">
                                <hr />
                            </div>
                            <div class="col-6 mb-3">
                                <span class="fs-6 fw-bold">PRICE DETAILS (<?php echo $cart_num; ?> ITEMS)</span>
                            </div>
                            <div class="col-6 text-end mb-3">
                                <span class="fs-6 fw-bold">Rs. <?php echo $total; ?> .00</span>
                            </div>
                            <div class="col-6">
                                <span class="fs-6 fw-bold">Delivery Charges</span>
                            </div>
                            <div class="col-6 text-end">
                                <span class="fs-6 fw-bold">Rs. <?php echo $shipping; ?> .00</span>
                            </div>
                            <div class="col-12 mt-3">
                                <hr />
                            </div>
                            <div class="col-6 mb-3">
                                <span class="fs-4 fw-bold">Total</span>
                            </div>
                            <div class="col-6 text-end mb-3">
                                <span class="fs-4 fw-bold">Rs. <?php echo $amount; ?> .00</span>
                            </div>
                            <div class="col-12 mb-3 d-grid">
                                <button class="btn btn-success fs-5 fw-bold" onclick="payNow()">Pay Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "footer.php"; ?>
        </div>
    </div>

    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script type="text/javascript">
        function payNow() {
            var pid = <?php echo json_encode($order_id); ?>;
            var obj = {
                "id": pid,
                "item": "Items ordered",
                "amount": <?php echo $amount; ?>,
                "hash": <?php echo json_encode($hash); ?>,
                "fname": <?php echo json_encode($fname); ?>,
                "lname": <?php echo json_encode($lname); ?>,
                "email": <?php echo json_encode($email); ?>,
                "mobile": <?php echo json_encode($mobile); ?>,
                "address": <?php echo json_encode($address); ?>,
                "city": <?php echo json_encode($city); ?>
            };
            payhere.onCompleted = function onCompleted(orderId) {
        console.log("Payment completed. OrderID:" + orderId);
        window.location = "home.php";


        // Note: validate the payment and show success or failure page to the customer
    };

            var payment = {
                "sandbox": true,
                "merchant_id": "1224457",
                "return_url": "http://localhost/glamour/home.php",
                "cancel_url": "http://localhost/glamour/singleproductview.php?id=" + pid,
                "notify_url": "http://sample.com/notify",
                "order_id": obj["id"],
                "items": obj["item"],
                "amount": obj["amount"],
                "currency": "LKR",
                "hash": obj["hash"],
                "first_name": obj["fname"],
                "last_name": obj["lname"],
                "email": obj["email"],
                "phone": obj["mobile"],
                "address": obj["address"],
                "city": obj["city"],
                "country": "Sri Lanka",
                "delivery_address": obj["address"],
                "delivery_city": obj["city"],
                "delivery_country": "Sri Lanka",
                "custom_1": "",
                "custom_2": ""
            };

            payhere.startPayment(payment);
        }

        
    </script>
</body>
</html>
<?php } else {
    echo "No items in cart.";
} ?>
