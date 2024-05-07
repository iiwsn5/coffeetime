<?php
    session_start();

    if (isset($_SESSION["user_id"])) {
        $selectedUserId = $_SESSION["user_id"];
    } else {
        echo "User ID not found in session.";
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Select Quantity</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function changeQuantity(quantity) {
            document.getElementById("price_display").innerHTML = "Price: SR" + quantity;
        }
    </script>
</head>
<body>
    <div class="content">
        <h2>Select Quantity</h2>

        <form action="process_order.php" method="post">
            <label>
                <input type="radio" name="quantity" class="quantity-btn" value="250" required onchange="changeQuantity(250)"> 250
            </label>
            <label>
                <input type="radio" name="quantity" class="quantity-btn" value="500" required onchange="changeQuantity(500)"> 500
            </label>
            <label>
                <input type="radio" name="quantity" class="quantity-btn" value="900" required onchange="changeQuantity(900)"> 900
            </label>

            <input type="hidden" name="user_id" value="<?php echo $selectedUserId; ?>">

            <input type="hidden" name="coffee_type" id="coffeeType" value="">

            <script>
                var param = window.location.href;
                var coffee_type = param.split("=")[1];
                document.getElementById("coffeeType").value = coffee_type;
            </script>

            <div id="price_display"></div>
            <br>

            <label>Payment Method:</label>
            <br><br>

            <label><input type="radio" name="payment_method" value="cash" required> Cash</label>
            <label><input type="radio" name="payment_method" value="card" required> Card</label>

            <br><br>

            <button type="submit">Submit Order</button>
        </form>

    </div>
</body>
</html>