<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4.세탁소별 일일 상태</title>
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
        <h1>4.세탁소별 일일 상태</h1>
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
                <label for="selectedDay">일 :</label>
                <select id="selectedDay" name="selectedDay">
                <?php for ($i = 1; $i <= 31; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?>일</option>
                <?php endfor; ?>
                </select>
                <button type="submit" id="searchButton">검색</button>
            </form>
        </div>
    
        <div id="tableContainer">
            <table border="1" id="daily"></table>
        </div>
    </div>
    <script src="./api/get_laundry_status.js"></script>
</body>
</html>

