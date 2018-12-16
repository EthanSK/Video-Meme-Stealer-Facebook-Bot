
<?php
session_start();
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once __DIR__ . '/vendor/autoload.php';
echo "<pre>";

date_default_timezone_set("GMT");
echo "The time is " . date("Y-m-d H:i:s").'   '.   time();

$refreshRate = 150;
echo "</pre>";
header( "refresh:$refreshRate;url= index.php" );
$currentTime = time();
$enablePosting = true;
//$myfile = fopen("memelog.txt", "a+");
//$content = fread($myfile);
//$content = file_get_contents("memelog.txt");
$content = file("memeURLs.txt");
$vineVideos = file("videoMemeURLs.txt");

echo "<pre>";

$version = file("version.txt");
$add = end($version)+1;
file_put_contents("version.txt",$add. "\n", FILE_APPEND );
$version = file("version.txt");

//$log = file("log.txt");



echo "script has loaded" . end($version) . "times \n";
echo "</pre>";
//print_r($content);


//database stuff
/*
$db_host = "localhost";
$db_username = "root";
$db_password = "memes";
$db_name = "stolen_meme_info";


$conn = new mysqli($db_host, $db_username, $db_password, $db_name) or die ("failed");
//@mysql_connect("$db_host","$db_username","$db_password") or die ("Could not connect to mysql");
//@mysql_select_db("$db_name") or die ("no database");
echo "succesful database connection";

*/




//require_once __DIR__ . '/path/to/facebook-php-sdk-v4/src/Facebook/autoload.php';
//define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__ . '/facebook-sdk-v5/');
//require_once __DIR__ . '/facebook-sdk-v5/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '1791997501070850',
  'app_secret' => '5f15d1c851d9e814380e4891ca800234',
  'default_graph_version' => 'v2.8',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['manage_pages', 'publish_pages', 'publish_actions'];

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
    $memesPosted = file("memesPosted.txt");
    $arrayOfNewFoundMemes =array_diff($vineVideos,$memesPosted);
    //function runScript($pageName){

  $arrayOfPagesVideos = array("normiememes69","DankMemesFromOuterSpace","seewaymore", "ericscreamymeme", "DankMemesGang", "ChildhoodPolio","mememangIG", "supremezestymemes", "WindowsMemes69", "reptilianmeme", "spicymemepls", "unexpectedMemes", "ayydelalmao3", "cuminassbro2", "684233818337530" , "robustgourmetmemes", "NEEMEMES", "zestysupreme", "TrolleyProblemMemes", "edgyteens5", "WATinTheFuWorld", "883146658474341",
"SuperMemoryHole1", "Shitposting2006","mochadepressotogoplease","amphetameme2","delakillyourself","succmymeme","1008892339157119",
);

$myPage = $fb->get('/thememestealmachine');
$myPage = $myPage->getGraphNode()->asArray();
$myMemes = $fb->get('/' . $myPage['id'] . '/posts?limit=10&fields=created_time,source,full_picture,type,id,status_type', $myPage['access_token']);
$myMemes = $myMemes->getGraphEdge()->asArray();
$myPhotoMemes = array();
// echo ("<pre>");
// print_r ($myMemes);
// echo ("</pre>");

