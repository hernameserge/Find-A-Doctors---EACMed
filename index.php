<?php
  session_start();
  include "./Config/Configure.php";
  include "./Components/Fetch_Home.php";
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
  <link href = "./Assets/Images/EACMC_LOGO 1.png" rel="icon" type="image/png">
  <link rel="stylesheet" href="./Assets/CSS_Index.css?ver=<?php echo time();?>">
  <link rel="stylesheet" href="./Assets/CSS_Public.css?ver=<?php echo time();?>">
  <title>EACMed - Find Your Doctor</title>
</head>
<body>
  <div class="EACMed_Body">
    <section class="Home_Banner"><?php include "./Components/Home_Banner.php"?></section>
    <section class="Home_Main"><?php include "./Components/Home_Main.php"?></section>
    <section class="Home_Modal"><?php include "./Components/Home_Modal.php"?></section>
    <section class="Home_NavigationFloat"><?php include "./Components/Home_NavFloat.php"?></section>
    <section class="Home_Loading"><?php include "./Components/Home_Loading.php"?></section>
    <!-- <section class="Home_POPUP"><?php include "./Components/Home_PopUp.php"?></section> -->
    <section class="FilterFloat SDiv">
      <div class="FilterFloatDivContainer0">
        <span class="material-symbols-sharp">filter_list</span>
      </div>
      <div class="FilterFloatDivContainer1">
        <div class="AllToday">
          <div class="Flex">
            <button class="AllTOdayBtn TodayBtn1 TodayBtnActive" onclick="BtnALlDocFilter('AllDoctor')">All</button>
            <button class="AllTOdayBtn TodayBtn2" onclick="BtnALlDocFilter('TodayDoctor')">Today</button>
          </div>
          <i class="fa-regular fa-circle-xmark HideFilter"></i>
        </div>
      </div>
    </section>
    <div class="FilterMobContainer">
          
          <div class="Main_Div2">
            <h2>Filter</h2>
            <div class="Main_Div2-Section">
              <div class="SearchDoctor InputText1">
                <i class="fa-solid fa-stethoscope"></i>
                <input type="text" readonly="readonly" onclick="OpenSearchModal1()" class="TextBoxFilter1">
                <i class="fa-regular fa-circle-xmark XCursor" onclick="ClearTxtField1()"></i>
                <div class="HoverP SearchPlaceholder1"><p>SPECIALIZATION</p></div>
              </div>
              <br>
              <div class="SearchDoctor InputText1">
                <i class="fa-solid fa-address-card"></i>
                <input type="text" readonly="readonly" onclick="OpenSearchModal2()" placeholder="" class="TextBoxFilter2">
                <i class="fa-regular fa-circle-xmark XCursor" onclick="ClearTxtField2()"></i>
                <div class="HoverP SearchPlaceholder2"><p>SUB SPECIALIZATION</p></div>
              </div>
              <br>
              <div class="SearchDoctor InputText1">
                <i class="fa-solid fa-calendar-days"></i>
                <input type="text" readonly="readonly" onclick="OpenSearchModal4()" placeholder="" class="TextBoxFilter6_2">
                <input type="text" readonly="readonly" placeholder="Clinic Day" class="TextBoxFilter6">
                <i class="fa-regular fa-circle-xmark XCursor" onclick="ClearTxtField4()"></i>
                <div class="HoverP SearchPlaceholder6"><p>CLINIC DAY</p></div>
              </div>
              <br>
              <div class="SearchDoctor InputText1">
                <i class="fa-solid fa-person-half-dress"></i>
                <input type="text"  readonly="readonly" onclick="OpenSearchModal5()" placeholder="" class="TextBoxFilter3">
                <i class="fa-regular fa-circle-xmark XCursor" onclick="ClearTxtField5()"></i>
                <div class="HoverP SearchPlaceholder3"><p>SEX</p></div>
              </div>
              <br>
              <div class="SearchDoctor InputText1">
                <i class="fa-solid fa-video"></i>
                <input type="text" readonly="readonly" onclick="OpenSearchModal6()" placeholder="" class="TextBoxFilter5">
                <i class="fa-regular fa-circle-xmark XCursor" onclick="ClearTxtField6()"></i>
                <div class="HoverP SearchPlaceholder5"><p>WITH TELECONSULTATION</p></div>
              </div>
              <br>
              <div class="SearchDoctor InputText1">
                <i class="fa-solid fa-id-card-clip"></i>
                <input type="text" readonly="readonly" onclick="OpenSearchModal3()" placeholder="" class="TextBoxFilter4_2">
                <input type="text" readonly="readonly"  placeholder="Hidden HMO Accreditation" class="TextBoxFilter4">
                <i class="fa-regular fa-circle-xmark XCursor" onclick="ClearTxtField3()"></i>
                <div class="HoverP SearchPlaceholder4"><p>HMO ACCREDITATION</p></div>
              </div>
              <br>
              <div class="">
                <button onclick="ClearText('Clear')"><i class="fa-solid fa-eraser"></i> Clear All</button>
              </div>
            </div>
            <br>
            <p class="Italic">DISCLAIMER: Doctors' clinic schedules are subject to change without prior notice.</p>
          </div>
        </div>
  </div>
  <script type="text/javascript" src="./Assets/JS_Home.js?ver=<?php echo time();?>"></script>
</body>
</html>