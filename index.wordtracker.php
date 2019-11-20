<?php 
ini_set('display_errors', 1);

define('DIR_INCLUDES',    CODE_BASE . 'public_html/includes/');

require_once(CODE_BASE."includes/toolbox.php");
$header = new YostWorksHeader();


require_once DIR_INCLUDES.'google/vendor/autoload.php';

$client = new \Google_Client();
$client->setApplicationName('WordTracker');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(DIR_INCLUDES.'project-id-[IDFORYOURPROJECT].json');
$service = new Google_Service_Sheets($client);
$spreadsheetId = "[IDFORYOURSPREADSHEET]";

$range = 'Sprint Tracker';
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$dataSet = returnAPIResponseAsKVPArray($response->getValues());

$class_array = array();

/* Gray */

$class_array[0]["class"] = "word-tracker-0";
$class_array[0]["top_word_value"] = 0;
$class_array[0]["background-color"]="#717171;";
$class_array[0]["color"]="#aaa";

/* Greem */

$class_array[1]["class"] = "word-tracker-1";
$class_array[1]["top_word_value"] = 249;
$class_array[1]["background-color"]="#799400";
$class_array[1]["color"]="#eee";

$class_array[2]["class"] = "word-tracker-2";
$class_array[2]["top_word_value"] = 499;
$class_array[2]["background-color"]="#349400";
$class_array[2]["color"]="#eee";


$class_array[3]["class"] = "word-tracker-3";
$class_array[3]["top_word_value"] = 999;
$class_array[3]["background-color"]="#147502";
$class_array[3]["color"]="#eee";



$class_array[4]["class"] = "word-tracker-4";
$class_array[4]["top_word_value"] = 1249;
$class_array[4]["background-color"]="#0e5202";
$class_array[4]["color"]="#eee";

/* Blue */


$class_array[5]["class"] = "word-tracker-5";
$class_array[5]["top_word_value"] = 1499;
$class_array[5]["background-color"]="#016d80";
$class_array[5]["color"]="#eee";


$class_array[6]["class"] = "word-tracker-6";
$class_array[6]["top_word_value"] = 1999;
$class_array[6]["background-color"]="#015680";
$class_array[6]["color"]="#eee";

$class_array[7]["class"] = "word-tracker-7";
$class_array[7]["top_word_value"] = 2999;
$class_array[7]["background-color"]="#013280";
$class_array[7]["color"]="#eee";

/* Purple */


$class_array[8]["class"] = "word-tracker-8";
$class_array[8]["top_word_value"] = 3999;
$class_array[8]["background-color"]="#360180";
$class_array[8]["color"]="#eee";


$class_array[9]["class"] = "word-tracker-9";
$class_array[9]["top_word_value"] = 4999;
$class_array[9]["background-color"]="#560180";
$class_array[9]["color"]="#eee";

$class_array[10]["class"] = "word-tracker-10";
$class_array[10]["top_word_value"] = 999999;
$class_array[10]["background-color"]="#7c0180";
$class_array[10]["color"]="eee";


/*
$class_array[0]["key"] = "n0";
$class_array[0]["top_word_value"] = 0;
$class_array[0]["background-color"]="#717171";
$class_array[0]["color"]="#aaa";
*/
;


?>

<!doctype html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Fred's Word Tracker</title>

<?php 
  foreach($header->returnIncludes("CSS") as $integrity => $filename)
  {
      echo "<link rel='stylesheet' href='".$filename."' integrity='".$integrity."' crossorigin='anonymous' >";
  }
  foreach($header->returnIncludes("JS") as $integrity => $filename)
  {
      echo "<script src='".$filename."' integrity='".$integrity."' crossorigin='anonymous' ></script>";
  }
  foreach($header->returnIncludes("CSS-DARK") as $integrity => $filename)
  {
      echo "<link rel='stylesheet' href='".$filename."'>";
  }
?>

<?php 

echo "<style>
.word-tracker
{
   border: thin solid #aaa;
}
";

foreach($class_array as $class_item)
{
    echo " .".$class_item["class"]."{background-color:".$class_item["background-color"].";color:".$class_item["color"].";}";
}
echo "</style>";
?>

</head>
<body>
<?php

echo $header->returnHeader("Word Tracker");

?>

<?php 
/*
echo "<pre>";
print_r($dataSet);
echo "</pre>";
*/


echo "<div class='container-fluid my-2 px-4'>";
// echo "<div class='row'>";

$year = date("Y");

$dateSet =  returnDateArray($year);
$months = array("");

