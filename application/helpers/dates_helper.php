<?php



	function toWords ($w_date,$days = FALSE, $short = FALSE) {
        if ($days)	$words[]	= DataDay(date("w",strtotime($w_date)),$short) .',' ;

        $words[]	= date("j",strtotime($w_date)) ;
        $words[] 	= DataMonth(date("m",strtotime($w_date)),$short) ;
        $words[] 	= date("Y",strtotime($w_date)) ;

        return implode(' ',$words) ;
    }

    function DataMonth($m = NULL,$short = FALSE) {
        $months = array(
                    '01'    => $short ? 'Jan' : 'Januari'    ,
                    '02'    => $short ? 'Feb' : 'Februari'   ,
                    '03'    => $short ? 'Mar' : 'Maret'      ,
                    '04'    => $short ? 'Apr' : 'April'      ,
                    '05'    => $short ? 'Mei' : 'Mei'       ,
                    '06'    => $short ? 'Jun' : 'Juni'       ,
                    '07'    => $short ? 'Jul' : 'Juli'       ,
                    '08'    => $short ? 'Agu' : 'Agustus'     ,
                    '09'    => $short ? 'Sep' : 'September'  ,
                    '10'    => $short ? 'Okt' : 'Oktober'    ,
                    '11'    => $short ? 'Nov' : 'November'   ,
                    '12'    => $short ? 'Des' : 'Desember'
            ) ;

        return $m !== NULL ? $months[$m] : $months ;
    }

    function DataDay($w = NULL , $short = FALSE) {
    	$days   = array(
                    '0'    => $short ? 'Min' : 'Minggu' ,
                    '1'    => $short ? 'Sen' : 'Senin'  ,
                    '2'    => $short ? 'Sel' : 'Selasa' ,
                    '3'    => $short ? 'Rab' : 'Rabu' 	,
                    '4'    => $short ? 'Kam' : 'Kamis'  ,
                    '5'    => $short ? 'Jum' : 'Jumat'  ,
                    '6'    => $short ? 'Sab' : 'Sabtu'  ,
                ) ;

        return $w !== NULL ? $days[$w] : $days ;
    }