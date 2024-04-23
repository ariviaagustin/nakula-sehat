<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('sms_send')) {
    
    /*function sms_send($msisdn,$sms) {
        if (!empty($msisdn) && !empty($sms)) {
            $url    = _SMS_URL_.'?uid='._SMS_USER_.'&pwd='._SMS_PASSWORD_.'&msisdn='.$msisdn.'&sms='.urlencode($sms) ;
			
			//die($url) ;
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 120); //timeout after 120 seconds
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            $result=curl_exec ($ch);
            curl_close ($ch);

            if (!empty($result)) return TRUE ;
        }
        
        return FALSE ;
    } */
	
    function sms_send($sms_to,$sms_msg)  {
        $user       = 'API8776CKUOMP' ;
        $pass       = 'API8776CKUOMP8776C' ;
        $sms_from   = 'KLHK' ;

        $query_string = "api.aspx?apiusername=".$user."&apipassword=".$pass;
        $query_string .= "&senderid=".urlencode($sms_from)."&mobileno=".urlencode($sms_to);
        $query_string .= "&message=".urlencode($sms_msg) . "&languagetype=1";        
        $url = "http://gateway.onewaysms.co.id:10002/".$query_string;       

        //die($url) ;

        $fd = @implode ('', file ($url));      
        if ($fd) {                       
            if ($fd > 0) {
                return TRUE ;
            }    
        }    

        return FALSE ;
    } 
}

/* End of file sms_helper.php */
/* Location: ./application/helpers/sms_helper.php */