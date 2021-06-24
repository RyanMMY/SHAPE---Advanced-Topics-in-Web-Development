<?php
$conn = mysqli_connect("localhost", "root", "", "atwd");

$row = 0;

$xml = simplexml_load_file("STOP_BUS.xml") or die("Error: Cannot create object");

foreach ($xml->children() as $row) {
    $STOP_ID = $row -> STOP_ID;
    $STOP_TYPE = $row -> STOP_TYPE;
    $X = $row -> Y;
    $Y = $row -> X;
    $LAST_UPDATE_DATE = $row -> LAST_UPDATE_DATE;
    
    $sql = "INSERT INTO stop(STOP_ID, STOP_TYPE, X, Y , LAST_UPDATE_DATE) VALUES ('" . $STOP_ID . "','" . $STOP_TYPE . "','" . $X . "','" . $Y . "','" . $LAST_UPDATE_DATE . "')";
    
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