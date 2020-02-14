<?php
    class MessagesClass
    {
        private $pdo;

        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }
        public function fetch()
        {
            $query = $this->pdo->query("SELECT a.*, b.* FROM messages a INNER JOIN users b ON a.sender = b.id ORDER BY a.msg_date ASC");
            if($query->rowCount() > 0) {
                while($rows = $query->fetch(PDO::FETCH_OBJ))
                    $data[] = $rows;
                return $data;
            }

            return false;
        }
        public function singleMessage($id) 
        {
            $query = $this->pdo->query("SELECT a.*, b.* FROM messages a INNER JOIN users b ON a.sender = b.id WHERE a.id = '$id'");
            if($query->rowCount() > 0) {
                $row = $query->fetch(PDO::FETCH_OBJ);
                return $row;
            }

            return false;
        }
        public function sendMessage($data)
        {
            $data = json_decode($data, true);
            $data = array_map('trim', $data);
            $data['msg_date'] = date('Y-m-d H:i:s');
            $data['sender'] = $_SESSION['id'];

            $result  = $this->pdo->prepare("INSERT INTO messages(
                content, 
                sender, 
                msg_date) 
            VALUES (:content, :sender, :msg_date)");
            foreach ($data as $key => &$value) {
                $field = ':' . $key;
                $result->bindParam($field, $value);
            }

            if($result->execute()) {
                $lastId  = $this->pdo->lastInsertId();
                $message = $this->singleMessage($lastId);
                if ($message) {
                    $data = [
                        'id'         => $message->id,
                        'content'    => $message->content,
                        'cover'      => $message->cover,
                        'sender'     => $message->sender,
                        'senderName' => $message->nickname,
                        'msg_date'    => $message->msg_date
                    ];

                    return json_encode($data);
                }
            }

            return false;
        }
    }
?>