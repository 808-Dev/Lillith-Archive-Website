<!-- 
    ╭───────────────────────────────────╮
    │   Author: Alex Merriam            │ 
    │   Date: 04-11-2023                │ 
    │   Version: 3.2 Public Release     │ 
    │   Codename: Benedict              │ 
    ╰───────────────────────────────────╯  
-->

<head>
  <?php

    echo("<link rel=\"shortcut icon\" href=\"{$favicon}\">
          <title>{$site_name} - {$slogan}</title>
          <link href=\"{$URL}/assets/styles.css\" rel=\"stylesheet\">
		      <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH\" crossorigin=\"anonymous\">
          <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz\" crossorigin=\"anonymous\"></script>
          <meta property=\"og:description\" content=\"{$description}\"/>
          <meta property=\"og:type\" content=\"website\" />
  		    <meta property=\"og:site_name\" content=\"{$site_name}\" />
  		    <meta property=\"og:locale\" content=\"en_US\" />
  		    <meta property=\"og:url\" content=\"{$URL}\" />
  		    <meta property=\"og:image\" content=\"{$URL}/assets/opengraph_favicon.png\" />
          <meta property=\"og:description\" content=\"{$description}\"/>
          <meta name=\"twitter:card\" content=\"summary_large_image\">
    		  <meta property=\"twitter:domain\" content=\"{$site_name}\">
		      <meta property=\"twitter:url\" content=\"{$URL}\">
		      <meta name=\"twitter:title\" content=\"{$site_name} - {$slogan}\">
		      <meta name=\"twitter:description\" content=\"{$description}\">
		      <meta name=\"twitter:image\" content=\"{$URL}/assets/opengraph_favicon.png\">
          {$extra_headers}
         ");
  ?>
  


</head>