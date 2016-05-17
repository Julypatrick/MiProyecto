<?php

// Page cr�� par Shepard [Fabian Pijcke] <Shepard8@laposte.net>
// Arno Esterhuizen <arno.esterhuizen@gmail.com>
// et Romain Bourdon <romain@anaska.com>
//  
// ic�nes par Mark James <http://www.famfamfam.com/lab/icons/silk/>



//chemin jusqu'au fichier de conf de WampServer
$wampConfFile = '../wampmanager.conf';

//chemin jusqu'aux fichiers alias
$aliasDir = '../alias/';



// on charge le fichier de conf locale
if (!is_file($wampConfFile))
    die ('Unable to open WampServer\'s config file, please change path in index.php file');
//require $wampConfFile;
$fp = fopen($wampConfFile,'r');
$wampConfFileContents = fread ($fp, filesize ($wampConfFile));
fclose ($fp);


//on r�cp�res les versions des applis
preg_match('|phpVersion = (.*)\n|',$wampConfFileContents,$result);
$phpVersion = str_replace('"','',$result[1]);
preg_match('|apacheVersion = (.*)\n|',$wampConfFileContents,$result);
$apacheVersion = str_replace('"','',$result[1]);
preg_match('|mysqlVersion = (.*)\n|',$wampConfFileContents,$result);
$mysqlVersion = str_replace('"','',$result[1]);
preg_match('|wampserverVersion = (.*)\n|',$wampConfFileContents,$result);
$wampserverVersion = str_replace('"','',$result[1]);



// repertoires � ignorer dans les projets
$projectsListIgnore = array ('.','..');


// textes
$langues = array(
	'en' => array(
		'langue' => 'English',
		'autreLangue' => 'Version Fran&ccedil;aise',
		'autreLangueLien' => 'fr',
		'titreHtml' => 'WAMPSERVER Homepage',
		'titreConf' => 'Server Configuration',
		'versa' => 'Apache Version :',
		'versp' => 'PHP Version :',
		'versm' => 'MySQL Version :',
		'phpExt' => 'Loaded Extensions : ',
		'titrePage' => 'Tools',
		'txtProjet' => 'Your Projects',
		'txtNoProjet' => 'No projects yet.<br />To create a new one, just create a directory in \'www\'.',
		'txtAlias' => 'Your Aliases',
		'txtNoAlias' => 'No Alias yet.<br />To create a new one, use the WAMPSERVER menu.',
		'faq' => 'http://www.en.wampserver.com/faq.php'
	),
	'fr' => array(
		'langue' => 'Fran�ais',
		'autreLangue' => 'English Version',
		'autreLangueLien' => 'en',
		'titreHtml' => 'Accueil WAMPSERVER',
		'titreConf' => 'Configuration Serveur',
		'versa' => 'Version de Apache:',
		'versp' => 'Version de PHP:',
		'versm' => 'Version de MySQL:',
		'phpExt' => 'Extensions Charg&eacute;es: ',
		'titrePage' => 'Outils',
		'txtProjet' => 'Vos Projets',
		'txtNoProjet' => 'Aucun projet.<br /> Pour en ajouter un nouveau, cr&eacute;ez simplement un r&eacute;pertoire dans \'www\'.',
		'txtAlias' => 'Vos Alias',
		'txtNoAlias' => 'Aucun alias.<br /> Pour en ajouter un nouveau, utilisez le menu de WAMPSERVER.',
		'faq' => 'http://www.wampserver.com/faq.php'
	)
);



