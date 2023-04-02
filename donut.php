<!-- 차트 정보 입력 페이지 -->
<!DOCTYPE html>
<html>
<head>
	<title></title>
    <meta charset="utf-8">
	<style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        
        h1 {
            font-size: 2.5em;
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
        
        label {
            font-size: 1.2em;
            margin-bottom: 10px;
        }
        
        input[type="text"], input[type="number"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
        }
        
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            font-size: 1.2em;
            cursor: pointer;
        }
    </style>
</head>
<body>
	<h1>도넛만들기</h1>
    
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label>도넛의 이름</label>
		<input type="text" name="name" required><br><br>
		<h2>어떤 맛의 소스를 발라드릴까요?</h2>
		<label>첫번째 소스</label>
		<input type="text" name="source_1" required><br><br>
        <label>두번째 소스</label>
		<input type="text" name="source_2" required><br><br>
        <label>세번째 소스</label>
		<input type="text" name="source_3" required><br><br>
        <label>네번째 소스</label>
		<input type="text" name="source_4" required><br><br>
        <label>다섯번째 소스</label>
		<input type="text" name="source_5" required><br><br>
	<h2>소스별로 얼마나 발라드릴까요? 1~10사이의 숫자를 입력하세요</h2>
        <label>첫번째 소스</label>
		<input type="number" name="percent_1" required><br><br>
        <label>두번째 소스</label>
		<input type="number" name="percent_2" required><br><br>
        <label>세번째 소스</label>
		<input type="number" name="percent_3" required><br><br>
        <label>네번째 소스</label>
		<input type="number" name="percent_4" required><br><br>
        <label>다섯번째 소스</label>
		<input type="number" name="percent_5" required><br><br>
		<input type="submit" value="도넛만들기">
	</form>
	<?php
	// 폼이 제출되면 차트 정보를 처리하는 코드
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// 데이터베이스 연결
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "donut";

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// 소스맛과 소스양 데이터 가져오기
		$name = $_POST["name"];
		$source1 = $_POST["source_1"];
		$source2 = $_POST["source_2"];
		$source3 = $_POST["source_3"];
		$source4 = $_POST["source_4"];
		$source5 = $_POST["source_5"];
		$percent1 = $_POST["percent_1"];
        $percent2 = $_POST["percent_2"];
		$percent3 = $_POST["percent_3"];
		$percent4 = $_POST["percent_4"];
		$percent5 = $_POST["percent_5"];

		// SQL 쿼리 실행
		$sql = "INSERT INTO dounut (source1, source2,source3,source4,source5,percent1,percent2,percent3,percent4,percent5,name) VALUES ('$source1', '$source2','$source3','$source4','$source5','$percent1','$percent2','$percent3','$percent4','$percent5','$name')";
		if ($conn->query($sql) === TRUE) {
			echo "<script>location.href='chart.php';</script>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
	}
	?>
</body>
</html>