foreach ($myMemes as $keymy => $valuemy) {

  if ($myMemes[$keymy]['type'] == "photo" ) {
  array_push($myPhotoMemes, array(
    $myMemes[$keymy]['full_picture'],
    //strtotime($myMemes[$keymy]['created_time'] -> format('Y-m-d H:i:s'))

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



//random which page should auto comment

$randomPageComment = rand(0,1);


foreach ($arrayOfPagesVideos as $keyf => $valuef) {

//££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££

    $stealPage1 = $fb->get('/'.$valuef);
    //$stealPage1 = $fb->get('/zucceveryday');
    $stealPage1 = $stealPage1->getGraphNode()->asArray();

    $myPage = $fb->get('/thememestealbot');
    $myPage = $myPage->getGraphNode()->asArray();


    $stoleVideos = $fb->get('/' . $stealPage1['id'] . '/posts?limit=5&fields=created_time,source,type,status_type', $stealPage1['access_token']);
    $stoleVideos = $stoleVideos->getGraphEdge()->asArray();

    $arrayOfVideoURLs = array();
      $arrayOfVideoOutputURLs = array();


    foreach ($stoleVideos as $keyvid => $valuevid) {


          if ($stoleVideos[$keyvid]['status_type'] == "added_video" ) {

          $currentVideoURL = $stoleVideos[$keyvid]['source'];
          $datePostedVideo = $stoleVideos[$keyvid]['created_time'];
          $memeID = $stoleVideos[$keyvid]['id'];

          $timePostedVideo = strtotime($datePostedVideo->format('Y-m-d H:i:s'));


          array_push($arrayOfVideoURLs, array(
           $currentVideoURL,
           $memeID,
           $timePostedVideo
         ));




       }



      }

      // echo ("<pre>");
      // print_r ($myPhotoMemes);
      // echo ("</pre>");





        foreach($arrayOfVideoURLs as $keyvi => $valuevi)
      	{
          	$lastValueAKAtimestampVideo = $arrayOfVideoURLs[$keyvi][2];
      	if ($lastValueAKAtimestampVideo >= $currentTime - $refreshRate)
      		{
      		array_push($arrayOfVideoOutputURLs, $valuevi);
      		}
      	}

        // echo ("<pre>");
        // print_r($arrayOfVideoOutputURLs);
        // print_r($valuef);
        //
        //  echo ("</pre>");

        foreach ($pages as $key) {
        if ($key['name'] == 'The Meme Steal Machine')
      {

                foreach($arrayOfVideoOutputURLs as $keyo => $valueo)
                  {
                    $currentURLtoPost = $arrayOfVideoOutputURLs[$keyo][0];
                    $currentURLtimestamp = $arrayOfVideoOutputURLs[$keyo][2];
                    $currentMemeID = $arrayOfVideoOutputURLs[$keyo][1];
                  $toPostvid = array(
                    'file_url' => $currentURLtoPost,

                     //'message' => $valuef
                  );
                  $randomNumber = rand(0,sizeof($myPhotoMemes));

                  $toComment = array(
                    'attachment_url' => $myPhotoMemes[$randomNumber][0],


                    // 'message' => ""
                  );

                  $whichPageWasThisFrom = array(
                    'message' => $valuef
                  );

                  if ($enablePosting){
                    if ($randomPageComment== 1){
                    $comment = $fb->post('/' .  $currentMemeID . '/comments', $toComment, $key['access_token']);
                    $comment = $comment->getGraphNode()->asArray();
                    echo ("<pre>");

                    echo $key['name'] . " commented " . $toComment['attachment_url'] . " on post with ID " . $currentMemeID;
                    echo ("</pre>");

                  }
                  $post = $fb->post('/' . $key['id'] . '/videos', $toPostvid, $key['access_token']);
                  $post = $post->getGraphNode()->asArray();

                  $comment = $fb->post('/' .  $post['id'] . '/comments', $whichPageWasThisFrom, $key['access_token']);
                $comment = $comment->getGraphNode()->asArray();
                  //
                  // $like = $fb->post('/' .  $post['id'] . '/likes', $key['access_token']);
                  // $like = $like->getGraphNode()->asArray();
                  //file_put_contents("log.txt", serialize($post), FILE_APPEND );

                }
                  echo ("<pre>");
                //  print_r($post);
                  echo "<br>";
                  print_r($valuef . '  ');
                  print_r($currentURLtimestamp . '  ');
                  echo "<br>";

                  print_r($currentURLtoPost);
                  echo "<br>";
                  echo "<br>";




                  //print_r ();
                  echo ("</pre>");




                // print_r($timeToPost);


              }


      }

      }


            foreach ($pages as $key) {
            if ($key['name'] == 'The Meme Steal Bot')
          {

                		foreach($arrayOfVideoOutputURLs as $keyo => $valueo)
                			{
                        $currentURLtoPost = $arrayOfVideoOutputURLs[$keyo][0];
                        $currentURLtimestamp = $arrayOfVideoOutputURLs[$keyo][2];
                        $currentMemeID = $arrayOfVideoOutputURLs[$keyo][1];
                			$toPostvid = array(
                				'file_url' => $currentURLtoPost,

                         //'message' => $valuef
                			);
                      $randomNumber = rand(0,sizeof($myPhotoMemes));

                      $toComment = array(
                        'attachment_url' => $myPhotoMemes[$randomNumber][0],


                        // 'message' => ""
                      );

                      $whichPageWasThisFrom = array(
                        'message' => $valuef
                      );

                      if ($enablePosting){
                        if ($randomPageComment== 1){
                        $comment = $fb->post('/' .  $currentMemeID . '/comments', $toComment, $key['access_token']);
                        $comment = $comment->getGraphNode()->asArray();
                        echo ("<pre>");

                        echo $key['name'] . " commented " . $toComment['attachment_url'] . " on post with ID " . $currentMemeID;
                        echo ("</pre>");

                      }
                			$post = $fb->post('/' . $key['id'] . '/videos', $toPostvid, $key['access_token']);
                			$post = $post->getGraphNode()->asArray();

                      $comment = $fb->post('/' .  $post['id'] . '/comments', $whichPageWasThisFrom, $key['access_token']);
                    $comment = $comment->getGraphNode()->asArray();
                      //
                      // $like = $fb->post('/' .  $post['id'] . '/likes', $key['access_token']);
                      // $like = $like->getGraphNode()->asArray();
                      //file_put_contents("log.txt", serialize($post), FILE_APPEND );

                    }
                      echo ("<pre>");
                    //  print_r($post);
                      echo "<br>";
                      print_r($valuef . '  ');
                      print_r($currentURLtimestamp . '  ');
                      echo "<br>";

                      print_r($currentURLtoPost);
                      echo "<br>";
                      echo "<br>";




                      //print_r ();
                      echo ("</pre>");




                		// print_r($timeToPost);


                	}


          }

        }
        //echo "hi";

        foreach ($pages as $key) {
          if ($key['name'] == 'Video Memes For Bot Absorbent Teens')
        {

                  foreach($arrayOfVideoOutputURLs as $keyo => $valueo)
                    {
                      $currentURLtoPost = $arrayOfVideoOutputURLs[$keyo][0];
                      $currentURLtimestamp = $arrayOfVideoOutputURLs[$keyo][2];
                      $currentMemeID = $arrayOfVideoOutputURLs[$keyo][1];

                    $toPostvid = array(
                      'file_url' => $currentURLtoPost,
                    //'file_url' => "https://v.cdn.vine.co/r/videos/A302AB611D1396650784300679168_5ec078626c5.37.0.DA8502D6-C0E5-4BBD-91AF-903C5001A810.mp4?versionId=gnXLTuMU6FNRq3PxKYQOYC.xeFdnwaGa",

                       //'message' => $valuef


                    );
                    $randomNumber = rand(0,sizeof($myPhotoMemes));


                    $toComment = array(
                      'attachment_url' => $myPhotoMemes[$randomNumber][0],


                      // 'message' => ""
                    );

                    $whichPageWasThisFrom = array(
                      'message' => $valuef
                    );

                    if ($enablePosting){

                      if ($randomPageComment== 0){
                      $comment = $fb->post('/' .  $currentMemeID . '/comments', $toComment, $key['access_token']);
                      $comment = $comment->getGraphNode()->asArray();
                      echo ("<pre>");

                      echo $key['name'] . " commented " . $toComment['attachment_url'] . " on post with ID " . $currentMemeID;
                      echo ("</pre>");
                    }
                    $post = $fb->post('/' . $key['id'] . '/videos', $toPostvid, $key['access_token']);
                    $post = $post->getGraphNode()->asArray();
                    //file_put_contents("log.txt", serialize($post), FILE_APPEND );

                    $comment = $fb->post('/' .  $post['id'] . '/comments', $whichPageWasThisFrom, $key['access_token']);
                    $comment = $comment->getGraphNode()->asArray();
                    // $like = $fb->post('/' .  $post['id'] . '/likes', $key['access_token']);
                    // $like = $like->getGraphNode()->asArray();

                  }
                    echo ("<pre>");
                    print_r($valuef . '  ');
                    print_r($currentURLtimestamp . '  ');
                    echo "<br>";

                    print_r($currentURLtoPost);
                    echo "<br>";
                    //echo "this meme has the id of:   " . $currentMemeID;
                    //echo "<br>";
                    echo "<br>";



                    //print_r ();
                    echo ("</pre>");




                  // print_r($timeToPost);


                }

        }

      }


//££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££££

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
<script>


    var elm=document.getElementById('login');
      document.location.href = elm.href;

</script>
