<?php session_start();

    require_once("login.inc.php");
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    # check connection
    if ($mysqli->connect_errno) {
        echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
        exit();
    }
?>
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
 <?php if(empty($_SESSION)){ ?>
	 
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post" class="form1">
        Username: <input type="text" name="username" /><br />
        Password: <input type="password" name="password" /><br />
 
        <input type="submit" name="submit" value="Login" />
    </form>    
 <?php }   ?>
 
<div class="userinfo"><?php
		
		
		if(isset($_SESSION['userid'])){
			$id = $_SESSION['userid'];
			$query = $mysqli->query('SELECT * FROM users WHERE id="'. $id .'"') or die ($mysqli->error);
			
			$row = $query->fetch_assoc();
			
			echo '<b>Username:</b>'.''. $row['username'].'</br>';
			echo '<b>Voornaam:</b>'.''. $row['first_name'].'</br>';
			echo '<b>Achternaam:</b>'.''. $row['last_name'].'</br>';
			echo '<b>Wachtwoord:</b>'.''. '*********'.'</br>';
			echo '<b>Email:</b>'.'&nbsp'. $row['email'].'</br>';
			
			echo '<form action="#" method="post" class="form3">
        Favoriete Acteur: <input type="text" name="username" class="velden" required /><br />
        Favoriete Film: <input type="password" name="password" class="velden" required /><br />
        Favoriete Genre: <input type="text" name="first_name"class="velden" required /><br />
		<input type="submit" name="submit" value="Toevoegen"/>
    </form>';

$link = 'http://www.nu.nl/feeds/rss/film.rss';
$xml = simplexml_load_file($link);
$titel = $xml->channel->item->title;
$beschrijving = $mysqli->real_escape_string($xml->channel->item->description);
$plaatje =$xml->channel->item->enclosure['url'];
$cato = $xml->channel->item->category;
	
	echo '<div id="rssinfo"><b>'. $titel .'</b><hr><br/><br/>'.$beschrijving.'<br/><img style="float:left" src="'.$plaatje.'"/></div>';
	
	echo '<div id="rssfilminfo">
	<b><span class="laatstbekeken">Laatst bekeken trailer</span></b>
	<iframe id="ytplayer" type="text/html" width="380" height="213.75"
src="https://www.youtube.com/embed/e73J71RZRn8?controls=0&showinfo=0&theme=light"
frameborder="0" allowfullscreen> 


</div>';
			
			
			
			
			
			
		}else{
		
			
if (!isset($_POST['submit'])){
	echo 'Log eerst in Alstublieft';

?></div>
<?php
} else {
    require_once("login.inc.php");
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    # check connection
    if ($mysqli->connect_errno) {
        echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
        exit();
    }
 
    $username =$mysqli->real_escape_string($_POST['username']);
    $password =$mysqli->real_escape_string(hash ('sha512',$_POST['password']));
 
    $sql = "SELECT * from users WHERE username LIKE '{$username}' AND password LIKE '{$password}' LIMIT 1";
    $result = $mysqli->query($sql);
    if (!$result->num_rows == 1) {
        echo "<p>Ongeldig Wachtwoord of gebruikersnaam</p>";
		echo $password;
    } else {
		$fetch = $result->fetch_assoc();
		$_SESSION['userid'] = $fetch['id'];
				echo "<p>U bent succesvol ingelogd.</p>";
        // do stuffs
    }
}

		}
		?>



     

</body>
</html>
