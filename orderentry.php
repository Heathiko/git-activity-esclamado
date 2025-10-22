<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Order Form</title>
</head>
<body>
  <h2>Customer Order Form</h2>

  <form method = 'post' action = "processorder.php">
    <label for="customerName">Customer Name:</label>
    <input type="text" id="customerName" name="customerName" required>
    </label>
    <br><br>
    <Label for="email">Email Address:</Label>
    <input type="email" id="email" name="email" required>
    <br><br>
    <Label for="quantity">Quantity:</Label>
    <input type = "number" id="quantity" name="quantity" min="1" required>
    <br><br>
    <Label for="productName">Product Name:</Label>
    <input type="text" id="productName" name="productName" required>
    <br><br> 
    <Label for="deliveryNotes">Delivery Notes:</Label>    
    <textarea id="deliveryNotes" name="deliveryNotes" rows="4" cols="50"></textarea>
    <br><br>
    <input type="submit" value="Submit Order"> 
  </form>

</body>
</html>
