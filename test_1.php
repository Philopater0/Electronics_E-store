<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecomm";

// Create connection using PDO
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "
    SELECT `Id`, `name`, `Price`
        FROM `test`
        WHERE `Id` IN (
            SELECT `Id_1` FROM `test_1`
            UNION
            SELECT `Id_2` FROM `test_1`
            UNION
            SELECT `Id_3` FROM `test_1`
            UNION
            SELECT `Id_4` FROM `test_1`
            UNION
            SELECT `Id_5` FROM `test_1`
        )
    ";

    $stmt = $pdo->query($query);

    if ($stmt->rowCount() > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Id</th><th>Name</th><th>Price</th></tr>";
        
        // Prepare the insert statement once outside the loop
        $insertSql = "INSERT INTO recom (Id, Price, Name_1) VALUES (?, ?, ?)";
        $insertStmt = $pdo->prepare($insertSql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['Id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Price']) . "</td>";
            echo "</tr>";

            // Access and insert each value directly inside the loop
            $Id = $row['Id'];
            $Name = $row['name'];
            $Price = $row['Price'];

            // Insert into recom table
            $insertStmt->execute([$Id, $Price, $Name]);
        }
        echo "</table>";

        $response = array("success" => true, "message" => "Answers inserted successfully.");
        echo json_encode($response);
    } else {
        echo "No rows found.\n";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
