    // Js 데이터 요청
    function fetch_monthly_order (selectedYear, selectedMonth, table) {

        // 기존 테이블 내용 지우기
        table.innerHTML = '';

        // 헤더 행 추가
        const headerRow = table.insertRow();
        const cellNames = ['일', '주문수'];
        cellNames.forEach(cellName => {
            const th = document.createElement('th');
            th.textContent = cellName;
            headerRow.appendChild(th);
        });

        console.log('클릭')
        fetch(`./api/get_monthly_order.php?selectedYear=${selectedYear.value}&selectedMonth=${selectedMonth.value}`)
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
            });
        }

    // 데이터 추가
    function addDataRow(row) {
        // 새로운 테이블 추가
        const newRow = table.insertRow();

        // 데이터 추가
        newRow.insertCell().textContent = row.일;
        newRow.insertCell().textContent = row.일별_주문수;
    }


    // 테이블 업데이트
    function updateTable(yearSelect, monthSelect, table) {
        console.log(yearSelect.value);
        console.log(monthSelect.value);

        // 선택한 연도와 월을 정수로 변환하여 변수에 저장
        selectedYear = parseInt(yearSelect.value);
        selectedMonth = parseInt(monthSelect.value);

        // fetch_monthly_order 함수를 호출하여 선택한 연도와 월로 데이터를 요청하고, 테이블을 업데이트합니다.
        fetch_monthly_order(yearSelect, monthSelect, table)
    }  

    // selector
    const table = document.getElementById('daily');
    const yearSelect = document.getElementById('selectedYear');
    const monthSelect = document.getElementById('selectedMonth');
    const searchButton = document.getElementById('searchButton')

    // 연도, 월, 검색버튼 이벤트 핸들러
    yearSelect.addEventListener('change', () => updateTable(yearSelect, monthSelect, table));
    monthSelect.addEventListener('change', () => updateTable(yearSelect, monthSelect, table));
    searchButton.addEventListener('click',function(e){
        e.preventDefault();
        fetch_monthly_order(yearSelect, monthSelect, table)
        }
    );
