<?php 

namespace Yostworks\Classes;

class WordTracker
{
    const VERSION = "1.0.0";
    const LAST_UPDATED = "2019/11/17";
    
    public function __construct()
    {
        // variables declared 
    } // end __construct 
    
    public function addYear($year = "2019")
    {
        // method that initiates the date pull to build a calendar for a specific year
        // needs to be called once per year 
    }
    public function setKeyLocation($location = null)
    {
        // passes the location of the 
    }
    public function setDailyWordGoal($dailyWordGoal = 500, $year = "2019")
    {
        // sets the words / day that user is trying to reach 
    } 
    public function setNaNoWriMoGoal($nanowrimoGoal = 50000, $year = "2019")
    {
        // set a different goal for NaNoWriMo
    }    
    public function setSheetName($sheetName = "Sprint Tracker")
    {
        // passes the name of the specfic sheet that stores the backend information 
    }   
    public function setSpreadSheetID($spreadsheetID = null)
    {
        // passes the ID of the google sheets spreadsheet that stores the backend information 
    }
    public function setWorkDaysPerWeek($workDays = 7)
    {
        // sets the number of days a user wants to work in a given week
    }
    public function setWordCountToColorArray($countToColorArray = array())
    {
        // alters defailt color scheme and word breaks 
    }
    public function returnDailyTracker($year = "2019")
    {
        // Retuns the full calendar format of the tracker 
    }
    public function returnWeeklyTracker($year = "2019", $order = "ranked")
    {
        // returns the weekly totals
        // option to return as ranked or chronological 
        // indicator for if weekly goal was reached 
    }
    public function returnMonthlyTacker($year = "2019")
    {
        // returns the Monthly Word Count tracker 
    }
    public function returnYearlyTracker()
    {
        // returns yearly total for all yeears that have been entered, ordered chronologically desc, with comparison to previous year

    }
    public function returnSprintTracker($year = "2019")
    {
        // Retuns the tracker in the format it is entered
    }


}

?>