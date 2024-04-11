# LILLITH.IO Website UI

Public Version: 3.2

[Configuration Files](config/general.php)

The configuration file is located in `/config/general.php` within the repository.

You will need to modify it to fit your instances configuration before the website can display content correctly and interact with the Lillith API. <br><br>
The main things you will need to set will be the `$IPAddress`, `$APIUrl`, and `$URL`.

`$IPAddress` - will need to be set as the IP of the API that will be used as the data source.
`$APIUrl` - will be the URL of the same API.
`$URL` - Will be where the client points to when accessing webpages. <h6>NOTE: Remote hosts will need to set the URL to the URL where the website is hosted at.</h6>

# Resources and Compatibility

Lillith was made using the following libraries:
<ul>
  <li><a href="https://fonts.google.com/icons">Google Material Icons</a></li>
  <li><a href="https://getbootstrap.com/docs/5.3/getting-started/introduction/">Bootstrap 5.3.3</a></li>
</ul>