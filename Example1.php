<?php 
define('PAYPAL_EMAIL', '************************'); 
define('RETURN_URL', 'http://localhost/payment-paypal_03/return.php'); 
define('CANCEL_URL', 'http://localhost/payment-paypal_03/cancel.php'); 
define('SANDBOX', TRUE); // TRUE or FALSE 

if (SANDBOX === TRUE){ $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr"; }
else { $paypal_url = "https://www.paypal.com/cgi-bin/webscr"; }
define('PAYPAL_URL', $paypal_url);

$products = [
    [
        "name" => "Product 1",
        "desc" => "Desc Test Product 1",
        "quantity" => 2,
        "price" => 10.99,
    ],
    [
        "name" => "Product 2",
        "desc" => "Desc Test Product 2",
        "quantity" => 1,
        "price" => 20.99,
    ],
    [
        "name" => "Product 3",
        "desc" => "Desc Test Product 3",
        "quantity" => 3,
        "price" => 9.99,
    ],
];
?>

<form method='post' action='<?php echo PAYPAL_URL; ?>'>

    <!-- PayPal business email to collect payments -->
    <input type='hidden' name='business' value='<?php echo PAYPAL_EMAIL; ?>'>

    <!-- Specify a Pay Now button. -->
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="upload" value="1">

    <?php
    foreach ($products as $index => $product) {
        $itemName = 'item_name_' . ($index + 1);
        $itemDesc = 'item_desc_' . ($index + 1);
        $itemQty = 'quantity_' . ($index + 1);
        $itemPrice = 'amount_' . ($index + 1);
    ?>
        <!-- Product information -->
        <input type='hidden' name='<?php echo $itemName; ?>' value='<?php echo $product["name"]; ?>'>
        <input type='hidden' name='<?php echo $itemDesc; ?>' value='<?php echo $product["desc"]; ?>'>
        <input type='hidden' name='<?php echo $itemQty; ?>' value='<?php echo $product["quantity"]; ?>'>
        <input type='hidden' name='<?php echo $itemPrice; ?>' value='<?php echo $product["price"]; ?>'>

    <?php
    }
    ?>

    <!-- Other PayPal return, cancel & IPN URLs -->
    <input type='hidden' name='return' value='<?php echo RETURN_URL; ?>'>
    <input type='hidden' name='cancel_return' value='<?php echo CANCEL_URL; ?>'>
    <button type='submit' class='pay'>Pay Now</button>

</form>
