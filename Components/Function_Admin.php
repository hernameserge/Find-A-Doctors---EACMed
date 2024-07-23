<?php
include '../Config/Configure.php';
date_default_timezone_set("Asia/Manila");
$Date = date("Y-m-d");
$Time = date("h:i:sa");
$Day = date('l');


// PAGINATION
if(isset($_POST["page"])){
  $page = $_POST['page'];
  $limit = 5; // Number of records per page
  $start = ($page - 1) * $limit;
  $query = "SELECT * FROM hmo LIMIT $start, $limit";
  $result = mysqli_query($connMysqli, $query);
  $output = '';
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $output .= '<div>' . $row['hmo_name'] . '</div>';
    }
    // Pagination links
    $query_total = "SELECT * FROM hmo";
    $result_total = mysqli_query($connMysqli, $query_total);
    $total_records = mysqli_num_rows($result_total);
    $total_pages = ceil($total_records / $limit);

    $output .= '<ul class="pagination">';
    for($i = 1; $i <= $total_pages; $i++){
      $active = ($i == $page) ? 'active' : '';
      $output .= '<li class="page-item '.$active.'"> <a class="page-link" href="#sdf'.$i.'" data-page="'.$i.'"><button>'.$i.'</button></a></li>';
    }
    $output .= '</ul>';
  } else {
    $output .= '<p>No data found</p>';
  }
  echo $output;
}




if(isset($_POST["InsertDoctor"])){
  global $connMysqli;
  $LastName = $_POST["LastName"]; 
  $MiddleName = $_POST["MiddleName"]; 
  $FirstName = $_POST["FirstName"]; 
  // $FullName = $LastName . " " . $FirstName;

  $Gender = $_POST["Gender"]; 
  $Specialization = $_POST["Specialization"]; 
  $SubSpecialization = $_POST["SubSpecialization"]; 
  $Category = $_POST["Category"]; 
  $PrimarySecretary = $_POST["PrimarySecretary"]; 
  $PrimaryFirstNumber = $_POST["PrimaryFirstNumber"]; 
  $PrimaryFirstNetwork = $_POST["PrimaryFirstNetwork"]; 
  $PrimarySecondNumber = $_POST["PrimarySecondNumber"]; 
  $PrimarySecondNetwork = $_POST["PrimarySecondNetwork"]; 
  $SecondarySecretary = $_POST["SecondarySecretary"]; 
  $SecondarySecondNumber = $_POST["SecondarySecondNumber"]; 
  $SecondarySecondNetwork = $_POST["SecondarySecondNetwork"]; 
  $Schedule = $_POST["Schedule"]; 
  $Room = $_POST["Room"]; 
  $TeleConsultation = $_POST["TeleConsultation"];
  $HMOAccreditation = $_POST["HMOAccreditation"]; 

  if($Gender == "Male"){
    $Profile_Img = "Doctor1.png";
  }
  else{
    $Profile_Img = "Doctor2.png";
  }


  $InsertDoctor = $connPDO->prepare("INSERT INTO `doctor`(doctor_firstname, doctor_middlename, doctor_lastname, profile_image, doctor_sex) VALUES(?,?,?,?,?)");
  $InsertDoctor->execute([$FirstName, $MiddleName, $LastName, $Profile_Img, $Gender]);
}






















?>

<!-- $output .= '<li class="page-item '.$active.'"> <a class="page-link" href="'.$i.'" data-page="'.$i.'"><button>'.$i.'</button></a></li>'; -->