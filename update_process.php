<?php
include("connection.php");
$id = $_POST['id'];
$sub_name = $_POST['sub_name'];
$sub_code = $_POST['sub_code'];
$sub_shortform = $_POST['sub_shortform'];
$sem = $_POST['sem'];
$crd = $_POST['crd'];

$sql = "UPDATE subject_details SET sub_name = '$sub_name', sub_code = '$sub_code', sub_shortform = '$sub_shortform', sem = '$sem', crd = '$crd' WHERE id='$id'";
        
$result = mysqli_query($conn, $sql);


if ($result) {
    if (mysqli_affected_rows($conn) > 0) {
        echo " Record Updated Successfully";
        header("Location: display.php");
    } else {
        echo "Record already up-to-date (no changes made)";
    }
} else {
    echo "SQL Error: " . mysqli_error($conn);
}

?>