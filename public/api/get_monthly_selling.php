<?php
    require_once '../../config/db_config.php';
    require_once '../../Includes/data.php';

    try {
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $selectedYear = $_GET['selectedYear'];
        $selectedMonth = $_GET['selectedMonth'];

        $monthlySellingData = getMonthlySelling($pdo, $selectedYear, $selectedMonth);

        echo json_encode($monthlySellingData);

    } catch (PDOException $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }
?>