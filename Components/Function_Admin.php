<?php
include '../Config/Configure.php';
date_default_timezone_set("Asia/Manila");
$Date = date("Y-m-d");
$Time = date("h:i:sa");
$Day = date('l');


// PAGINATION
if (isset($_POST["page"])) {
  $page = $_POST['page'];
  $limit = 5; // Number of records per page
  $start = ($page - 1) * $limit;
  $query = "SELECT * FROM hmo LIMIT $start, $limit";
  $result = mysqli_query($connMysqli, $query);
  $output = '';
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $output .= '<div>' . $row['hmo_name'] . '</div>';
    }
    // Pagination links
    $query_total = "SELECT * FROM hmo";
    $result_total = mysqli_query($connMysqli, $query_total);
    $total_records = mysqli_num_rows($result_total);
    $total_pages = ceil($total_records / $limit);

    $output .= '<ul class="pagination">';
    for ($i = 1; $i <= $total_pages; $i++) {
      $active = ($i == $page) ? 'active' : '';
      $output .= '<li class="page-item ' . $active . '"> <a class="page-link" href="#sdf' . $i . '" data-page="' . $i . '"><button>' . $i . '</button></a></li>';
    }
    $output .= '</ul>';
  } else {
    $output .= '<p>No data found</p>';
  }
  echo $output;
}

if (isset($_POST["InsertDoctor"])) {
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

  if ($Gender == "Male") {
    $Profile_Img = "Doctor1.png";
  } else {
    $Profile_Img = "Doctor2.png";
  }


  $InsertDoctor = $connPDO->prepare("INSERT INTO `doctor`(doctor_firstname, doctor_middlename, doctor_lastname, profile_image, doctor_sex) VALUES(?,?,?,?,?)");
  $InsertDoctor->execute([$FirstName, $MiddleName, $LastName, $Profile_Img, $Gender]);
}








// Telle Function_Admin Start

if (isset($_POST["AccessAccount"])) {
  global $connMysqli;

  $AccessUsername = $_POST["AccessUsername"];
  $AccessType = $_POST["AccessType"];
  $DefaultAccess = '$2y$10$TX6XGGHg9b5BrZuHA6bJCOa9scgvdYtv1CUc1S1oQIcVPPES5SpyW';
  $StrTimestamp = strtotime("$Date $Time");
  $Current_Timestamp = date("Y-m-d H:i:s", $StrTimestamp);
  $AccountStatus = 'New';
  $DefaultStatus = 'Active';

  $InsertDoctor = $connPDO->prepare("INSERT INTO `admin_accounts`(admin_username, admin_password, admin_account_status, admin_status, account_access, account_created_timestamp) VALUES(?, ?, ?, ?, ?, ?)");
  $InsertDoctor->execute([$AccessUsername, $DefaultAccess, $AccountStatus, $DefaultStatus, $AccessType, $Current_Timestamp]);
}

if (isset($_POST["ViewAdmin_ID"])) {
  global $connMysqli;
  $Admin_ID = $_POST["ViewAdmin_ID"];

  $AdminFetchQuery = "SELECT * from admin_accounts
  WHERE admin_id = '$Admin_ID'";
  $AdminFetchQuery = mysqli_query($connMysqli, $AdminFetchQuery);

  if (!$AdminFetchQuery) {
    die('MySQL ErrorL ' . mysqli_error($conn));
  }
  if ($AdminFetchQuery->num_rows > 0) {
    while ($row1 = mysqli_fetch_assoc($AdminFetchQuery)) {
      echo " 
            <div class='Modal-Sidebar-Top'>
              <i class='fa-solid fa-user-tie'></i>
              <h4>Admin Account</h4>
            </div>
            <div class='Modal-Sidebar-Main'>
              <div class='ModalSidebar-Container AddDoctorDivContainer-Form'>
                <div class='Div-Container1'>
                  <div class='Doctor-Img-Profile'><img src='../Uploaded/Doctor1.png' alt=''></div>
                  <div class=''>
                    <p>" . $row1['admin_username'] . "</p>
                    <div class='Doctor-Active Doctor-Capitalize'><i class='fa-solid fa-circle'></i><span>" . $row1['admin_status'] . "</span></div>
                  </div>
                </div>

                <div class='InputFieldForm'>
                  <i>Access Level:</i>
                  <div class='InputFieldForm-Info'> <span> " . $row1['account_access'] . " </span> </div>
                </div>

                <div class='InputFieldForm'>
                  <i>Created on</i>
                  <div class='InputFieldForm-Info'> <span> " . $row1['account_created_timestamp'] . " </span> </div>
                </div>

                <div class='InputFieldForm'>
                  <i>Last edited on</i>
                  <div class='InputFieldForm-Info'> 
                    <span> " . $row1['account_created_timestamp'] . " </span> 
                    <br>
                    <span> (by a Super Admin) </span>
                  </div>
                </div>

                
                <!-- <div class='InputFieldForm'>
                  <i>Remarks:</i>

                  <div class='InformationField'></div>
                </div> -->
              </div>
            </div>
            <div class='Modal-Sidebar-Bottom'>
              <button class='Btn_1' onclick='EditAdmin(" . $row1['admin_id'] . ")'>Edit</button>
              <button class='Btn_2' onclick='ResetPasswordAdmin(" . $row1['admin_id'] . ")'>Reset Password</button>
            </div> ";
    };
  } else {
    echo "No Data Found";
  }
}

