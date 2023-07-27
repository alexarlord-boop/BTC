<?php
require_once "../utility.php";
require_once "dashboard.php";

$host = 'localhost:3306';
$user = 'root';
$password = '';
$dbname = 'btcdb';
$conn = new mysqli($host, $user, $password, $dbname);


if ($conn->connect_error) {
    echo "death";
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && isset($_POST["tableName"])) {
    $response = array('status' => 'success', 'message' => 'new team added');

    $action = json_decode($_POST["action"], true);
    switch ($action) {
        case "add":
            if (isset($_POST["inputs"])) {
                $inputs = json_decode($_POST["inputs"], true);
                $result = addData($inputs, $_POST["tableName"], $conn);

                if ($result === true) {
                    $response['status'] = 'success';
                    $response['message'] = 'New team added';
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Failed to add new team: ' . $result;
                }
            } else {
                $response['status'] = 'error';
                $response['message'] = 'No input data to add';
            }
            break;
        default:
            $response['status'] = 'error';
            $response['message'] = 'Invalid action';
            break;
    }

    // Encode the response array as JSON and send it back to the JavaScript function
    echo json_encode($response);
}
//        case "remove":
//            if (isset($_POST["id"])) {
//                removeData($_POST["id"], $_POST["tableName"], $conn);
//            }
//            break; // Add a break statement to prevent fall-through to the "edit" case
//        case "edit":
//            editData();
//            break; // Add a break statement to prevent fall-through to the default case
//        default:
//            echo "Invalid action" . $conn->error;
//            exit;
//    }
//}


// for now only for 1 table
// for now not really oaying attention to the type of the input
// function addData($data, $tableName, $conn)
// {
//     $columnDataTypes = getNamesTypesOfTable($tableName, $conn);
//
//     // Build the query with the correct data types and placeholders
//     $columns = implode(', ', array_keys($data));
//     $placeholders = implode(', ', array_fill(0, count($data), '?'));
//
//     $query = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";
//
//     $stmt = $conn->prepare($query);
//
//     if (!$stmt) {
//         return false;
//     }
//
//     list($bindParams, $types) = bindWithCorrectType($data, $columnDataTypes);
//
//     array_unshift($bindParams, $types);
//     call_user_func_array(array($stmt, 'bind_param'), $bindParams);
//
//     if ($stmt->execute()) {
//         return true;
//     }
//     return false;
// }


// TODO: add triggers in future
// function removeData($id, $tableName, $conn)
// {
//     $tableName = $conn->real_escape_string($tableName);
//     $tableName = "`" . $tableName . "`"; // Assuming the table name should be enclosed in backticks (`)
//
//     $query = "DELETE FROM $tableName WHERE id = ?";
//
//     $stmt = $conn->prepare($query);
//
//     if (!$stmt) {
//         echo "Error: " . $query . "<br>" . $conn->error;
//         return;
//     }
//
//     $stmt->bind_param("i", $id);
//
//     if ($stmt->execute()) {
//         echo "Row with ID $id removed successfully.";
//     } else {
//         echo "Error: " . $stmt->error;
//     }
//
//     $stmt->close();
// }
//
//
// function editData()
// {
// }


$conn -> close();
?>


<!--// Get the column names and their data types from the database-->
<!--$columnsQuery = "SHOW COLUMNS FROM $tableName";-->
<!--$columnsResult = $conn->query($columnsQuery);-->
<!---->
<!--// Create an associative array to store column names and their corresponding data types-->
<!--$columnDataTypes = array();-->
<!---->
<!--while ($row = $columnsResult->fetch_assoc()) {-->
<!--$columnDataTypes[$row['Field']] = $row['Type'];-->
<!--}-->
