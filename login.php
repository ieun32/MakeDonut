<?php
// 데이터베이스 연결
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// 폼 데이터 수집 및 쿼리 작성
$name = $_POST['name'];
$email = $_POST['email'];
$sql = "SELECT * FROM users WHERE name='$name' AND email='$email'";

// 쿼리 실행 및 결과 처리
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // 로그인 성공
  echo "Login success!";
} else {
  // 로그인 실패
  echo "Invalid username or password";
}

// 데이터베이스 연결 종료
$conn->close();
?>