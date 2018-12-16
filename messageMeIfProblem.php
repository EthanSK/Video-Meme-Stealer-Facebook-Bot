<?php
echo 'loaded message me if problem ';
  $messages = $fb->get('/' . $key['id'] . '/conversations?limit=10000&fields=snippet,unread_count,senders,can_reply', $key['access_token']);
  $messages = $messages->getGraphEdge()->asArray();
$humanReadableTimeOfLastPost = date('d/m/Y h:i',$mostRecentTimeOfPost);
$humanReadableTimeSinceLastPost = date('h',$timeSinceLastPost);
  $messageToWarnMe = array(
'message' =>"The most recent post on Video memes was over ". round($timeSinceLastPost/3600 ). " hours ago. Post ID of video: $mostRecentPostID"

  );
 echo ("<pre>");
 echo "message to warn me : ";
   print_r($messageToWarnMe);
    echo ("</pre>");

  foreach($messages as $keymes => $valuemes)
    {

        // echo ("<pre>");
        //  print_r($valuemes);
        //    echo ("</pre>");


    if ($valuemes['senders'][0]['id'] == '1027468654052605' && $valuemes['can_reply'] == 1)
      {
        echo 'found me! ';
        $previousMessageAsExplodedArray = explode('video: ',$valuemes['snippet']);
 echo ("<pre>");
   print_r($previousMessageAsExplodedArray);
    echo ("</pre>");
     echo ("<pre>");
       print_r($mostRecentPostID);
        echo ("</pre>");

        if($previousMessageAsExplodedArray[1] != $mostRecentPostID){
        echo 'should send me message now ';
      $replymessage = $fb->post('/' . $valuemes['id'] . '/messages', $messageToWarnMe, $key['access_token']);
      $replymessage = $replymessage->getGraphNode()->asArray();
      echo ("<pre>");
      print_r("replied to:" . $individualMessage[0]['from']['name']);
      echo ("</pre>");
    }
      }


    }
 ?>
