<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My daily activities';
?>
<?php
    $months = array('1'=>'January', '2'=>'February', '3'=>'March', '4'=>'April', '5'=>'May', '6'=>'June', '7'=>'July', '8'=>'August', '9'=>'September', '10'=>'October', '11'=>'November', '12'=>'December');
    // $current_month = date('m', time());
    // $current_day = date('d', time());
    // $current_day = intval($current_day);
    // $current_month = intval($current_month);
 //   $months_days = array($jan, $feb,  $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec);
?>
<?php
     function showDay($day, $i){
        $current_month = date('m', time());
        $current_day = date('d', time());
        $current_day = intval($current_day);
        $current_month = intval($current_month);
        if($i < $current_month || ($i == $current_month && $day<$current_day )){
          echo "<td class='text-center'>". Html::a($day, ['/myday/index'], ['class'=>'text-success']) ."</td>";
        }elseif ($i==$current_month && $day==$current_day) {
            echo "<td class='text-center'>". Html::a($day, ['/myday/create'], ['class'=>'text-primary']) ."</td>";
        }else{
          echo "<td class='text-center text-warning'>". $day ."</td>";  
        }
                              
    }
?>

            

<div class="site-index">
    

    <!--<div class="jumbotron">
        <h3>Day-In Day-Out</h3>

        <p class="lead">This application helps you keep accurate record of your daily activities; hence, it maximises your productivity</p>

    </div>-->

    <div class="body-content">

        <div class="row">
            <div class="col-lg-2 col-xs-2 col-sm-2 col-md-2">
                
            </div>
            <div class="col-lg-8 col-xs-8 col-sm-8 col-md-8">
            
                <?php 

                    for($i = 1; $i<=12; $i++){
                        if($i < $current_month){
                        
                            echo "<p class='text-success'>$months[$i]</p>";

                        }elseif($i==$current_month){

                            echo "<p class='text-primary'>$months[$i]</p>";

                        }else{
                            echo "<p class='text-warning'>$months[$i]</p>";
                        }

                        echo "<table class='table table-bordered'>";
                        echo "<tr>";
                        echo '<th class="text-danger text-center">SUNDAY</th>';
                        echo "<th class='text-center'>MONDAY</th>";
                        echo "<th class='text-center'>TUESDAY</th>";
                        echo "<th class='text-center'>WEDNESDAY</th>";
                        echo "<th class='text-center'>THURSDAY</th>";
                        echo "<th class='text-center'>FRIDAY</th>";
                        echo "<th class='text-center'>SATURDAY</th>";
                        echo "</tr>";
                       
                        if($i == 1){
                             echo "<tr>";
                            for($j = 1; $j<=7; $j++){
                                if($j != $days[$first_day_of_year]){
                                   echo "<td></td>";
                                }else{
                                    showDay($first_daynum, $i);
                                    $first_daynum++;   
                                }
                                if($first_daynum == 2 && ($j<7)){
                                    for ($k = 1; $k<=(7-$j); $k++){

                                        showDay($first_daynum, $i);
                                        $first_daynum++;

                                    }
                                    break;

                                }
                            }
                            echo "</tr>";

                            while ($first_daynum<=$months_days[0]){
                                echo "<tr>";
                                for($j = 1; $j<=7; $j++){
                                    showDay($first_daynum, $i);
                                    $first_daynum++;
                                    if($first_daynum>$months_days[0]){
                                        $past_month_sec = $months_days[0] * 86400;
                                        break;
                                    }
                                }
                                echo "</tr>";    
                            }
                            $first_daynum = 1;

                        }elseif($i<= $current_month || $i>$current_month){
                            $epoch_till_last_month = ($epoch - $sec_since) + $past_month_sec;
                            $first_day_of_month = date('D', $epoch_till_last_month);
                            echo "<tr>";
                                for($j = 1; $j<=7; $j++){
                                    if($j != $days[$first_day_of_month]){
                                       echo "<td></td>";
                                    }else{
                                        showDay($first_daynum, $i);
                                        $first_daynum++;   
                                    }
                                    if($first_daynum == 2 && ($j<7)){
                                        for ($k = 1; $k<=(7-$j); $k++){

                                            showDay($first_daynum, $i);
                                            $first_daynum++;

                                        }
                                        break;

                                    }
                                }
                            echo "</tr>";

                            while ($first_daynum<=$months_days[$i-1]){
                                echo "<tr>";
                                for($j = 1; $j<=7; $j++){
                                    showDay($first_daynum, $i);
                                    $first_daynum++;
                                    if($first_daynum>$months_days[$i-1]){
                                        $past_month_sec += $months_days[$i-1] * 86400;
                                        break;
                                    }
                                }
                                echo "</tr>";    
                            }
                            $first_daynum = 1;
                            
                        }
                        echo "</table>";
                    }
                    
                ?>

            </div>
            <div class="col-lg-2 col-xs-2 col-sm-2 col-md-2">
            
            </div>
        </div>

    </div>
</div>
