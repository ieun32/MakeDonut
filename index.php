<!-- 로그인 페이지, 첫화면 -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    body {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    /* h1 태그에 대한 스타일을 지정합니다 */
    h1 {
      text-align: center;
    }

    /* form 요소를 가운데 정렬합니다 */
    form {
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			background-color: #f2f2f2;
			padding: 30px;
			border-radius: 10px;
		}
    
    /* label 태그에 대한 스타일을 지정합니다 */
    label {
      display: flex;
      align-items: center;
      margin: 10px 0;
      font-size: 18px;
      font-weight: bold;
    }
    
    /* input 요소에 대한 스타일을 지정합니다 */
    input[type="email"],
    input[type="password"],
    input[type="submit"],
    a {
      font-size: 18px;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.1);
      width: 300px;
      max-width: 100%;
      box-sizing: border-box;
    }

    #submit{
      background-color: #4CAF50;
      color: white;
      border: 1px solid #3E8E41;
    }
    
    /* a 태그에 대한 스타일을 지정합니다 */
    a {
      background-color: #56b5e8;
      color: white;
      font-size: 18px;
      text-align: center;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #56b5e8;
      text-decoration: none;
      width: 300px;
      max-width: 100%;
      margin-top: 10px;
    }
    
    /* a 태그에 마우스를 올렸을 때의 스타일을 지정합니다 */
    a:hover {
      background-color: #354dd3;
    }
  </style>
</head>
<body>
  <h1>로그인</h1>
  <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> accept-charset="UTF-8">
    <input type="email" id="email" name="email" placeholder="이메일을 입력하세요" required><br>
    <input type="password" id="password" name="password" placeholder="비밀번호를 입력하세요" required><br>
    <input type="submit" id="submit" value="로그인">
    <a href='signin.php'>회원가입</a>
  </form>
  <?php
  // 폼이 제출되면 회원 정보를 처리하는 코드
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		// 데이터베이스 연결
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "mydb";

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// 이메일과 비밀번호 데이터 가져오기
		$email = $_POST["email"];
    $passwd = $_POST["password"];

		// SQL 쿼리 실행
		$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$passwd'";
		$result = $conn->query($sql);
    if ($result->num_rows > 0) {
			echo "로그인 성공!";
      echo "<script>location.href='donut.php';</script>";
		} else {
      echo "<script>alert('아이디나 비밀번호가 올바르지 않습니다.');</script>";
		}

		$conn->close();
  }
  ?>
</body>
</html>

