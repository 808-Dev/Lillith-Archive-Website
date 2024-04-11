<?php
//---------------------------------------------------------------------------------
//Author: Alex Merriam
//Date: 04-11-2023
//Version: 3.2 API Public Release
//Codename: Benedict
//---------------------------------------------------------------------------------
?>
<ul class="nav justify-content-center p-3">
    <li class="nav-item">
        <a class="navbar-brand align-middle  text-white" href="/">
            <p class="fs-1 LillithFont">
                <img src="<?php echo("{$favicon}"); ?>" width="56" alt="">&nbsp; 
				<?php echo($site_name); ?>
            </p>
        </a>
    </li>
</ul>
<form class="mw-100" role="search" action="/" methods="get">
    <div class="input-group">
        <input type="text" 
               name="search" 
               class="form-control text-white text-start btn bg-black outline border-white border-start-0 border-end-0" 
               placeholder="<?php echo($textbox_placeholder); ?>" 
               style="border-radius:0px;">
        <button class="btn bg-black border-start-0 border-white text-white" 
                type="submit" 
                aria-expanded="false">
                Search
        </button>
    </div> 
</form>
                
<?php
function menuElement($element){
    require("{$_SERVER['DOCUMENT_ROOT']}/config/general.php");

    if(in_array("Highlighted",$element)){
        echo("<a href=\"{$element[2]}\" class=\"text-decoration-none\">
        		<div class=\"p-3 mt-3 border border-start-0 rounded-end overflow-hidden {$highlighted_sidelink}\">
                	{$element[0]}
                    <hr class=\"border {$highlighted_divider}\">
                    {$element[1]}
                </div>
              </a>");
    } else {
        echo("<a href=\"{$element[2]}\" class=\"text-decoration-none\">
        		<div class=\"p-3 mt-3 border border-start-0 rounded-end overflow-hidden {$default_sidelink}\">
		        	{$element[0]}
        			<hr class=\"border {$default_divider}\">
		        	{$element[1]}
        		</div>
        	  </a>");
    }
}
?>