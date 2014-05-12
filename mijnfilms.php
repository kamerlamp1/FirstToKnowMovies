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
   <li class='last'><a href='#'><span>Contact</span></a></li>
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



     

</body>
</html>
