<?php
    if (!isset($_SESSION['login'])){
        header("Location:login.php");
        exit;
    }
    else{
        require 'include/Connection.php';
        require 'include/class/UsersClass.php';
        require 'include/class/MessagesClass.php';

        $usersClass = new UsersClass($pdo);
        $messagesClass = new MessagesClass($pdo);

        $fetchMessages = $messagesClass->fetch();
        $listUsers = $usersClass->list($_SESSION['id']);
        $userid = $_SESSION['id'];
        $userdata = $usersClass->loginUser($userid);
        $name = $userdata->nickname;
        $cover = $userdata->cover;
    }
     
   
?>

<!DOCTYPE html>
<html class="uk-background-primary">

<head>
    <title>SKENSA-GroupChat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js">
    </script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/js/moment.js"></script>
    <script src="assets/js/livestamp.min.js"></script>
    <script src="assets/js/moment-with-locales.js"></script>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="assets/css/uikit.min.css" />
    <link rel="icon" href="skensa.png">
    <script src="assets/js/uikit.min.js"></script>
    <script src="assets/js/uikit-icons.min.js"></script>
    <style>
        body {
            overflow: hidden;
        }

        .foto {
            -webkit-filter: brightness(35%);
        }

        .uk-icon {}
    </style>
</head>

<body>
    <div class="uk-position-center" style=" width: 100%;;">
        <div class="container-fluid h-100 uk-animation-fade">
            <div class="row justify-content-center h-100 ">
                <div class="col-md-4 col-xl-8 chat">
                    <div class="card">
                        <div class="card-header msg_head" style="background-color:lightseagreen;">
                            <div class="d-flex bd-highlight">
                                <div class="active uk-navbar" style="background:transparent; margin-bottom:-20px;">
                                    <div class="d-flex " style="padding-bottom:-100px;">
                                        <div class="img_cont">
                                            <img src="skensa.png" class="rounded-circle"
                                                style="max-width:70px; margin-left:5px;">
                                        </div>
                                        <div class="user_info">
                                            <h3 style="font-family:'Poppins', sans-serif; color:white;"> <b>Magang
                                                    SKENSA</b>
                                            </h3>
                                            <p class="uk-text-meta uk-margin-remove-top"><span id="bind-typing"
                                                    class="bind-typing"
                                                    style="font-size:10px; color:black;font-family:'Poppins', sans-serif;">
                                                    <?php
                                                        $i = 1;
                                                        $total = count($listUsers);
                                                        $sisanya = $total - 3;
                                                        echo "You ,";
                                                        foreach ($listUsers as $list) {
                                                            if ($i == 1 || $i == 2 || $i == 3) {
                                                                echo $list->nickname.', ';
                                                            }
                                                            $i++;
                                                        }
                                                        echo ' and ' . $sisanya.' other members';
                                                    ?>
                                                </span></p>
                                            <!--                                                 
                                             -->
                                        </div>

                                        <div>
                                            <span uk-icon="icon:more-vertical"
                                                style="color:white; background:transparent;"></span>
                                            <div uk-dropdown>
                                                <ul class="uk-nav uk-dropdown-nav" style="padding-right:50px;">
                                                    <li>Signed in As</li>
                                                    <li class=""
                                                        style="font-family:'Poppins', sans-serif; font-size:15px;"><img
                                                            src=" <?php echo  "assets/cover/".$cover; ?> "
                                                            class="rounded-circle user_img_msg" alt="">
                                                        <b><?= $name; ?></b> </li>
                                                    <li class="uk-nav-divider"></li>
                                                    <li><a href="logout.php">Log Out</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Wilayah Chat nya -->
                        <div class="card-body msg_card_body msg_history" id="loadmessage"
                            style="background-color:white;">
                            <?php
                                    if ($fetchMessages):
                                        foreach ($fetchMessages as $message):
                                            if ($message->sender == $_SESSION['id']):
                                ?>
                            <!-- Pesan Dari User -->
                            <div style="margin-right:-8px;">
                                <div class="d-flex justify-content-end mb-4">
                                    <p class="msg_cotainer"><?= $message->content ?></p>
                                </div>
                                <div style="margin-top:-25px;" align="right">
                                    <span class="uk-text-meta livestamp">

                                        <span data-livestamp="<?= $message->msg_date ?>" style="font-size:10px;"></span>
                                        <span uk-icon="icon: clock; ratio: .7"></span>
                                    </span>
                                </div>
                            </div>

                            <!-- Penutup Pesan Dari User -->
                            <?php
                                            else:
                                ?>
                            <!-- Pesan Dari User Lain -->
                            <div style="margin-left:-8px;">
                                <div style="margin-bottom:-23px;">
                                    <p class="">
                                        <?= $message->nickname ?></p>
                                </div>
                                <div class="d-flex justify-content-start mb-4">
                                    <div class="img_cont_msg" style="padding-right:4px;">
                                        <img src=" <?php echo  "assets/cover/".$message->cover?> "
                                            class="rounded-circle user_img_msg" style=" max-width:40px;">
                                    </div>
                                    <p class="msg_cotainer_send" style="padding:9px;"><?= $message->content ?></p>
                                    <br>

                                </div>
                                <div style="margin-top:-25px;">
                                    <span class="uk-text-meta livestamp">
                                        <span uk-icon="icon: clock; ratio: .7"></span>
                                        <span data-livestamp="<?= $message->msg_date ?>"
                                            style="font-size:10px; font-family:'Poppins', sans-serif;"></span>
                                    </span>
                                </div>
                            </div>


                            <!-- Penutup Pesan Dari User Lain -->
                            <?php
                                            endif;
                                        endforeach;
                                    endif;
                                ?>
                        </div>
                        <!-- Penutup Wilayah Chat nya -->

                        <form id="form-send-message" action="include/action/Send-Message.php" method="post">
                            <div class="card-footer" style="background-color:lightgrey;">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text attach_btn"><i
                                                class="fas fa-paperclip"></i></span>
                                    </div>
                                    <input id="content" name="content" class="form-control type_msg"
                                        placeholder="Type your message..." required autofocus></input>
                                    <div class="input-group-append">
                                        <button id="button-send-message" class="input-group-text send_btn"
                                            type="submit"><i class="fas fa-location-arrow"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    $(document).ready(function () {
        var form;

        $('#loadmessage').animate({
            scrollTop: $('#loadmessage')[0].scrollHeight + 1000
        }, "slow");

        $('#form-send-message').submit(function (event) {
            var targetForm = $(this);
            url = targetForm.attr('action');
            submit = targetForm.find('button-send-message');


            if (form) {
                form.abort();
            }

            form = $.ajax({
                url: url,
                type: "POST",
                beforeSend: function () {},
                data: targetForm.serialize(),
                // contentType: false,
                cache: false,
                // processData:false
            });

            form.done(function (data) {
                console.log(data);
                targetForm.find('input').val('');
                // untuk load data
                // $('#load').html(data);
                // untuk refresh halaman
                // window.location = 'index.php?page=dashboard';
            });

            form.always(function () {
                targetForm.find('input').prop("disabled", false);
                targetForm.find('select').prop("disabled", false);
                targetForm.find('textarea').prop("disabled", false);
            });

            event.preventDefault();
        })
    })
