<?php
//---------------------------------------------------------------------------------
//Author: Alex Merriam
//Date: 04-11-2023
//Version: 3.2 API Public Release
//Codename: Benedict
//---------------------------------------------------------------------------------

    function getInstance($id='')
    {
        require("{$_SERVER['DOCUMENT_ROOT']}/config/general.php");
        return(file_get_contents("http://{$IPAddress}:{$port}/instance/{$id}"));
    }

    function getListings($query='')
    {
        require("{$_SERVER['DOCUMENT_ROOT']}/config/general.php");
        return(json_decode(file_get_contents("http://{$IPAddress}:{$port}/instance/tag/{$query}")));
    }

    function getLatest()
    {
        require("{$_SERVER['DOCUMENT_ROOT']}/config/general.php");
        return(json_decode(file_get_contents("http://{$IPAddress}:{$port}/instance/latest/")));
    }

	function getblobdata($id=0)
    {
    	require("{$_SERVER['DOCUMENT_ROOT']}/config/general.php");
        return(file_get_contents("http://{$IPAddress}:{$port}/blob/meta/{$id}"));
    }
?>