$daily_words = translateSprintsToDailyWords($dataSet, "Date", "Session Wordcount");

$daily__array = array();
$week_array = array();
$month_array = array();
$year_array = array();
$word_per_day_denom = array();

foreach($dateSet as $day => $array)
{
    if($month != $array["monthTitle"])
    {
        $month = $array["monthTitle"];
        $intramonth_counter = 0;
                
        for($i = 1; $i < $array["firstDayOfWeekOfMonth"]; $i++)
        {
            $daily__array[$month][$intramonth_counter]["TITLE"] = "";
            $daily__array[$month][$intramonth_counter]["VALUE"] = "";
            $intramonth_counter++;
        }
        
    }

    $daily__array[$month][$intramonth_counter]["TITLE"]= $array["dayOfMonth"];
    $words = $daily_words[$day];
    if(!$words && $array["futureInd"] == "N")
    {
        $words = 0;
    }
    elseif(!$words && $array["futureInd"] == "Y")
    {
        $words = "&nbsp;";
    }
    
    $daily__array[$month][$intramonth_counter]["VALUE"]=$words;
    $intramonth_counter++;
    
    if($array["dayOfMonth"] == $array["daysInMonth"] && $intramonth_counter %7 != 0 )
    {
        
        for($i =  $intramonth_counter % 7 + 1; $i <= 7 ; $i++ )
        {
            $daily__array[$month][$intramonth_counter]["TITLE"]= "";
            $daily__array[$month][$intramonth_counter]["VALUE"]= "";
            $intramonth_counter++;
        }
    }
    
    $week_array[$array["week"]]+= $daily_words[$day];
    $month_array[$array["monthTitle"]]+= $daily_words[$day];
    $year_array[$array["year"]]+= $daily_words[$day];
    
    if($array["futureInd"] == "N")
    {
        $word_per_day_denom[$array["year"]]++;
    }
    
}


echo "<pre>";
// print_r($daily__array);
echo "</pre>";

$tables = array();



foreach($daily__array as $month_title => $days)
{
     $tables[$month_title] = "<div class=''>";
     $tables[$month_title].= "<h5 class='text-center'>".$month_title."</h5>";
     $tables[$month_title].= "<table class='table table-sm border border-dark'>";
     $date_row = "<tr>";
     $values_row = "<tr>";
     
     foreach($days as $key => $day_array)
     {
         if($key % 7 == 0)
         {
             $date_row.= "</tr>";
             $values_row.= "</tr>";
             $tables[$month_title].= $date_row;
             $tables[$month_title].=  $values_row;
             $date_row = "<tr>";
             $values_row = "<tr>";
         }
         
         $date_class = "table-dark border border-light text-center";
         
         if($day_array["TITLE"] == "")
         {
             $date_class = "btn-dark disabled";
         }
         
         $values_class = "text-center ";
         $ranking_class = "word-tracker-0 border border-light";
         $prev_top_wordcount = 0;
         
         foreach($class_array as $class_item)
         {
             
             if($day_array["VALUE"] === "")
             {
                 $ranking_class = "btn-dark disabled";
             }
             elseif($day_array["VALUE"] === "&nbsp;")
             {
                 $ranking_class = "word-tracker border border-light";
             }
             elseif($day_array["VALUE"] >= $prev_top_wordcount+1)
             {
                 $ranking_class = "border border-light word-tracker ".$class_item["class"];
             }
             $prev_top_wordcount =  $class_item["top_word_value"];
         
         }
         
         $values_class.= " ".$ranking_class;
                  
         $date_row.= "<td class='".$date_class."'>".$day_array["TITLE"]."</td>";
         $values_row.= "<td class='".$values_class."'>".$day_array["VALUE"]."</td>";
     
     }
     
     $date_row.= "</tr>";
     $values_row.= "</tr>";
     $tables[$month_title].= $date_row;
     $tables[$month_title].=  $values_row;
      
     $tables[$month_title].= "</table>";
     $tables[$month_title].= "</div>";
    
}
echo "<div class='row'>";
echo "<div class='col-lg-4'>";
$counter = 0;

