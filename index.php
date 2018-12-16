<?php
$enablePosting = 1;

$urlToConvert = '
https://www.facebook.com/videomemesbot/videos/311331165951030/
';
//require 'mongodbconnect.php';
session_start();
// session_unset();
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once __DIR__ . '/vendor/autoload.php';
echo "<pre>";

date_default_timezone_set("GMT");
echo "The time is " . date("Y-m-d H:i:s").'   '.   time();

$refreshRate = 2000;
$timeToAllowLatestPostToBe  = 36000;

echo "</pre>";
//i have tested the header reload thing, and it will always go with the first one no matter whatever
//so if i set it to reload after 10 seconds, but it takes longer than 10 seconds to load, then
//it will never reload because the command to reload after say 30 seconds or any time will be ignored.
//this means i must always either have the first reload command long enough to definitely confirm the page has finished loading, or i must find a different method of reloading
//header( "refresh:5;url= index.php" );

header( "refresh:$refreshRate;url= index.php" );

$currentTime = time();
$dontPostVines = true;
//$myfile = fopen("memelog.txt", "a+");
//$content = fread($myfile);
//$content = file_get_contents("memelog.txt");
//$content = file("memeURLs.txt");

echo "<pre>";

$version = file("version.txt");
$add = end($version)+1;
file_put_contents("version.txt",$add. "\n", FILE_APPEND );
$version = file("version.txt");

//$log = file("log.txt");



echo "script has loaded" . end($version) . "times \n";
echo "</pre>";


