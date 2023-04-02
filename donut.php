<!-- 차트 정보 입력 및 실시간 보여주는 페이지 -->
<!DOCTYPE html>
<html>
<head>
	<title></title>
    <meta charset="utf-8">
	<style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: left;
            align-items: left;
        }
        
        h1 {
            font-size: 2.5em;
            text-align: center;
        }
        
        form {
            display: flex;
            flex-direction: column;
            justify-content: left;
            align-items: left;
            background-color: #f2f2f2;
            padding: 30px;
            border-radius: 10px;
        }
        
        label {
            font-size: 1.2em;
            margin-bottom: 5px;
        }
        
        input[type="text"], input[type="number"], input[type="submit"] {
            width: 30%;
            padding: 10px;
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

		#donutchart {
			position: absolute;
			left: 50%;
			top: 20%;
		}

		button {
			position: absolute;
			left: 90%;
			top: 5%;
			width: 100px;
			height: 50px;
			font-size: 1.2em;
		}
    </style>
</head>
<body>
	<h1>도넛만들기</h1>
    <button id="logout" onclick="location.href=`index.php`">로그아웃</button>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<h2>도넛의 이름</h2>
		<input type="text" name="name" required><br><br>
		<h3>어떤 맛의 소스를 발라드릴까요?</h3>
		<input type="text" name="source_1" placeholder="첫번째 소스" required><br>
		<input type="text" name="source_2" placeholder="두번째 소스" required><br>
		<input type="text" name="source_3" placeholder="세번째 소스" required><br>
		<input type="text" name="source_4" placeholder="네번째 소스" required><br>
		<input type="text" name="source_5" placeholder="다섯번째 소스" required><br>
		<h3>소스별로 얼마나 발라드릴까요? 1~10사이의 숫자를 입력하세요</h3>
		<input type="number" name="percent_1" placeholder="첫번째 소스" required><br>
		<input type="number" name="percent_2" placeholder="두번째 소스" required><br>
		<input type="number" name="percent_3" placeholder="세번째 소스" required><br>
		<input type="number" name="percent_4" placeholder="네번째 소스" required><br>
		<input type="number" name="percent_5" placeholder="다섯번째 소스" required><br>
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
			// 데이터베이스 연결
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "donut";
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			}
			
			// 한글 깨짐 방지
			mysqli_set_charset($conn, "utf8");
		
			// 데이터베이스에서 데이터 가져오기
			$sql = "SELECT * FROM dounut WHERE name='$name'";
			$result = $conn->query($sql);
		
			// 가져온 데이터를 차트 데이터에 넣어주기
			if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$source01 = $row["source1"];
			$source02 = $row["source2"];
			$source03 = $row["source3"];
			$source04 = $row["source4"];
			$source05 = $row["source5"];
			$percent01 = $row["percent1"];
			$percent02 = $row["percent2"];
			$percent03 = $row["percent3"];
			$percent04 = $row["percent4"];
			$percent05 = $row["percent5"];
			$name = $row["name"];
			
			echo '<div id="donutchart" style="width: 900px; height: 500px;">';
			echo '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>';
			echo '<script type="text/javascript">';
			echo 'google.charts.load("current", {packages:["corechart"]});';
			echo 'google.charts.setOnLoadCallback(drawChart);';
			echo 'function drawChart() {';
			echo 'var data = google.visualization.arrayToDataTable([';
			echo "['소스', '소스양'],";
			echo "['$source01',$percent01],";
			echo "['$source02',$percent02],";
			echo "['$source03',$percent03],";
			echo "['$source04',$percent04],";
			echo "['$source05',$percent05]";
			echo ']);';
		
			echo 'var options = {';
			echo "title: '당신이 만든 도넛, $name',";
			echo 'pieHole: 0.4,';
			echo '};';
		
			echo 'var chart = new google.visualization.PieChart(document.getElementById("donutchart"));';
			echo 'chart.draw(data, options);';
			echo '}';
			echo '</script>';
			echo '</div>';
			echo '<div>';
			echo '</div>';
			} else {
			echo "아직 만드신 도넛이 없습니다.";
			}
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();
	}
	?>
</body>
</html>
