<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
	session_start();
	if(@$_SESSION['tt.logged_in'] !== $_SERVER['REMOTE_ADDR']) { unset($_SESSION['tt.logged_in']); }

	/*define('IN_PHPBB',true);
	$phpbb_root_path = './community/';
	$phpEx = substr(strrchr(__FILE__, '.'),1);
	require_once($phpbb_root_path.'common.'.$phpEx);
	$user->session_begin();*/


	require_once("./common.php");
	require_once("./includes.php");

?>

	<title>Tunnel Trouble</title>
	
	<meta property="og:url"           content="http://durf.cf/tt/" />
	<meta itemprop="name"             content="Tunnel Trouble" />
	<meta property="og:title"         content="Tunnel Trouble" />
	<meta itemprop="description"      content="Rankings for tunnel trouble" />
	<meta property="og:description"   content="Rankings for tunnel trouble" />
	<meta property="og:image"         content="http://durf.cf/favicon.ico" />
	
<?php addIncludes("head", "\t"); ?>
</head>

<body class="blue-grey darken-4">
	
	<nav class="grey darken-4" role="navigation">
		<div class="nav-wrapper container">
			<a id="logo-container" href="/tt/" class="brand-logo left">Tunnel Trouble</a>
			<ul class="nav-mobile right">
<?php
				require_once("./pages.php");
				if(file_exists("./pages_usr.php")) include("./pages_usr.php");
				foreach($pages_nav as $page)
				{
					print("\t\t\t\t");
					$class = "";
					if( isset($page["active"]) && ($page["active"])() )
					{
						$class .= "active ";
					}
					print('<li class="'.$class.'"><a class="waves-effect" href="'.$page[1].'">'.$page[0].'</a></li>'."\n");
				}
?>
			</ul>
		</div>
	</nav>
	
<?php 
	if( isset($_GET["error"]) && $_GET["error"] == 404 )
	{
	}
	elseif( isset($_GET["ladder"]) )
	{
		include("content/ladder.php");
	}
	elseif( isset($_GET["user"]) )
	{
		include("content/user.php");
	}
	elseif( isset($_GET["ranks"]) )
	{
		include("content/ranks.php");
	}
	elseif( empty($_GET) || isset($_GET["maps"]) )
	{
		include("content/maps.php");
	}
?>

<!-- Map preview dialog -->
	<div id="previewmap" class="modal fade grey darken-4" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<span class="modal-title" id="pMapTitle"></span>
				</div>
				<div class="modal-content" id="pMapContent">
					<p>Error!</p>
				</div>
				<div class="modal-footer grey darken-4">
					<!--
					<label class="checkbox-inline"><input type="checkbox" class="filled-in" id="gridcheck" onchange="previewgrid(this.checked)"/><span>Show Grid</span></label>
					-->
					<a id="viewsrc" href="https://www.armanelgtron.tk/armagetronad/resource/" target="_blank" class="btn btn-info">View source</a>
					<button type="button" class="btn btn-primary modal-close" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

<?php addIncludes("end"); ?>
</body>

</html>