// images
$pngFolder = <<< EOFILE
iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAA3NCSVQICAjb4U/gAAABhlBMVEX//v7//v3///7//fr//fj+/v3//fb+/fT+/Pf//PX+/Pb+/PP+/PL+/PH+/PD+++/+++7++u/9+vL9+vH79+r79+n79uj89tj89Nf889D88sj78sz78sr58N3u7u7u7ev777j67bL67Kv46sHt6uP26cns6d356aP56aD56Jv45pT45pP45ZD45I324av344r344T14J734oT34YD13pD24Hv03af13pP233X025303JL23nX23nHz2pX23Gvn2a7122fz2I3122T12mLz14Xv1JPy1YD12Vz02Fvy1H7v04T011Py03j011b01k7v0n/x0nHz1Ejv0Hnuz3Xx0Gvz00buzofz00Pxz2juz3Hy0TrmznzmzoHy0Djqy2vtymnxzS3xzi/kyG3jyG7wyyXkwJjpwHLiw2Liw2HhwmDdvlXevVPduVThsX7btDrbsj/gq3DbsDzbrT7brDvaqzjapjrbpTraojnboTrbmzrbmjrbl0Tbljrakz3ajzzZjTfZijLZiTJdVmhqAAAAgnRSTlP///////////////////////////////////////8A////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////9XzUpQAAAAlwSFlzAAALEgAACxIB0t1+/AAAAB90RVh0U29mdHdhcmUATWFjcm9tZWRpYSBGaXJld29ya3MgOLVo0ngAAACqSURBVBiVY5BDAwxECGRlpgNBtpoKCMjLM8jnsYKASFJycnJ0tD1QRT6HromhHj8YMOcABYqEzc3d4uO9vIKCIkULgQIlYq5haao8YMBUDBQoZWIBAnFtAwsHD4kyoEA5l5SCkqa+qZ27X7hkBVCgUkhRXcvI2sk3MCpRugooUCOooWNs4+wdGpuQIlMDFKiWNbO0dXTx9AwICVGuBQqkFtQ1wEB9LhGeAwDSdzMEmZfC0wAAAABJRU5ErkJggg==
EOFILE;
$pngFolderGo = <<< EOFILE
iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAJISURBVDjLpZPLS5RhFIef93NmnMIRSynvgRF5KWhRlmWbbotwU9sWLupfCBeBEYhQm2iVq1oF0TKIILIkMgosxBaBkpFDmpo549y+772dFl5bBIG/5eGch9+5KRFhOwrYpmIAk8+OjScr29uV2soTotzXtLOZLiD6q0oBUDjY89nGAJQErU3dD+NKKZDVYpTChr9a5sdvpWUtClCWqBRxZiE/9+o68CQGgJUQr8ujn/dxugyCSpRKkaw/S33n7QQigAfxgKCCitqpp939mwCjAvEapxOIF3xpBlOYJ78wQjxZB2LAa0QsYEm19iUQv29jBihJeltCF0F0AZNbIdXaS7K6ba3hdQey6iBWBS6IbQJMQGzHHqrarm0kCh6vf2AzLxGX5eboc5ZLBe52dZBsvAGRsAUgIi7EFycQl0VcDrEZvFlGXBZshtCGNNa0cXVkjEdXIjBb1kiEiLd4s4jYLOKy9L1+DGLQ3qKtpW7XAdpqj5MLC/Q8uMi98oYtAC2icIj9jdgMYjNYrznf0YsTj/MOjzCbTXO48RR5XaJ35k2yMBCoGIBov2yLSztNPpHCpwKROKHVOPF8X5rCeIv1BuMMK1GOI02nyZsiH769DVcBYXRneuhSJ8I5FCmAsNomrbPsrWzGeocTz1x2ht0VtXxKj/Jl+v1y0dCg/vVMl4daXKg12mtCq9lf0xGcaLnA2Mw7hidfTGhL5+ygROp/v/HQQLB4tPlMzcjk8EftOTk7KHr1hP4T0NKvFp0vqyl5F18YFLse/wPLHlqRZqo3CAAAAABJRU5ErkJggg==
EOFILE;
$gifLogo = <<< EOFILE
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
EOFILE;
$pngPlugin = <<< EOFILE
iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAACXBIWXMAAAsSAAALEgHS3X78AAAABGdBTUEAALGOfPtRkwAAACBjSFJNAAB6JQAAgIMAAPn/AACA6QAAdTAAAOpgAAA6mAAAF2+SX8VGAAABmklEQVR42mL4//8/AyUYIIDAxK5du1BwXEb3/9D4FjBOzZ/wH10ehkF6AQIIw4B1G7b+D09o/h+X3gXG4YmteA0ACCCsLghPbPkfm9b5PzK5439Sdg9eAwACCEyANMBwaFwTGIMMAOEQIBuGA6Mb/qMbABBAEAOQnIyMo1M74Tgiqf2/b3gVhgEAAQQmQuKa/8ekdYMxyLCgmEYMHJXc9t87FNMAgACCGgBxIkgzyDaQU5FxQGQN2AUBUXX/vULKwdgjsOQ/SC9AAKEEYlB03f+oFJABdSjYP6L6P0guIqkVjt0DisEGAAQQigEgG0AhHxBVi4L9wqvBBiEHtqs/xACAAAIbEBBd/x+Eg2ObwH4FORmGfYCaQRikCUS7B5YBNReBMUgvQABBDADaAtIIwsEx9f/Dk9pQsH9kHTh8XANKMAIRIIDAhF9ELTiQQH4FaQAZCAsskPNhyRpkK7oBAAEEMSC8GsVGkEaYIlBghcU3gbGzL6YBAAEEJnzCgP6EYs/gcjCGKQI5G4Z9QiswDAAIIAZKszNAgAEAHgFgGSNMTwgAAAAASUVORK5CYII=
EOFILE;
$pngWrench = <<< EOFILE
iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAA3NCSVQICAjb4U/gAAABO1BMVEXu7u7n5+fk5OTi4uLg4ODd3d3X19fV1dXU1NTS0tLPz8+7z+/MzMy6zu65ze65zu7Kysq3zO62zO3IyMjHx8e1yOiyyO2yyOzFxcXExMSyxue0xuexxefDw8OtxeuwxOXCwsLBwcGuxOWsw+q/v7+qweqqwuqrwuq+vr6nv+qmv+m7u7ukvumkvemivOi5ubm4uLicuOebuOeat+e0tLSYtuabtuaatuaXteaZteaatN6Xs+aVs+WTsuaTsuWRsOSrq6uLreKoqKinp6elpaWLqNijo6OFpt2CpNyAo92BotyAo9+dnZ18oNqbm5t4nt57nth7ntp4nt15ndp3nd6ZmZmYmJhym956mtJzm96WlpaVlZVwmNyTk5Nvl9lultuSkpKNjY2Li4uKioqIiIiHh4eGhoZQgtVKfNFdha6iAAAAaXRSTlMA//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////914ivwAAAACXBIWXMAAAsSAAALEgHS3X78AAAAH3RFWHRTb2Z0d2FyZQBNYWNyb21lZGlhIEZpcmV3b3JrcyA4tWjSeAAAAKFJREFUGJVjYIABASc/PwYkIODDxBCNLODEzGiQgCwQxsTlzJCYmAgXiGKVdHFxYEuB8dkTOIS1tRUVocaIWiWI8IiIKKikaoD50kYWrpwmKSkpsRC+lBk3t2NEMgtMu4wpr5aeuHcAjC9vzadjYyjn7w7lK9kK6tqZK4d4wBQECenZW6pHesEdFC9mbK0W7otwsqenqmpMILIn4tIzgpG4ADUpGMOpkOiuAAAAAElFTkSuQmCC
EOFILE;
$favicon = <<< EOFILE
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AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADx5dJX7ceM/+/Iif/u1Ku5AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADx7+kG7NSvpOrMnMjt5NUmAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP///////z9AH///////P0AH//////8/QAD//////z9AAD//////P0AwB/////8/YB4B/////z9wD8Af////P3gH8AH///8/fAP+AB///z9+Af/AB///P38A//AD//8/f4B//AP//z9/wB//A///P3/gD/wD//8/f/gH8Af//z9//APAB///P3/+AQAf//8/f/8AAH///z9//4AA////P3//AAP///8/f/wAD////z9/8AAH////P3+AAAP///8/fAAEAf///z94AB8A////P3AA/4B///8/cAP/wD///z9wD4fgH///P3h/A/AH//8/f/8D+AP//z9//gP+AP//P3/8B8cAf/8/f/wPg4Af/z9/+B+DwA//P3/4PwPwA/8/f/x/A/gA/z9///8D/AA/P3///wP/AD8/f///B+GAPz9///8HwcA/P3///wfA8D8/f///D8D8fz9/////wP//P3/////gf/8/f////+B//z9/////8P//P3/////w//8/SgAAAAYAAAAMAAAAAEAIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAC7jFuUp18I8LR8QLS/k2RD3NDGAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACqZhvhplwC/6ZcA/2nXg/trW4q0LiHTm3OtJkPAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA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
EOFILE;


