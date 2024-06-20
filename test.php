<?php
session_start();
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

// Fetch data from the database
$sql = "SELECT * FROM user_answers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Initialize an empty array to hold all rows
    $data_array = [];

    // Fetch each row from the result and add it to the array
    while ($row = $result->fetch_assoc()) {
        // Convert numeric values to integers if they are numeric strings
        foreach ($row as $key => $value) {
            if (is_numeric($value)) {
                $row[$key] = intval($value);
            }
        }
        // Add the row to the data array
        $data_array = $row;
    }

    // Close the database connection
   

    // Set the Content-Type header to application/json
    header('Content-Type: application/json');

    // Encode the data array as JSON
    $jsonData = json_encode($data_array);

    // Initialize cURL
    $curl = curl_init();

    // Set cURL options
    curl_setopt_array($curl, [
        CURLOPT_URL => 'http://127.0.0.1:5000/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $jsonData,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ]
    ]);

    // Execute the cURL request
    $response = curl_exec($curl);

    // Check for errors
    if ($response === false) {
        echo "cURL Error: " . curl_error($curl);
    } else {
        // Output the response
        echo "Response: " . $response;
        $array = json_decode($response, true);

        //echo $array;
        // Remove brackets
        $response = str_replace(['[', ']'], '', $response);
        // Split the string at commas and convert it into an array
        $array = explode(',', $response);
        // Remove double quotes from each element
        $array = array_map('trim', str_replace('"', '', $array));

        print_r($array);
       // echo $array[1];

        

    }
    

    // Close cURL
    curl_close($curl);
} else {
    echo "No data found.";
}

    $Id_1 = $array[0];
    $price_1 =$array[1];
    $Id_2 = $array[2];
    $price_2 = $array[3];
    $Id_3 = $array[4];
    $price_3 = $array[5];
    $Id_4 = $array[6];
    $price_4 = $array[7];
    $Id_5 = $array[8];
    $price_5 = $array[9];
    
    $sql = "INSERT INTO test_1 (Id_1, price_1, Id_2, price_2, Id_3, price_3, Id_4, price_4, Id_5, price_5) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ididididid", $Id_1, $price_1, $Id_2, $price_2, $Id_3, $price_3, $Id_4, $price_4, $Id_5, $price_5);

    if ($stmt->execute()) {
        $response = array("success" => true, "message" => "Answers inserted successfully.");
    } else {
        $response = array("success" => false, "message" => "Error inserting answers: " . $stmt->error);
        // Add this line to check for SQL errors
        var_dump($stmt->error);
    }
    $stmt->close();
   
    if (session_status() == PHP_SESSION_ACTIVE) {
        // إعدادات الاتصال بقاعدة البيانات
        
    
        // استعلام SQL لحذف السجل
        $sql = "DELETE FROM user_answers";
    
        // تنفيذ الاستعلام والتحقق من النجاح
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    
        // إغلاق الاتصال بقاعدة البيانات
        $conn->close();
    
        // تدمير الجلسة لمنع الحذف مرة أخرى عند تحديث الصفحة
        session_destroy();
    }
    
?>