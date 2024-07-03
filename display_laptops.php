<?php
session_start();

// Check if the response is set in the session
if (isset($_SESSION['response'])) {
    // Get the response from the session
    $response = $_SESSION['response'];

    // Decode the JSON response
    $laptops = json_decode($response, true);

    // Check if the response is an array
    if (is_array($laptops)) {
        // Output the laptops in a table format
        echo "<table border='1'>
                <tr>
                    <th>Min Price</th>
                    <th>Max Price</th>
                    <th>Company</th>
                    <th>Ram</th>
                    <th>Touch</th>
                    <th>OS</th>
                    <th>Inches Min</th>
                    <th>Inches Max</th>
                    <th>CPU Min</th>
                    <th>CPU Max</th>
                    <th>GPU Min</th>
                    <th>GPU Max</th>
                </tr>";
        foreach ($laptops as $laptop) {
            echo "<tr>
                    <td>{$laptop['min_price']}</td>
                    <td>{$laptop['max_price']}</td>
                    <td>{$laptop['company']}</td>
                    <td>{$laptop['Ram']}</td>
                    <td>{$laptop['Touch']}</td>
                    <td>{$laptop['OS']}</td>
                    <td>{$laptop['Inches_min']}</td>
                    <td>{$laptop['Inches_max']}</td>
                    <td>{$laptop['cpu_min']}</td>
                    <td>{$laptop['cpu_max']}</td>
                    <td>{$laptop['GPU_min']}</td>
                    <td>{$laptop['GPU_max']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "Invalid response from server. Raw response: " . htmlspecialchars($response);
    }

    // Clear the response from the session
    unset($_SESSION['response']);
} else {
    echo "No response found.";
}
?>
