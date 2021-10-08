<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<?php 
if (isset($_POST['submit'])) { 
	include('connection.php');
	// 3. Create variables to capture information from the form
	$ffirst_name = $_POST['ffirst_name'];
	$flast_name  = $_POST['flast_name'];
	$mfirst_name = $_POST['mfirst_name'];
	$mlast_name  = $_POST['mlast_name'];
	$gender     = $_POST['gender'];
	$date_of_birth = $_POST['date_of_birth'];
	$applicant_district = $_POST['applicant_district'];
	$applicant_sector = $_POST['applicant_sector'];
	$guardian_first_name = $_POST['guardian_first_name'];
	$guardian_last_name = $_POST['guardian_last_name'];
	$guardian_phone= $_POST['guardian_phone'];
	$guardian_district = $_POST['guardian_district'];
	$guardian_sector = $_POST['guardian_sector'];
    $learning_option_id = $_POST['learning_option_id'];
    $title_of_certificate = $_POST['title_of_certificate'];
    $national_id = $_POST['national_id'];
    $user_id= $_SESSION["user_id"] ;
   

	// 4. create variable for insert query
	$query = "INSERT INTO applicants(user_id, ffirst_name,	flast_name, mfirst_name,	mlast_name,	gender,
	 date_of_birth, applicant_district, applicant_sector, guardian_first_name, guardian_last_name, guardian_phone,  guardian_district, guardian_sector, learning_option_id, title_of_certificate,id_number) VALUES ('$user_id','$ffirst_name', '$flast_name', '$mfirst_name','$mlast_name','$gender', '$date_of_birth', '$applicant_district', '$applicant_sector', '$guardian_first_name', '$guardian_last_name', '$guardian_phone', '$guardian_district', '$guardian_sector', '$learning_option_id', '$title_of_certificate', '$national_id')";
 
// File upload path
$targetDir = "uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $insert = $db->query("INSERT into images (file_name, uploaded_on) VALUES ('".$fileName."', NOW())");
            if($insert){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }else{
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
echo $statusMsg;
		}
		else {
		echo "Error: " . $sql . "" . mysqli_error($connection);
	 }

?>





