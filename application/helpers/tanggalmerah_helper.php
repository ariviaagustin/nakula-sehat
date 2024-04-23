<?php 
    function tanggalmerah_helper($value) 
    {
        $array = json_decode(file_get_contents("https://raw.githubusercontent.com/guangrei/APIHariLibur_V2/main/calendar.json"),true);

        if(isset($array[$value]) && $array[$value]["holiday"])
        {
            $data = 1;
        }   
        elseif(date("D",strtotime($value))==="Sun")
        {
            $data = 1;
        }
        elseif(date("D",strtotime($value))==="Sat")
        {
            $data = 1;
        }
        else
        {
            $data = 2;
        }

        return $data;
    }
?>