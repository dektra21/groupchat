<?php
session_start();
    require __DIR__ . '/../Connection.php';
    require __DIR__ . '/../class/MessagesClass.php';
    require __DIR__ . '/../../vendor/autoload.php';

    $content = trim($_POST['content']);
    $sender  = trim($_POST['sender']);

    $classMessages = new MessagesClass($pdo);
    $send = $classMessages->sendMessage(json_encode($_POST));

    if ($send) {
        $decode = json_decode($send);

        $options = array(
          'cluster' => 'ap1',
          'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
          'd60d3a640f33564c082a',
          '155ec8fbce8a62dbd782',
          '944982',
          $options
        );
      
        // $data['message'] = 'hello world';
        $pusher->trigger('my-event', 'my-event', $decode);


    }
?>