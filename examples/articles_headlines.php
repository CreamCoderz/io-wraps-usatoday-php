<?php
/**
 * articles_headlines.php
 *
 * I/O Wraps PHP Client Library Sample App for Articles API 
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

if (isset($_GET['section'])) {
    $section = $_GET['section'];
    $StoryList = new StoryList(
        $service->ArticlesMethods->TopNews("json", $section)
    );
}
?>

<!doctype html>
<html>
    <head>
        <title>USA TODAY Articles API - Headlines Sample App</title>
    </head>
    <body>
        <div class="container" id="mainwrap">
            <header>
                <link rel="stylesheet" 
                    href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css" 
                    media="screen" />
                <h1>USA TODAY Articles API - Headlines Sample App</h1>
            </header>
            <div class="box">
                <div class="request">
                    <form id="section" method="GET" action="articles_headlines.php">
                        Section:
                        <select name="section">
                            <option value="home" selected="selected">home</option>
                            <option value="news">news</option>
                            <option value="travel">travel</option>
                            <option value="money">money</option>
                            <option value="sports">sports</option>
                            <option value="life">life</option>
                            <option value="tech">tech</option>
                            <option value="weather">weather</option>
                            <option value="test">test</option>
                            <option value="nation">nation</option>
                            <option value="offbeat">offbeat</option>
                            <option value="washington">washington</option>
                            <option value="world">world</option>
                            <option value="religion">religion</option>
                            <option value="opinion">opinion</option>
                            <option value="yl-health">yl-health</option>
                            <option value="nfl">nfl</option>
                            <option value="mlb">mlb</option>
                            <option value="nba">nba</option>
                            <option value="nhl">nhl</option>
                            <option value="collegefootball">collegefootball</option>
                            <option 
                                value="collegebasketball">collegebasketball</option>
                            <option value="highschool">highschool</option>
                            <option value="motorsports">motorsports</option>
                            <option value="golf">golf</option>
                            <option value="soccer">soccer</option>
                            <option value="horseracing">horseracing</option>
                            <option value="books">books</option>
                            <option value="people">people</option>
                            <option value="music">music</option>
                            <option value="reviews">reviews</option>
                        </select><br />
                        <br /><br />
                        <input type="submit" value="Search News Articles" />
                    </form>
                </div>

<?php 
// Pardon this inline control
if (isset($_GET['section'])): 
?>
<hr />Results<br /><br />
<?php
/*
 * Iterate through each story object, and hyperlink the
 * title of each article
 */
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