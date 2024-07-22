<?php 
$flag = 0;
require_once "dbconnection.php"; // Include the connection file

// Check if the connection is established
if (!$conn) {
    die("Database connection failed.");
}

if (isset($_POST['submit'])) {
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['source'];
    $airportname = $_POST['airportname'];
    $source = $_POST['source'];
    $destination = $_POST['destination'];
    $departure = $_POST['departure'];
    $arrival = $_POST['arrival'];
    $duration = $_POST['duration'];
    $airlinesid = $_POST['airlinesid'];
    $flightcode = $_POST['flightcode'];
    $date = $_POST['date'];
    $economyclass = $_POST['economyclass'];
    $businessclass = $_POST['businessclass'];
    $students = $_POST['students'];
    $diff = $_POST['diff'];

    $sql = "SELECT * FROM airline WHERE AIRLINE_ID='$airlinesid'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        $sql = "SELECT * FROM flight WHERE FLIGHT_CODE='$flightcode'";
        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) == 0) {
            if (strlen($flightcode) == 10) {
                $sql1 = "INSERT INTO city(C_NAME, STATE, COUNTRY) VALUES ('$city', '$state', '$country')";
                if (mysqli_query($conn, $sql1)) {
                    $flag++;
                }

                $sql2 = "INSERT INTO airport(A_NAME, STATE, COUNTRY, C_NAME) VALUES ('$airportname', '$state', '$country', '$city')";
                if (mysqli_query($conn, $sql2)) {
                    $flag++;
                }

                $sql4 = "INSERT INTO contains(A_NAME, AIRLINE_ID) VALUES('$airportname', '$airlinesid')";
                if (mysqli_query($conn, $sql4)) {
                    $flag++;
                }

                $sql5 = "INSERT INTO flight(SOURCE, DESTINATION, DEPARTURE, ARRIVAL, DURATION, FLIGHT_CODE, AIRLINE_ID, PRICE_BUSINESS, PRICE_ECONOMY, PRICE_STUDENTS, PRICE_DIFFERENTLYABLED, DATE) VALUES('$source', '$destination', '$departure', '$arrival', '$duration', '$flightcode', '$airlinesid', '$businessclass', '$economyclass', '$students', '$diff', '$date')";
                if (mysqli_query($conn, $sql5)) {
                    $flag++;
                }

                if ($flag == 4) {
                    echo "<script>alert('Inserted successfully')</script>";
                    echo "<script>window.location='homepage.html'</script>";
                } else {
                    echo "<script>alert('Insertion Failed')</script>";
                }
            } else {
                echo "<script>alert('Flight Code should be of length 10')</script>";
                echo "<script>window.location='admin_form.html'</script>";
            }
        } else {
            echo "<script>alert('Duplicate Flight Code !')</script>";
            echo "<script>window.location='admin_form.html'</script>";
        }
    } else {
        echo "<script>alert('Airline Code not in database')</script>";
        echo "<script>window.location='admin_form.html'</script>";
    }
}
?>
