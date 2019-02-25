<?php

class humanoidTime{
    
    private $time,$day,$getTime,$getDay;
    private $timeDiff;
    private $getDate = ["","","","","",""];
    private $date;

    public function __construct(){
        $this->time = time();
        // Calculates the seconds of the current time
        $this->day  = mktime(0,  0 ,  0 , $month = date("n") , $day = date("j") , date("Y"));
    }

    public function getHumanoid($date){
        // Format capture
        if (is_numeric($date) && (strlen($date)==14)) 
        {
            $this->date = $date;
            
        }
        else if(strstr($date, '/'))
        {
            $this->date = str_replace('/', '', $date).'<br>';
        }
        else
        {
            echo 'Invalid date';
        }



        // Splits time into arrays
        for ($i = 0; $i < 6; $i++){
            $slipter    = ($i == 2) ? 4 : 2;
            $multipler  = ($i > 2)  ? ($i+1)*2/$i: 2;
            $this->getDate[$i] = substr($this->date, $i*$multipler,$slipter);
        }

        $this->getTime = mktime(
        $this->getDate[3],
        $this->getDate[4],
        $this->getDate[5],
        $this->getDate[1],
        $this->getDate[0],
        $this->getDate[2]
        );
        // Difference between sent value and present time
        $this->timeDiff = $this->time - $this->getTime;

        if ($this->timeDiff>=0){
            $this->timeToString($this->timeDiff);
        }
        else{
                // Coming soon :d
            echo 'Future time';
        }
    }


    private function timeConvert($value,$type=6){
        // Converts value to desired value in seconds  
        //0 => Year, 1 => Month, 2 => Week, 3 => Day, 4 => Hour, 5 => Minute, 6 => Second
        switch ($type) {
             case 0:
             return $value/31556926;
                 break;
             case 1:
             return $value/2629743.83;
                 break;
             case 2:
             return $value/604800;
                 break;
             case 3:
             return $value/86400;
                 break;
             case 4:
             return $value/3600;
                 break;
             case 5:
             return floor($value/60);
                 break;
             default:
             return $value;
                 break;
         } 
    }

    private function timeToString($value)
    {
        // Convert time language to string
        if ($value <= 300) 
        {
            if ($value <= 180) 
            {
                echo 'Just now';       
            }
            else
            {
                echo 'A few minutes ago';
            }
        }
        else if ($value < 3600)
        {
            if ($this->timeConvert($value,5) > 29 && $this->timeConvert($value,5) < 31) 
            {
                echo 'Half an hour ago';
            }
            else
            {   
                echo $this->timeConvert($value,5).' minutes ago';   
            }
        }   
        else if($value < 86400)
        {
            if ($value > 4300 && $value<7920) 
            {
                echo 'A few hours ago';
            }
            else
            {
                echo round($this->timeConvert($value,4)).' hours ago';
            } 
        }
        else if($value < 2629743.83)
        {
            if ($value >= 86400 && $value < 172800) 
            {
                echo 'Yesterday';    
            }
            else
            {
                if ((round($this->timeConvert($value,3))%7) == 0) 
                {
                    echo (round($this->timeConvert($value,3))/7).' weeks ago';    
                }
                else
                {
                    echo round($this->timeConvert($value,3)).' days ago';
                }
            }
        }
        else if($value < 31536014)
        {
            if (floor($this->timeConvert($value,1)) == 1) 
            {
                echo 'Last month';
            }
            else if (floor($this->timeConvert($value,1)) > 1 && floor($this->timeConvert($value,1)) <= 3) 
            {
                echo 'A few months ago';   
            }
            else
            {
                echo floor($this->timeConvert($value,1)).' months ago';
            }
        }
        else if($value >= 31536014)
        {
            if (round($this->timeConvert($value,0)) == 1) 
            {
                echo 'Last Year';
            }
            else
            {
                echo round($this->timeConvert($value,0)).' years ago';
            }
        }
    }
}

?>