<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function qrcode_create($data, $errorCorrectionLevel = 'H', $matrixPointSize = '13', $prefix = 'barcode_') {
    if ( ! in_array($errorCorrectionLevel, array('L','M','Q','H')))
        $errorCorrectionLevel = 'L' ;    

    $filename = $prefix.md5($data).'.png' ;
    
    $pathname = 'assets/upload/pasien/qrcode/'. $filename ;
    
    if (file_exists($pathname)) {
        return $filename ;
    }
    else {
        require_once("qrcode/qrlib.php") ;
        QRcode::png($data, $pathname, $errorCorrectionLevel, $matrixPointSize, 2);       
        
        return $filename ;
    }
}

/* End of file qrcode_helper.php */
/* Location: ./application/helpers/qrcode_helper.php */
