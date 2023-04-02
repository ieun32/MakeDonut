<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>차트보기</title>

    <style>
    body {
      background-color: #FFFFFF;
      font-family: Arial, sans-serif;
      font-size: 16px;
      line-height: 1.5;
      color: #333333;
    }

    form {
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: center;
      margin-top: 50px;
    }

    label {
      font-weight: bold;
      margin-right: 10px;
    }

    input[type=text] {
      padding: 10px;
      border-radius: 20px;
      border: none;
      box-shadow: 2px 2px 5px #999999;
      margin-right: 10px;
    }

    input[type=submit] {
      padding: 10px 30px;
      background-color: #ECF2FF;
      border-radius: 20px;
      border: none;
      box-shadow: 2px 2px 5px #999999;
      cursor: pointer;
      font-weight: bold;
      transition: all 0.3s ease-in-out;
    }

    input[type=submit]:hover {
      background-color: #F3F3F3;
      box-shadow: 2px 2px 10px #999999;
      transform: translateY(-3px);
    }

    #donutchart {
      margin-top: 50px;
      margin-left: 400px;
      border-radius: 20px;
      background-color: #FFD2D2;
    }

    div {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }

    button {
        margin-top: 50px;
        margin-left: 20px;
        padding: 10px 30px;
        background-color: #ECF2FF;
        border-radius: 20px;
        border: none;
        box-shadow: 2px 2px 5px #999999;
        cursor: pointer;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
        
    }

    button:hover {
        background-color: #F3F3F3;
        box-shadow: 2px 2px 10px #999999;
        transform: translateY(-3px);
    }

  </style>

</head>
<body>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label>도넛의 이름</label>
    <input type="text" name="name">
    <input type="submit" value="도넛보기">
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
    
    // 한글 깨짐 방지
    mysqli_set_charset($conn, "utf8");

    // 데이터베이스에서 데이터 가져오기
    $name = $_POST["name"];
    $sql = "SELECT * FROM dounut WHERE name='$name'";
    $result = $conn->query($sql);

    // 가져온 데이터를 차트 데이터에 넣어주기
    if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $source1 = $row["source1"];
    $source2 = $row["source2"];
    $source3 = $row["source3"];
    $source4 = $row["source4"];
    $source5 = $row["source5"];
    $percent1 = $row["percent1"];
    $percent2 = $row["percent2"];
    $percent3 = $row["percent3"];
    $percent4 = $row["percent4"];
    $percent5 = $row["percent5"];
    $name = $row["name"];
    
    echo '<div id="donutchart" style="width: 900px; height: 500px;"></div>';
    echo '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>';
    echo '<script type="text/javascript">';
    echo 'google.charts.load("current", {packages:["corechart"]});';
    echo 'google.charts.setOnLoadCallback(drawChart);';
    echo 'function drawChart() {';
    echo 'var data = google.visualization.arrayToDataTable([';
    echo "['소스', '소스양'],";
    echo "['$source1',$percent1],";
    echo "['$source2',$percent2],";
    echo "['$source3',$percent3],";
    echo "['$source4',$percent4],";
    echo "['$source5',$percent5]";
    echo ']);';

    echo 'var options = {';
    echo "title: '당신이 만든 도넛, $name',";
    echo 'pieHole: 0.4,';
    echo '};';

    echo 'var chart = new google.visualization.PieChart(document.getElementById("donutchart"));';
    echo 'chart.draw(data, options);';
    echo '}';
    echo '</script>';
    echo '<div>';
    echo '<button id="remake" onclick="location.href=`donut.php`">도넛 다시 만들기</button>';
    echo '<button id="logout" onclick="location.href=`index.php`">로그아웃</button>';
    echo '</div>';
    } else {
    echo "아직 만드신 도넛이 없습니다.";
    }
    $conn->close();
}
?>
</body>
</html>

