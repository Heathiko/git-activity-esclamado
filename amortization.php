
<?php
$loanAmount = filter_input(INPUT_POST, 'loanAmount', FILTER_VALIDATE_FLOAT);
$interestRate = filter_input(INPUT_POST, 'interestRate', FILTER_VALIDATE_FLOAT);
$loanTerm = filter_input(INPUT_POST, 'loanTerm', FILTER_VALIDATE_INT);
$borrowerName = filter_input(INPUT_POST, 'borrowerName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($loanAmount === false || $loanAmount <= 0) {
  echo "Invalid loan amount.";
  exit;
}
if ($interestRate === false || $interestRate <= 0) {
  echo "Invalid interest rate.";
  exit;
}
if ($loanTerm === false || $loanTerm <= 0) {
  echo "Invalid loan term.";
  exit;
}
if (empty($borrowerName)) {
  echo "Borrower name is required.";
  exit;
}

$monthlyInterestRate = $interestRate / 100 / 12;
$monthlyPayment = $loanAmount * $monthlyInterestRate / (1 - pow(1 + $monthlyInterestRate, -$loanTerm));
$monthlyPaymentFormatted = number_format($monthlyPayment, 2);

echo "<h3>Loan Payment Summary</h3>";
echo "<p><strong>Borrower Name:</strong> " . htmlspecialchars($borrowerName) . "</p>";
echo "<p><strong>Loan Amount:</strong> $" . number_format($loanAmount, 2) . "</p>";
echo "<p><strong>Interest Rate:</strong> {$interestRate}%</p>";
echo "<p><strong>Loan Term:</strong> {$loanTerm} months</p>";
echo "<p><strong>Monthly Payment:</strong> \${$monthlyPaymentFormatted}</p>";


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Amortization Schedule</title>
    <style>
        table {
            border-collapse: collapse;
            width: 70%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #555;
            padding: 8px;
            text-align: right;
        }
        th {
            background-color: #f2f2f2;
        }
        h3, p { text-align: left; }
    </style>
</head>
<body>
<h3>Amortization Schedule</h3>
<table>
    <tr>
        <th>Month</th>
        <th>Beginning Balance ($)</th>
        <th>Interest ($)</th>
        <th>Principal ($)</th>
        <th>Ending Balance ($)</th>
    </tr>

    <?php
    $balance = $loanAmount;
    $payment = (float)str_replace(',', '', $monthlyPayment); 

    for ($month = 1; $month <= $loanTerm; $month++) {
        $interest = $balance * $monthlyInterestRate;
        $principal = $payment - $interest;
        $endingBalance = $balance - $principal;

        if ($endingBalance < 0) $endingBalance = 0;

        echo "<tr>";
        echo "<td>$month</td>";
        echo "<td>" . number_format($balance, 2) . "</td>";
        echo "<td>" . number_format($interest, 2) . "</td>";
        echo "<td>" . number_format($principal, 2) . "</td>";
        echo "<td>" . number_format($endingBalance, 2) . "</td>";
        echo "</tr>";

        $balance = $endingBalance;
    }
    ?>
</table>

</body>
</html>