//affichage du phpinfo
if (isset($_GET['phpinfo']))
{
	phpinfo();
	exit();
}


//affichage des images
if (isset($_GET['img']))
{
    switch ($_GET['img'])
    {
        case 'pngFolder' :
        header("Content-type: image/png");
        echo base64_decode($pngFolder);
        exit();
        
        case 'pngFolderGo' :
        header("Content-type: image/png");
        echo base64_decode($pngFolderGo);
        exit();
        
        case 'gifLogo' :
        header("Content-type: image/gif");
        echo base64_decode($gifLogo);
        exit();
        
        case 'pngPlugin' :
        header("Content-type: image/png");
        echo base64_decode($pngPlugin);
        exit();
        
        case 'pngWrench' :
        header("Content-type: image/png");
        echo base64_decode($pngWrench);
        exit();
        
        case 'favicon' :
        header("Content-type: image/x-icon");
        echo base64_decode($favicon);
        exit();
    }
}



// D�finition de la langue et des textes 

if (isset ($_GET['lang']))
{
	$langue = $_GET['lang'];
}
elseif (isset ($_SERVER['HTTP_ACCEPT_LANGUAGE']) AND preg_match("/^fr/", $_SERVER['HTTP_ACCEPT_LANGUAGE']))
{
	$langue = 'fr';
}
else
{
	$langue = 'en';
}

