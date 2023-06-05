<?php

require_once "../components/dashboard_template.php";

$_SESSION['searchFor'] = '';
$pointer = getPointers()['team'];

echo returnDashboard("Team Dashboard", $pointer, null)


?>