<?php
if ($key['name'] == 'Video Memes For Bot Absorbent Teens')
 {
   echo 'videomemes.php';

   if ($urlToConvert != ''){


           $currentPostID =$urlToConvert;
            echo ("<pre>");
            echo 'current psot id ';
              print_r($currentPostID);
               echo ("</pre>");

          $currentPostID = str_replace('https://', '', $currentPostID);
          $currentPostID = str_replace('www.', '', $currentPostID);
          $currentPostID = str_replace('facebook.com/', '', $currentPostID);
          $lastSlash = strrpos($currentPostID, '/');
          $secondToLastSlash = strrpos($currentPostID, '/', $lastSlash - strlen($currentPostID) - 1);
          $currentPageName = substr($currentPostID, 0, stripos($currentPostID, '/'));
          $currentPostID = substr($currentPostID, $secondToLastSlash + 1, $lastSlash - $secondToLastSlash - 1);
echo ("<pre>");
 print_r($currentPostID);
  echo ("</pre>");


           $convertURL = $fb->get("/$currentPostID/?fields=source", $key['access_token']);
           $convertURL = $convertURL->getGraphNode()->asArray();

            echo ("<pre>");
            echo 'my own converted url: ';
              print_r($convertURL);
               echo ("</pre>");

               $link = $convertURL['source'];
                 echo "<a target = '_blank' href=".$link.">$link</a>";    echo ("</pre>");
             echo ("</pre>");



   }


       foreach($arrayOfVideoOutputURLs as $keyo => $valueo)
               {
                 $currentURLtoPost = $arrayOfVideoOutputURLs[$keyo][0];
                 $currentURLtimestamp = $arrayOfVideoOutputURLs[$keyo][2];
                 $currentMemeID = $arrayOfVideoOutputURLs[$keyo][1];
               $toPostvid = array(
                 'file_url' => $currentURLtoPost,
                 //'description' => '@['.$pageIDtoShoutout.']',
                 'description' => "https://www.facebook.com/memewarsincomments/"

                  //'message' => $valuef
               );
               $randomNumber = rand(0,sizeof($myPhotoMemes));

               $toComment = array(
                 'attachment_url' => $myPhotoMemes[$randomNumber][0],


                 // 'message' => ""
               );
               $randomNumber = rand(0,sizeof($myPhotoMemes));

               $toComment = array(
                 'attachment_url' => $myPhotoMemes[$randomNumber][0],


                 // 'message' => ""
               );

               $whichPageWasThisFrom = array(
                 'message' => 'We stole this video from '.$arrayOfVideoOutputURLs[$keyo][3]."\n\nhttps://www.facebook.com/".$arrayOfVideoOutputURLs[$keyo][3]
               );


               if ($enablePosting){
               //   if ($randomPageComment== 3){
               //   // $comment = $fb->post('/' .  $currentMemeID . '/comments', $toComment, $key['access_token']);
               //   // $comment = $comment->getGraphNode()->asArray();
               //   echo ("<pre>");
               //
               // //  echo $key['name'] . " commented " . $toComment['attachment_url'] . " on post with ID " . $currentMemeID;
               //   echo ("</pre>");
               //

               // }
               file_put_contents("memesPosted.txt",$currentMemeID."\n", FILE_APPEND );

               $post = $fb->post('/' . $key['id'] . '/videos', $toPostvid, $key['access_token']);
               $post = $post->getGraphNode()->asArray();

               $comment = $fb->post('/' .  $post['id'] . '/comments', $whichPageWasThisFrom, $key['access_token']);
             $comment = $comment->getGraphNode()->asArray();



             }
               echo ("<pre>");
               print_r($post);
               echo "this is the post for video memes for bot absorbent teens: ";

               $link = '//facebook.com/'.$post['id'];
                 echo "<a target = '_blank' href=".$link.">$link</a>";



               //print_r ();
               echo ("</pre>");




             // print_r($timeToPost);


           }
//this is for vines, which has been shut down so I disabled it ffs
   foreach($arrayOfNewFoundMemes as $keyo => $valueo)
     {


     $toPostvid = array(
       'file_url' => $valueo,
//  'description' => '@['.$pageIDtoShoutout.']',
  'description' => "https://www.facebook.com/memewarsincomments/"


     );
          $randomNumber = rand(0,sizeof($myPhotoMemes));

          $toComment = array(
            'attachment_url' => $myPhotoMemes[$randomNumber][0],


            // 'message' => ""
          );


          if ($enablePosting){
            if ($randomPageComment== 2){
            // $comment = $fb->post('/' .  $currentMemeID . '/comments', $toComment, $key['access_token']);
            // $comment = $comment->getGraphNode()->asArray();
            echo ("<pre>");

            //echo $key['name'] . " commented " . $toComment['attachment_url'] . " on post with ID " . $currentMemeID;
            echo ("</pre>");

          }
          if (!$dontPostVines){
            file_put_contents("memesPosted.txt",$valueo."\n", FILE_APPEND );

          $post = $fb->post('/' . $key['id'] . '/videos', $toPostvid, $key['access_token']);
          $post = $post->getGraphNode()->asArray();


}



        }
          echo ("<pre>");
          print_r($post);
          echo "this is the post for video memes for bot absorbent teens: ";

          $link = '//facebook.com/'.$post['id'];
            echo "<a target = '_blank' href=".$link.">$link</a>";

          echo ("</pre>");
      }

      $getLatestPostVideoMemes = $fb->get('/' . $key['id'] . '/videos', $key['access_token']);
      $getLatestPostVideoMemes = $getLatestPostVideoMemes->getGraphEdge()->asArray();
       echo ("<pre>");
    //   echo "latest meme: ";
        // print_r($getLatestPostVideoMemes);
          echo ("</pre>");
          $mostRecentTimeOfPost = $getLatestPostVideoMemes[0]['updated_time']->getTimestamp();
          $mostRecentPostID = $getLatestPostVideoMemes[0]['id'];
           echo ("<pre>");
             print_r($mostRecentTimeOfPost);
              echo ("</pre>");
              $timeSinceLastPost = time() -$mostRecentTimeOfPost;
              //$timeToAllowLatestPostToBe  = 25200;
              if ($mostRecentTimeOfPost < time() - $timeToAllowLatestPostToBe){
                echo "most recent post was over this many seconds ago: $timeToAllowLatestPostToBe";
                require "messageMeIfProblem.php";

              }


              //this is for getting memes for the youtube bot
              //------------------------------------------------------------------------------------------------
              $arrayOfPagesForYT = array($key['id'], "toodank89","TheMemeArmy","135636106970222", "imakememesforliving", "imakememes69","TheDankLads", "lymphoma420", "OfficialBardockObama", "1590697684292763","DankusMaximusMemes","grandayy","1242917139163973");

              $makePaginationTXTtrackerUnique = file('pagesalreadypaginated.txt', FILE_IGNORE_NEW_LINES);
              $makePaginationTXTtrackerUnique = array_unique($makePaginationTXTtrackerUnique);
              file_put_contents('pagesalreadypaginated.txt', "" );

              foreach ($makePaginationTXTtrackerUnique as $keyofmeme => $valueofmeme) {
                file_put_contents('pagesalreadypaginated.txt', $valueofmeme."\n",FILE_APPEND );

              }
              $pagesAlreadyPaginated = file('pagesalreadypaginated.txt', FILE_IGNORE_NEW_LINES);

              //these are for video memes
              //add reactions field back in
              foreach ($arrayOfPagesForYT as $keypageforyt => $valuepageforyt)  {

              $getPageVideos = $fb->get('/'.$valuepageforyt.'/videos?fields=source,created_time,reactions,live_status,from,status_type,length&limit=100', $key['access_token']);
              $getPageVideos = $getPageVideos->getGraphEdge();

              $getPageVideosArray = $getPageVideos->asArray();

              $getPageID = $fb->get('/'.$valuepageforyt.'?fields=id', $key['access_token']);
              $getPageID = $getPageID->getGraphNode()->asArray();

               echo ("<pre>");
               echo 'this page id: ';
                 print_r($getPageID);
                  echo ("</pre>");




              if (!in_array($valuepageforyt, $pagesAlreadyPaginated)){
                echo 'not already paginated ';
                $nextFeed = $getPageVideos;
                //i know looping through more pages that existst will break the script, but since it is always a one off, at least it will kind of work.
                //these memes will be old, but for the new memes, we need to put them at the top of the txt file because of the limiter we will place in the for loop
                $videomemestxt = file('/Applications/XAMPP/xamppfiles/htdocs/youtubebotphp/videomemestopost.txt', FILE_IGNORE_NEW_LINES);

                    for ($i=0; $i < 30 ; $i++) {
                      file_put_contents('pagesalreadypaginated.txt', $valuepageforyt."\n", FILE_APPEND);

                      echo 'for loop starts ';
                      $nextFeed = $fb->next($nextFeed);
                      $nextFeedArray = $nextFeed->asArray();
                       echo ("<pre>");
                       echo 'my page pagination test:'. $i."\n";
                        print_r(count($nextFeedArray));
                          echo ("</pre>");


                          foreach ($nextFeedArray as $keyPagination => $valuePagination) {


                                  if(count($valuePagination['reactions']) >= 3 && $valuePagination['from']['id'] == $getPageID['id'] && $valuePagination['length'] < 420){
                                    array_unshift($videomemestxt, $valuePagination['id']);
                                // file_put_contents("/Applications/XAMPP/xamppfiles/htdocs/youtubebotphp/videomemestopost.txt",$valueofmeme['id']."\n", FILE_APPEND );
                                }


                          //array_push($getPageVideosArray,$valuePage);
                          }
                           echo ("<pre>");
                             //print_r($videomemestxt);
                              echo ("</pre>");
                              file_put_contents('/Applications/XAMPP/xamppfiles/htdocs/youtubebotphp/videomemestopost.txt', "" );

                              //this needs to be in this for loop, i know it is excessive, but because we page more than theree are pages, the for loop will never finish, the script breaks and would never get to outside the for loop
                              foreach ($videomemestxt as $keyofmeme => $valueofmeme) {
                             file_put_contents("/Applications/XAMPP/xamppfiles/htdocs/youtubebotphp/videomemestopost.txt",$valueofmeme."\n", FILE_APPEND );

                              }

                              $videomemestxtVarForPuttingBackInFile = file('/Applications/XAMPP/xamppfiles/htdocs/youtubebotphp/videomemestopost.txt', FILE_IGNORE_NEW_LINES);
                              $videomemestxtVarForPuttingBackInFile = array_unique($videomemestxtVarForPuttingBackInFile);
                              file_put_contents('/Applications/XAMPP/xamppfiles/htdocs/youtubebotphp/videomemestopost.txt', "" );

                              foreach ($videomemestxtVarForPuttingBackInFile as $keyofmeme => $valueofmeme) {
                                file_put_contents('/Applications/XAMPP/xamppfiles/htdocs/youtubebotphp/videomemestopost.txt', $valueofmeme."\n",FILE_APPEND );

                              }



                    }

                    echo 'end of loop';

                      }

 echo ("<pre>");
 echo 'get page videos: ';
   print_r($getPageVideosArray);
    echo ("</pre>");

          $videomemestxt = file('/Applications/XAMPP/xamppfiles/htdocs/youtubebotphp/videomemestopost.txt', FILE_IGNORE_NEW_LINES);

              foreach ($getPageVideosArray as $keyofmeme => $valueofmeme) {

                if(count($valueofmeme['reactions']) >= 5&& $valueofmeme['from']['id'] == $getPageID['id'] && $valueofmeme['length'] < 420){
                  array_unshift($videomemestxt, $valueofmeme['id']);
              //  file_put_contents("/Applications/XAMPP/xamppfiles/htdocs/youtubebotphp/videomemestopost.txt",$valueofmeme['id']."\n", FILE_APPEND );
              }
             }
             file_put_contents('/Applications/XAMPP/xamppfiles/htdocs/youtubebotphp/videomemestopost.txt', "" );

             foreach ($videomemestxt as $keyofmeme => $valueofmeme) {
            file_put_contents("/Applications/XAMPP/xamppfiles/htdocs/youtubebotphp/videomemestopost.txt",$valueofmeme."\n", FILE_APPEND );

             }
}


                 $videomemestxt = file('/Applications/XAMPP/xamppfiles/htdocs/youtubebotphp/videomemestopost.txt', FILE_IGNORE_NEW_LINES);
                 $videomemestxt = array_unique($videomemestxt);
                 file_put_contents('/Applications/XAMPP/xamppfiles/htdocs/youtubebotphp/videomemestopost.txt', "" );

                 foreach ($videomemestxt as $keyofmeme => $valueofmeme) {
                   file_put_contents('/Applications/XAMPP/xamppfiles/htdocs/youtubebotphp/videomemestopost.txt', $valueofmeme."\n",FILE_APPEND );

                 }
 }
 ?>
