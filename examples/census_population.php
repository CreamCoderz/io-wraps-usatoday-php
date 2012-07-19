<?php
/**
 * census_population.php
 *
 * I/O Wraps PHP Client Library Sample App for Census API 
 *
 * PHP version 5
 * 
 * @category Examples
 * @package  Mashery_IO_Wraps_USATODAY
 * @author   Neil Mansilla <neil@mashery.com>
 * @license  https://raw.github.com/mashery/io-wraps-usatoday-php/master/LICENSE.txt MIT License
 * @version  GIT: $Id:$
 * @link     https://github.com/mashery/io-wraps-usatoday-php/
 * 
 */
session_start();

require_once "../google-api-php-client/src/apiClient.php";
require_once "../google-api-php-client/src/contrib/apiCensusapiService.php";
$client = new apiClient();
$client->setDeveloperKey("YOUR_KEY_HERE");
$service = new apiCensusapiService($client);

$response = "";
$Response = "";
$Request = "";

if (isset($_GET['keypat'])) {
    $keypat = $_GET['keypat'];
    $keyname = $_GET['keyname'];
    $sumlevid = $_GET['sumlevid'];
    $response = $service->CensusResources->Population(
        array(
            "keypat"=>$keypat,
            "keyname"=>$keyname,
            "sumlevid"=>$sumlevid
            )
    );
    $Response = $response["response"];
    $Request = $response["request"];
}
?>

<!doctype html>
<html>
    <head>
        <link rel="stylesheet" 
            href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css" 
            media="screen" />
        <title>USA TODAY Census API - Sample App</title>
    </head>
    <body>
        <div class="container" id="mainwrap">
            <header>
                <h1>USA TODAY Census API - Sample App</h1>
            </header>
            <div class="box">
                <div class="request">
                    <form id="section" method="GET" action="census_population.php" 
                        class="well">
                        <table>
                            <tr><td>keypat</td><td><input type="text" name="keypat" 
                                value="greenville" /></td></tr>
                            <tr><td>keyname</td><td><input type="text" name="keyname" 
                                value="placename" /></td></tr>
                            <tr><td>sumlevid</td><td><input type="text" name="sumlevid" 
                                value="4,6" /></td></tr>
                        </table>
                        <br />
                        <input type="submit" value="Search Census" />
                    </form>
                </div>

<?php 
// Pardon the inline control
if (isset($_GET['keypat'])): 
?>
<hr />Results<br /><br />
<?php
// Iterate through each response object and show census information
foreach ($Response as $responseSet) {
    if ($responseSet == 'End') {
         break;
    }
    echo($responseSet["Placename"] . ", " . $responseSet["StatePostal"] . " has " . 
        $responseSet["Pop"] . " people. ");
    echo("That's about " . (int)$responseSet["PopSqMi"] . 
        " people per square mile.");
    echo("</a><br />\n");
}
?>
<?php endif ?>
           </div>
        </div>
    </body>
</html>