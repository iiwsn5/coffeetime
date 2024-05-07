!DOCTYPE html>
<html>
<head>
    <title>Select Quantity</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="done">
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new mysqli("localhost", "root", "", "coffee_project");
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $coffeeType = $_POST["coffee_type"];
        $selectedQuantity = $_POST["quantity"];
        $paymentMethod = $_POST["payment_method"];
        $selectedUserId = $_POST["user_id"];
        
        $sql = "INSERT INTO orders (user_id, coffee_type, quantity, payment_method) VALUES ('$selectedUserId', '$coffeeType', '$selectedQuantity', '$paymentMethod')";

        if ($conn->query($sql) === TRUE) {
            echo "<h1>Order placed successfully!</h1>";
        } else {
            echo "Error placing order: " . $conn->error;
        }

        $sql = "SELECT quantity, coffee_type, payment_method, order_date FROM orders WHERE id= '$conn->insert_id'";
        $result = $conn->query($sql);

        $row = $result->fetch_assoc();
        echo '<div class="content">
                <h2>Your order details</h2>
                <table>
                    <tr>
                        <td>Type</td>
                        <td>'. $row['coffee_type'] .'</td>
                    </tr>
                    <tr>
                        <td>Quantity</td>
                        <td>'. $row['quantity'] .'</td>
                    </tr>
                    <tr>
                        <td>Payment Method</td>
                        <td>'. $row['payment_method'] .'</td>
                    </tr>
                    <tr>
                        <td>Order Date</td>
                        <td>'. $row['order_date'] .'</td>
                    </tr>
                </table>
            </div>';

        $conn->close();
    } else {
        echo "Invalid request.";
    }
?>
</body>
</html>