function BTNDashboard(){
  $(".AdminDashboard").css("display","flex")
  $(".AdminDashboard").siblings().css("display","none");
  
  $(".SBFocus1").siblings().removeClass("Sidebar_Active");
  $(".SBFocus1").addClass("Sidebar_Active");
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

function ViewDoctorsModal(){
  $(".DoctorsViewPanel").css("display","flex")
  $(".DoctorsViewPanel").siblings().css("display","none");
}
function HideDoctorsModal(){
  $(".DoctorsDiv").css("display","flex")
  $(".DoctorsDiv").siblings().css("display","none");
}





// function CLickMe(){
//   // chart.render();
//     // Simulated new data (replace with your actual data fetching logic)
//     var newData = [400, 430, 448, 470, 540];

//     // Update chart data and refresh
//     chart.updateSeries([{ data: newData }]);
// }


// document.getElementById("refreshBtn").addEventListener("click", function() {
//   // Simulated new data (replace with your actual data fetching logic)
//   var newData = [402, 430, 448, 470, 540];

//   // Update chart data and refresh
//   chart.updateSeries([{ data: newData }]);
// });




var options = {
  series: [{ 
    data: [400, 430, 448, 470, 540]
  }],
  chart: {
    
    type: 'bar',
    height: 250,
    dropShadow: {
      enabled: true,
      top: 0,
      left: 0,
      blur: 2,
      opacity: 0.2
    },
  },
  plotOptions: {
    bar: {
      borderRadius: 4,
      borderRadiusApplication: 'end',
      horizontal: true,
    }
  },
  fill: {
    colors: ['#277540']
  },

  dataLabels: {
    enabled: false
  },
  xaxis: {
    categories: ['Healthway Medi-Access', 'Intellicare', 'Insular Life Assurance Co., Ltd.', 'KAISER International Healthgroup, Inc.', 'IMS Wellth Care, Inc.'
    ],
  }
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();



var options = {
  series: [{ 
    data: [400, 430, 448, 470, 540]
  }],
  chart: {
    type: 'bar',
    height: 250,
    dropShadow: {
      enabled: true,
      top: 0,
      left: 0,
      blur: 2,
      opacity: 0.2
    },
  },
  plotOptions: {
    bar: {
      borderRadius: 4,
      borderRadiusApplication: 'end',
      horizontal: true,
    }
  },
  fill: {
    colors: ['#318499']
  },

  dataLabels: {
    enabled: false
  },

  labels: {
    show: true,
    rotate: -45,
    rotateAlways: false,
    hideOverlappingLabels: true,
    showDuplicates: false,
    trim: false,
    minHeight: undefined,
    maxHeight: 120,
  },


  xaxis: {
    categories: ['Internal Medicine', 'Orthopedics', 'Pediatrics', 'Pediatrics', 'Surgery'
    ],
  }
};

var chart = new ApexCharts(document.querySelector("#chart2"), options);
chart.render();



$(document).ready(function(){
  
  var domainName = window.location.hostname;
  console.log("Domain Name: " + domainName);



  $('.tooltip').each(function(){
      $(this).attr('data-title', $(this).attr('href'));
  });
});






$(document).ready(function(){
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
});


$(document).ready(function(){
  
  $(".BtnAddDoctor").click(function(){
    $('.AddDoctorDiv').css("display","flex");
  });
});





