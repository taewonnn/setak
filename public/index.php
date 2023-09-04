<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./index_style.css">
    <title>laundry_data</title>
</head>
<body>
    <h1>
        <a href="?page=/" style="text-decoration: none;">laundryData</a>
        <a href="?page=login" class="login-button">로그인</a>
    </h1>    
    <nav>
        <ul>
            <li>
                <a href="?page=monthly">monthlyOrder</a>
            </li>
            <li>
                <a href="?page=daily">dailyOrder</a>
            </li>
            <li>
                <a href="?page=monthly_selling">monthlySelling</a>
            </li>
            <li>
                <a href="?page=laundry_status">laundryStatus</a>
            </li>
        </ul>
    </nav>
    <main>
        <?php
            $page = $_GET['page'] ?? 'daily';
            $allowedPages = ['daily', 'laundry_status', 'monthly', 'monthly_selling', 'login'];
            if (in_array($page, $allowedPages)) {
                include "{$page}.php";
            } else {
                echo "";
            }
        ?>
    </main>
</body>
</html>