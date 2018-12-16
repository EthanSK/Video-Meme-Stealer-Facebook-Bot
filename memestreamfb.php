<?php
if ($key['name'] == 'Meme Stream'){

  echo 'meme stream fb page starting';


           foreach($arrayOfVideoOutputURLsMemeStream as $keyo => $valueo)
                   {
                     $currentURLtoPost = $arrayOfVideoOutputURLsMemeStream[$keyo][0];
                     $currentURLtimestamp = $arrayOfVideoOutputURLsMemeStream[$keyo][2];
                     $currentMemeID = $arrayOfVideoOutputURLsMemeStream[$keyo][1];


                   $toPostvid = array(
                     'file_url' => $currentURLtoPost,
                    // 'description' => '@[1370489539690801]'
                     'description' => 'https://www.facebook.com/videomemesbot/'
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
                     'message' => 'We stole this video from '.$arrayOfVideoOutputURLsMemeStream[$keyo][3]."\n\nhttps://www.facebook.com/".$arrayOfVideoOutputURLsMemeStream[$keyo][3]
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
                   file_put_contents("memesPosted.txt",$valueo."\n", FILE_APPEND );

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

       foreach($arrayOfNewFoundMemes as $keyo => $valueo)
         {


         $toPostvid = array(
           'file_url' => $valueo,
    //  'description' => '@['.$pageIDtoShoutout.']'
      'description' => 'https://www.facebook.com/videomemesbot/'


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


}
 ?>
