<h1>Query 2</h1>
  <br> Via Rail is trying to find the employee ID's of their employees who have been working for 10 or more years. Here are their results!<br><br>

<?php


error_reporting(E_ALL);
ini_set('display_errors', 'on');

include ('./my_connect.php');
$mysqli = get_mysqli_conn();

$sql = " select E.`e_id`, E.`yrs_exp`" 
. " FROM employee E, `operating_comp` C" 
. " WHERE C.`c_name` = ?" 
. " AND E.`c_id` = C.`c_id`" 
. " GROUP BY E.`yrs_exp`" 
. " HAVING(E.`yrs_exp`>=10)";

$stmt = $mysqli->prepare($sql);

$cname = $_GET['c_name'];

$stmt->bind_param('s',$cname); 

$stmt->execute();
 
$stmt->bind_result($eid, $yrsexp);

if ($stmt->fetch()){
    echo "Employee ID: " . $eid . " Years of Experience: ". $yrsexp .  "<br>";
  }else{
  echo "O Results";
}

//close statement and connection 
$stmt->close(); 
$mysqli->close();
?>






