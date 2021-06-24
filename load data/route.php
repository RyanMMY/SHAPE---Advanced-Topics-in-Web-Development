<?php
$conn = mysqli_connect("localhost", "root", "", "atwd");

$row = 0;

$xml = simplexml_load_file("ROUTE_BUS.xml") or die("Error: Cannot create object");

foreach ($xml->children() as $row) {
    $ROUTE_ID = $row -> ROUTE_ID;
    $COMPANY_CODE = $row -> COMPANY_CODE;
    $DISTRICT = $row -> DISTRICT;
    $ROUTE_NAMEC = $row -> ROUTE_NAMEC;
    $ROUTE_NAMES = $row -> ROUTE_NAMES;
    $ROUTE_NAMEE = $row -> ROUTE_NAMEE;
    $ROUTE_TYPE = $row -> ROUTE_TYPE;
    $SERVICE_MODE = $row -> SERVICE_MODE;
    $SPECIAL_TYPE = $row -> SPECIAL_TYPE;
    $JOURNEY_TIME = $row -> JOURNEY_TIME;
    $LOC_START_NAMEC = $row -> LOC_START_NAMEC;
    $LOC_START_NAMES = $row -> LOC_START_NAMES;
    $LOC_START_NAMEE = $row -> LOC_START_NAMEE;
    $LOC_END_NAMEC = $row -> LOC_END_NAMEC;
    $LOC_END_NAMES = $row -> LOC_END_NAMES;
    $LOC_END_NAMEE = $row -> LOC_END_NAMEE;
    $HYPERLINK_C = $row -> HYPERLINK_C;
    $HYPERLINK_S = $row -> HYPERLINK_S;
    $HYPERLINK_E = $row -> HYPERLINK_E;
    $FULL_FARE = $row -> FULL_FARE;
    $LAST_UPDATE_DATE = $row -> LAST_UPDATE_DATE;
    
    
    $sql = "INSERT INTO route(ROUTE_ID, COMPANY_CODE, DISTRICT, ROUTE_NAMEC, ROUTE_NAMES, ROUTE_NAMEE, ROUTE_TYPE, SERVICE_MODE, SPECIAL_TYPE, JOURNEY_TIME, FULL_FARE, LOC_START_NAMEC, LOC_START_NAMES, LOC_START_NAMEE, LOC_END_NAMEC, LOC_END_NAMES, LOC_END_NAMEE, HYPERLINK_C, HYPERLINK_S, HYPERLINK_E, LAST_UPDATE_DATE) VALUES ('" . $ROUTE_ID . "', '" . $COMPANY_CODE . "', '" . $DISTRICT . "', '" . $ROUTE_NAMEC . "', '" . $ROUTE_NAMES . "', '" . $ROUTE_NAMEE . "', '" . $ROUTE_TYPE . "', '" . $SERVICE_MODE . "', '" . $SPECIAL_TYPE . "', '" . $JOURNEY_TIME . "', '" . $FULL_FARE . "', '" . $LOC_START_NAMEC . "', '" . $LOC_START_NAMES . "', '" . $LOC_START_NAMEE . "', '" . $LOC_END_NAMEC . "', '" . $LOC_END_NAMES . "', '" . $LOC_END_NAMEE . "', '" . $HYPERLINK_C . "', '" . $HYPERLINK_S . "', '" . $HYPERLINK_E . "', '" . $LAST_UPDATE_DATE . "')";

    set_time_limit(999);
    
    $result = mysqli_query($conn, $sql);
    
    if (! empty($result)) {
        $row ++;
    } else {
        $error_message = mysqli_error($conn) . "\n";
    }
}
?>
<h2>Insert XML Data to MySql Table Output</h2>
<?php
if ($row > 0) {
    $message = $row . " records inserted";
} else {
    $message = "No records inserted";
}

?>

<div><?php  echo $message; ?></div>
<?php if (! empty($error_message)) { ?>
<div><?php echo nl2br($error_message); ?></div>
<?php } ?>