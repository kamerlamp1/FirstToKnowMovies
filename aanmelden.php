<?php session_start(); ?> 
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<title>FirstToKnowMovies</title>
</head>

<body bgcolor='#fff2cc' '>
<div id='background'></div>
<div id='logobackground'><div id='logo'></div></div>
<hr color=#000 ,width=auto , height=2px , margin=0 ,>
<div id='cssmenu'>
<ul>
   <li class='active'><a href='index.php'><span>Home</span></a></li>
   <li class='has-sub'><a href='aanmelden.php'><span>Aanmelden</span></a>
      <ul>
         <li class='has-sub'><a href='login1.php'><span>
<?php
	if(isset($_SESSION['userid'])) {
		echo '<a href="profiel.php">Mijn Account</a>';
	}
	else {
		echo '<a href="login1.php">Login</a>';
	}
?>
            </span></a>

            <ul>
               <li><a href='profiel.php'><span>Profiel</span></a></li>
               <li><a href='mijnfilms.php'><span>Mijn films</span></a></li>
               <li><a href='uitloggen.php'><span>Uitloggen</span></a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li><a href='about.php'><span>About</span></a></li>
   <li class='last'><a href='contact.php'><span>Contact</span></a></li>
</ul>
</div>
<script>
$('#cssmenu').prepend('<div id="indicatorContainer"><div id="pIndicator"><div id="cIndicator"></div></div></div>');
    var activeElement = $('#cssmenu>ul>li:first');

    $('#cssmenu>ul>li').each(function() {
        if ($(this).hasClass('active')) {
            activeElement = $(this);
        }
    });


	var posLeft = activeElement.position().left;
	var elementWidth = activeElement.width();
	posLeft = posLeft + elementWidth/2 -6;
	if (activeElement.hasClass('has-sub')) {
		posLeft -= 6;
	}

	$('#cssmenu #pIndicator').css('left', posLeft);
	var element, leftPos, indicator = $('#cssmenu pIndicator');
	
	$("#cssmenu>ul>li").hover(function() {
        element = $(this);
        var w = element.width();
        if ($(this).hasClass('has-sub'))
        {
        	leftPos = element.position().left + w/2 - 12;
        }
        else {
        	leftPos = element.position().left + w/2 - 6;
        }

        $('#cssmenu #pIndicator').css('left', leftPos);
    }
    , function() {
    	$('#cssmenu #pIndicator').css('left', posLeft);
    });


	$('#cssmenu>ul>.has-sub>ul').append('<div class="submenuArrow"></div>');
	$('#cssmenu>ul').children('.has-sub').each(function() {
		var posLeftArrow = $(this).width();
		posLeftArrow /= 2;
		posLeftArrow -= 12;
		$(this).find('.submenuArrow').css('left', posLeftArrow);

	});

	$('#cssmenu>ul').prepend('<li id="menu-button"><a>Menu</a></li>');
	$( "#menu-button" ).click(function(){
    		if ($(this).parent().hasClass('open')) {
    			$(this).parent().removeClass('open');
    		}
    		else {
    			$(this).parent().addClass('open');
    		}
    	});
		</script>



<?php
require_once("login.inc.php");
if (!isset($_POST['submit'])) {
?>    <!-- The HTML registration form -->
    <form action="#" method="post" class="form">
        Inlognaam: <input type="text" name="username" class="velden" required /><br />
        Wachtwoord: <input type="password" name="password" class="velden" required /><br />
        Voornaam: <input type="text" name="first_name"class="velden" required /><br />
        Achternaam: <input type="text" name="last_name" class="velden" required /><br />
        Email: <input type="type" name="email" class="velden" required /><br />
        <input type="submit" name="submit" value="Register" id='Register' />
    </form>
<?php
} else {
## connect mysql server
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    # check connection
    if ($mysqli->connect_errno) {
        echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
        exit();
    }
## query database
    # prepare data for insertion
    $username    = $mysqli->real_escape_string($_POST['username']);
    $password    = $mysqli->real_escape_string(hash('sha512',$_POST['password']));
    $first_name  = $mysqli->real_escape_string($_POST['first_name']);
    $last_name   = $mysqli->real_escape_string($_POST['last_name']);
    $email       = $mysqli->real_escape_string($_POST['email']);
 
    # check if username and email exist else insert
    $exists = 0;
    $result = $mysqli->query("SELECT username from users WHERE username = '{$username}' LIMIT 1");
    if ($result->num_rows == 1) {
        $exists = 1;
        $result = $mysqli->query("SELECT email from users WHERE email = '{$email}' LIMIT 1");
        if ($result->num_rows == 1) $exists = 2;    
    } else {
        $result = $mysqli->query("SELECT email from users WHERE email = '{$email}' LIMIT 1");
        if ($result->num_rows == 1) $exists = 3;
    }
 
    if ($exists == 1) echo "<p>Username already exists!</p>";
    else if ($exists == 2) echo "<p>Username and Email already exists!</p>";
    else if ($exists == 3) echo "<p>Email already exists!</p>";
    else {
        # insert data into mysql database
       # insert data into mysql database
        $sql = "INSERT  INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`) 
                VALUES (NULL, '{$username}', '{$password}', '{$first_name}', '{$last_name}', '{$email}')";
 
         if ($mysqli->query($sql)) {
            //echo "New Record has id ".$mysqli->insert_id;
            echo "<p>Registred successfully!</p>";
        } else {
            echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
            exit();
        }
		
    }
}

?>     

</body>
</html>
