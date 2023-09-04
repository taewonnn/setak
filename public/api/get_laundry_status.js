   function fetch_laundry_status(selectedYear, selectedMonth, selectedDay, table) {
    
        // 기존 테이블 내용 지우기
        table.innerHTML = '';

        // 헤더 행 추가
        const headerRow = table.insertRow();
        const cellNames = ['세탁소명', '주문수', '픽업예정', '세탁중', '배송중', '배송완료'];
        cellNames.forEach(cellName => {
            const th = document.createElement('th');
            th.textContent = cellName;
            headerRow.appendChild(th);
        });

        console.log('클릭');

        fetch(`./api/get_laundry_status.php?selectedYear=${selectedYear.value}&selectedMonth=${selectedMonth.value}&selectedDay=${selectedDay.value}}`)
            .then(res => res.json())
            .then(data => {
                // 데이터 확인
                console.log(data);

                // 데이터 행 추가
                data.forEach(row => {
                    addDataRow(row);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            })

   }

    function addDataRow(row) {
        // 새로운 테이블 추가
        const newRow = table.insertRow();

        // 데이터 추가
        const cellNames = ['세탁소명', '주문수', '픽업예정','세탁중', '배송중', '배송완료'];
        cellNames.forEach(cellName => {
            newRow.insertCell().textContent = row[cellName];
        });
    }

    // 테이블 업데이트
    function updateTable(yearSelect, monthSelect, daySelect, table) {

        console.log(yearSelect.value);
        console.log(monthSelect.value);
        console.log(daySelect.value);

        // 선택한 연 / 월 / 일을 정수로 변환하여 변수에 저장
        selectedYear = parseInt(yearSelect.value);
        selectedMonth = parseInt(monthSelect.value);
        selecetdDay = parseInt(daySelect.value);
        
        // fetch_laundry_status 함수를 호출하여 선택한 연 / 월 / 일로 데이터를 요청하고, 테이블을 업데이트합니다.
        fetch_laundry_status(yearSelect, monthSelect, daySelect, table)
    }  

    // selector 
    const table = document.getElementById('daily');
    const yearSelect = document.getElementById('selectedYear');
    const monthSelect = document.getElementById('selectedMonth');
    const daySelect = document.getElementById('selectedDay');
    const searchButton = document.getElementById('searchButton');
    

    // 연 / 월 / 일 / 검색버튼 이벤트 핸들러
    yearSelect.addEventListener('change', () => updateTable(yearSelect, monthSelect, daySelect, table));
    monthSelect.addEventListener('change', () => updateTable(yearSelect, monthSelect, daySelect, table));
    searchButton.addEventListener('change', () => updateTable(yearSelect, monthSelect, daySelect, table));
    searchButton.addEventListener('click', function(e){
        e.preventDefault();
        table.innerHTML=""
        fetch_laundry_status(yearSelect, monthSelect, daySelect, table)
        }
    );