$fb = new Facebook\Facebook([
  'app_id' => '1822644451348499',
  'app_secret' => 'f7c9dddc762893ee9d6c5ab7fe029dd0',
  'default_graph_version' => 'v2.8',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['manage_pages', 'publish_pages', 'publish_actions', 'read_page_mailboxes', 'pages_messaging'];

try {
	if (isset($_SESSION['facebook_access_token'])) {
		$accessToken = $_SESSION['facebook_access_token'];
	} else {
  		$accessToken = $helper->getAccessToken();
	}
} catch(Facebook\Exceptions\FacebookResponseException $e) {
 	// When Graph returns an error
 	echo 'Graph returned an error: ' . $e->getMessage();

  	exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
 	// When validation fails or other local issues
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
  	exit;
 }



if (isset($accessToken)) {
	if (isset($_SESSION['facebook_access_token'])) {
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	} else {
		// getting short-lived access token
		$_SESSION['facebook_access_token'] = (string) $accessToken;

	  	// OAuth 2.0 client handler
		$oAuth2Client = $fb->getOAuth2Client();

		// Exchanges a short-lived access token for a long-lived one
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);

		$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;

		// setting default access token to be used in script
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}

	// redirect the user back to the same page if it has "code" GET variable
	if (isset($_GET['code'])) {
		//header('Location: ./');
	}

	// getting basic info about user
	try {
		$profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
		$profile = $profile_request->getGraphNode()->asArray();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		//session_destroy();
		// redirecting user back to app login page
		//header("Location: ./");
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
//this is for the photo upload
//•••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••
//  runScript("zucceveryday");

  try {

    //     $pages = $fb->get('/me/accounts');
    //     $pages = $pages->getGraphEdge()->asArray();
    // foreach($pages as $key)
    //   {
    //     if ($key['name'] == 'Video Memes For Bot Absorbent Teens'){
    //
    //     $myPagePaginationTest = $fb->get('/221259188291562/posts?limit=100', $key['access_token']);
    //     $myPagePaginationTest = $myPagePaginationTest->getGraphEdge();
    //
    //     $nextFeed = $fb->next($myPagePaginationTest);
    //     $doubleNext = $fb->next($nextFeed)->asArray();
    //      echo ("<pre>");
    //      echo 'my page pagination test:';
    //        print_r($doubleNext);
    //         echo ("</pre>");
    //       }
    //   }


//maybe this is causing suspision
 //require '/Applications/XAMPP/xamppfiles/htdocs/memewarsAutoComment.php';

    if (!$dontPostVines)
    	{
    	$vineVideos = file("videoMemeURLs.txt", FILE_IGNORE_NEW_LINES);
    	}

    $memesPosted = file("memesPosted.txt", FILE_IGNORE_NEW_LINES);

    // $arrayOfNewFoundMemes = array_diff(array_slice($vineVideos,-3,3),$memesPosted);

    $arrayOfNewFoundMemes = array_diff($vineVideos, $memesPosted);
    $invalidUsernames = file("invalidUsernames.txt", FILE_IGNORE_NEW_LINES);

    // removed: toodank89, but its a good page. just too many memes atm - use for yotuube meme bot
    //put toodank89 in meme stream now
    $arrayOfPagesVideos = array(
    	"memeglomeratebot",
    	"Dankpedia",
    	"succmymeme",
    	"Handoveryourmancard3",
    	"IhavenomemesImustshitpost",
    	"DankMemesFromOuterSpace",
    	"seewaymore",
    	"ericscreamymeme",
    	"DankMemesGang",
    	"mememangIG",
    	"supremezestymemes",
    	"WindowsMemes69",
    	"ayydelalmao3",
    	"cuminassbro2",
    	"robustgourmetmemes",
    	"NEEMEMES",
    	"zestysupreme",
    	"TrolleyProblemMemes",
    	"Edgyteensanonymous",
    	"WATinTheFuWorld",
    	"883146658474341",
    	"Shitposting2006",
    	"mochadepressotogoplease",
    	"1165949343424004",
    	"amphetameme2",
    	"delakillyourself",
    	"1008892339157119",
    	"Succpedia",
    	"260604947659228"
    );

//if you wanna add to the youtube meme stream, go to videomemes.php and add it to the array there
        $arrayOfPagesVideosMemeStream = array(
        	"memeglomeratebot",
          "toodank89",
          "TheMemeArmy",
          "135636106970222",
          "heckinbamboozledbot",
          "Dankpedia",
        	"succmymeme",
          "VivaLaMemeMan3",
          "imakememesforliving",
          "imakememes69",
          "TheDankLads",
          "lymphoma420",
          "OfficialBardockObama",
          "1590697684292763",
          "DankusMaximusMemes",
          "grandayy",
          "VivaLaMemeMan",
          "1242917139163973"


        );

    // $myPage = $fb->get('/memesdelafresh');
    // $myPage = $myPage->getGraphNode()->asArray();
    // $myMemes = $fb->get('/' . $myPage['id'] . '/posts?limit=10&fields=created_time,source,full_picture,type,id,status_type', $myPage['access_token']);
    // $myMemes = $myMemes->getGraphEdge()->asArray();

    $myPhotoMemes = array();

    foreach($myMemes as $keymy => $valuemy)
    	{
    	if ($myMemes[$keymy]['type'] == "photo")
    		{
    		array_push($myPhotoMemes, array(
    			$myMemes[$keymy]['full_picture'],

    			// strtotime($myMemes[$keymy]['created_time'] -> format('Y-m-d H:i:s'))

    		));
    		}
    	}

    $pages = $fb->get('/me/accounts');
    $pages = $pages->getGraphEdge()->asArray();
    $infoAboutMe = $fb->get('/me');
    $infoAboutMe = $infoAboutMe->getGraphNode()->asArray();
    echo ("<pre>");
    print_r($infoAboutMe);
    echo ("</pre>");

    // random which page should auto comment

    $randomPageComment = rand(0, 2);
    $arrayOfVideoOutputURLs = array();
    $arrayOfVideoOutputURLsMemeStream = array();

    // for every page i am stealing from for loop

    foreach($arrayOfPagesVideos as $keyf => $valuef)
    	{
    	if (in_array($valuef, $invalidUsernames)) continue;
    	$stealPage1 = $fb->get('/' . $valuef);
    	$stealPage1 = $stealPage1->getGraphNode()->asArray();
    	$stoleVideos = $fb->get('/' . $stealPage1['id'] . '/posts?limit=10&fields=created_time,source,type,status_type', $stealPage1['access_token']);
    	$stoleVideos = $stoleVideos->getGraphEdge()->asArray();
    	$arrayOfVideoURLs = array();
       echo ("<pre>");
      //echo 'stole video array ; ';
      //   print_r($stoleVideos);
          echo ("</pre>");

    	foreach($stoleVideos as $keyvid => $valuevid)
    		{
    		if ($stoleVideos[$keyvid]['status_type'] == "added_video")
    			{
    			$currentVideoURL = $stoleVideos[$keyvid]['source'];
    			$datePostedVideo = $stoleVideos[$keyvid]['created_time'];
    			$memeID = $stoleVideos[$keyvid]['id'];
    			$timePostedVideo = strtotime($datePostedVideo->format('Y-m-d H:i:s'));
    			array_push($arrayOfVideoURLs, array(
    				$currentVideoURL,
    				$memeID,
    				$timePostedVideo,
    				$valuef
    			));
    			}
    		}
//make it get all memes that havent been posted yet, and if they have store in a txt
    	foreach($arrayOfVideoURLs as $keyvi => $valuevi)
    		{
    		$lastValueAKAtimestampVideo = $valuevi[2];
    		if ($lastValueAKAtimestampVideo >= time() - $refreshRate)
    			{
            print_r( 'eligible meme: '. $valuevi);
    			array_push($arrayOfVideoOutputURLs, $valuevi);
    			}
    		}
    	}


      //this is for meme stream.


      foreach($arrayOfPagesVideosMemeStream as $keyf => $valuef)
        {
        if (in_array($valuef, $invalidUsernames)) continue;
        $stealPage1 = $fb->get('/' . $valuef);
        $stealPage1 = $stealPage1->getGraphNode()->asArray();
        $stoleVideos = $fb->get('/' . $stealPage1['id'] . '/posts?limit=5&fields=created_time,source,type,status_type', $stealPage1['access_token']);
        $stoleVideos = $stoleVideos->getGraphEdge()->asArray();
        $arrayOfVideoURLsMemeStream = array();
        foreach($stoleVideos as $keyvid => $valuevid)
          {
          if ($stoleVideos[$keyvid]['status_type'] == "added_video")
            {
            $currentVideoURL = $stoleVideos[$keyvid]['source'];
            $datePostedVideo = $stoleVideos[$keyvid]['created_time'];
            $memeID = $stoleVideos[$keyvid]['id'];
            $timePostedVideo = strtotime($datePostedVideo->format('Y-m-d H:i:s'));
            array_push($arrayOfVideoURLsMemeStream, array(
              $currentVideoURL,
              $memeID,
              $timePostedVideo,
              $valuef
            ));
            }
          }

        foreach($arrayOfVideoURLsMemeStream as $keyvi => $valuevi)
          {
          $lastValueAKAtimestampVideo = $valuevi[2];
          if ($lastValueAKAtimestampVideo >= time() - $refreshRate)
            {
            array_push($arrayOfVideoOutputURLsMemeStream, $valuevi);
            }
          }
        }



    foreach($arrayOfVideoOutputURLs as $keyLink => $valueLink)
    	{
    	echo ("<pre>");
    	echo "<a target = '_blank' href=" . $valueLink . ">$valueLink</a>";
    	echo ("</pre>");
    	}

    echo ("<pre>");
    echo 'array of output urls; ';
    print_r($arrayOfVideoOutputURLs);
    echo ("</pre>");
    $randomPageToShoutout = mt_rand(0, 8);
    $randomPageToShoutout = mt_rand(0, 1);
$randomPageToShoutout =1;
    if ($randomPageToShoutout == 0) $pageIDtoShoutout = 1370489539690801;

    if ($randomPageToShoutout == 1) $pageIDtoShoutout = 517492175041173;

    if ($randomPageToShoutout == 3) $pageIDtoShoutout = 300661440286662;

    if ($randomPageToShoutout == 4) $pageIDtoShoutout = 659399367574615;

    if ($randomPageToShoutout == 5) $pageIDtoShoutout = 358902957828947;

    if ($randomPageToShoutout == 6) $pageIDtoShoutout = 650848015089879;

    if ($randomPageToShoutout == 7) $pageIDtoShoutout = 327005084362135;

    if ($randomPageToShoutout == 8) $pageIDtoShoutout = 336864756683691;

    if ($randomPageToShoutout == 9) $pageIDtoShoutout = 1200868279959517;

    //    'description' => '@['.$pageIDtoShoutout.']'

    foreach($pages as $key)
    	{
    	require "videomemes.php";

    	//require "memestreamfb.php";

    	// require "memestealbot.php";
    	// require "memesdelafresh.php";
    	// require "bestvines.php";

    	}


	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
    $exceptionMessage = print_r( 'Graph returned an error: ' . $e->getMessage(), true);

preg_match_all('/".*?"|\'.*?\'/', $e->getMessage(), $pageFromErrorMessage);
$pageID = trim($pageFromErrorMessage[0][0], "'");

 echo ("<pre>");
   print_r($exceptionMessage);
    echo ("</pre>");

 echo ("<pre>");
   print_r($pageFromErrorMessage);
    echo ("</pre>");

    if (strpos($exceptionMessage,'Graph returned an error: Unsupported get request. Object with ID') !== false ){
       echo ("<pre>");
         print_r("this page no longer exists: ". $pageID);
          echo ("</pre>");

          file_put_contents("invalidUsernames.txt", $pageID . "\n", FILE_APPEND );
          exit;

    }
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
    echo 'Facebook SDK returned an error: ' . $e->getLine();

		exit;
	}


	// printing $profile array on the screen which holds the basic info about user
//	print_r($profile);





  	// Now you can redirect to another page and use the access token from $_SESSION['facebook_access_token']
}



else {
	// replace your website URL same as added in the developers.facebook.com/apps e.g. if you used http instead of https and you used non-www version or www version of your website then you must add the same here
	$loginUrl = $helper->getLoginUrl('http://videobot.com/videobot/', $permissions);
	echo '<a id = "login" href="   ' . $loginUrl . '   ">Log in with Facebook!</a>';
}
echo "loaded  the video bot";


?>


<head>

  <meta http-equiv="refresh" content="3000;url=http://videobot.com/videobot/">

<script>


    var elm=document.getElementById('login');
      document.location.href = elm.href;

</script>
