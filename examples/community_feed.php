<?php
/**
 * community_feed.php
 *
 * I/O Wraps PHP Client Library Sample App for Articles/Community Feed API 
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

// Client library (network/authentication)
require_once "../google-api-php-client/src/apiClient.php";

// USA TODAY resource/method library
require_once "../google-api-php-client/src/contrib/apiArticlesapiService.php";

// Instantiate client
$client = new apiClient();

// Set credentials
$client->setDeveloperKey("YOUR_API_KEY");

// Instantiate service
$service = new apiArticlesapiService($client);

$StoryList = new StoryList;
$story = new Story;

if (isset($_GET['community'])) {
    $community = $_GET['community'];
    $encoding = $_GET['encoding'];
    
    $StoryList = new StoryList(
        $service->ArticlesMethods->CommunityFeedMethods($community, "json")
    );
}
?>

<!doctype html>
<html>
    <head>
        <link rel="stylesheet" 
            href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css" 
            media="screen" />
        <title>USA TODAY Articles API - Community Feed Sample App</title>
    </head>
    <body>
        <div class="container" id="mainwrap">
            <header>
                <h1>USA TODAY Articles API - Community Feed Sample App</h1>
            </header>
            <div class="box">
                <div class="request">
                    <form id="section" method="GET" action="community_feed.php">
                        Community:
                        <select name="community" placeholder="required">
                            <option value="religion">religion</option>
                            <option value="greenhouse">greenhouse</option>
                            <option value="kindness">kindness</option>
                            <option value="ondeadline">ondeadline</option>
                            <option value="onpolitics">onpolitics</option>
                            <option value="theoval">theoval</option>
                            <option value="thecruiselog">thecruiselog</option>
                            <option value="hotelcheckin">hotelcheckin</option>
                            <option value="todayinthesky">todayinthesky</option>
                            <option value="driveon">driveon</option>
                            <option value="campusrivalry">campusrivalry</option>
                            <option 
                                value="christinebrennan">christinebrennan</option>
                            <option value="dailypitch">dailypitch</option>
                            <option value="fantasyjoe">fantasyjoe</option>
                            <option value="fantasywindup">fantasywindup</option>
                            <option value="mma">mma</option>
                            <option value="gameon">gameon</option>
                            <option value="thehuddle">thehuddle</option>
                            <option value="idolchatter">idolchatter</option>
                            <option value="entertainment" 
                                selected="selected">entertainment</option>
                            <option value="livefrom">livefrom</option>
                            <option value="pawprintpost">pawprintpost</option>
                            <option value="popcandy">popcandy</option>
                            <option value="gamehunters">gamehunters</option>
                            <option value="sciencefair">sciencefair</option>
                            <option value="technologylive">technologylive</option>
                        </select>
                        <br />
                        <br />
                        <br />
                        <input type="submit" 
                            value="Search Community Blog Articles" />
                    </form>
                </div>
<?php
// Pardon the inline control 
if (isset($_GET['community'])): 
?>
<hr />Results<br /><br />
<?php
// Iterate through each story object, and hyperlink the title of each article
foreach ($StoryList->getStories() as $story) {
    echo("<a href='" . $story->getLink() . "' target='_blank'>");
    echo($story -> getTitle());
    echo("</a><br />\n");
}
?>
<?php endif ?>
            </div>
        </div>
    </body>
</html>