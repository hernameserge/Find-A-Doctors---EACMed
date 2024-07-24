<?php
  session_start();
  include "../Config/Configure.php";
  if(isset($_SESSION['Admin_Id'])){
    $Admin_id = $_SESSION['Admin_Id'];
    $ACCOUNT = "SELECT * FROM admin WHERE `admin_id`= '$Admin_id' ";
    $ACCOUNT = mysqli_query($connMysqli, $ACCOUNT);
    while($row = mysqli_fetch_assoc($ACCOUNT)){ 
      $AdminName = $row['admin_username'];
     }
    // ACCOUNT ACCESS
    $ACCESS = "SELECT * FROM admin WHERE `admin_id`= '$Admin_id' AND (account_access = 'Super Admin')";
    $ACCESS = mysqli_query($connMysqli, $ACCESS);
    if ($ACCESS === false) {echo 'MySQL Error:'.mysqli_error($conn);}
  }else{
    header('location: ../Admin Panel Login');
  };
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="https://cdn.lordicon.com/lordicon.js"></script>
  <script src="https://cdn.lordicon.com/libs/mojs/2.7.0/mojs.min.js"></script>
  <script defer  type="text/javascript" src="../Assets/JS_Admin.js?ver=<?php echo time();?>"></script>
  <link href = "../Assets/Images/EACMC_LOGO 1.png" rel="icon" type="image/png">
  <link rel="stylesheet" href="../Assets/CSS_Public.css?ver=<?php echo time();?>">
  <link rel="stylesheet" href="../Assets/CSS_Admin.css?ver=<?php echo time();?>">
  <title>EACMed - Admin</title>
</head>

