<?php
    require('ScrapMachine.php');
    
    $o = new cacharreoGeek\searchMachine('HyperX Pulsefire Surge');
    $o->init();
    
    //$result = $o->single('ebay.es');
    
    var_export($result);
?>