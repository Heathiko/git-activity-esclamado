<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Distance Unit Converter</title>
</head>
<body>
  <h2><strong>Distance Unit Converter</strong></h2>

  <form method="get" action="">
    <label for="value">Enter Distance:</label>
    <input type="number" id="value" name="value" step="any" required>
    <br><br>
    <label for="from">From:</label>
    <select id="from" name="from">
      <option value="m" <?php if(isset($GET['from']) && isset($GET['from']) == 'm') echo 'selected'; ?>>Meters</option>
      <option value="km" <?php if(isset($GET['from']) && isset($GET['from']) == 'km') echo 'selected'; ?>>Kilometers</option>
      <option value="mi" <?php if(isset($GET['from']) && isset($GET['from']) == 'mi') echo 'selected'; ?>>Miles</option>
    </select>
    <br><br>
    <label for="to">To:</label>
    <select id="to" name="to">
      <option value="m" <?php if(isset($GET['from']) && isset($GET['from']) == 'm') echo 'selected'; ?>>Meters</option>
      <option value="km" <?php if(isset($GET['from']) && isset($GET['from']) == 'km') echo 'selected'; ?>>Kilometers</option>
      <option value="mi" <?php if(isset($GET['from']) && isset($GET['from']) == 'mi') echo 'selected'; ?>>Miles</option>
    </select>
    <br><br>
    <input type="submit" name="convert" value="Convert">
   </form>

</body>
</html>


<?php 
if(isset($_GET['convert'])){
    $value = filter_input(INPUT_GET, 'value', FILTER_VALIDATE_FLOAT);
    $from = $_GET['from'];
    $to = $_GET['to'];


    if($value == false || $value < 0){
        echo "<p style='color:red;'>Invalid input. Please check your values and try again</p>";
    } else {

        $conversionRates = [
            'km' => 1000,
            'mi' => 1609.34
        ];

    $meters = match($from){
        'm' => $value * 1,
        'km' => $value * $conversionRates['km'],
        'mi' => $value *$conversionRates['mi'],
    };

    $results = match($to){
        'm' => $meters / 1,
        'km' => $meters / $conversionRates['km'],
        'mi' => $meters / $conversionRates['mi'],   
    };

    echo "<p>" . htmlspecialchars($value) . " " . htmlspecialchars($from) . " is equal to " . htmlspecialchars($results) . " " . htmlspecialchars($to) . "</p>";
    }
}   



