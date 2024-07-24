function LinkToLogout(){
  location.href = "../Admin - Panel/Logout.php";
  console.log("Logout successfully!");
}

function BTNDashboard(){
  $(".AdminDashboard").css("display","flex")
  $(".AdminDashboard").siblings().css("display","none");
  $(".SBFocus1").siblings().removeClass("Sidebar_Active");
  $(".SBFocus1").addClass("Sidebar_Active");
  updateChartData();
  updateChartData2();
}
function BTNDoctors(){
  $(".DoctorsDiv").css("display","flex")
  $(".DoctorsDiv").siblings().css("display","none");

  $(".SBFocus2").siblings().removeClass("Sidebar_Active");
  $(".SBFocus2").addClass("Sidebar_Active");
}
function BTNAccounts(){
  $(".AccountsDiv").css("display","flex")
  $(".AccountsDiv").siblings().css("display","none");
  
  $(".SBFocus3").siblings().removeClass("Sidebar_Active");
  $(".SBFocus3").addClass("Sidebar_Active");
}
function BTNActivity(){
  $(".ActivityLogs").css("display","flex")
  $(".ActivityLogs").siblings().css("display","none");
  
  $(".SBFocus4").siblings().removeClass("Sidebar_Active");
  $(".SBFocus4").addClass("Sidebar_Active");
}
function BTNArchive(){
  $(".ArchivesDiv").css("display","flex")
  $(".ArchivesDiv").siblings().css("display","none");
  
  $(".SBFocus5").siblings().removeClass("Sidebar_Active");
  $(".SBFocus5").addClass("Sidebar_Active");
}

function clearText(){
  $(".CT1").val("");
}





// Dashboard Chart
var chart;
function FuncChart(data) {
  var options = {series: [{data: data}],
    chart: {type: 'bar', height: 250, dropShadow: { enabled: true, top: 0, left: 0, blur: 2, opacity: 0.2},},
    plotOptions: {bar: { borderRadius: 4, borderRadiusApplication: 'end', horizontal: true,}},
    fill: {colors: ['#318499']},
    dataLabels: {enabled: false},
    labels: {show: true,rotate: -45,rotateAlways: false,hideOverlappingLabels: true,showDuplicates: false,trim: false,minHeight: undefined,maxHeight: 120,},
    xaxis: {categories: ['Internal Medicine', 'Orthopedics', 'Pediatrics', 'Pediatrics', 'Surgery'],

    }
  };
  chart = new ApexCharts(document.querySelector("#chart"), options);
  chart.render();
}

function updateChartData() {
  var newData = [0, 0, 0, 0, 0];
  var inputChart = $("#chartInput").val();
  var newData2 = [inputChart, 430, 500, 480, 550];
  chart.updateSeries([{data: newData}]);
  chart.updateSeries([{data: newData2}]);
}

var inputChart = $("#chartInput").val();
var initialData = [42, 23, 12, 10, 12];
FuncChart(initialData);




// Dashboard Chart 2
var chart2;
function FuncChart2(data) {
  var options = {series: [{data: data}],
    chart: {type: 'bar', height: 250, dropShadow: { enabled: true, top: 0, left: 0, blur: 2, opacity: 0.2},},
    plotOptions: {bar: { borderRadius: 4, borderRadiusApplication: 'end', horizontal: true,}},
    fill: {colors: ['#318499']},
    dataLabels: {enabled: false},
    labels: {show: true,rotate: -45,rotateAlways: false,hideOverlappingLabels: true,showDuplicates: false,trim: false,minHeight: undefined,maxHeight: 120, minWidth: 400,},
    xaxis: {      categories: ['Healthway Medi-Access', 'Intellicare', 'Insular Life Assurance Co., Ltd.', 'KAISER International Healthgroup, Inc.', 'IMS Wellth Care, Inc.'],    }
  };
  chart2 = new ApexCharts(document.querySelector("#chart2"), options);
  chart2.render();
}

function updateChartData2() {
  var newData = [0, 0, 0, 0, 0];
  var inputChart = $("#chartInput").val();
  var newData2 = [inputChart, 53, 32, 42, 23];
  chart2.updateSeries([{data: newData}]);
  chart2.updateSeries([{data: newData2}]);
}

var inputChart2 = $("#chartInput").val();
var initialData2 = [44, 53, 32, 42, 23];
FuncChart2(initialData2);





$(document).ready(function(){
  // POP UP MESSAGE / WELCOME ADMIN
  const myTimeout = setTimeout(timer2, 3000);
  function timer2() {
    $('.PopUp-Div').css("display","none");
    $('.AddDoctorDiv').removeClass("PopUp-Div-Add");
  }


  // PAGINATION - LOAD DATA
  function loadData(page){
    $.ajax({
      url: "../Components/Function_Admin.php",
      type: "POST",
      data: {page: page},
      success: function(response){
        // console.log(response);
        $("#data-container").html(response);
      }
    });
  }
  loadData(1);
  $(document).on("click", ".pagination li a", function(e){
      e.preventDefault();
      var page = $(this).attr("data-page");
      loadData(page);
  });


  // ADD DOCTOR
  $(".BtnAddDoctor").click(function(){
    $('.AddDoctorDiv').css("display","flex");
  });

  // CLOSE ADD DOCTOR CONTAINER
  $(".Close-AddDoctorDiv").click(function(){
    $('.AddDoctorDivContainer').css("display","flex");
    $('.AddDoctorDivContainer').addClass("AddDoctorDivContainerClosing");
    $('.AddDoctorDiv').addClass("AddDoctorDivClosing");
    const myTimeout = setTimeout(timer2, 900);
    function timer2() {
      $('.AddDoctorDiv').css("display","none");
      $('.AddDoctorDivContainer').removeClass("AddDoctorDivContainerClosing");
      $('.AddDoctorDiv').removeClass("AddDoctorDivClosing");
    }
  });
});


