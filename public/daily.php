<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2.일별 주문수</title>
    <style>
        #container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        #formContainer,
        #tableContainer {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div id="container">
        <h1>2.세탁소 일별 주문수</h1>
        <div id="formContainer">
            <form>    
                <label for="selectedYear">연도 :</label>
                <select id="selectedYear" name="selectedYear">
                    <option>2020</option>
                    <option>2021</option>
                    <option>2022</option>
                    <option>2023</option>
                </select>
                <label for="selectedMonth">월 :</label>
                <select id="selectedMonth" name="selectedMonth">
                    <?php for ($i = 1; $i <= 12; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?>월</option>
                    <?php endfor; ?>
                </select>
                <button type="submit" id="searchButton">검색</button>
            </form>
        </div>
    
        <div id="tableContainer">
            <table border="1" id="daily"></table>
        </div>
    </div>
    <script src="./api/get_daily_order.js"></script>
</body>
</html>