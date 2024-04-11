<?php
    //---------------------------------------------------------------------------------
    //Author: Alex Merriam
    //Date: 04-11-2023
    //Version: 3.2 API Public Release
    //Codename: Benedict
    //---------------------------------------------------------------------------------

    require_once("{$_SERVER['DOCUMENT_ROOT']}/libraries/api.php");
	$singleInstance = json_decode(getInstance($_GET['id']),True);
    $webpageInstance = base64_decode(explode(":",$singleInstance['raw_data'])[2]);
	echo($webpageInstance);
?>