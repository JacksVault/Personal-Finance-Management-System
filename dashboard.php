<?php
// Start the PHP session to maintain user login state
session_start();

// Include the database configuration file
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header("Location: auth.php");
    exit;
}

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

// Get total income and expenditure from the database
$totalIncome = getTotalIncome($db_conn);
$totalExpenditure = getTotalExpenditure($db_conn);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Personal Finance Manage - Dashboard</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Personal Finance Manage</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="income_form.php">Capture Income</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="expense_form.php">Capture Expenditure</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="budget_form.php">Capture Budget</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reports.php">View Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <h2>Summary of Your Financial Data:</h2>
        <p>Total Income: $<?php echo number_format($totalIncome, 2); ?></p>
        <p>Total Expenditure: $<?php echo number_format($totalExpenditure, 2); ?></p>
        <p>Net Savings: $<?php echo number_format($totalIncome - $totalExpenditure, 2); ?></p>
    </div>

    <!-- Add your additional HTML content here -->

    <!-- Add Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
