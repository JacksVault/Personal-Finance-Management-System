# Personal Finance Management System

This is a simple Personal Finance Management System web application built with PHP and MySQL. It allows users to manage their income, expenses, and budgets to keep track of their financial activities.

## Features

- User Registration and Login: Users can register for a new account and log in to the system using their credentials.

- Dashboard: After logging in, users are presented with a dashboard that displays a summary of their total income, total expenditure, and net savings.

- Capture Income: Users can enter details of their income, including the source, amount, date, and narration.

- Capture Expenditure: Users can record their expenses, providing details such as the date, particulars, amount spent, and category.

- Capture Budget: Users can set up a budget by specifying a description and the budgeted amount for each category.

- Reports: Users can view reports that display their income, expenditure, and budget analysis. The reports are presented using Google Charts for visualization.

- Logout: Users can log out from their account to end the session.

## Requirements

- Web server with PHP support (e.g., Apache, Nginx)
- MySQL database
- PHP 5.6 or higher
- PDO extension for PHP
- Google Charts library (included via CDN)

## Installation

1. Clone the repository to your local web server directory:

```bash
git clone https://github.com/your-username/personal-finance-management.git
```

2. Import the database schema and sample data using the `pfund_db.sql` file provided in the project's root directory:

```bash
mysql -u your-mysql-username -p pfund_db < pfund_db.sql
```

3. Configure the database connection settings by updating the `config.php` file:

```php
<?php
// Replace the following values with your actual database credentials
$host = 'localhost';
$db_name = 'pfund_db';
$db_user = 'your-mysql-username';
$db_password = 'your-mysql-password';

// Create a PDO database connection
try {
    $db_conn = new PDO("mysql:host={$host};dbname={$db_name}", $db_user, $db_password);
    $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
```

4. Ensure that PHP has read and write access to the project directory and the database.

5. Launch the application by accessing it through your web browser, e.g., `http://localhost/personal-finance-management/`.

## Usage

1. Register for a new account if you are a new user or log in using your credentials.

2. On the dashboard, you can view your total income, total expenditure, and net savings.

3. Capture your income by filling out the income capture form.

4. Record your expenses by providing the necessary details in the expenditure capture form.

5. Set up your budget by specifying the description and the budgeted amount for each category.

6. View financial reports that display your income, expenditure, and budget analysis.

7. Log out from your account when you are done.

## Contributing

Contributions are welcome! If you find any bugs or have ideas for improvements, please feel free to open an issue or submit a pull request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Credits

This project was created by Jack

---

Please replace the placeholders (like `your-username`, `your-mysql-username`, `your-mysql-password`, etc.) with your actual values.
