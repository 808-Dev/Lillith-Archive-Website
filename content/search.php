<?php
    //---------------------------------------------------------------------------------
    //Author: Alex Merriam
    //Date: 04-11-2023
    //Version: 3.2 API Public Release
    //Codename: Benedict
    //---------------------------------------------------------------------------------

	require("{$_SERVER['DOCUMENT_ROOT']}/config/general.php");
    require_once("{$_SERVER['DOCUMENT_ROOT']}/libraries/api.php");
    $mainPanel = "";
    $tabPanel = array("home" => ["Home", "Go back","javascript:history.back()"]);
    
	
	//This keeps the current result highlighted instead of resorting to the home button for highlighting
	if(!isset($_GET['id'])){
        array_push($tabPanel["home"], "Highlighted");
    }

	//This takes the listings and converts the mess of data into something that is more readable.

    foreach(getListings($_GET['search']) as $listingNumber){ //Take the list that the API gives
        $singleInstance = json_decode(getInstance($listingNumber),True); //Send it into the API to get the instance that is sent back
        $iterator = 0; 
    	$miniTable = "";
        $miniTableDefault = "<table class=\"table {$default_table}\" style=\"{$table_css_modifier}\"><tbody>";
        $miniTableSelected = "<table class=\"table {$highlighted_table}\" style=\"{$table_css_modifier}\"><tbody>";

        if(!empty($singleInstance['meta_data'])){ //If it's empty then ignore because there's something fucked with the instance and we can't trust it to work
            foreach($singleInstance['meta_data'] as $key => $value){ //Get the variables and keys
                    ++$iterator;
                    if($iterator < 3){
                        $miniTable.= "<tr><th scope=\"row\">{$key}</th> <td>{$value}</td></tr>"; //Save the variable and its value and redo 1 more time.
                    }
            }
            $miniTable.="</tbody></table>";
        
            if(isset($_GET['id']) AND $_GET['id'] == $singleInstance['archival_instance_id']){ 		//Check to see if the ID is selected.
                $tabPanel = $tabPanel + array(strval($singleInstance['archival_instance_id']) =>
                                                [explode(".",
                                                strval($singleInstance['create_time']))[0], //May change to something like the embedded title.
                                                "{$miniTableSelected}{$miniTable}",
                                                "{$URL}/?search={$_GET['search']}&id={$listingNumber}",
                                                "Highlighted"]); //This looks complicated and it needlessly is. Fuck you.
            } else {
                $tabPanel = $tabPanel + array(strval($singleInstance['archival_instance_id']) =>	//If it's not selected then don't highlight. 
                [explode(".",
                 strval($singleInstance['create_time']))[0], 
                 "{$miniTableDefault}{$miniTable}",
                 "{$URL}/?search={$_GET['search']}&id={$listingNumber}"]);
            }
        }
    }

    //When an ID is set, it will generate a new $mainPanel
    if(isset($_GET['id'])){
        $parentID = $_GET['id'];
      	//This is used for generating the webpage since it is not stored in the same area as normal files are stored.
    	$Addons.="<div class=\"modal h-100\" id=\"modal-web\" style=\"{$modal_style_modifier}\" tabindex=\"-1\" aria-hidden=\"true\"> 
            		<div class=\"modal-dialog modal-lg h-100 modal-fullscreen\">
            			<div class=\"modal-content h-75\">
                    		<div class=\"modal-header\">
    							<h1 class=\"modal-title \">	
                                    <a href=\"{$URL}/components/emulators/web.php?id={$parentID}\" class=\"link-muted link-light text-decoration-none {$icon_source}\" >
                                        {$download_icon}
                                    </a> 
                                </h1>
      		  					<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
            	            </div>
                	        <iframe class=\"modal-body\" src=\"{$URL}/components/emulators/web.php?id={$parentID}\" sandbox></iframe>
                    	</div>
                    </div>
                  </div>";	//icon reference stored in config.php file
        
        $attachementIterator = 0; //This is used to ID emulation and preview dialogs
        $fullTable = ""; //Used as a cleanslate for generating tables 
    	$mediaKeys = array(); //Used to store which links have which icons
        $singleInstance = json_decode(getInstance($_GET['id']),True); //The instance
    
    	//Link for toggling webpage emulation modal
    
        $Attachments = "<li class=\"list-group-item\">
							<a href=\"#\" data-bs-toggle=\"modal\" data-bs-target=\"#modal-web\" class=\"{$attachment_link_color} icon-link text-decoration-none\">
                            	<span class=\"{$icon_source}\">{$web_icon}</span>
                                Webpage Archive
                            </a>
                        </li>";
    
    	//Custom frame and link generation
    	//Instead of treating all of the data as normal data that can be previewed,
    	//it makes more sense to separate it into several different categories.
    	//Such categories are: media, webpage, nsfw, and file.
		//This keeps the browser from shitting itself and plopping unwanted files on a users pc
    	//and allows the site to keep safe from the possibility of legal action taken by a bunch
    	//of fucking karens because their walking stds saw a guys head getting chopped off or whatever.
    
        foreach($singleInstance['media_references'] as $key => $element){
            ++$attachementIterator;

            if(in_array("media",json_decode(getblobdata($element),True)['property_data']) == True){ //media - send to api
                $frame = "<iframe class=\"modal-body\" src=\"{$API_URL}/blob/{$element}\" sandbox></iframe>";
                $mediaKeys[$element] = "<span class=\"{$icon_source}\">{$media_preview_icon}</span>"; //icon reference stored in config.php file
            } elseif(in_array("webpage",json_decode(getblobdata($element),True)['property_data']) == True) { //webpage - send to emulator
                $frame = "<div class=\"p-1\">NOTE: Webpage emulation is currently in BETA testing. If a page does not load click the download button to view the original page with no sandboxing.</div> <br><br><iframe class=\"modal-body\" src=\"{$API_URL}/blob/{$element}\" sandbox></iframe>";
                $mediaKeys[$element] = "<span class=\"{$icon_source}\">{$web_preview_icon}</span>";	//icon reference stored in config.php file
            } elseif(in_array("webpage-chrome",json_decode(getblobdata($element),True)['property_data']) == True) { //webpage - send to emulator
                $frame = "<div class=\"p-1\">NOTE: This is meant for MHTML compatible browsers only. If it is not displaying correctly, please use <a href=\"https://chrome.google.com\">Chrome</a> or <a href=\"https://microsoft.com/edge\">Edge</a></div> <br><br><iframe class=\"modal-body\" src=\"{$API_URL}/blob/{$element}\" sandbox></iframe>";
                $mediaKeys[$element] = "<span class=\"{$icon_source}\">{$web_preview_icon}</span>";	//icon reference stored in config.php file
            } elseif(in_array("nsfw",json_decode(getblobdata($element),True)['property_data']) == True) { //nsfw - block and enforce download only policy
                $frame = "<div class=\"modal-body\">
                            <div class=\"position-absolute top-50 start-50 translate-middle\">
                                <img src=\"{$nsfw_img_src}\">
                                <h3 class=\"text-center\">
                                    {$nsfw_block_msg}
                                </h3>
                            </div>
                          </div>";
                $mediaKeys[$element] = "<span class=\"{$icon_source}\">{$nsfw_icon}</span>";	//icon reference stored in config.php file
            } else { //file - enforce a download only policy
                $frame = "<div class=\"modal-body\">
                            <div class=\"position-absolute top-50 start-50 translate-middle\">
                                <img src=\"{$download_only_img_src}\">
                                <h3 class=\"text-center\">
                                    {$download_only_msg}
                                </h3>
                            </div>
                          </div>";
                $mediaKeys[$element] = "<span class=\"{$icon_source}\">{$download_only_icon}</span>";	//icon reference stored in config.php file
            }
        
        	//General modal configuration
        
        	$Addons.="<div class=\"modal h-100\" id=\"modal-{$attachementIterator}\" style=\"{$modal_style_modifier}\" tabindex=\"-1\" aria-hidden=\"true\">
            			<div class=\"modal-dialog modal-lg h-100 modal-fullscreen-lg-down\">
            				<div class=\"modal-content h-75\">
                        		<div class=\"modal-header\">
        							<h1 class=\"modal-title \">	
                                        <a href=\"{$API_URL}/blob/{$element}\" class=\"link-muted link-light text-decoration-none {$icon_source}\" download>
                                            {$download_icon}
                                       	</a> 
                                    </h1>
      		  						<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
            	                </div>
                	            {$frame}
                        	</div>
                        </div>
                      </div>";//icon reference stored in config.php file


			//This is where the attachments are generated and stored until usage.

        	$Attachments.="<li class=\"list-group-item\">
            					<a href=\"#\" data-bs-toggle=\"modal\" data-bs-target=\"#modal-{$attachementIterator}\" class=\"{$attachment_link_color} icon-link text-decoration-none\">
                                	{$mediaKeys[$element]} {$key}
                                </a>
                		   </li>";
        }

        if(!empty($singleInstance['meta_data'])){ //This generates a table for the meta data and stores them until use.
            foreach($singleInstance['meta_data'] as $key => $value){
                $fullTable.= "<tr><th scope=\"row\">{$key}</th> <td>{$value}</td></tr>";
            }
        }
        
        $mainPanel="<div class=\"container\">
                        <div class=\"container\">
                            <div class=\"container p-3\">
                                <h3 class=\"text-center\">{$singleInstance['create_time']}</h3>
                            </div>
                            <table class=\"table {$table_theme}\" style=\"{$table_css_modifier}\">
                                <thead><tr><th>Variable Name:</th><th>Variable Body:</th></tr></thead>
                                    {$fullTable}          
                                </tbody></table>
                            <div class=\"container\">
                                <p>Meta Data Attachments:</p>
                                <ul class=\"list-group\" style=\"{$list_css_modifier}\">
                                    <li class=\" list-group-item \">
                                    	<div class=\"icon-link text-decoration-none text-reset\">
                                    		<span class=\"{$icon_source}\">{$archival_icon}</span>
                                        	Time: {$singleInstance['create_time']}
                                        </div>
                                    </li>
                                    <li class=\"list-group-item\">
                                       <div class=\"icon-link text-decoration-none text-reset\">
                                    		<span class=\"{$icon_source}\">{$platform_icon}</span>
	                                        Platform: {$singleInstance['embed_data']['platform']}
    									</div>
    								</li>   
                                </ul>
                            </div>
                            <hr>
                            <div class=\"container\">
                                <p>Meta Data Attachments:</p>
                                <ul class=\"list-group\" style=\"{$list_css_modifier}\">
                                    {$Attachments}
                                </ul>
                            </div>
							{$Addons}
                        </div>
                    </div><br>";
    }
?>