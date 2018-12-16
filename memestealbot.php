<?php
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
            // $comment = $fb->post('/' .  $currentMemeID . '/comments', $toComment, $key['access_token']);
            // $comment = $comment->getGraphNode()->asArray();
            // echo ("<pre>");
            //
            // echo $key['name'] . " commented " . $toComment['attachment_url'] . " on post with ID " . $currentMemeID;
            // echo ("</pre>");

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

          print_r($post );
          echo "this is the post for the meme steal bot: ";

          $link = '//facebook.com/'.$post['id'];
            echo "<a target = '_blank' href=".$link.">$link</a>";
          echo "<br>";
          echo "<br>";




          //print_r ();
          echo ("</pre>");




        // print_r($timeToPost);


      }


}

 ?>
