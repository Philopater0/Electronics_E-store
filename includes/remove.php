<?php

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
 if (session_status() == PHP_SESSION_ACTIVE) {
    // إعدادات الاتصال بقاعدة البيانات
$sql = "DELETE FROM user_answers";
    
        // تنفيذ الاستعلام والتحقق من النجاح
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
      
  
$sql = "DELETE FROM test_1";

    // تنفيذ الاستعلام والتحقق من النجاح
    if ($conn->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    // استعلام SQL لحذف السجل
    $sql = "DELETE FROM recom";

    // تنفيذ الاستعلام والتحقق من النجاح
    if ($conn->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Error deleting record: " . $conn->error;
    }


    
    // إغلاق الاتصال بقاعدة البيانات
    $conn->close();

    // تدمير الجلسة لمنع الحذف مرة أخرى عند تحديث الصفحة
    
} 
?>