foreach($tables as $tr)
{
    echo $tr; 
    $counter++;
    
    if($counter == 6)
    {
        echo "</div>";
        echo "<div class='col-lg-2 text-center'>";
        echo "<div class='pb-1'><h3>".$year."</h3></div>";
        $prev_top_wordcount = 0;
        
        foreach($class_array as $class_item)
        {
            if($class_item["top_word_value"] === 0)
            {
                $display_value = 0; 
            }
            else
            {
                $display_value = $prev_top_wordcount+1;
            }
            
            echo "<div class='word-tracker ".$class_item["class"]." col-6 py-1 mx-auto'>".$display_value."</div>";
            $prev_top_wordcount = $class_item["top_word_value"];
        }
        
        echo "<div class='col-6 mt-2 mx-auto word-tracker table-dark'><h5 class='mt-2'>Yearly Total</h5>";
        echo "</div>";
        echo "<div class='col-6 mx-auto word-tracker table-info'><h6 class='mt-2'>".number_format($year_array[$year])."</h6>";
        echo "</div>";
        
        echo "<table class='my-3 table table-sm col-lg-6 mx-auto table-hover'><thead class='sticky-top border border-light'><tr class='table-primary'><th class='border border-light table-primary'>Week</th><th class='border border-light table-primary'>Total</th></tr></thead>";
        echo "<tbody>";
        
        foreach($week_array as $key => $value)
        {
            echo "<tr><th class='table-secondary border border-light'>".$key."</th><th class='table-dark border border-light'>".number_format($value)."</th></tr>";
        }
        
        echo "</tbody></table>";
        
        echo "</div>";
        echo "<div class='col-lg-4'>";
    }
}
echo "</div>";
echo "</div>";

/*
echo "<h3>Sprint Tracker</h3>";
echo "<table class='table table-hover table-striped table-sm'>";

foreach($dataSet as $key => $tableRow)
{
    if($key === 0)
    {
        echo "<thead>";
        echo "<tr class='table-secondary sticky-top'>";
        
        foreach($tableRow as $tableCell)
        {
            echo "<th>".$tableCell."</th>";
        }
        
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
    }
    elseif($tableRow["Date"] != "")
    {
        echo "<tr>";
        
        foreach($tableRow as $tableCell)
        {
            echo "<td>".$tableCell."</td>";
        }
        
        echo "</tr>";
    
    }
}

echo "</tbody>";
echo "</table>";

*/

// echo "</div>";
echo "</div>";

?>

</body>
</html>

<?php
function returnAPIResponseAsKVPArray($responseValues)
{
    $dataRow = array();
    $row_counter = 0;
    $key_values = array();
    
    foreach ($responseValues as $row) 
    {
        $new_row = array();
       
        if($row_counter == 0)
        {
            for ($i = 0; $i < sizeof($row); $i++) 
            {
                $key_values[$i] = $row[$i];
            }
        }      
        for ($i = 0; $i < sizeof($row); $i++) 
        {
            $new_row[$key_values[$i]] = $row[$i];
        }
        
        $dataRow[] = $new_row;
        $row_counter++;
    }
    
    return $dataRow; 
} // end returnAPIResponseAsKVPArray

function returnDateArray($year = "2019")
{
    $dateArray = array();
    $date1 = DateTime::createFromFormat('Y-m-d H:i:s', $year.'-01-01 00:00:00');
    $check_year = $date1 ->format('Y');
    $today = new DateTime('NOW');
    
    do
    {
        $key = $date1 ->format('j-M-Y');
        $future_ind = "N";
        
        if($date1 > $today )
        {
           $future_ind = "Y";
        }
        
        if($date1->format('j') == "1")
        {
          $first_day_of_week_month = $date1 ->format('N');
        }
        
        
        $dateArray[$key] = array(
            "date" => $date1 ->format('j-M-Y'),
            "dayOfWeek" => $date1 ->format('N'),
            "dayOfWeekLabel" => $date1 ->format('D'),
            "dayOfMonth" => $date1 ->format('d'),
            "year" => $date1 ->format('Y'),
            "month" => $date1 ->format('n'),
            "monthTitle" => $date1 ->format('F'),
            "daysInMonth" => $date1 ->format('t'),
            "week" => $date1 ->format('W'),
            "dayOfYear" => $date1 ->format('z'),
            "firstDayOfWeekOfMonth" => $first_day_of_week_month,
            "futureInd" => $future_ind
        );
        $date1->add(date_interval_create_from_date_string('1 day'));
        $check_year = $date1 ->format('Y');
    } while ($check_year == $year);
    return $dateArray;
}

function translateSprintsToDailyWords($dataset = array(), $date_column = "Date", $countColumn = "Session Wordcount")
{
    $daily_words_array = array();
    
    foreach($dataset as $row)
    {
        if($row[$date_column] && $row[$date_column] != "Date")
        {
            $daily_words_array[$row[$date_column]] += $row[$countColumn];
        }
    }
    
    return $daily_words_array;
}

function returnClassFromValue($value, $class_array = array())
{
    
}

?>