//PROMPT - RESET PASSWORD - ADMIN (FUNCTION)

if (isset($_POST["ResetPasswordAdmin_ID"])) {
  global $connMysqli;
  $Admin_ID = $_POST["ResetPasswordAdmin_ID"];

  $AdminFetchQuery = "SELECT * from admin_accounts
  WHERE admin_id = '$Admin_ID'";
  $AdminFetchQuery = mysqli_query($connMysqli, $AdminFetchQuery);

  if (!$AdminFetchQuery) {
    die('MySQL ErrorL ' . mysqli_error($conn));
  }
  if ($AdminFetchQuery->num_rows > 0) {
    while ($row1 = mysqli_fetch_assoc($AdminFetchQuery)) {
      echo " 
      <div class='Prompt-Message-Top'>
            <lord-icon src='https://cdn.lordicon.com/ygvjgdmk.json' trigger='loop' delay='1500' class='lord-icon'></lord-icon>
            <h4>Are you sure?</h4>
          </div>
          <div class='Prompt-Message-Center'>
            <p class='P-Message'>Are you sure you want to reset the password of this admin account?</p>
          </div>
          <div class='Prompt-Message-Bottom'>
            <button class='Btn_1' onclick='Yes_ResetPasswordAdmin(" . $Admin_ID . ")'>Yes</button>
            <button class='Btn_2' onclick='HidePromptMessage()'>No</button>
      </div>";
    };
  } else {
    echo "No Data Found";
  }
}

//RESET PASSWORD - ADMIN

if (isset($_POST["Yes_ResetPasswordAdmin_ID"])) {
  global $connMysqli;
  $Admin_ID = $_POST["Yes_ResetPasswordAdmin_ID"];
  $AdminDefaultPass = '$2y$10$ZkgThNp4XqRGDaXyuXVtr.5RGI0DsFW3Bop9MW1m.ZE7WVT6AnHvO';

  $ResetPasswordValidation = "SELECT * from admin_accounts 
  WHERE admin_id = '$Admin_ID'";
  $ResetPasswordValidation = mysqli_query($connMysqli, $ResetPasswordValidation);

  if (!$ResetPasswordValidation) {
    die('MySQL ErrorL ' . mysqli_error($conn));
  }
  if ($ResetPasswordValidation->num_rows > 0) {
    while ($row1 = mysqli_fetch_assoc($ResetPasswordValidation)) {
      $Admin_Password = $row1['admin_password'];

      if ($Admin_Password === $AdminDefaultPass) {
        echo "Cannot be changed";
      } else {
        // UPDATE RESET PASSWORD
        $ResetPasswordQuery = "UPDATE admin_accounts SET
        admin_password = '$AdminDefaultPass'
        WHERE admin_id = '$Admin_ID'";
        mysqli_query($connMysqli, $ResetPasswordQuery);
      }
    };
  } else {
    echo "No Data Found";
  }
}



// Telle Function_Admin Ends





















?>

<!-- $output .= '<li class="page-item '.$active.'"> <a class="page-link" href="'.$i.'" data-page="'.$i.'"><button>'.$i.'</button></a></li>'; -->