<body>
  <div class="AdminDiv">
    <!-- SIDEBAR -->
      <section class="AdminSidebar">
        <div class="AdminSidebarDiv1">
          <input type="hidden" id="chartInput" value="10">
          <div class="AdminSidebarDiv1IMG"><img src="../Assets/Images/EACMed Logo.png" alt=""></div>
        </div>
        <div class="AdminSidebarDiv2">
          <ul>
            <li class="Sidebar_Focus SBFocus1 Sidebar_Active" onclick="BTNDashboard()"><i class="fa-solid fa-chart-line"></i>  Dashboard</li>
            <li class="Sidebar_Focus SBFocus2 " onclick="BTNDoctors()"> <i class="fa-solid fa-user-doctor"></i> Doctors</li>

            <?php if (mysqli_num_rows($ACCESS) > 0) { ?>
              <li class="Sidebar_Focus SBFocus3 " onclick="BTNAccounts()"> <i class="fa-solid fa-user"></i> Accounts</li> 
              <li class="Sidebar_Focus SBFocus4 " onclick="BTNActivity()"> <i class="fa-regular fa-rectangle-list"></i> Activity Logs</li> 
              <li class="Sidebar_Focus SBFocus5 " onclick="BTNArchive()"> <i class="fa-solid fa-file-zipper"></i> Archived Doctors</li>
            <?php } ?>

          </ul>
        </div>
        <div class="AdminSidebarDiv3">
          <div class="AdminSidebarDiv3_Flex">
            <div class="AdminDashboard-Profile-Box">
              <div class="AdminDashboard-Profile-Box-Circle">
                <img src="../Uploaded/Doctor1.png" alt="">
              </div>
              <h4 class="Text-Trans-Upper"><?php echo $AdminName;?></h4>
            </div>
            <button class="Btn_1" onclick="LinkToLogout()"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
          </div>
        </div>
      </section>
    <!-- END -->


    <!-- ADMIN MAIN -->
      <section class="AdminMain">
        <!-- Dashboard -->
          <div class="AdminDashboard AdminMainDiv">
            <div class="AdminDashboard-Header">
              <div class="Flex">
                <h4>DASHBOARD</h4>
                <div class="">

                </div>
              </div>
              <div class="Pop-Container">
                <?php
                  if(isset($_SESSION['message'])){
                    echo "
                      <div class='PopUp-Div'>
                        <lord-icon class='Lord-Icon'
                          src='https://cdn.lordicon.com/jnzhohhs.json'
                          trigger='loop'
                          colors='primary:#ffffff'
                          delay='2000'>
                        </lord-icon>
                        <h4 class='Text-Trans-Upper'>{$_SESSION['message']}</h4>
                      </div>
                    ";
                    unset($_SESSION['message']);
                  }          
                ?>
              </div>
            </div>

            <div class="AdminDashboard-Container">
              <div class="AdminDashboard-Panel">
                <div class="AdminDashboard-Panel-Div AdminDashboard-Box1">

                <!-- COUNT -->
                  <div class="Dashboard-Box-Ch Dashboard-Box1-Ch">
                    <div class="Dashboard-Box-Total">
                      <p>Total Doctors</p>
                      <h2><i class="fa-solid fa-user-doctor"></i> 1,000</h2>
                    </div>
                    <div class="Dashboard-Box-Total">
                      <p>Total Active Doctors</p>
                      <h2><i class="fa-solid fa-user-large"></i> 700</h2>
                    </div>
                    <div class="Dashboard-Box-Total">
                      <p>Total Inactive Doctors</p>
                      <h2><i class="fa-solid fa-user-large-slash"></i> 300</h2>
                    </div>
                    <div class="Dashboard-Box-Total">
                      <p>Total Admins</p>
                      <h2><i class="fa-solid fa-user-tie"></i> 10</h2>
                    </div>
                    <div class="Dashboard-Box-Total">
                      <p>Total Visiting Consultation</p>
                      <h2><i class="fa-solid fa-user-nurse"></i> 50</h2>
                    </div>
                    <div class="Dashboard-Box-Total">
                      <p>Total Regular Consultation</p>
                      <h2><i class="fa-solid fa-hospital-user"></i> 100</h2>
                    </div>
                    <div class="Dashboard-Box-Total">
                      <p>Total HMOs</p>
                      <h2><i class="fa-solid fa-briefcase"></i> 420</h2>
                    </div>
                  </div>

                  <!-- CHART -->
                  <div class="Dashboard-Box-Ch Dashboard-Box2-Ch">
                    <div class="Dashboard-Box2-Header">
                      <h4>Chart</h4>
                    </div>
                    <div class="Dashboard-Box2-Chart">
                        <div class="">
                          <h4>TOP 5 Specification</h4>
                          <div id="DIV">
                            <div id="chart"></div>
                          </div>
                        </div>
                        <div class="">
                        <h4>TOP 5 HMO</h4>
                          <!-- <button onclick="updateChartData()">Update Data</button> -->
                          <div id="chart2"></div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="AdminDashboard-Panel-Div AdminDashboard-Box2">
                  <div class="Dashboard-Table Dashboard-Table1">
                    <div class="Dashboard-Table-Header">
                      <h4>HMOs</h4>
                      <p>See More <i class="fa-solid fa-angle-right"></i></p>
                    </div>
                    <table>
                      <tr>
                        <td>Healthway Medi-Access</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Healthway Medi-Access</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Healthway Medi-Access</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Healthway Medi-Access</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Healthway Medi-Access</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Healthway Medi-Access</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Healthway Medi-Access</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Healthway Medi-Access</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Healthway Medi-Access</td>
                        <td>232</td>
                      </tr>
                    </table>
                  </div>
                  <div class="Dashboard-Table Dashboard-Table2">
                    <div class="Dashboard-Table-Header">
                      <h4>Specialization</h4>
                      <p>See More <i class="fa-solid fa-angle-right"></i></p>
                    </div>
                    <table>
                      <tr>
                        <td>Obstetrics & Gynecology</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Obstetrics & Gynecology</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Obstetrics & Gynecology</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Obstetrics & Gynecology</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Obstetrics & Gynecology</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Obstetrics & Gynecology</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Obstetrics & Gynecology</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Obstetrics & Gynecology</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Obstetrics & Gynecology</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Obstetrics & Gynecology</td>
                        <td>232</td>
                      </tr>
                    </table>
                  </div>
                  <div class="Dashboard-Table Dashboard-Table2">
                    <div class="Dashboard-Table-Header">
                      <h4>Sub Specialization</h4>
                      <p>See More <i class="fa-solid fa-angle-right"></i></p>
                    </div>
                    <table>
                      <tr>
                        <td>Obstetrics & Gynecology</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Obstetrics & Gynecology</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Obstetrics & Gynecology</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Obstetrics & Gynecology</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Obstetrics & Gynecology</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Obstetrics & Gynecology</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Obstetrics & Gynecology</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Obstetrics & Gynecology</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Obstetrics & Gynecology</td>
                        <td>232</td>
                      </tr>
                      <tr>
                        <td>Obstetrics & Gynecology</td>
                        <td>232</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- END -->

        <!-- Doctors -->
          <div class="DoctorsDiv AdminMainDiv">
            <div class="MainDiv-Header">
              <div class="">
                <h4>Doctor</h4>
              </div>

              <div class="MainDiv-Header-Right">
                <button class="Btn_1" onclick="AddDoctor()"><i class="fa-solid fa-plus"></i> Add Doctor</button>
                <div class="InputText3">
                  <input type="text" placeholder="Search">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </div>
              </div>
            </div>
            <div class="MainDiv-Main DoctorsDiv-Main">
              <div class="Table-Div">
                <table>
                  <thead>
                    <tr class="Tr-Header">
                      <th>Name</th>
                      <th class="TCenter">Number of HMO/s</th>
                      <th class="TCenter">Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="tbody-doctor">
                    <?php
                    $FetchDoctor = "SELECT DISTINCT * FROM doctor 
                    WHERE doctor_status = 'ACTIVE'
                    ";

                    $FetchDoctor = mysqli_query($connMysqli,$FetchDoctor);
                    while($row = mysqli_fetch_assoc($FetchDoctor)){
                      $Specs_ID = $row['doctor_id'];
                      $FetchSpecs = "SELECT * FROM doctor_specialization  
                      WHERE specialization_doctor_id = 2;
                    ";
                      echo "
                      <tr class='tr-doctor'>
                        <td class='capitalize'>".$row['doctor_lastname']." ".$row['doctor_firstname']." ".substr($row['doctor_middlename'], 0, 1).".</td>
                        <td class='TCenter'>78 </td>
                        <td class='TCenter'>Active </td>
                        <td><div class='td-div'><button class='Btn_1' onclick='ViewDoctor()'><i class='fa-regular fa-eye'></i>View</button></div></td>
                      </tr>
                    ";};?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        <!-- END -->

        <!-- Accounts -->
          <div class="AccountsDiv AdminMainDiv">
            <div class="MainDiv-Header">
              <div class="">
                <h4>Admin Accounts</h4>
              </div>

              <div class="MainDiv-Header-Right">
                <button class="Btn_1" onclick="AddAdmin()"><i class="fa-solid fa-plus"></i> Add Admin</button>
                <div class="InputText3">
                  <input type="text" placeholder="Search">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </div>
              </div>
            </div>
            <div class="MainDiv-Main DoctorsDiv-Main">
              <div class="Table-Div">
                <table>
                  <thead>
                    <tr class="Tr-Header">
                      <th>Username</th>
                      <th>Access Level</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $FetchAdmin = "SELECT * FROM admin";
                    $FetchAdmin = mysqli_query($connMysqli,$FetchAdmin);
                    while($row = mysqli_fetch_assoc($FetchAdmin)){echo "
                      <tr class='tr-center'>
                        <td>".$row['admin_username']."</td>
                        <td class='td-center'>Super Admin</td>
                        <td class='td-center'>Active</td>
                        <td><div class='td-div'><button class='Btn_1' onclick='ViewAdmin()'><i class='fa-regular fa-eye'></i> View</button></div></td>
                      </tr>
                    ";};?>   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        <!-- END -->

        <!-- Activity Logs -->
          <div class="ActivityLogs AdminMainDiv">
            <div class="MainDiv-Header">
              <div class="">
              <h4>Activity Logs</h4>
              </div>

              <div class="MainDiv-Header-Right">
                <!-- <button class="Btn_1" onclick="AddAdmin()"><i class="fa-solid fa-plus"></i> Add Admin</button> -->
                <div class="InputText3">
                  <input type="text" placeholder="Search">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </div>
              </div>
            </div>
            <div class="MainDiv-Main DoctorsDiv-Main">
              <div class="Table-Div">
                <table>
                  <thead>
                    <tr class="Tr-Header">
                      <th>Date/Time</th>
                      <th>Event By</th>
                      <th>Event Type</th>
                      <th>Before Event</th>
                      <th>After Event</th>
                      <th>Event Location</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $FetchAdmin = "SELECT * FROM admin";
                    $FetchAdmin = mysqli_query($connMysqli,$FetchAdmin);
                    while($row = mysqli_fetch_assoc($FetchAdmin)){echo "
                      <tr>
                        <td>April 24, 2024 18:00</td>
                        <td>Oliver</td>
                        <td>Edit Doctor: Dr. Rosario U. Santiago</td>
                        <td>Secretary: Sophia Marie L. Cruz</td>
                        <td>Secretary: Adrian S. Magdangal</td>
                        <td>Doctors</td>
                        <td><button class='Btn_1' onclick='ViewAdmin()'><i class='fa-regular fa-eye'></i> View</button></td>
                      </tr>
                    ";};?>   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        <!-- END -->

        <!-- Archived Doctors -->
          <div class="ArchivesDiv AdminMainDiv">
            <div class="MainDiv-Header">
              <div class="">
              <h4>Archived Doctors</h4>
              </div>

              <div class="MainDiv-Header-Right">
                <!-- <button class="Btn_1" onclick="AddAdmin()"><i class="fa-solid fa-plus"></i> Add Admin</button> -->
                <div class="InputText3">
                  <input type="text" placeholder="Search">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </div>
              </div>
            </div>
            <div class="MainDiv-Main DoctorsDiv-Main">
              <div class="Table-Div">
                <table>
                  <thead>
                    <tr class="Tr-Header">
                      <th>Name</th>
                      <th>Specialization</th>
                      <th>Secretary</th>
                      <th>Room</th>
                      <th>Number of HMO/s</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $FetchDoctorInactive = "SELECT * FROM doctor
                    INNER JOIN doctor_specialization ON doctor.doctor_id = doctor_specialization.specialization_doctor_id 
                    WHERE doctor_archive_status = 'HIDDEN'
                    ";
                    $FetchDoctorInactive = mysqli_query($connMysqli,$FetchDoctorInactive);
                    while($row = mysqli_fetch_assoc($FetchDoctorInactive)){echo "
                      <tr>
                        <td>".$row['doctor_name']."</td>
                        <td>Super Admin</td>
                        <td>Active</td>
                        <td>2nd Floor - Room 2408</td>
                        <td>Active</td>
                        <td>Active</td>
                        <td><button class='Btn_1' onclick='ViewAdmin()'> <lord-icon  src='https://cdn.lordicon.com/ogkflacg.json'trigger='hover'colors='primary:#ffffff' style='width:20px;height:20px'></lord-icon> Restore</button></td>
                      </tr>
                    ";};?>   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        <!-- END -->
      </section>
    <!-- END -->


    <!-- Modal -->
      <section class="Modal-Sidebar">
        <div class="Modal-Container">
          <div class="Modal-Sidebar-Exit" onclick="ModalSidebarExit()">
            <i class="fa-solid fa-xmark"></i>
          </div>
          <div class="Modal-Sidebar-Container">
            <!-- Add Doctor -->
            <div class="Modal-DivDoctor Modal-AddDoctor D1">
              <div class="Modal-Sidebar-Top">
                <i class="fa-solid fa-user-plus"></i>
                <h4>Add Doctor</h4>
              </div>
              <div class="Modal-Sidebar-Main">
                <div class="AddDoctorDivContainer-Form"> 
                  <h4>Doctor</h4>
                  <div class="InputFieldForm">
                    <i>First Name:</i>
                    <input type="text" placeholder="First Name" class="CT1" id="DoctorsFirstName">
                  </div>
                  <div class="InputFieldForm">
                    <i>Middle Name:</i>
                    <input type="text" placeholder="Middle Name" class="CT1" id="DoctorsMiddleName">
                  </div>
                  <div class="InputFieldForm">
                    <i>Last Name:</i>
                    <input type="text" placeholder="Last Name" class="CT1" id="DoctorsLastName">
                  </div>
                  <div class="InputFieldForm">
                    <i>Gender:</i>
                    <select name="" id="DoctorGender" class="CT1">
                      <option value="" selected disabled>-</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                  <br>
                  <h4>Specialization</h4>
                  <div class="InputFieldForm">
                    <i>Specialization:</i>
                    <div class="Flex">
                      <input type="text" placeholder="Specialization" class="CT1">
                      <button class="Btn_1"><i class="fa-solid fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="InputFieldForm">
                    <i></i>
                    <div class="InformationField"></div>
                  </div>
                  <br>
                  <h4>Sub Specialization</h4>
                  <div class="InputFieldForm">
                    <i>Sub Specialization:</i>
                    <div class="Flex">
                      <input type="text" placeholder="Sub Specialization " class="CT1">
                      <button class="Btn_1"><i class="fa-solid fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="InputFieldForm">
                    <i></i>
                    <div class="InformationField"></div>
                  </div>
                  <br>
                  <h4>Category</h4>
                  <div class="InputFieldForm">
                    <i>Category:</i>
                    <select name="" id="" class="CT1">
                      <option value="" selected disabled>-</option>
                      <option value="">Regular Consultant</option>
                      <option value="">Waiting Consultant</option>
                    </select>
                  </div>
                  <br>
                  <h4>Primary Secretary</h4>
                  <div class="InputFieldForm">
                    <i>Full Name:</i>
                    <input type="text" placeholder="Full Name" class="CT1">
                  </div>
                  <div class="InputFieldForm">
                    <i>Contact Number:</i>
                    <input type="text" placeholder="09*********" class="CT1">
                  </div>
                  <div class="InputFieldForm">
                    <i>Network:</i>
                    <input type="text" placeholder="Ex. Smart, Globe" class="CT1">
                  </div>
                  <br>
                  <h4>Secondary Secretary</h4>
                  <div class="InputFieldForm">
                    <i>Full Name:</i>
                    <input type="text" placeholder="Full Name" class="CT1">
                  </div>
                  <div class="InputFieldForm">
                    <i>Contact Number:</i>
                    <input type="text" placeholder="09*********" class="CT1">
                  </div>
                  <div class="InputFieldForm">
                    <i>Network:</i>
                    <input type="text" placeholder="Ex. Smart, Globe" class="CT1">
                  </div>
                  <br>
                  <h4>Schedule</h4>
                  <div class="InputFieldForm">
                    <i>Schedule:</i>
                    <input type="text" placeholder="Schedule" class="CT1">
                  </div>
                  <div class="InputFieldForm">
                    <i></i>
                    <div class="InformationField"></div>
                  </div>
                  <br>
                  <h4>Room</h4>
                  <div class="InputFieldForm">
                    <i>Room:</i>
                    <div class="Flex">
                      <input type="text" placeholder="Room" class="CT1">
                      <button class="Btn_1"><i class="fa-solid fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="InputFieldForm">
                    <i></i>
                    <div class="InformationField"></div>
                  </div>
                  <br>
                  <h4>Teleconsultaion</h4>
                  <div class="InputFieldForm">
                    <i>Teleconsultaion:</i>
                    <input type="text" placeholder="Teleconsultaion" class="CT1">
                  </div>
                  <br>
                  <h4>HMO Accreditation</h4>
                  <div class="InputFieldForm">
                    <i>HMO Accreditation:</i>
                    <input type="text" placeholder="HMO Accreditation" class="CT1">
                  </div>
                  <div class="InputFieldForm">
                    <i></i>
                    <div class="InformationField"></div>
                  </div>
                </div>
              </div>
              <div class="Modal-Sidebar-Bottom">
                <button class="Btn_1" onclick="AddNewDoctor()">Add</button>
                <button class="Btn_2" onclick="ModalSidebarExit()">Cancel</button>
              </div>
            </div>

            <!-- View Doctor -->
            <div class="Modal-DivDoctor Modal-ViewDoctor D1">
              <div class="Modal-Sidebar-Top">
                <i class="fa-solid fa-user-doctor"></i>
                <h4>Doctor Information</h4>
              </div>
              <div class="Modal-Sidebar-Main">
                <div class="ModalSidebar-Container AddDoctorDivContainer-Form"> 
                  <div class="Div-Container1">
                    <div class="Doctor-Img-Profile"><img src="../Uploaded/Doctor1.png" alt=""></div>
                    <div class="">
                      <p>Dr. OLIVER H. DADOLE</p>
                      <div class="Doctor-Active"><i class="fa-solid fa-circle"></i> Active</div>
                    </div>
                  </div>
                  
                  <div class="InputFieldForm">
                    <i>Category:</i>
                    <input type="text" placeholder="">
                  </div>

                  <div class="InputFieldForm">
                    <i>Specialization:</i>
                      
                    <div class="InformationField"></div>
                  </div>
                  <div class="InputFieldForm">
                    <i>Sub Specialization:</i>
                      
                    <div class="InformationField"></div>
                  </div>
                  <div class="InputFieldForm">
                    <i>Secretary:</i>
                      
                    <div class="InformationField"></div>
                  </div>
                  <div class="InputFieldForm">
                    <i>Room Number:</i>
                      
                    <div class="InformationField"></div>
                  </div>
                  <div class="InputFieldForm">
                    <i>HMO Accreditation:</i>
                      
                    <div class="InformationField"></div>
                  </div>
                  <div class="InputFieldForm">
                    <i>Remarks:</i>
                      
                    <div class="InformationField"></div>
                  </div>
                </div>
              </div>
              <div class="Modal-Sidebar-Bottom">
                <button class="Btn_1" onclick="EditDoctor()">Edit</button>
                <button class="Btn_2" onclick="DeleteDoctor()">Delete</button>
              </div>
            </div>

            <!-- Edit Doctor -->
            <div class="Modal-DivDoctor Modal-EditDoctor D1">
              <div class="Modal-Sidebar-Top">
                <i class="fa-solid fa-user-pen"></i>
                <h4>Edit Doctor</h4>
              </div>
              <div class="Modal-Sidebar-Main">
                <div class="EditDoctorDivContainer-Form"> 
                  <h4>Doctor</h4>
                  <div class="InputFieldForm">
                    <i>Last Name:</i>
                    <input type="text" placeholder="Last Name">
                  </div>
                  <div class="InputFieldForm">
                    <i>First Name:</i>
                    <input type="text" placeholder="First Name">
                  </div>
                  <div class="InputFieldForm">
                    <i>Gender:</i>
                    <select name="" id="">
                      <option value="" selected disabled>-</option>
                      <option value="">Male</option>
                      <option value="">Female</option>
                    </select>
                  </div>
                  <br>
                  <h4>Specialization</h4>
                  <div class="InputFieldForm">
                    <i>Specialization:</i>
                    <div class="Flex">
                      <input type="text" placeholder="Specialization">
                      <button class="Btn_1"><i class="fa-solid fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="InputFieldForm">
                    <i></i>
                    <div class="InformationField"></div>
                  </div>
                  <br>
                  <h4>Sub Specialization</h4>
                  <div class="InputFieldForm">
                    <i>Sub Specialization:</i>
                    <div class="Flex">
                      <input type="text" placeholder="Sub Specialization">
                      <button class="Btn_1"><i class="fa-solid fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="InputFieldForm">
                    <i></i>
                    <div class="InformationField"></div>
                  </div>
                  <br>
                  <h4>Category</h4>
                  <div class="InputFieldForm">
                    <i>Category:</i>
                    <select name="" id="">
                      <option value="" selected disabled>-</option>
                      <option value="">Regular Consultant</option>
                      <option value="">Waiting Consultant</option>
                    </select>
                  </div>
                  <br>
                  <h4>Primary Secretary</h4>
                  <div class="InputFieldForm">
                    <i>Full Name:</i>
                    <input type="text" placeholder="Full Name">
                  </div>
                  <div class="InputFieldForm">
                    <i>Contact Number:</i>
                    <input type="text" placeholder="09*********">
                  </div>
                  <div class="InputFieldForm">
                    <i>Network:</i>
                    <input type="text" placeholder="Ex. Smart, Globe">
                  </div>
                  <br>
                  <h4>Secondary Secretary</h4>
                  <div class="InputFieldForm">
                    <i>Full Name:</i>
                    <input type="text" placeholder="Full Name">
                  </div>
                  <div class="InputFieldForm">
                    <i>Contact Number:</i>
                    <input type="text" placeholder="09*********">
                  </div>
                  <div class="InputFieldForm">
                    <i>Network:</i>
                    <input type="text" placeholder="Ex. Smart, Globe">
                  </div>
                  <br>
                  <h4>Schedule</h4>
                  <div class="InputFieldForm">
                    <i>Schedule:</i>
                    <input type="text" placeholder="Schedule">
                  </div>
                  <div class="InputFieldForm">
                    <i></i>
                    <div class="InformationField"></div>
                  </div>
                  <br>
                  <h4>Room</h4>
                  <div class="InputFieldForm">
                    <i>Room:</i>
                    <div class="Flex">
                      <input type="text" placeholder="Room">
                      <button class="Btn_1"><i class="fa-solid fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="InputFieldForm">
                    <i></i>
                    <div class="InformationField"></div>
                  </div>
                  <br>
                  <h4>Teleconsultaion</h4>
                  <div class="InputFieldForm">
                    <i>Teleconsultaion:</i>
                    <input type="text" placeholder="Teleconsultaion">
                  </div>
                  <br>
                  <h4>HMO Accreditation</h4>
                  <div class="InputFieldForm">
                    <i>HMO Accreditation:</i>
                    <input type="text" placeholder="HMO Accreditation">
                  </div>
                  <div class="InputFieldForm">
                    <i></i>
                    <div class="InformationField"></div>
                  </div>
                  <h4>Remarks</h4>
                  <div class="InputFieldForm">
                    <i>Remarks:</i>
                    <div class="InformationField"></div>
                  </div>
                </div>
              </div>
              <div class="Modal-Sidebar-Bottom">
                <button class="Btn_1" onclick="UpdateDoctor()">Save</button>
                <button class="Btn_2" onclick="BackToViewDoctor()">Cancel</button>
              </div>
            </div>

            <!-- Telle Index Start -->

            <!-- Add Admin -->
            <div class="Modal-DivDoctor Modal-AddAdmin D1">
              <div class="Modal-Sidebar-Top">
                <i class="fa-solid fa-user-plus"></i>
                <h4>Add Access Account</h4>
              </div>
              <div class="Modal-Sidebar-Main Modal-Not-Capitalize">
                <div class="AddDoctorDivContainer-Form"> 
                  <!-- <h4>Username</h4> -->
                  <div class="InputFieldForm">
                    <i>Username</i>
                    <input type="text" placeholder="Username" id="AccessUsername">
                  </div>
                  <div class="InputFieldForm">
                    <i>Access</i>
                    <select name="" id="AccessType">
                      <option value="" selected disabled>-</option>
                      <option value="Admin">Admin</option>
                      <option value="Super Admin">Super Admin</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="Modal-Sidebar-Bottom">
                <button class="Btn_1" onclick="AddNewAccess()">Add</button>
                <button class="Btn_2" onclick="ModalSidebarExit()">Cancel</button>
              </div>
            </div>

          <!-- Telle Index End -->

          </div>
        </div>
      </section>
    <!-- END -->


    <!-- Prompt Message -->
      <section class="Prompt-Message">
        <div class="Prompt-Message-Div">
          <!-- Add New Doctor -->
          <div class="Prompt-Div Prompt-AddNewDoctor">
            <div class="Prompt-Message-Top">
              <lord-icon src="https://cdn.lordicon.com/ygvjgdmk.json" trigger="loop"delay="1500" class="lord-icon"></lord-icon>
              <h4>Are you sure?</h4>
            </div>
            <div class="Prompt-Message-Center">
              <p class="P-Message">Are you sure you want to add this doctor?</p>
            </div>
            <div class="Prompt-Message-Bottom">
              <button class="Btn_1" onclick="InsertNewDoctor('InsertDoctor')">Yes</button>
              <button class="Btn_2" onclick="HidePromptMessage()">No</button>
            </div>
          </div>

          <!-- Add Update Doctor -->
          <div class="Prompt-Div Prompt-UpdateDoctor Hide">
            <div class="Prompt-Message-Top">
              <lord-icon src="https://cdn.lordicon.com/ygvjgdmk.json" trigger="loop"delay="1500" class="lord-icon"></lord-icon>
              <h4>Are you sure?</h4>
            </div>
            <div class="Prompt-Message-Center">
              <p class="P-Message">Are you sure you want to update this doctor?</p>
            </div>
            <div class="Prompt-Message-Bottom">
              <button class="Btn_1">Yes</button>
              <button class="Btn_2" onclick="HidePromptMessage()">No</button>
            </div>
          </div>

          <!-- Remove Doctor -->
          <div class="Prompt-Div Prompt-RemoveDoctor Hide">
            <div class="Prompt-Message-Top">
              <lord-icon src="https://cdn.lordicon.com/ygvjgdmk.json" trigger="loop"delay="1500" class="lord-icon"></lord-icon>
              <h4>Are you sure?</h4>
            </div>
            <div class="Prompt-Message-Center">
              <p class="P-Message">Are you sure you want to remove this doctor?</p>
            </div>
            <div class="Prompt-Message-Bottom">
              <button class="Btn_1">Yes</button>
              <button class="Btn_2" onclick="HidePromptMessage()">No</button>
            </div>
          </div>
        </div>

      
        <!-- Telle Start - Prompt -->

          <!-- Add Access Account -->
          <div class="Prompt-Div Prompt-AccessAccount Hide">
            <div class="Prompt-Message-Top">
              <lord-icon src="https://cdn.lordicon.com/ygvjgdmk.json" trigger="loop"delay="1500" class="lord-icon"></lord-icon>
              <h4>Are you sure?</h4>
            </div>
            <div class="Prompt-Message-Center">
              <p class="P-Message">Are you sure you want to add an access account?</p>
            </div>
            <div class="Prompt-Message-Bottom">
              <button class="Btn_1" onclick="Yes_AddNewAccess('Access')">Yes</button>
              <button class="Btn_2" onclick="HidePromptMessage()">No</button>
            </div>
          </div>

        <!-- Telle End - Prompt -->
      </section>
    <!-- END -->


    <!-- POP UP -->
      <section class="PopUp-Message">
        <div class="PopUp-Container">
          <h4 id="Pop-Message">New Doctors have been successfully added!</h4>
          <lord-icon src="https://cdn.lordicon.com/lomfljuq.json" trigger="loop"delay="1500" class="lord-icon" colors="primary:#9acd32" style="width:60px;height:60px"> </lord-icon>
        </div>
      </section>
    <!-- END -->

  </div>
</body>
</html>