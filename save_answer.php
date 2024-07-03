
<?php
// Database connection

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecomm";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(!isset($_REQUEST['answers'])){
    header('Content-Type: application/json');
    echo json_encode(array("error" => "No Answers Received."));
    exit();
}
$answers = $_REQUEST['answers'];
$answers = json_decode(urldecode(base64_decode($answers)),true);

$yesValue = 250; // You can adjust this value as needed
$noValue = 350;
// Initialize total value
$totalValue = 0;

// Calculate total value based on answers
foreach ($answers as $key => $answer) {
    if ($answer['choice'] === 'Yes') {
        // Assign specific value to "Yes" answers
        switch ($key) {
            case 2: // Question 3
                $totalValue += $yesValue; // Add value for RAM question
                break;
            case 4: // Question 5
                $totalValue += $yesValue; // Add value for heavy applications question
                break;
            case 9: // Question 10
                $totalValue += $yesValue; // Add value for touch screen question
                break;
            // Add cases for other questions if needed
        }
    }
}
foreach ($answers as $key => $answer) {
    if ($answer['choice'] === 'No') {
        // Assign specific value to "Yes" answers
        switch ($key) {
            case 2: // Question 3
                $totalValue += $noValue; // Add value for RAM question
                break;
            case 4: // Question 5
                $totalValue += $noValue; // Add value for heavy applications question
                break;
            case 9: // Question 10
                $totalValue += $noValue; // Add value for touch screen question
                break;
            // Add cases for other questions if needed
        }
    }
}

// Insert answers into database
$priceValues = ["Less than 15000" => 400, "15000-25000" => 600, "25000-50000" => 800, "More than 50000" => 1000];
$ramValues = ["4GB" => 400, "8GB" => 600, "16GB" => 800, "32GB" => 1000];
$osValues = ["Windows" => 400, "Mac OS" => 600, "Chrome OS" => 800, "No preference" => 1000];

// Initialize total value


// Calculate total value based on answers
$totalValue += $priceValues[$answers[0]['choice']];
$totalValue += $ramValues[$answers[3]['choice']];
$totalValue += $osValues[$answers[6]['choice']];


$minPrice = 0;
$maxPrice = 1000;
$company = 0;
$ram = 0;
$touch = 0;
$os = 0;
$Inches_min = 0;
$Inches_max = 0;
$cpu_min = 0;
$cpu_max = 0;
$gpu_min = 0;
$gpu_max = 0;

switch ($answers[0]['choice']) {
    case 'Less than 15000':
        $minPrice = 0;
        $maxPrice = 100000;
        break;
    case '15000-25000':
        $minPrice = 100000;
        $maxPrice = 500000;
        break;
    case '25000-50000':
        $minPrice = 500000;
        $maxPrice = 900000;
        break;   
    case 'More than 50000':
        $minPrice = 600000;
        $maxPrice = 1000000;
        break;     
    // Add cases for other choices if needed
}
switch ($answers[1]['choice']) {
    case 'Apple':
        $company = 1;
        break;
    case 'HP':
        $company = 2;
        break;
    case 'Lenovo':
        $company = 3;
        break;
    case 'Dell':
        $company = 4;
        break;
    case 'Don’t prefer any company':
        $company = 5;
        break;  
    // Add cases for other RAM sizes if needed
}
switch ($answers[3]['choice']) {
    case '4GB':
        $ram = 4;
        break;
    case '8GB':
       $ram = 8;
        break;
    case '16GB':
        $ram = 16;
        break;
    case '32GB':
        $ram = 32;
        break;
    // Add cases for other RAM sizes if needed
}
switch ($answers[4]['choice']) {
    case 'Yes':
        $ram = 16;
        
        break;
    case 'No':
        $ram = 4;
        break;     
    // Add cases for other choices if needed
}
switch ($answers[9]['choice']) {
    case 'Yes':
        $touch = 1;
        break;
    case 'No':
        $touch = 0;
        break;     
    // Add cases for other choices if needed
}
switch ($answers[6]['choice']) {
    case 'Windows':
        $os = 1;
        break;
    case 'Mac OS':
        $os = 2;
        $company = 1;
        break;
    case 'Chrome OS':
        $os = 3;
        break;
    case 'No preference':
        $os = 4;
        break;
    
}
switch ($answers[7]['choice']) {
    case 'Small':
        $Inches_min = 0.0;
        $Inches_max = 13.9;
        break;
    case 'Medium':
        $Inches_min = 14.0;
        $Inches_max = 16.0;
        break;
    case 'Large':
        $Inches_min = 16.1;
        $Inches_max = 17.54;
        break; 
}
switch ($answers[8]['choice']) {
    case 'Browsing':
        $cpu_min = 365;
        $cpu_max = 1000;
        $gpu_min = 0;
        $gpu_max = 47;
        break;
    case 'Work':
        $cpu_min = 184;
        $cpu_max = 365;
        $gpu_min = 47;
        $gpu_max = 93;
        break;
    case 'Gaming or graphic editing':
        $cpu_min = 0;
        $cpu_max = 184;
        $gpu_min = 93;
        $gpu_max = 233;
        break;   
}




// Insert answers and calculated total value into database
$sql = "INSERT INTO user_answers (min_price, max_price, company, Ram, Touch, OS, Inches_min, Inches_max, cpu_min, cpu_max, GPU_min, GPU_max) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssss", $minPrice, $maxPrice, $company, $ram, $touch, $os, $Inches_min, $Inches_max, $cpu_min, $cpu_max, $gpu_min, $gpu_max);

if ($stmt->execute()) {
    $response = array("success" => true, "message" => "Answers inserted successfully.");
} else {
    $response = array("success" => false, "message" => "Error inserting answers: " . $stmt->error);
    // Add this line to check for SQL errors
    var_dump($stmt->error);
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
