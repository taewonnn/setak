<?php

    // 데이터베이스 연결 객체($pdo)를 받아서 데이터를 가져온다.
    // 1. 월별 주문 데이터
    function getMonthlyOrderData($pdo, $selectedYear, $selectedMonth) {
        $query = "
        select
            date_format(created_at, '%Y-%m') as 월,
            date_format(created_at, '%d') as 일,
            count(*) as 일별_주문수
        from
            orders

        where year(created_at) = :year and month(created_at) = :month
        
        group by 월, 일
        order by 월, 일;
        ";

        $stmt = $pdo->prepare($query);

        // :year 매개변수에 선택한 연도를 바인딩 (정수 값으로)
        $stmt->bindParam(":year", $selectedYear, PDO::PARAM_INT);

        // :month 매개변수에 선택한 월을 바인딩 (정수 값으로)
        $stmt->bindParam(":month", $selectedMonth, PDO::PARAM_INT);

        // 쿼리 실행
        $stmt->execute();

        // 실행 결과를 모두 가져오기
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    

    // 2. 일별 주문 데이터
    function getdailyOrderData($pdo,$selectedYear, $selectedMonth) {
        $query = "
        select 
            s.name as 세탁소명, 
            date(o.created_at) as 일자,
            sum(case when o.status = '픽업예정' then 1 else 0 end) as 픽업예정,
            sum(case when o.status = '세탁중' then 1 else 0 end) as 세탁중,
            sum(case when o.status = '배송중' then 1 else 0 end) as 배송중,
            sum(case when o.status = '배송완료' then 1 else 0 end) as 배송완료
        from shops s
        
        join products p on s.id = p.shop_id
        join orders o on p.id = o.product_id
        
        where year(o.created_at) = :year and month(o.created_at) = :month

        group by s.id, date(o.created_at)
        order by date(o.created_at)
        ";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":year", $selectedYear, PDO::PARAM_INT);
        $stmt->bindParam(":month", $selectedMonth, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    // 3. 세탁소 별 월 매출액
    function getMonthlySelling($pdo, $selectedYear, $selectedMonth) {
        $query = "
        select 
            s.name as 세탁소명,
            year(o.created_at) as 연도,
            month(o.created_at) as 월,
            sum(o.total_price) as 월매출,
            count(*) as 주문수
        from shops s
        
        join products p on s.id = p.shop_id
        join orders o on p.id = o.product_id

        where year(o.created_at) = :year and month(o.created_at) = :month

        group by s.id, year(o.created_at), month(o.created_at)
        order by s.id, year(o.created_at), month(o.created_at)
        ";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":year", $selectedYear, PDO::PARAM_INT);
        $stmt->bindParam(":month", $selectedMonth, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    // 4. 세탁소별 일일 상태
    function getLaundryStatus($pdo, $selectedYear, $selectedMonth, $selectedDay) {
        $query = "
        select 
            s.name as 세탁소명,
            date(o.created_at) as 일자,
            count(*) as 주문수,
            sum(case when o.status = '픽업예정' then 1 else 0 end) as 픽업예정,
            sum(case when o.status = '배송중' then 1 else 0 end) as 배송중,
            sum(case when o.status = '세탁중' then 1 else 0 end) as 세탁중,
            sum(case when o.status = '배송완료' then 1 else 0 end) as 배송완료
        from shops s
        
        join products p on s.id = p.shop_id
        join orders o on p.id = o.product_id

        where year(o.created_at) = :year and month(o.created_at) = :month and day(o.created_at) = :day

        group by s.id, date(o.created_at)
        order by s.id, date(o.created_at)
        ";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":year", $selectedYear, PDO::PARAM_INT);
        $stmt->bindParam(":month", $selectedMonth, PDO::PARAM_INT);
        $stmt->bindParam(":day", $selectedDay, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);   
    }


    // 로그인 기능
    function authenticateUser($pdo, $username, $password) {
        $query = "
        select id, password
        from members
        where id = :username
        limit 1;
        ";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return true; // 사용자 인증 성공
        } else {
            return false; // 인증 실패
        }
    }
?>
