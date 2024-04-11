<?php
//---------------------------------------------------------------------------------
//Author: Alex Merriam
//Date: 04-11-2023
//Version: 3.2 API Public Release
//Codename: Benedict
//---------------------------------------------------------------------------------

    $mainPanel = '<br><br><h2 class="LillithFont">Latest Archived Instances</h2><hr>';
    require_once("{$_SERVER['DOCUMENT_ROOT']}/libraries/api.php");
	foreach(getLatest() as $listingNumber){
    	$instanceData = json_decode(getInstance($listingNumber),True);
    	$metaData = count($instanceData['meta_data']);
    	$iterator = 0;
    	foreach($instanceData['media_references'] as $key=>$variable){
        	++$iterator;
        }
    	$mainPanel.="<a href=\"https://lillith.io/?search=.&id={$listingNumber}\" class=\"text-decoration-none link-light\">
					 <div class=\"p-3 bg-black bg-opacity-10 mt-3 border border-secondary rounded\">
      					<h3>{$instanceData['embed_data']['text']}</h3>
					    <hr class=\"border border-white\">
        				<table class=\"table {$table_theme}\" style=\"{$table_css_modifier}\">
                        	<thead>
                      	      <tr>
                  	            <th>Data Types:</th>
                                <th>Returned Quantity:</th>
                               </tr>
                            </thead>
                        	<tbody>
                               <tr>
                                <th scope=\"row\">data_variables</th> 
                                <td>{$metaData}</td>                                      
                               </tr>
                               <tr>
                                <th scope=\"row\">data_variables</th> 
                                <td>{$iterator}</td>                                      
                               </tr>
                            </tbody>
      					</table>
    				 </div>
                     </a>";
    }
	$mainPanel.="<br>";
?>