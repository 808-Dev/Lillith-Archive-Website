<?php
//---------------------------------------------------------------------------------
//Author: Alex Merriam
//Date: 04-11-2023
//Version: 3.2 API Public Release
//Codename: Benedict
//---------------------------------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<?php

	require("{$_SERVER['DOCUMENT_ROOT']}/config/general.php");
  require("{$_SERVER['DOCUMENT_ROOT']}/components/header.php");

  echo('<div class="row"><div class="col-3 bg-black vh-100" style="overflow: auto;">');

  require("{$_SERVER['DOCUMENT_ROOT']}/libraries/autorun.php");
  
  foreach($tabPanel as $element){
    echo(menuElement($element));
  }
  echo('</div>');

?>

<div class="col bg-black vh-100" style="overflow: auto;">
  <div class="container">
    <?php
      echo($mainPanel);
    ?>
  </div>
</div>