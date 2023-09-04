<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <style>
        #container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body>
    <div id="container">
        <form id="loginForm" method="post">
            <label for="username">아이디 : </label>
            <input type="text" id="username" name="username" required>

            <label for="password">비밀번호 :</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">로그인</button>
        </form>
    <div>
    <script src="./api/authenticate_user.js"></script>
</body>
</html>
