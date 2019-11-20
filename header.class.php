<?php 

class YostWorksHeader
{
    public function __construct()
    {
    
    } // end __construct 
    
    public function returnIncludes($fileType)
    {
       $fileArray = array();
       if($fileType=="JS")
       {
           $fileArray["sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"]="https://code.jquery.com/jquery-3.3.1.slim.min.js";
           $fileArray["sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"]="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js";
           $fileArray["sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"]="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js";
       }
       if($fileType=="CSS"){
           $fileArray["sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"]="https://use.fontawesome.com/releases/v5.8.1/css/all.css";
           $fileArray["sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"]="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css";    
       }
       if($fileType=="CSS-DARK"){
           $fileArray[]="https://[SITE].com/includes/css/bootstrap.dark.min.css";
       }
       
       return $fileArray;
    } // end returnIncludes
    
    public function returnHeader($pageName)
    {
        $headerString = "";
        $links = array();
        $links["Home"]="https://yostworks.com/";
        $links["About"]="https://yostworks.com/about";
        $links["Blog"]="https://yostworks.com/blog";
        $links["Word Tracker"]="https://www.yostworks.com/wordtracker/";
        $links["Stories"]["Skies of Wonder"]="https://skiesofwonder.com";
        $links["Stories"]["Free Short Stories"]="https://www.yostworks.com/blog/tag/flash-fiction/";
        $links["Stories"]["Mental Health"]="https://www.yostworks.com/blog/tag/mental-health/";
        $links["Stories"]["Data Visualizations"]="https://public.tableau.com/profile/fred.yost/";
        $links["Charity"]["Extra Life 2019"]="https://www.extra-life.org/index.cfm?fuseaction=donordrive.team&teamID=45298";
        
        $headerString .= "<nav class='navbar navbar-light navbar-expand-lg bg-primary'>";
        $headerString .= "<a class='navbar-brand' href='#'><i class='fa fa-cogs'></i>  YostWorks</a>";
        $headerString .= "<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>";
        $headerString .= "<span class='navbar-toggler-icon'></span>";
        $headerString .= "</button>";
        
        $headerString .= "<div class='collapse navbar-collapse' id='navbarNav'>";
        $headerString .= "<ul class='navbar-nav mr-auto'>";
        foreach($links as $title=>$link)
        {
            if(is_array($link))
            {
                $headerString .= "<li class='nav-item dropdown'>";
                $headerString .=  "<a class='nav-link dropdown-toggle' href='#' id='".$title."DropDown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
                $headerString .=  $title;
                $headerString .=  "</a>";
                $headerString .=  "<div class='dropdown-menu' aria-labelledby='".$title."DropDown'>";
                foreach($link as $t2=>$l2)
                {
                    $headerString .=  "<a class='dropdown-item' href='".$l2."'>".$t2."</a>";
                }
                $headerString .= "</div>";
            }
            else
            {
                $activeClass = "";
                if($pageName==$title)
                {
                    $activeClass = "active";
                }
                $headerString .= "<li class='nav-item ".$activeClass."'>";
                $headerString .=  "<a class='nav-link' href='".$link."'>".$title."</a>";
            }
            $headerString .= "</li>";
        }
        $headerString .= "</ul>";
        $headerString .= "<span class='navbar-text mr-3'>";
        $headerString .= "<a href='https://twitter.com/waidr' class=''><i class='fab fa-twitter btn btn-outline-light m-1'></i></a>";
        $headerString .= "<a href='https://www.twitch.tv/snark_runner/' class=''><i class='fab fa-twitch btn btn-outline-light m-1'></i></a>";
        $headerString .= "<a href='https://discord.gg/NegCdx4' class=''><i class='fab fa-discord btn btn-outline-light m-1'></i></a>";
        $headerString .= "<a href='mailto:webmaster@yostworks.com' class=''><i class='fas fa-envelope-open btn btn-outline-light m-1'></i></a>";
        $headerString .= "</span>";
        $headerString .= "</div>";
        $headerString .= "</nav>";
        
        return $headerString;
    } // end returnHeader


}


?>