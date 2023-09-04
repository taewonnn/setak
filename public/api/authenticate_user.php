<?php

    require_once '../../config/db_config.php';
    require_once '../../Includes/data.php';

    try {
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = json_decode(file_get_contents("php://input"), true); // JSON 데이터를 디코딩

            $username = $input['username'] ?? ''; // 배열 키를 확인하여 기본값 설정
            $password = $input['password'] ?? '';

            if (authenticateUser($pdo, $username, $password)) {
                session_start();
                $_SESSION['user_id'] = $username;
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "message" => "유효하지 않은 사용자 이름 또는 비밀번호입니다."]);
            }
        }
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "데이터베이스 연결 오류: " . $e->getMessage()]);
    }
?>