<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $dealership = $_POST['dealership'];
    $recommend = $_POST['recommend'];
    $knowledge = $_POST['knowledge'];
    $rate = $_POST['rate'];
    $warranty = $_POST['warranty'];
    $ability = $_POST['ability'];

    $sql = "INSERT INTO ca (dealership, recommend, knowledge, rate, warranty, ability) VALUES ('$dealership', '$recommend', '$knowledge', '$rate', '$warranty', '$ability')";

    if ($conn->query($sql) === TRUE) {
        echo "Feedback submitted successfully!";
        header("Location: success.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feedback System</title>
    <link rel="stylesheet" href="css/user.css">
    
</head>
<body>

    <form method="POST" action="">
    <label for="rate" class="dealership-label">&nbsp;&nbsp;&nbsp;Excellent&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Good&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Average&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;Poor</label>
<br><br>
    <div class="label-container">
        <label > How our car dealership match your expectations :</label>
        <label for="accuracy">
            <input type="radio" name="dealership" id="excellent" value="5" required>
            <input type="radio" name="dealership" id="good" value="4"> 
            <input type="radio" name="dealership" id="average" value="3"> 
            <input type="radio" name="dealership" id="poor" value="2">
        </label>
    </div>
        <br>
    <div class="label-container">
        <label>How likely are you to recommend us to your friends 
            <br>and relatives, on a scale:</label>
        <label for="service">
            <input type="radio" name="recommend" id="excellent" value="5" required> 
            <input type="radio" name="recommend" id="good" value="4">    
            <input type="radio" name="recommend" id="average" value="3">     
            <input type="radio" name="recommend" id="poor" value="2">
    </label>
    </div>   
        <br>
    <div class="label-container">
        <label>knowledge of the product feature and benefits:</label>
        <label for="hygiene">
            <input type="radio" name="knowledge" id="excellent" value="5" required>        
            <input type="radio" name="knowledge" id="good" value="4">       
            <input type="radio" name="knowledge" id="average" value="3">      
            <input type="radio" name="knowledge" id="poor" value="2">
        </label> 
    </div>
        <br>
    <div class="label-container">
        <label>How satisfied are you with… <br>
            (the selection of vehicles, price,knowledge of staff, <br>
            friendliness of staff, overall satisfaction, etc.)
:</label>
        <label for="quality">
            <input type="radio" name="rate" id="excellent" value="5" required>   
            <input type="radio" name="rate" id="good" value="4">     
            <input type="radio" name="rate" id="average" value="3"> 
            <input type="radio" name="rate" id="poor" value="2"> 
        </label>
    </div> 
        <br>
    <div class="label-container">
        <label> Explanation of warranty coverages:</label>
        <label for="decor">
            <input type="radio" name="warranty" id="excellent" value="5" required> 
            <input type="radio" name="warranty" id="good" value="4">
            <input type="radio" name="warranty" id="average" value="3">
            <input type="radio" name="warranty" id="poor" value="2"> 
        </label>
    </div>
        <br>
    <div class="label-container"> 
        <label>Ability to listen understand and answer your questions:</label>
        <label for="timing">
            <input type="radio" name="ability" id="excellent" value="5" required> 
            <input type="radio" name="ability" id="good" value="4">
            <input type="radio" name="ability" id="average" value="3">
            <input type="radio" name="ability" id="poor" value="2">
        </label>
    </div>
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
