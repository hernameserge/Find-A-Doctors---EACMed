<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- <meta http-equiv="refresh" content="3600; url=logout.php"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <!-- <link href = "./Assets/Images/" rel="icon" type="image/png"> -->
  <link rel="stylesheet" href="../Assets/CSS_Admin.css">
  <link rel="stylesheet" href="../Assets/CSS_Public.css?ver=<?php echo time();?>">

  <title>EACMC - Find Your Doctor</title>
</head>
<body>
  <div class="Admin-LoginPage">
    <div class="Admin-LoginDiv">

      <div class="Admin-LoginLogo">
        <img src="../Assets/Images/EACMed Logo.png" alt="">
      </div>
      <div class="Admin-LoginPageForm">
        <h1>Admin Panel</h1>
        <p>Login to access your admin account.</p>

        <div class="SearchDoctor InputText1">
          <i class="fa-solid fa-stethoscope"></i>
          <input type="text" placeholder="Admin">
          <div class=""></div>
        </div>
        <div class="SearchDoctor InputText1">
          <i class="fa-solid fa-stethoscope"></i>
          <input type="password" placeholder="Admin">
          <div class=""></div>
        </div>
        <br>
        <button>Login</button>
      </div>
    </div>
  </div>
</body>
</html>