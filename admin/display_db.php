<?php
require_once "../utility.php";


$tableNames = $_GET['q'] ?? [];
$tableNames = json_decode($tableNames, true);

$host = 'localhost:3306';
$user = 'root';
$password = '';
$dbname = 'btcdb';

$query = '';

if (empty($tableNames) || count($tableNames) == 0) {
    echo "No databases selected.";
    return;
}

$mysqli = new mysqli($host, $user, $password, $dbname);

$tableName = '';
// if only one table selected
if (count($tableNames) == 1) {
    $query .= "SELECT * FROM {$tableNames[0]}";
    $tableName = $tableNames[0];
}
// case if more than 1 is selected will be updated


// add headers of the table to the html representation of the table
// for now works only for 1 table
function addHeaders($headers)
{
    $tableHeaders = '';
    foreach ($headers as $header) {
        $tableHeaders .= " <th>$header </th > ";
    }
    return $tableHeaders;
}

function addEditDelete($rowData, $id)
{
    $rowData .= "<td><button onclick='removeRow($id)'> Remove</button ></td> ";
    $rowData .= "<td><button onclick='editInRow($id, this)'> Edit</button ></td> ";
    return $rowData;
}

// add content of a table to html representation of a table
function addRowData($headers, $row)
{
    $rowData = '';
    $id = $row['id'];
    foreach ($headers as $index => $header) {
        if ($index === 0) {
            $rowData .= "<td data-id='$id' class='first-cell'>$row[$header]</td>";
        } else {
            $rowData .= "<td data-id='$id'>$row[$header]</td>";
        }
    }

    return $rowData;
}


function addInputField($headers, $tableName, $cnt)
{
    $inputRow = "<tr > ";
    $i = 0;
    $size = count($headers);
    foreach ($headers as $header) {
        if ($i === 0) {
            $value = $cnt;
        } else {
            $value = '';
        }
        $inputRow .= "<td><input name ='$header|$tableName|$i::$size'
                                 oninput='inputData(this, {$cnt})' placeholder = '$header' " . ($i === 0 ? ' readonly' : '') . " value='$value'>
                      </td> ";
        $i += 1;
    }
    $inputRow .= "<td id='inputTD' colspan = '" . (count($headers) + 2) . "'>
                    <button id='add_button'  class='$tableName' value='add' onclick='addRow()'>Add</button >
                  </td > ";
    $inputRow .= "</tr > ";
    return $inputRow;
}

if (!empty($query)) {
    $result = $mysqli->multi_query($query);
    $headers = [];
    if ($result) {
        $tableRows = '';
        $tableHeaders = '';
        do {
            if ($result = $mysqli->store_result()) {
                // for now works only for 1 selected table
                $tableHeaders = addHeaders($headers = getAllTableHeaders($tableName)); // add headers to a displayed table
                while ($row = $result->fetch_assoc()) {
                    $rowData = addRowData($headers, $row);
                    $id = $row['id'];
                    $rowData = addEditDelete($rowData, $id);

                    $tableRows .= "<tr> $rowData</tr > ";
                }
                $result->free();
            }
        } while ($mysqli->next_result());


        // Combine table rows and input row
        $tableRows .= addInputField($headers, $tableName, substr_count($tableRows, '<tr>') + 1);

        if (!empty($tableRows)) {
            $tableRows = str_replace("<td>", "<td contenteditable='false' onclick='enableInput(this)'>", $tableRows);
            echo <<<HTML
            <table id="db_table">
                <thead>
                    <tr>
                        $tableHeaders
                    </tr>
                </thead>
                <tbody>
                    $tableRows
                </tbody>
            </table>
            HTML;
        } else {
            echo "No data available for the selected databases . ";
        }
    } else {
        echo "Error in query execution: " . $mysqli->error;
    }
} else {
    echo "No databases selected . ";
    return;
}
?>




<!--Useful to find wit wich db the selected db are connected-->
<?php
//$tableStructure = array(
//    array('t1' => "user", 't2' => 'member_info', 'joining_component' => 'user_member')
//);
//
//function getConnectionForTables($table, $t1, $t2)
//{
//    foreach ($table as $row) {
//        if (($row['t1'] == $t1 && $row['t2'] == $t2) || ($row['t1'] == $t2 && $row['t2'] == $t1)) {
//            return $row['joining_component'];
//        }
//    }
//    return null; // Return null if the pair is not found in the table
//}
//?>
