<?php
//---------------------------------------------------------------------------------
//Author: Alex Merriam
//Date: 04-11-2023
//Version: 3.2 API Public Release
//Codename: Benedict
//---------------------------------------------------------------------------------

    require("{$_SERVER['DOCUMENT_ROOT']}/content/home.php");
    require("{$_SERVER['DOCUMENT_ROOT']}/components/layout.php");

	$tabPanel = array(
    				"latest" => ["Latest captures", "Look at the latest archives","{$URL}/"],
                    "about" => ["About", "Why we exist","{$URL}/?page=about"],
    				"api" => ["API", "Get API access","{$URL}/?page=api"],
                    "privacy" => ["Privacy", "Your rights to privacy","{$URL}/?page=privacy"],
                    "socials" => ["Follow on social media", "List of social media apps","{$URL}/?page=socials"],
                    "support" => ["Support us", "Support Lilliths mission","{$URL}/?page=support"]
                );


    if($_GET AND !empty($_GET['search'])){
        require("{$_SERVER['DOCUMENT_ROOT']}/content/search.php");
    } elseif($_GET AND !empty($_GET['id'])){
        require("{$_SERVER['DOCUMENT_ROOT']}/content/search.php");
    }
    if($_GET AND !empty($_GET['page']) AND !isset($_GET['search'])){
        if(array_key_exists($_GET['page'],$tabPanel)){
            array_push($tabPanel[$_GET['page']], "Highlighted");
            require("{$_SERVER['DOCUMENT_ROOT']}/content/{$_GET['page']}.php");
        }
    } elseif(!isset($_GET['search'])){
        array_push($tabPanel["latest"], "Highlighted");
    }
?>