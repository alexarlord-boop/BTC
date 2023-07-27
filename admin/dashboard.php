<?php
require_once "../components/admin_header_card.php";
require_once "../components/admin_dashboard_template.php";
require_once "../utility.php";

$headerCard1 = getHeaderCard("Users", [], "user", "cardSelected(this)");
$headerCard2 = getHeaderCard("Members", [], "member_info", "cardSelected(this)");
$headerCard3 = getHeaderCard("Companies", [], "company_info", "cardSelected(this)");
$headerCard4 = getHeaderCard("Teams", [], "team", "cardSelected(this)");
$pointer = null;

$header = <<<HTML
    <div class="admin header" style="display: flex; flex-direction: column; align-items: center; gap: 50px;">
        <div class="admin header-card-container">
            $headerCard1 
            $headerCard2
            $headerCard3   
            $headerCard4   
        </div>
        <div id="showDB" class="admin db-container" style="overflow: auto; border: #d8363a 1px solid; min-height: 300px; height: 100%; width: 100%;">
        </div>
        <div class="m-2"></div>
    </div>
HTML;

echo returnAdminDashboard("Admin Dashboard", $pointer, $header);
?>

<script>
    // for now works only for a single selected db

    selectedCardDBs = [];
    updateDB(selectedCardDBs);

    function cardSelected(card) {
        card.style.backgroundColor = (card.style.backgroundColor === "rgb(216, 54, 58)") ? "rgb(255, 255, 255)" : "rgb(216, 54, 58)";
        var isSelected = card.classList.contains("selected");
        var db = getDB(card.id);
        if (isSelected) {
            var index = selectedCardDBs.indexOf(db);
            if (index > -1) {
                selectedCardDBs.splice(index, 1);
            }
            card.classList.remove("selected");
        } else {
            selectedCardDBs.push(db);
            card.classList.add("selected");
        }
        updateDB(selectedCardDBs);
    }

    var inputs = []
    var tableName = ''

    function inputData(el, cnt) {
        var size = 0;
        if (selectedCardDBs.length === 0) {
            inputs = []
        } else {
            var info = (el.name).split('|');
            tableName = info[info.length - 2]
            var positioning = info[info.length - 1].split(':');
            size = positioning[1];
            var index = positioning[0];
            if (inputs.length === 0 || inputs.length < size) {
                inputs = Array(size).fill('');
                if (index !== 0) {
                    inputs[0] = cnt;
                }
            }
            inputs[index] = el.value.trim();
        }
    }
    function enableInput(input) {

    }

    function updateDB(selectedCardDBs) {
        const ajax_Request = new XMLHttpRequest();
        ajax_Request.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("showDB").innerHTML = ajax_Request.responseText;
            }
        };

        ajax_Request.open("GET", "display_db.php?q=" + JSON.stringify(selectedCardDBs), true);

        ajax_Request.send();
    }

    function getDB(id) {
        return id;
    }

    function addRow() {
        console.log(inputs);
        changeData(
            {'action': 'add',
            'tableName': tableName,
            'inputs': inputs}
        );
        JSON.stringify({action: `add`, tableName: tableName, inputs: inputs})
        blankLines();
        updateDB([tableName]);
    }

    // function removeRow(id) {
    //     console.log(id);
    //     changeData(JSON.stringify({action: 'remove', tableName: tableName, id: id}));
    //     updateDB([tableName]);
    // }

    // function editInRow(id, button) {
    //     if (button.textContent === 'Edit') {
    //         button.textContent = 'Save';
    //     } else if (button.textContent === 'Save') {
    //         button.textContent = 'Edit';
    //     }
    //     button.textContent = 'Save';
    //     const row = getRowByIDValue(id);
    //     const cells = row.getElementsByTagName("td");
    //     const action = `edit`;
    //     if (row.classList.contains("selected-row")) {
    //         row.classList.remove("selected-row");
    //         for (let i = 1; i < cells.length; i++) {
    //             cells[i].contentEditable = "false";
    //
    //     } else {
    //         const selectedRow = document.querySelector(".selected-row");
    //         if (selectedRow) {
    //             selectedRow.classList.remove("selected-row");
    //             const selectedCells = selectedRow.getElementsByTagName("td");
    //             for (let i = 0; i < selectedCells.length; i++) {
    //                 selectedCells[i].contentEditable = "false";
    //             }
    //         }
    //
    //         row.classList.add("selected-row");
    //         for (let i = 0; i < cells.length; i++) {
    //             cells[i].contentEditable = "true";
    //         }
    //     }
    // }


    function changeData(data) {
        console.log(data);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "change_data.php", true);
        // xhr.open("POST", "../process/new_record.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log(xhr.response);
                    // console.log(`Operation was successful`);
                } else {
                    console.log(xhr.response);
                    // console.log(`Operation WASN\'T successful`);
                }
            } else {
                console.log(xhr.response)
            }
            // else {
            //     console.log(`Error: xhr NOT ready`);
            // }
        }
        xhr.send(data);

        // $.post("../process/new_record.php", {data: data}, function (response) {
        //     r = JSON.parse(response);
        //     console.log(r);
        // })



    }

    function getRowByIDValue(id) {
        const table = document.getElementById("db_table");
        const rows = table.getElementsByTagName("tr");

        if (typeof id !== "number") {
            id = parseInt(id, 10); // Convert to an integer if it's a string
            if (isNaN(id)) {
                console.error("Invalid id provided.");
                return null;
            }
        }
        for (let i = 0; i < rows.length; i++) {
            const firstCell = rows[i].getElementsByTagName("td")[0];
            if (firstCell.textContent.trim() === id) {
                return rows[i];
            }
        }
        return null;
    }


    function blankLines() {
        const table = document.getElementById("db_table");

        const inputElements = table.querySelectorAll("td input");

        for (let i = 1; i < inputElements.length; i++) {
            inputElements[i].value = "";
        }
    }




</script>
