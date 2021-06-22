<?php
$con  = mysqli_connect("localhost","root","","iot");
 if (!$con) {
     # code...
    echo "Problem in database connection! Contact administrator!" . mysqli_connect_error();
 }else{
         $sql ="SELECT * FROM elec_cons";
         $result = mysqli_query($con,$sql);
         $chart_data="";
         while ($row = mysqli_fetch_array($result)) { 
 
           
            $month[]  = date_format(date_create( $row['DATE']),"M")  ;
            $total[] = $row['total'];
        }
 
 
 }
 
 
?>

<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Graph</title> 
    </head>
    <body>
        <div id= "charttable">
            <h3 class="page-header"style="color:white">Consumption Report</h3>
          
            <canvas  id="chartjs_line"></canvas> 
        </div>    
    </body>
    <style>
#charttable{


margin-left:55%;
width:40%;
margin-bottom:50%;
height:25%;
margin-top:-190px;
text-align:center;

}
</style>


  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script type="text/javascript">
      var ctx = document.getElementById("chartjs_line").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels:<?php echo json_encode($month); ?>,
                        datasets: [{
                            backgroundColor: [
                               "#5969ff",
                                "#ff407b",
                                "#25d5f2",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"
                            ],
                            data:<?php echo json_encode($total); ?>,
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'bottom',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },
 
 
                }
                });
    </script>
</html>