<!-- 회원가입 페이지 -->
<!DOCTYPE html>
<html>
<head>
	<title>회원가입</title>
	<style>
		body {
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
		}
		
		h1 {
			font-size: 30px;
			text-align: center;
		}
		
		form {
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			background-color: #f2f2f2;
			padding: 30px;
			border-radius: 10px;
		}
		
		input[type="text"], input[type="email"], input[type="password"], input[type="submit"] {
			width: 300px;
			padding: 10px;
			border: none;
			border-radius: 5px;
			box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
			font-size: 18px;
		}
		
		input[type="submit"] {
			background-color: #4CAF50;
			color: white;
			font-size: 18px;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<h1>회원가입</h1>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<input type="text" name="name" placeholder="이름 입력" required><br>
		<input type="email" name="email" placeholder="이메일 입력" required><br>
		<input type="password" name="passwd" placeholder="비밀번호 입력" required><br>
		<input type="submit" value="가입">
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

		// 이름과 이메일 데이터 가져오기
		$name = $_POST["name"];
		$email = $_POST["email"];
        $passwd = $_POST["passwd"];

		// SQL 쿼리 실행
		$sql = "INSERT INTO users (name, email,password) VALUES ('$name', '$email','$passwd')";
		if ($conn->query($sql) === TRUE) {
			echo "<alert>회원가입이 완료되었습니다.</alert>";
			echo "<script>location.href='index.php';</script>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
	}
	?>
</body>
</html>
