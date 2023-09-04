<?php
    require_once '../../config/db_config.php';
    require_once '../../Includes/data.php';

    try {
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $selectedYear = $_GET['selectedYear'];
        $selectedMonth = $_GET['selectedMonth'];
        $selectedDay = $_GET['selectedDay'];

        $laundryStatusData = getLaundryStatus($pdo, $selectedYear, $selectedMonth, $selectedDay);
   
        echo json_encode($laundryStatusData);

    } catch (PDOException $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }
?>