// ============= AJAX =============
// HIDE MODAL
function ModalSidebarExit(){
  $(".Modal-Sidebar").css("display","none");
}

// DOCTOR ==================================
// OPEN NEW DOCTOR - MODAL
function AddDoctor(){
  $(".Modal-Sidebar").css("display","flex")
  $(".Modal-AddDoctor").css("display","flex")
  $(".Modal-AddDoctor").siblings().css("display","none");
  $(".Modal-Container").css("display", "flex");
}


// OPEN MODAL / VIEW DOCTOR DETAILS
function ViewDoctor(){
  $(".Modal-Sidebar").css("display","flex")
  $(".Modal-ViewDoctor").css("display","flex")
  $(".Modal-Container").css("display","flex")
  $(".Modal-ViewDoctor").siblings().css("display","none");
}

// OPEN MODAL / EDIT DOCTOR DETAILS
function EditDoctor(){
  $(".Modal-Sidebar").css("display","flex")
  $(".Modal-EditDoctor").css("display","flex")
  $(".Modal-EditDoctor").siblings().css("display","none");
}

// BACK TO DOCTOR DETAILS
function BackToViewDoctor(){
  $(".Modal-Sidebar").css("display","flex")
  $(".Modal-ViewDoctor").css("display","flex")
  $(".Modal-ViewDoctor").siblings().css("display","none");
}

// PROMPT MESSAGE / HIDE PROMPT MODAL
function HidePromptMessage(){
  $(".Prompt-Message").css("display","none")
  $(".Prompt-Message-Div").child().css("display","none");
}

// PROMPT MESSAGE / ADD NEW DOCTOR
function AddNewDoctor(){
  $(".Prompt-Message").css("display","flex")
  $(".Prompt-AddNewDoctor").css("display","flex")
  $(".Prompt-AddNewDoctor").siblings().css("display","none");
}

// PROMPT MESSAGE / UPDATE DOCTOR
function UpdateDoctor(){
  $(".Prompt-Message").css("display","flex")
  $(".Prompt-UpdateDoctor").css("display","flex")
  $(".Prompt-UpdateDoctor").siblings().css("display","none");
}

// PROMPT MESSAGE / DELETE DOCTOR
function DeleteDoctor(){
  $(".Prompt-Message").css("display","flex")
  $(".Prompt-RemoveDoctor").css("display","flex")
  $(".Prompt-RemoveDoctor").siblings().css("display","none");
}



// ACCOUNT ==================================
// OPEN NEW ADMIN - MODAL
function AddAdmin(){
  $(".Modal-Sidebar").css("display","flex")
  $(".Modal-AddAdmin").css("display","flex")
  $(".Modal-AddAdmin").siblings().css("display","none");
}



// INSERT NEW DOCTOR
function PopMessages(){
  $(".Prompt-Message").css("display","none");
  $(".PopUp-Message").css("display","flex");
  $(".PopUp-Message").addClass("AddPopUp-Message");
  $(".Modal-Sidebar").css("display","none")
  const myTimeout = setTimeout(timer2, 3000);
  function timer2() {
    $(".PopUp-Message").css("display","none");
  }
}


function InsertNewDoctor(InsertDoctor){
  PopMessages()
  var data = {
    InsertDoctor: InsertDoctor,
    LastName: $("#DoctorsLastName").val(),
    MiddleName: $("#DoctorsMiddleName").val(),
    FirstName: $("#DoctorsFirstName").val(),
    Gender: $("#DoctorGender").val(),
    Specialization: $("#DoctorsFirstName").val(),
    SubSpecialization: $("#DoctorsFirstName").val(),
    Category: $("#DoctorsFirstName").val(),
    PrimarySecretary: $("#DoctorsFirstName").val(),
    PrimaryFirstNumber: $("#DoctorsFirstName").val(),
    PrimaryFirstNetwork: $("#DoctorsFirstName").val(),
    PrimarySecondNumber: $("#DoctorsFirstName").val(),
    PrimarySecondNetwork: $("#DoctorsFirstName").val(),
    SecondarySecretary: $("#DoctorsFirstName").val(),
    SecondarySecondNumber:$("#DoctorsFirstName").val(),
    SecondarySecondNetwork: $("#DoctorsFirstName").val(),
    Schedule: $("#DoctorsFirstName").val(),
    Room: $("#DoctorsFirstName").val(),
    TeleConsultation: $("#DoctorsFirstName").val(),
    HMOAccreditation: $("#DoctorsFirstName").val(),
  };
  $.ajax({
    url: '../Components/Function_Admin.php',
    type: 'post',
    data: data,
    success: function(response){
      console.log(response);
      $(".tbody-doctor").load(location.href + " .tr-doctor");
      $(".Modal-Container").css("display", "none");
      clearText();
    }
  });
}

