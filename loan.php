<?php $title = 'Loan Payment Calculator'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
</head>
<body>
  <h2><?php echo $title; ?></h2>
  <form method="post" action="amortization.php">
      <label for="loanAmount">Loan Amount:</label>
      <input type="number" id="loanAmount" name="loanAmount" required>
      <br><br>

      <label for="interestRate">Interest Rate (%):</label>
      <input type="number" id="interestRate" name="interestRate" step="any" required>
      <br><br>

      <label for="loanTerm">Loan Term (months):</label>
      <input type="number" id="loanTerm" name="loanTerm" required>
      <br><br>

      <label for="borrowerName">Borrower Name:</label>
      <input type="text" id="borrowerName" name="borrowerName" required>
      <br><br>

      <input type="submit" value="Compute">
  </form>
</body>
</html>
