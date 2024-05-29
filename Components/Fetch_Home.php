<?php 
  // Fetch All Doctors
  $AllDoctors1 = "SELECT * FROM doctor ";
  $AllDoctors1 = mysqli_query($connMysqli,$AllDoctors1);
  
  // Doctors Schedule
  $DoctorsSchedule1 = "SELECT * FROM doctor_schedule ";
  $DoctorsSchedule1 = mysqli_query($connMysqli,$DoctorsSchedule1);





  // $CountDoctorHMO = mysqli_query($connMysqli, "SELECT * FROM doctor_hmo WHERE  hmo_doctor_id = 1");
  // $CountDoctorHMO = mysqli_num_rows($CountDoctorHMO);
?>