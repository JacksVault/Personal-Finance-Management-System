<?php
// Start the PHP session to maintain user login state
session_start();

// Include the database configuration file
include 'config.php';

// Function to calculate the total income
function getTotalIncome($db_conn)
{
    $query = "SELECT SUM(amount) AS total_income FROM Income";
    $stmt = $db_conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total_income'] ? $result['total_income'] : 0;
}

// Function to calculate the total expenditure
function getTotalExpenditure($db_conn)
{
    $query = "SELECT SUM(amount_spent) AS total_expenditure FROM Expenditure";
    $stmt = $db_conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total_expenditure'] ? $result['total_expenditure'] : 0;
}

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // User is logged in, retrieve user data
    $userId = $_SESSION['user_id'];

    // Get user's name from the database
    $query = "SELECT name FROM Users WHERE UserID = :user_id";
    $stmt = $db_conn->prepare($query);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $username = $user['name'];

    // Get total income and expenditure
    $totalIncome = getTotalIncome($db_conn);
    $totalExpenditure = getTotalExpenditure($db_conn);
} else {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Personal Finance Manage - Dashboard</title>
    <!-- Add your CSS styles here -->
</head>

<body>
    <h1>Welcome, <?php echo $username; ?>!</h1>
    <p>Here's a summary of your financial data:</p>
    <p>Total Income: $<?php echo number_format($totalIncome, 2); ?></p>
    <p>Total Expenditure: $<?php echo number_format($totalExpenditure, 2); ?></p>
    <p>Net Savings: $<?php echo number_format($totalIncome - $totalExpenditure, 2); ?></p>

    <h2>Navigation Links:</h2>
    <ul>
        <li><a href="income_form.php">Capture Income</a></li>
        <li><a href="expense_form.php">Capture Expenditure</a></li>
        <li><a href="budget_form.php">Capture Budget</a></li>
        <li><a href="reports.php">View Reports</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>

    <!-- Add your additional HTML content here -->

    <!-- Add your JavaScript code here -->
</body>

</html>