</script>
<script src="https://js.pusher.com/5.1/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    // Untuk update data siapa yg lagi ngetik
    var pusher = new Pusher('d60d3a640f33564c082a', {
        cluster: 'ap1',
        forceTLS: true
    });
    var anggota = $('.bind-typing').html();
    var channelTyping = pusher.subscribe('chat-typing');
    channelTyping.bind('chat-typing', function (data) {
        var userId = '<?= $userid ?>';
        if (userId != data.typer) {
            $('.bind-typing').html(data.content);
            setTimeout(() => {
                $('.bind-typing').html(anggota);
            }, 3000);
        }
    });

    // Untuk ngirim data siapa yg lagi ngetik
    $("#content").keyup(function () {
        var typer = '<?= $userid ?>';

        $.ajax({
            type: "POST",
            url: 'include/action/Check-Typer.php',
            data: {
                typer: typer
            },
            cache: false,
            beforeSend: function () {},
            success: function (data) {}
        })
    });

    var channelTyping = pusher.subscribe('my-event');
    channelTyping.bind('my-event', function (data) {
        console.log(data);
        var response = JSON.stringify(data);
        var userid = '<?= $userid ?>';

        if (userid == data.sender) {
            var chat =
                ' <div class="d-flex justify-content-end mb-4"> <p class="msg_cotainer"> ' + data.content +
                ' </p></div><div style="margin-top:-25px;" align="right"> <span class="uk-text-meta livestamp"> <span data-livestamp="' +
                data.msg_date +
                '" style="font-size:10px;"></span> <span uk-icon="icon: clock; ratio: .7"></span> </span> </div>';

        } else {
            $('title').html('Ada pesan baru dari' + data.senderName);
            var chat =
                ' <div style="margin-bottom:-15px;"> <p class="" style="color:black; style="padding:9px;""> ' +
                data
                .senderName +
                ' </p></div><div class="d-flex justify-content-start mb-4"> <div class="img_cont_msg" style="padding-right:4px;"> <img src="assets/cover/' +
                data.cover + '" class="rounded-circle user_img_msg"> </div><p class="msg_cotainer_send">' +
                data.content +
                '</p><br></div><div style="margin-top:-25px;"> <span class="uk-text-meta livestamp"> <span uk-icon="icon: clock; ratio: .7"></span> <span data-livestamp="' +
                data.msg_date + '" style="font-size:10px;"></span> </span> </div>';
                var myAudio = document.createElement('audio');
        if (myAudio.canPlayType('audio/mpeg')) {
            myAudio.setAttribute('src', 'assets/audio/ringtone.mp3');
        }
        myAudio.play();

        }
        $('#loadmessage').append(chat);
        $('#loadmessage').animate({
            scrollTop: $('#loadmessage')[0].scrollHeight + 1000
        }, "slow");
        setTimeout(() => {
            $('title').html('SKENSA-GroupChat');
        }, 1000);
        
    });
</script>