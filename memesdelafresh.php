<?php

if ($key['name'] == 'Memes De La Fresh')
 {

   foreach($arrayOfNewFoundMemes as $keyo => $valueo)
     {
         echo ("<pre>");
           print_r($valueo);
            echo ("</pre>");


     $toPostvid = array(
       'file_url' => $valueo,

        //'message' => $valuef
     );
          $randomNumber = rand(0,sizeof($myPhotoMemes));

          $toComment = array(
            'attachment_url' => $myPhotoMemes[$randomNumber][0],


            // 'message' => ""
          );


          if ($enablePosting ){
            if ($randomPageComment== 2){
            // $comment = $fb->post('/' .  $currentMemeID . '/comments', $toComment, $key['access_token']);
            // $comment = $comment->getGraphNode()->asArray();
            echo ("<pre>");

            echo $key['name'] . " commented " . $toComment['attachment_url'] . " on post with ID " . $currentMemeID;
            echo ("</pre>");

          }
          file_put_contents("memesPosted.txt",$valueo, FILE_APPEND );

          if (!$dontPostVines){

          $post = $fb->post('/' . $key['id'] . '/videos', $toPostvid, $key['access_token']);
          $post = $post->getGraphNode()->asArray();
}



        }
          echo ("<pre>");
          print_r($post);
          echo "this is the post for memes de la fresh: ";

          $link = '//facebook.com/'.$post['id'];
            echo "<a target = '_blank' href=".$link.">$link</a>";

          echo "<br>";




          //print_r ();
          echo ("</pre>");




        // print_r($timeToPost);


      }


}
 ?>
