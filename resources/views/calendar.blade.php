@extends('welcome')

<?php
function build_calendar($month, $year){
    //fist of all we'll create an array containing names of all days in a week
    $daysOfWeek = array('Lunedy', 'Martedi', 'Merquledi', 'Giovedi', 'Venerdi', 'Sabato', 'Domenica');

    //then we'll get the first day of the month that is in the argument of this function
    $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

    //Now getting the number of days this month contains
    $numberDays = date('t', $firstDayOfMonth);

    //Getting some information about the first day of this month
    $dateComponents = getdate($firstDayOfMonth);

    //getting the name of this month
    $monthName = $dateComponents['month'];

    //getting the index value 0-6 of the first day of this month
    $dayOfWeek = $dateComponents['wday'];

    //getting the current date
    $dateToday = date('Y-m-d');

    //now creating the HTML table
    $calendar = "<table class='table table-bordered'>";
    $calendar.="<center><h2>$monthName $year</h2>";
    $calendar.="<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0,0,0,$month-1,1,$year))."&year=".date('Y', mktime(0,0,0,$month-1,1,$year))."'>Previous Month</a> ";
    $calendar.=" <a class='btn btn-xs btn-primary' href='?month=".date('m')."&year=".date('Y')."'>Current Month</a> ";
    $calendar.=" <a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0,0,0,$month+1,1,$year))."&year=".date('Y', mktime(0,0,0,$month+1,1,$year))."'>Next Month</a></center><br>";

    $calendar.="<tr>";

    //creating the calendar headers
    foreach ($daysOfWeek as $day){
        $calendar.="<th class='header'>$day</th>";
    }

    $calendar.="</tr><tr>";

    //the variable $dayOfWeek will make sure that there must be only 7 columns on our table
    if($dayOfWeek > 0){
        for($k=0; $k<$dayOfWeek; $k++){
            $calendar.="<td></td>";
        }
    }

    //initiating the day counter
    $currentDay = 1;

    //getting the month number
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    while($currentDay <= $numberDays){
        //if seventh column (saturday) reached , start a new row

        if($dayOfWeek == 7){
            $dayOfWeek = 0;
            $calendar.="</tr><tr>";
        }


        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";

        $dayname = strtolower(date('I', strtotime($date)));
        $eventNum=0;

        $today = $date == date('Y-m-d')?"today":"";

        if($date > date('Y-m-d')){
            $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>N/A</button>";
        }else{
            $calendar.="<td class='$today'><h4>$currentDay</h4> <a href='/add/".$date."' class='btn btn-success btn-xs'>add Hour</a>";
        }

//            if($dateToday == $date){
//                $calendar.="<td class='todayY'><h4>$currentDay</h4>";
//            }else{
//                $calendar.="<td><h4>$currentDay</h4>";
//            }

        $calendar.="</td>";

        //incrementing the counters
        $currentDay++;
        $dayOfWeek++;
    }

    //completing the row of the last week in month, if necessary
    if($dayOfWeek != 7){
        $remainingDay = 7-$dayOfWeek;
        for($i=0; $i<$remainingDay; $i++){
            $calendar.="<td></td>";
        }
    }

    $calendar.="</tr>";
    $calendar.="</table>";

    echo $calendar;
}
?>

@section('header')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <style>
        table{
            table-layout: fixed;
        }

        td{
            width: 33%;
        }

        .todayY{
            background: #ffff00;
        }
    </style>
@endsection



@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                $dateComponents = getdate();
                $month = $dateComponents['mon'];
                $year = $dateComponents['year'];
                echo build_calendar($month, $year);
                ?>
            </div>
        </div>
    </div>
@endsection



@section('scripts')

@endsection