//initialisation
$aliasContents = '';

// recuperation des alias
if (is_dir($aliasDir))
{
    $handle=opendir($aliasDir);
    while ($file = readdir($handle)) 
    {
	    if (is_file($aliasDir.$file) && strstr($file, '.conf'))
	    {		
		    $msg = '';
		    $aliasContents .= '<li><a href="'.str_replace('.conf','',$file).'/">'.str_replace('.conf','',$file).'</a></li>';
	    }
    }
    closedir($handle);
}
if (!isset($aliasContents))
	$aliasContents = $langues[$langue]['txtNoAlias'];


// recuperation des projets
$handle=opendir(".");
$projectContents = '';
while ($file = readdir($handle)) 
{
	if (is_dir($file) && !in_array($file,$projectsListIgnore)) 
	{		
		$projectContents .= '<li><a href="'.$file.'">'.$file.'</a></li>';
	}
}
closedir($handle);
if (!isset($projectContents))
	$projectContents = $langues[$langue]['txtNoProjet'];


//initialisation
$phpExtContents = '';

// recuperation des extensions PHP
$loaded_extensions = get_loaded_extensions();
foreach ($loaded_extensions as $extension)
	$phpExtContents .= "<li>${extension}</li>";




$pageContents = <<< EOPAGE
<?xml version="1.0" encoding="iso-8859-1"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html lang="en" xml:lang="en">
<head>
	<title>{$langues[$langue]['titreHtml']}</title>
	<meta http-equiv="Content-Type" content="txt/html; charset=utf-8" />

	<style type="text/css">
* {
	margin: 0;
	padding: 0;
}

html {
	background: #ddd;
}
body {
	margin: 1em 10%;
	padding: 1em 3em;
	font: 80%/1.4 tahoma, arial, helvetica, lucida sans, sans-serif;
	border: 1px solid #999;
	background: #eee;
	position: relative;
}
#head {
	margin-bottom: 1.8em;
	margin-top: 1.8em;
	padding-bottom: 0em;
	border-bottom: 1px solid #999;
	letter-spacing: -500em;
	text-indent: -500em;
	height: 125px;
	background: url(index.php?img=gifLogo) 0 0 no-repeat;
}
.utility {
	position: absolute;
	right: 4em;
	top: 145px;
	font-size: 0.85em;
}
.utility li {
	display: inline;
}

