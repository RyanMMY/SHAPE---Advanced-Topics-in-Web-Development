<?php
$conn = mysqli_connect("localhost", "root", "", "atwd");

$row = 0;

$xml = simplexml_load_file("RSTOP_BUS.xml") or die("Error: Cannot create object");

foreach ($xml->children() as $row) {
    $ROUTE_ID = $row -> ROUTE_ID;
    $ROUTE_SEQ = $row -> ROUTE_SEQ;
    $STOP_SEQ = $row -> STOP_SEQ;
    $STOP_ID = $row -> STOP_ID;
    $STOP_NAMEC = $row -> STOP_NAMEC;
    $STOP_NAMES = $row -> STOP_NAMES;
    $STOP_NAMEE = $row -> STOP_NAMEE;
    $LAST_UPDATE_DATE = $row -> LAST_UPDATE_DATE;

    
    $sql = "INSERT INTO rstop(ROUTE_ID, ROUTE_SEQ, STOP_SEQ, STOP_ID, STOP_NAMEC, STOP_NAMES, STOP_NAMEE, LAST_UPDATE_DATE) VALUES ('" . $ROUTE_ID . "','" . $ROUTE_SEQ . "','" . $STOP_SEQ . "','" . $STOP_ID . "','" . $STOP_NAMEC . "','" . $STOP_NAMES . "','" . $STOP_NAMEE . "','" . $LAST_UPDATE_DATE . "')";
    
    set_time_limit(9999);
    
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