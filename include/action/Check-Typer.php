<?php
  require __DIR__ . '/../../vendor/autoload.php';
  require '../Connection.php';
  require '../class/UsersClass.php';

  $classUsers = new UsersClass($pdo);
  
  $typer = trim($_POST['typer']);
  
  $userid = $classUsers->userid($typer);

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

  $data['content'] = $userid->nickname . ' Lagi Ngetik';
  $data['typer']   = $typer;

  $pusher->trigger('chat-typing', 'chat-typing', $data);
?>