<?PHP
require_once 'RESTInterface.php';

class Service implements RESTInterface {


public function restGet($urlSegment){
    $urlSegment = explode('=',$urlSegment);
    $type = array_shift($urlSegment);
    $type= str_replace("/", "", $type);
    $keyword = array_shift($urlSegment);
	
if(empty ($keyword)){
	$status = (object) array();
	$status->statuscode='120';
	$status->statusmessage='Keyword missing';
	echo json_encode($status);
}
else{
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $db = "ATWD";
    $conn = mysqli_connect($hostname, $username, $password, $db ) or die(mysqli_connect_error()); 

	$sql = "SELECT * From route Where $type = '$keyword'";
    $result = $conn->query($sql) or die($conn->error);
    $dbdata = (object) array();

    while ( $row = $result->fetch_assoc())  {
        $dbdata->ROUTE_NAMEE=$row['ROUTE_NAMEE'];
        $dbdata->LOC_START_NAMEE=$row['LOC_START_NAMEE'];
        $dbdata->LOC_END_NAMEE=$row['LOC_END_NAMEE'];
        $dbdata->FULL_FARE=$row['FULL_FARE'];

        echo json_encode($dbdata);
    }

    $conn->close();

}
}


public function restPut($urlSegment){
    $urlSegment = explode('/',$urlSegment);
    $empty = array_shift($urlSegment);
    $ROUTE_NAMEE = array_shift($urlSegment);
    $LOC_START_NAMEE = array_shift($urlSegment);
    $LOC_END_NAMEE = array_shift($urlSegment);
    $FULL_FARE = array_shift($urlSegment);
    $keyword = array_shift($urlSegment);

if(empty($ROUTE_NAMEE)){
	$status = (object) array();
	$status->statuscode='122';
	$status->statusmessage='Route Name missing';
	echo json_encode($status);	
} 
else if(empty($LOC_START_NAMEE)){
	$status = (object) array();
	$status->statuscode='123';
	$status->statusmessage='Starting Point Location Name missing';
	echo json_encode($status);	
}
else if(empty($LOC_END_NAMEE)){
	$status = (object) array();
	$status->statuscode='124';
	$status->statusmessage='End Point Location Name missing';
	echo json_encode($status);	
} 
else if(empty($FULL_FARE)){
	$status = (object) array();
	$status->statuscode='125';
	$status->statusmessage='Full Fare missing';
	echo json_encode($status);	
} 
else{
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $db = "ATWD";
    $conn = mysqli_connect($hostname, $username, $password, $db )  or die(mysqli_connect_error()); 

	$sql = "UPDATE route
    SET LOC_START_NAMEE='$LOC_START_NAMEE', LOC_END_NAMEE='$LOC_END_NAMEE', FULL_FARE='$FULL_FARE', LAST_UPDATE_DATE=CURRENT_TIMESTAMP()
    Where ROUTE_NAMEE='$ROUTE_NAMEE'";
    $sql3 = "SELECT * FROM route WHERE ROUTE_NAMEE NOT LIKE '$ROUTE_NAMEE'";

if ($conn->query($sql) === TRUE) {
    $status = (object) array();
	$status->statuscode='130';
	$status->statusmessage='Update successfully';
	echo json_encode($status);
} else {
    $status = (object) array();
	$status->statuscode='110';
	$status->statusmessage='No record';
	echo json_encode($status);
}

$conn->close();

    }
}


public function restDelete($urlSegment){
    $urlSegment = explode('/',$urlSegment);
    $empty = array_shift($urlSegment);
    $type = array_shift($urlSegment);
    $keyword = array_shift($urlSegment);

if(empty ($keyword)){
	$status = (object) array();
	$status->statuscode='120';
	$status->statusmessage='Keyword missing';
	echo json_encode($status);		
}else{
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $db = "ATWD";
    $conn = mysqli_connect($hostname, $username, $password, $db )
                or die(mysqli_connect_error()); 

	$sql = "DELETE FROM route Where $type = '$keyword'";

if ($conn->query($sql) === TRUE) {
    $status = (object) array();
	$status->statuscode='140';
	$status->statusmessage='Delete successfully';
	echo json_encode($status);
} else {
    $status = (object) array();
	$status->statuscode='110';
	$status->statusmessage='No record';
	echo json_encode($status);
}

$conn->close();
    }
}
    

public function restPost($urlSegment){
    $urlSegment = explode('/',$urlSegment);
    $empty = array_shift($urlSegment);
    $COMPANY_CODE = array_shift($urlSegment);
    $ROUTE_NAMEE = array_shift($urlSegment);
    $LOC_START_NAMEE = array_shift($urlSegment);
    $LOC_END_NAMEE = array_shift($urlSegment);
    $FULL_FARE = array_shift($urlSegment);

if(empty($COMPANY_CODE)){
	$status = (object) array();
	$status->statuscode='121';
	$status->statusmessage='Company Code missing';
	echo json_encode($status);	
}
else if(empty($ROUTE_NAMEE)){
	$status = (object) array();
	$status->statuscode='122';
	$status->statusmessage='Route Name missing';
	echo json_encode($status);	
} 
else if(empty($LOC_START_NAMEE)){
	$status = (object) array();
	$status->statuscode='123';
	$status->statusmessage='Starting Point Location Name missing';
	echo json_encode($status);	
}
else if(empty($LOC_END_NAMEE)){
	$status = (object) array();
	$status->statuscode='124';
	$status->statusmessage='End Point Location Name missing';
	echo json_encode($status);	
} 
else if(empty($FULL_FARE)){
	$status = (object) array();
	$status->statuscode='125';
	$status->statusmessage='Full Fare missing';
	echo json_encode($status);	
} 
else{
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $db = "ATWD";
    $conn = mysqli_connect($hostname, $username, $password, $db) or die(mysqli_connect_error()); 

    $sql2 = "SELECT COUNT(*) FROM route";
    $count = mysqli_fetch_array($conn->query($sql2));
    $ROUTE_ID = $count[0]+1;
    $sql = "INSERT INTO route ( ROUTE_ID,COMPANY_CODE,DISTRICT,ROUTE_NAMEE,ROUTE_TYPE,SERVICE_MODE,SPECIAL_TYPE,JOURNEY_TIME,FULL_FARE,LOC_START_NAMEE,LOC_END_NAMEE,LAST_UPDATE_DATE)
    VALUES ('$ROUTE_ID','$COMPANY_CODE','','$ROUTE_NAMEE','','','','','$FULL_FARE','$LOC_START_NAMEE','$LOC_END_NAMEE','');";
        
if ($conn->query($sql) === TRUE) {
    $status = (object) array();
	$status->statuscode='150';
	$status->statusmessage='Add successfully';
	echo json_encode($status);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

    }
} 

}
?>
