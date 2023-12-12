// contoh dougnut
var ctx = document.getElementById("myBarChart");
var myBarChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [

      <?php

      // $matrix_eye = mysqli_query($cnts,"SELECT Distinct Weld_type AS Jumlah FROM matrix_eye WHERE Part_No='Matrixeye MB RH' ");                                      
      // foreach($matrix_eye AS $data){
      // $Jumlah =$data ['Jumlah'];                                                                                                                                                
      // echo "'".$Jumlah."',";                                  
      // }
      
      ?>
     
  'TOTAL SPOT',
],

    datasets: [{
      label: "Revenue",
      backgroundColor: "#4e73df",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#4e73df",
      data: [

        <?php 

        $tabeltotal =  mysqli_query ($cnts,"SELECT * from matrix_eye WHERE Part_No='Matrixeye MB RH'"); 
        $total = mysqli_num_rows ($tabeltotal);                               
        $matrix_eye = mysqli_query($cnts,"SELECT *, Count('Weld_type') AS Jumlah FROM matrix_eye WHERE Part_No='Matrixeye MB RH' GROUP BY Weld_type");                                      
        foreach($matrix_eye AS $data){
        $Jumlah =$data ['Jumlah'];                                                                                                                                                
        echo $Jumlah.',';                                  
        }
        echo $total;

        ?>
      ],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: ''
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 6
        },
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 15000,
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          // callback: function(value, index, values) {
          //   return '$' + number_format(value);
          // }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      
    },
  }
});
