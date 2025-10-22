<?php

$customerName = filter_input(INPUT_POST, 'customerName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
$productName = filter_input(INPUT_POST, 'productName', FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_HIGH);
$deliveryNotes = filter_input(INPUT_POST, 'deliveryNotes', FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_HIGH);

if($quantity === false || $quantity <= 0){
  echo "Invalid quantity.";
  exit;
};

if($email === false){
  echo "Invalid email address.";
  exit;
}

echo "<h3>Order Summary</h3>";
echo "<p><strong>Customer Name: </strong>" . htmlspecialchars($customerName) . "</p>";
echo "<p><strong>Email Address: </strong>" . htmlspecialchars($email) . "</p>";
echo "<p><strong>Quantity: </strong>" . htmlspecialchars($quantity) . "</p>";
echo "<p><strong>Product Name: </strong>" . htmlspecialchars($productName) . "</p>";
echo "<p><strong>Delivery Notes: </strong>" . nl2br(htmlspecialchars($deliveryNotes)) . "</p>";
