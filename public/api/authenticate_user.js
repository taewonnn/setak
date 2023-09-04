// selector
const usernameInput = document.getElementById('username');
const passwordInput = document.getElementById('password');
const loginForm = document.getElementById('loginForm');
const apiUrl = "../api/authenticate_user.php";


// 통신 데이터 - config 
const config = {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    }
};


// form 제출 이벤트 함수
async function handleLoginFormSubmit(event) {
    event.preventDefault();

    // 입력된 아이디와 비밀번호를 가져옵니다.
    const username = usernameInput.value;
    const password = passwordInput.value;

    // 요청 옵션 객체에 body 추가
    config.body = JSON.stringify({ username, password });

    fetch("../api/authenticate_user.php", config)
    .then(response => response.json())
    .then(result => {

        // 확인용
        console.log(result);

        // 알림
        if (result.success) {
            alert("로그인 성공");
            window.location.href = "index.php";
        } else {
            alert("로그인 실패!!: " + result.message);
        }
    })
    .catch(error => {
        console.error("로그인 에러:", error);
        alert("로그인 중 에러가 발생했습니다.");
    });
    }

// 폼 제출 이벤트 리스너 등록
loginForm.addEventListener('submit', handleLoginFormSubmit);