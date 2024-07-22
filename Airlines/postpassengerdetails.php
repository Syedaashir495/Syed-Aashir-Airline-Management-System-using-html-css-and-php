<?php 
require_once "dbconnection.php";

if(isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $sex = $_POST['Sex'];
    $phonenumber = $_POST['phonenumber'];
    $address = $_POST['address'];
    $passportnumber = $_POST['passportnumber'];

    // Retrieve flight code from selected table
    $query = mysqli_query($conn, "SELECT * FROM selected");
    if ($rows = mysqli_fetch_array($query)) {
        $flight = $rows['FLIGHT_CODE'];
    } else {
        echo "<script>alert('No selected flight found.')</script>";
        echo "<script>window.location='searchflight.html'</script>";
        exit;
    }

    // Retrieve price from price table
    $sql1 = mysqli_query($conn, "SELECT PRICE FROM price");
    if ($row = mysqli_fetch_array($sql1)) {
        $price = $row['PRICE'];
    } else {
        echo "<script>alert('No price found.')</script>";
        echo "<script>window.location='searchflight.html'</script>";
        exit;
    }

    // Insert into passenger table
    $sql = "INSERT INTO passenger(FNAME, MNAME, LNAME, PASSPORT_NO, AGE, SEX, PHONE, ADDRESS, FLIGHT_CODE) 
            VALUES ('$firstname', '$middlename', '$lastname', '$passportnumber', '$age', '$sex', '$phonenumber', '$address', '$flight')";
    if (!mysqli_query($conn, $sql)) {
        echo "<script>alert('Failed to insert passenger details.')</script>";
        echo "<script>window.location='searchflight.html'</script>";
        exit;
    }

    // Insert into pass table
    $sql = "INSERT INTO pass(PASSPORT_NO) VALUES ('$passportnumber')";
    if (!mysqli_query($conn, $sql)) {
        echo "<script>alert('Failed to insert passport number.')</script>";
        echo "<script>window.location='searchflight.html'</script>";
        exit;
    }

    // Retrieve flight details from flight table
    $query = mysqli_query($conn, "SELECT SOURCE, DESTINATION, DATE FROM flight WHERE FLIGHT_CODE='$flight'");
    if ($rows1 = mysqli_fetch_array($query)) {
        $source = $rows1['SOURCE'];
        $destination = $rows1['DESTINATION'];
        $date = $rows1['DATE'];
    } else {
        echo "<script>alert('No flight details found.')</script>";
        echo "<script>window.location='searchflight.html'</script>";
        exit;
    }

    // Retrieve price and type from price table
    $query = mysqli_query($conn, "SELECT PRICE, TYPE FROM price");
    if ($rows2 = mysqli_fetch_array($query)) {
        $price = $rows2['PRICE'];
        $type = $rows2['TYPE'];
    } else {
        echo "<script>alert('No price and type found.')</script>";
        echo "<script>window.location='searchflight.html'</script>";
        exit;
    }

    // Insert into ticket table
    $sql = "INSERT INTO ticket(PRICE, SOURCE, DESTINATION, DATE_OF_TRAVEL, PASSPORT_NO, FLIGHT_CODE, TYPE) 
            VALUES ('$price', '$source', '$destination', '$date', '$passportnumber', '$flight', '$type')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Ticket Booked Successfully')</script>";
        echo "<script>window.location='reviewticket.php'</script>";
    } else {
        echo "<script>alert('Ticket Booking Failed')</script>";
        echo "<script>window.location='searchflight.html'</script>";
    }
}
?>
