<?php
require 'vendor/autoload.php';
MongoLog::setModule( MongoLog::ALL );
MongoLog::setLevel( MongoLog::ALL );

error_reporting( E_ALL );
  //$connection = new MongoClient('ETGgames:0B7ZiPWiHttkhj0o@memeservice-shard-00-00-xgsep.mongodb.net:27017,memeservice-shard-00-01-xgsep.mongodb.net:27017,memeservice-shard-00-02-xgsep.mongodb.net:27017/memeservice?ssl=true&replicaSet=MemeService-shard-0&authSource=admin');



    try
{
  $connection = new MongoClient('ETGgames:0B7ZiPWiHttkhj0o@memeservice-shard-00-00-xgsep.mongodb.net:27017,memeservice-shard-00-01-xgsep.mongodb.net:27017,memeservice-shard-00-02-xgsep.mongodb.net:27017/memeservice?ssl=true&replicaSet=MemeService-shard-0&authSource=admin');
    $db = $connection->testdb;
}
catch ( MongoConnectionException $e )
{
    echo '<p>Couldn\'t connect to mongodb, is the "mongo" process running?</p>';
    exit();
}

 echo ("<pre>");
   print_r($db);
    echo ("</pre>");

    //$result1 = $db->createCollection('testcollection');
    $collection = $db->command(array(
        "create" => 'testcollection',
        "capped" => $options["capped"],
        "size" => $options["size"],
        "max" => $options["max"],
        "autoIndexId" => $options["autoIndexId"],
    ));

    var_dump($collection);

  //
  // $memes = $db->ameme;
  //
  // $doc=Array(
  //                  "url"=>"test_url" ,
  //                  "has_been_posted"=>true,
  //             );
  //
  //       //$memes->Insert($doc);


 ?>
