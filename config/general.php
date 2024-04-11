<?php
//---------------------------------------------------------------------------------
//Author: Alex Merriam
//Date: 04-11-2023
//Version: 3.2 API Public Release
//Codename: Benedict
//---------------------------------------------------------------------------------

//System modifications and settings.
$IPAddress = '0.0.0.0'; # Change this to 'IPV4' if you are using an IPV4 address.
$port = '8000';
$URL = 'http://localhost'; # Change this to the URL of your site if you are not running it locally.
$API_URL = 'https://api.lillith.io'; # Change this to the URL of your API if you are not running it from the parent server.
$site_name = 'lillith.io';
$favicon = "{$URL}/assets/favicon.png";
$textbox_placeholder = 'When in doubt, type a dot ;3';
$extra_headers = "<link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0\" />";
$description = "Browse the past as it was meant to be viewed. From webpages to zip files lillith has you covered.";
$slogan = "Reality at your fingertips";

//Modal modifications
$modal_style_modifier = "--bs-modal-bg:rgba(var(--bs-black-rgb), var(--bs-bg-opacity)) !important";
$nsfw_block_msg = "This file is marked as unsafe for general audiences. By downloading and viewing this content, you are stating that you are above 18 years old.";
$download_only_msg = "File is not viewable in browser and must be downloaded.";
$download_only_img_src = "{$URL}/assets/file_favicon.png";
$nsfw_img_src = "{$URL}/assets/nsfw_favicon.png";

//Icon packs and modifiers
$icon_source = "material-symbols-outlined"; #This is the Google Material Icons package
$download_only_icon = "folder_zip";
$nsfw_icon = "explicit";
$web_icon = "globe";
$media_preview_icon = "perm_media";
$web_preview_icon = "web";
$download_icon = "Download";
$archival_icon = "archive";
$platform_icon = "deployed_code";

//Link colors
$attachment_link_color = "";

//Sidebar themes
$highlighted_sidelink = "bg-black border-info bg-opacity-10 text-info link-info";
$default_sidelink  = "bg-black bg-opacity-10 link-light border-secondary";
$default_divider = "border-light";
$highlighted_divider = "border-info";
$highlighted_table = "";
$default_table = "";

//Table Modifications
$table_css_modifier = "--bs-table-bg:none;";
$table_theme = "table-bordered";

//List modifications
$list_css_modifier = "--bs-list-group-bg:none;";
$list_theme = "";

?>