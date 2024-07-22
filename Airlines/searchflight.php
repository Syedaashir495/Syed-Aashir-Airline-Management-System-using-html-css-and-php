<?php 
require_once "dbconnection.php";

if (isset($_POST['search'])) {
    if (!empty($_POST['source']) && !empty($_POST['destination']) && !empty($_POST['date'])) {
        $source = $_POST['source'];
        $destination = $_POST['destination'];
        $date = $_POST['date'];

        $query = "SELECT ARRIVAL, DEPARTURE, DURATION, FLIGHT_CODE, AIRLINE_ID, PRICE_BUSINESS, PRICE_ECONOMY, PRICE_STUDENTS, PRICE_DIFFERENTLYABLED 
                  FROM flight 
                  WHERE SOURCE='$source' AND DESTINATION='$destination' AND DATE='$date'";

        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        $rowscount = mysqli_num_rows($result);

        if ($rowscount == 0) {
            echo "<script>alert('No Flights available')</script>";
            echo "<script>window.location='searchflight.html'</script>";
        }
    } else {
        echo "<script>alert('Please Enter the details correctly')</script>";
        echo "<script>window.location='homepage.html'</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Available Flights</title>
    <style>
        *{
			margin: 0;
			padding: 0;
			font-family: Century Gothic;
		}
		ul{
			float: right;
			list-style-type: none;
			margin-top: 25px;
		}
		ul li{
			display: inline-block;
		}
		ul li a{
			text-decoration: none;
			color: #fff;
			padding: 5px 20px;
			border: 1px solid #fff;
			transition: 0.6s ease;
		}
		ul li a:hover{
			background-color: #fff;
			color: #000;
		}
		ul li.active a{
			background-color: #fff;
			color: #000;
		}
		.title{
			position: absolute;
			top: 15%;
			left: 35%;
			/*transform: translate(-50%,-50%);*/
		}
		.title h1{
			color: #fff;
			font-size: 70px;
		}
		body{
			background-color:black;
			height: 100vh;
			background-size: cover;
			background-position: center;
		}
		table.a{
			position: absolute;
			top: 27%;
			left: 20%;
			/*transform: translate(-50%,-50%);*/
			border: 1px solid #fff;
			padding: 10px 30px;
			color: #fff;
			text-decoration: none;
			transition: 0.6s ease;
			font-size: 20px;
		}
		button[type="submit"]{
			border: 1px solid #fff;
			padding: 10px 30px;
			text-decoration: none;
			transition: 0.6s ease;
		}
		button[type="submit"]:hover{
			background-color: #fff;
			color: #000;
		}
    </style>
</head>
<body>
    <div class="main">
        <ul>
            <li class="active"><a href="#">Available Flights</a></li>
            <li><a href="homepage.html">Home</a></li>
        </ul>
    </div>
    <div class="title">
        <h1>Available Flights</h1>
    </div>
    <table class="a">
        <tr>
            <th>DEPARTURE&emsp;</th>
            <th>ARRIVAL&emsp;</th>
            <th>DURATION&emsp;</th>
            <th>FLIGHT_CODE&emsp;</th>
            <th>AIRLINE_ID&emsp;</th>
            <th>PRICE&emsp;</th>
            <th>TYPE&emsp;</th>
            <th></th>
        </tr>

        <?php 
        if (isset($result) && $rowscount > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['DEPARTURE']}</td>
                        <td>{$row['ARRIVAL']}</td>
                        <td>{$row['DURATION']}</td>
                        <td>{$row['FLIGHT_CODE']}</td>
                        <td>{$row['AIRLINE_ID']}</td>
                        <td>{$row['PRICE_BUSINESS']}</td>
                        <td>BUSINESS</td>
                        <td><a href='postflightcodebusiness.php?id={$row['FLIGHT_CODE']}'>Select</a></td>
                      </tr>
                      <tr>
                        <td>{$row['DEPARTURE']}</td>
                        <td>{$row['ARRIVAL']}</td>
                        <td>{$row['DURATION']}</td>
                        <td>{$row['FLIGHT_CODE']}</td>
                        <td>{$row['AIRLINE_ID']}</td>
                        <td>{$row['PRICE_ECONOMY']}</td>
                        <td>ECONOMY</td>
                        <td><a href='postflightcodeeconomy.php?id={$row['FLIGHT_CODE']}'>Select</a></td>
                      </tr>
                      <tr>
                        <td>{$row['DEPARTURE']}</td>
                        <td>{$row['ARRIVAL']}</td>
                        <td>{$row['DURATION']}</td>
                        <td>{$row['FLIGHT_CODE']}</td>
                        <td>{$row['AIRLINE_ID']}</td>
                        <td>{$row['PRICE_STUDENTS']}</td>
                        <td>STUDENTS</td>
                        <td><a href='postflightcodestudents.php?id={$row['FLIGHT_CODE']}'>Select</a></td>
                      </tr>
                      <tr>
                        <td>{$row['DEPARTURE']}</td>
                        <td>{$row['ARRIVAL']}</td>
                        <td>{$row['DURATION']}</td>
                        <td>{$row['FLIGHT_CODE']}</td>
                        <td>{$row['AIRLINE_ID']}</td>
                        <td>{$row['PRICE_DIFFERENTLYABLED']}</td>
                        <td>DIFFERENTLY ABLED</td>
                        <td><a href='postflightcodediff.php?id={$row['FLIGHT_CODE']}'>Select</a></td>
                      </tr>";
            }
        }
        ?>
    </table>
</body>
</html>