h2 {
	margin: 0.8em 0 0 0;
}

ul {
	list-style: none;
	margin: 0;
	padding: 0;
}
#head ul li, dl ul li, #foot li {
	list-style: none;
	display: inline;
	margin: 0;
	padding: 0 0.2em;
}
ul.aliases, ul.projects, ul.tools {
	list-style: none;
	line-height: 24px;
}
ul.aliases a, ul.projects a, ul.tools a {
	padding-left: 22px;
	background: url(index.php?img=pngFolder) 0 100% no-repeat;
}
ul.tools a {
	background: url(index.php?img=pngWrench) 0 100% no-repeat;
}
ul.aliases a {
	background: url(index.php?img=pngFolderGo) 0 100% no-repeat;
}
dl {
	margin: 0;
	padding: 0;
}
dt {
	font-weight: bold;
	text-align: right;
	width: 11em;
	clear: both;
}
dd {
	margin: -1.35em 0 0 12em;
	padding-bottom: 0.4em;
	overflow: auto;
}
dd ul li {
	float: left;
	display: block;
	width: 16.5%;
	margin: 0;
	padding: 0 0 0 20px;
	background: url(index.php?img=pngPlugin) 2px 50% no-repeat;
	line-height: 1.6;
}
a {
	color: #024378;
	font-weight: bold;
	text-decoration: none;
}
a:hover {
	color: #04569A;
	text-decoration: underline;
}
#foot {
	text-align: center;
	margin-top: 1.8em;
	border-top: 1px solid #999;
	padding-top: 1em;
	font-size: 0.85em;
}
</style>
    
	<link rel="shortcut icon" href="index.php?img=favicon" type="image/ico" />
</head>

<body>
	<div id="head">
		<h1><abbr title="Windows">W</abbr><abbr title="Apache">A</abbr><abbr title="MySQL">M</abbr><abbr title="PHP">P</abbr></h1>
		<ul>
			<li>PHP 5</li>
			<li>Apache 2</li>
			<li>MySQL 5</li>
		</ul>
	</div>

	<ul class="utility">
		<li>Version ${wampserverVersion}</li>
		<li><a href="?lang={$langues[$langue]['autreLangueLien']}">{$langues[$langue]['autreLangue']}</a></li>
	</ul>

	<h2> {$langues[$langue]['titreConf']} </h2>

	<dl class="content">
		<dt>{$langues[$langue]['versa']}</dt>
		<dd>${apacheVersion} &nbsp;</dd>
		<dt>{$langues[$langue]['versp']}</dt>
		<dd>${phpVersion} &nbsp;</dd>
		<dt>{$langues[$langue]['phpExt']}</dt> 
		<dd>
			<ul>
			${phpExtContents}
			</ul>
		</dd>
		<dt>{$langues[$langue]['versm']}</dt>
		<dd>${mysqlVersion} &nbsp;</dd>
	</dl>
	<h2>{$langues[$langue]['titrePage']}</h2>
	<ul class="tools">
		<li><a href="?phpinfo=1">phpinfo()</a></li>
		<li><a href="phpmyadmin/">phpmyadmin</a></li>
	</ul>
	<h2>{$langues[$langue]['txtProjet']}</h2>
	<ul class="projects">
	$projectContents
	</ul>
	<h2>{$langues[$langue]['txtAlias']}</h2>
	<ul class="aliases">
	${aliasContents}			
	</ul>
	<ul id="foot">
		<li><a href="http://www.wampserver.com">WampServer</a></li> - 
        <li><a href="http://www.wampserver.com/en/donations.php">Donate</a></li> -
		<li><a href="http://www.anaska.com">Anaska</a></li>
	</ul>
</body>
</html>
EOPAGE;

echo $pageContents;
?>


