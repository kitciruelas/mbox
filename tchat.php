<html>
<head>
    <link rel="stylesheet" href="css/tchat.css">
    <title>Chat Box</title>
</head>
<body>
    <div id="container">
        <div class="header">
            <h1>Pansol Group Chat</h1>
        </div>
        
        <div class="main">
            <?php
                session_start();
                if(!isset($_SESSION['username'])){
            ?>
            <form name="form2" method="post" action="login.php">
                <?php 
                    if(isset($_GET['message'])){ 
                        $message=$_GET['message'];
                        echo "<h3>$message</h3>";
                    }
                ?>
                <h3>
                <table>
                <tr>
                    <td><input type="text" name="username" placeholder="Username"></td>
                    <td><input type="password" name="password" placeholder="Passwords"></td>
                    <td><input type="submit" name="submit" value="Login"></td>
                </tr>
                </table>
                </h3>

                <?php 
                    if(isset($_GET['message1'])){ 
                        $message=$_GET['message1'];
                        echo "<h5>$message</h5>";
                    }
                ?>
            <?php
                exit;
                }
            ?>

            <?php 
                if(isset($_GET['username'])){
                    $_GET['username'];
                }
            ?>

            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script>
    function submitchat(){
        if(form1.msg.value == ''){ //exit if the message field is blank
            alert('Enter your message!');
            return;
        }
        var msg = form1.msg.value;
        var xmlhttp = new XMLHttpRequest(); //http request instance
        
        xmlhttp.onreadystatechange = function(){ //display the content of insert.php once successfully loaded
            if(xmlhttp.readyState==4&&xmlhttp.status==200){
                document.getElementById('chatlogs').innerHTML = xmlhttp.responseText; //the chatlogs from the db will be displayed inside the div section
                scrollChatToBottom(); // Scroll to bottom after new content is added
                document.getElementById("messageForm").reset(); // Reset the form after sending the message
            }
        }
        xmlhttp.open('GET', 'insert.php?msg='+msg, true); //open and send http request
        xmlhttp.send();
    }

    $(document).ready(function(e) {
        $.ajaxSetup({cache:false});
        setInterval(function() {
            $('#chatlogs').load('logs.php', function() {
                scrollChatToTop(); // Scroll to top after loading new logs
            });
        }, 2000);
    });

    function scrollChatToBottom() {
        var chatlogs = document.getElementById('chatlogs');
        chatlogs.scrollTop = chatlogs.scrollHeight; // Scroll to the bottom
    }

    function scrollChatToTop() {
        var chatlogs = document.getElementById('chatlogs');
        chatlogs.scrollTop = 0; // Scroll to the top
    }
</script>

        
            <h2>Hi, <?php echo $_SESSION['username']; ?></h2>
            <div id="chatlogs">
                LOADING CHATLOGS, PLEASE WAIT...
            </div>
            <form name="form1" id="messageForm">
                <textarea name="msg" placeholder="Your message here..."></textarea>
                <a href="#" onClick="submitchat()" class="button">Send</a><br><br>
            </form>
        </div>
    </div>
</body>
</html>
