<?php
require ('config.php');
if(in_array($language, $LANGUAGE_LIST)) {
  include('./lang/'.$language.'.php');
} else {
  include('./lang/'.$LANGUAGE_LIST[0].'.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AIUM - <? echo $lang[title];?></title>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold' rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="<?=$dir_img?>/<?=$style?>.css" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans+Mono' rel='stylesheet' type='text/css' />
<!--links above are for the special font used in this design-->
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.4.2.min.js" language="javascript"></script>
<script type="text/javascript" src="js/jquery.tools.min.js" language="javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".trigger").click(function(){
		$(".panel").toggle("fast");
		$(this).toggleClass("active");
		return false;
	});
});
</script>
<!--[if IE 8]>
<link href="css/ie8.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!--[if IE 7]>
<link href="css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!--[if IE 6]>
<script defer type="text/javascript" src="js/pngfix.js"></script>
<![endif]-->
<?
if (@phpversion() < '4.1.0') {
    $_FILE = $HTTP_POST_FILES;
    $_GET = $HTTP_GET_VARS;
    $_POST = $HTTP_POST_VARS;
}
clearstatcache();
error_reporting(E_ALL & ~E_NOTICE);
$fum_vers = "1.3"; # do not edit this line, the script will not work!!!
$fum_info_full = "File Upload Manager v$fum_vers";

function authDo($auth_userToCheck, $auth_passToCheck) 
{
	global $auth_usern, $auth_passw;
	$auth_encodedPass = md5($auth_passw);
	
	if ($auth_userToCheck == $auth_usern && $auth_passToCheck == $auth_encodedPass) {
	$auth_check = TRUE;
	} else {
	$auth_check = FALSE;
	} 
	return $auth_check;
	}
	
	if (isset($logout)) {
	setcookie ('fum_user', "",time()-3600); 
	setcookie ('fum_pass', "",time()-3600);
	}
		
	if (isset($login)) {
	$auth_password_en = md5($auth_formPass); 
	$auth_username_en = $auth_formUser;

	if (authDo($auth_username_en, $auth_password_en)) { 
	setcookie ('fum_user', $auth_username_en,time()+3600); 
	setcookie ('fum_pass', $auth_password_en,time()+3600); 
	$auth_msg = "<b>Authentication successful!</b> The cookies have been set.<br><br>".
	$auth_msg . "Your password (MD5 encrypted) is: $auth_password_en";
	} else { 
	$auth_msg = "<b>Authentication error!</b>";
	}
}

if (($_GET[act]=="dl")&&$_GET[file]) 
{
	if ($auth_ReqPass != 1 || ($auth_ReqPass == 1 && isset($fum_user) && !isset($logout))) { 
	if ($auth_ReqPass != 1 || ($auth_ReqPass == 1 && authDo($fum_user, $fum_pass))) {

	$value_de=base64_decode($_GET[file]);
	$dl_full=$dir_store."/".$value_de;
	$dl_name=$value_de;

	if (!file_exists($dl_full))
	{ 
	echo"ERROR: Cannot download file, it does not exist.<br>�<a href=\"$_SERVER[PHP_SELF]\">back</a>";  
	exit();
	} 
	
	header("Content-Type: application/octet-stream");
	header("Content-Disposition: attachment; filename=$dl_name");
	header("Content-Length: ".filesize($dl_full));
	header("Accept-Ranges: bytes");
	header("Pragma: no-cache");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-transfer-encoding: binary");
			
	@readfile($dl_full);
	
	exit();

	}
	}
}

function getlast($toget)
{
	$pos=strrpos($toget,".");
	$lastext=substr($toget,$pos+1);

	return $lastext;
}

function replace($o)
{
	$o=str_replace("/","",$o);
	$o=str_replace("\\","",$o);
	$o=str_replace(":","",$o);
	$o=str_replace("*","",$o);
	$o=str_replace("?","",$o);
	$o=str_replace("<","",$o);
	$o=str_replace(">","",$o);
	$o=str_replace("\"","",$o);
	$o=str_replace("|","",$o);
	
	return $o;
}

?>
<!-- <?=$fum_info_full?> -->
</head>
<body>
<div id="bg_top">
  <div id="wrapper">
    <div id="header">
      <div id="logo"><a href="index.php"><img src="images/aium-logo.png" WIDTH=224 HEIGHT=80  alt="Logo" /></a> </div>
      <!--end logo-->
      <div id="header_contact"> <img src="images/copy.gif" alt="Phone" width="17" height="13" class="icon" /><span class="small">Powered By</span><br />
        <span ><a href="http://fileupper.eu">MetroHost NetWork Group</a></span></div>
      <!--end header_contact-->
    </div>
    <!--end header-->
    
    <!--end menu-->
    <div id="content">
      <div id="content_top"><img src="images/main_top.png" width="956" height="16" alt="background" /></div>
      <!-- the shadow border down left/right -->
      <div id="content_border">
        <!-- the gradient from top to bottom -->
        <div id="content_bg">
          <!-- the optional line down the middle of the content area -->
          <div id="content_seperator">
            <div id="left_column">
              <div id="proposal" onclick="location.href='#';" style="cursor:pointer;">
                <div class="text">
                  <h3><? echo $lang[left_up];?></h3>
                  <p><? echo $lang[leftup_desc];?></p>
                </div>
                <div class="icon"><img src="images/png_jpg_gif_bmp.png" alt="Proposal" width="42" height="42" border="0" /></div>
              </div>
              <!--end proposal-->
              <div id="clients">
                <h3><? echo $lang[ftype];?></h3>
                <ul>
                  <li> <a href="#" class="tooltip_button"><img src="images/png.png" width="50" height="42" alt="1" /></a>
                    <!--start popup for client 1-->
                    <div class="tooltip">
                      <div class="text"> <span class="title"> <? echo $lang[png];?></span>
                        <p> <? echo $lang[png_desc];?>.<br />
                          <a href="http://en.wikipedia.org/wiki/Portable_Network_Graphics" target="_blank">More info</a></p>
                      </div>
                      
                    </div>
                    <!--end popup for client 1-->
                  </li>
                  <li><a href="#" class="tooltip_button"><img src="images/JPEG-File-icon.png" width="68" height="42" alt="2" /></a>
                    <!--start popup for client 2-->
                    <div class="tooltip">
                      <div class="text"> <span class="title"> <? echo $lang[jpeg];?></span>
                        <p> <? echo $lang[jpeg_desc];?>.<br />
                          <a href="http://en.wikipedia.org/wiki/JPG" target="_blank">More info</a></p>
                      </div>
                      
                    </div>
                    <!--end popup for client 2-->
                  </li>
                  <li><a href="#" class="tooltip_button"><img src="images/gif.png" width="50" height="42" alt="3" /></a>
                    <!--start popup for client 3-->
                    <div class="tooltip">
                      <div class="text"> <span class="title"> <? echo $lang[gif];?></span>
                        <p> <? echo $lang[gif_desc];?> [..]<br />
                          <a href="http://en.wikipedia.org/wiki/Gif" target="_blank">More info</a></p>
                      </div>
                      
                    </div>
                    <!--end popup for client 3-->
                  </li>
                  <li><a href="#" class="tooltip_button"><img src="images/rar.png" width="50" height="42" alt="4" /></a>
                    <!--start popup for client 4-->
                    <div class="tooltip">
                      <div class="text"> <span class="title"> <? echo $lang[rar];?></span>
                        <p> <? echo $lang[rar_desc];?>.<br />
                          <a href="http://en.wikipedia.org/wiki/Rar" target="_blank">More info</a></p>
                      </div>
                      
                    </div>
                    <!--end popup for client 4-->
                  </li>
                  <li><a href="#" class="tooltip_button"><img src="images/doc.png" width="68" height="42" alt="5" /></a>
                    <!--start popup for client 5-->
                    <div class="tooltip">
                      <div class="text"> <span class="title"> <? echo $lang[doc];?></span>
                        <p> <? echo $lang[doc_desc];?>.<br />
                          <a href="http://en.wikipedia.org/wiki/DOC_%28computing%29" target="_blank">More info</a></p>
                      </div>
                      
                    </div>
                    <!--end popup for client 5-->
                  </li>
                  <li><a href="#" class="tooltip_button"><img src="images/exe.png" width="50" height="42" alt="6" /></a>
                    <!--start popup for client 6-->
                    <div class="tooltip">
                      <div class="text"> <span class="title"> <? echo $lang[exe];?></span>
                        <p> <? echo $lang[exe_desc];?>.<br />
                          <a href="http://en.wikipedia.org/wiki/Exe">More info</a></p>
                      </div>
                      
                    </div>
                    <!--end popup for client 6-->
                  </li>
                </ul>
                <!--tooltip element-->
                <script type="text/javascript"> 
			$(document).ready(function() {
				$('.tooltip_button').tooltip({ 
					effect: 'fade', 
					predelay: 400,
					position: 'top center',
					offset: [-30,94]
				}); 
			});
            </script>
              </div>
              <!--end clients-->
              <div id="newsletter">
                <h3><? echo $lang[newsletter];?></h3>
                <form action="#" method="post" id="newsletter_form">
                  <div id="newsletter_input">
                    <label for="newsletter_name">
                      <input type="text" value="Name" name="name" id="newsletter_name" onfocus="if(this.value=='Name')this.value='';" onblur="if(this.value=='')this.value='Name';" />
                    </label>
                    <label for="newsletter_email">
                      <input name="email" type="text" id="newsletter_email" onfocus="if(this.value=='Email')this.value='';" onblur="if(this.value=='')this.value='Email';" value="Email"  />
                    </label>
                  </div>
                  <div id="newsletter_submit">
                    <label for="newsletter_submit_button">
                      <input type="submit" value="Subscribe" name="newsletter_submit_button" id="newsletter_submit_button" />
                    </label>
                  </div>
                </form>
              </div>
            </div>
            <!--end left_column-->
            <div id="right_column">
              <h1><? echo $lang[wmessage];?></h1><br/>
<center>
<?	
	if ($auth_ReqPass != 1 || ($auth_ReqPass == 1 && isset($fum_user) && !isset($logout))) { 
	if ($auth_ReqPass != 1 || ($auth_ReqPass == 1 && authDo($fum_user, $fum_pass))) {
?>
<table width="560" cellspacing="0" cellpadding="0" border="0">
  
</table>
<?
	if (!eregi("777",decoct(fileperms($dir_store))))
	{
		echo"<br><br><b><h4><font color=\"FF0000\">ERROR: cannot access the upload store file directory. please chmod the \"$dir_store\" directory with value 0777 (xrw-xrw-xrw)!</h4></font></b><br>�<a href=\"$_SERVER[PHP_SELF]\">refresh</a>";
	}
	else
	{
		if (!$_FILES[fileupload])
		{
?>
<table width="560" cellspacing="0" cellpadding="0" border="0" class="table_decoration" style="padding-top:5px;padding-left=5px;padding-bottom:5px;padding-right:5px">
  <form method="post" enctype="multipart/form-data">
  <tr>
    <td><? echo $lang[file];?>:</td><td><input type="file" name="fileupload" class="textfield" size="30"></td>
  </tr>
  <tr>
    <td><? echo $lang[rename];?>:</td><td><input type="text" name="rename" class="textfield" size="46"></td>
  </tr>
  <tr>
    <td><? echo $lang[ftypeall];?>:</td><td>
	<?
	for($i=0;$i<count($file_ext_allow);$i++)
	{
		if (($i<>count($file_ext_allow)-1))$commas=", ";else $commas="";
		list($key,$value)=each($file_ext_allow);
		echo $value.$commas;
	}
	?>
    </td>
  </tr>
  <tr>
    <td><? echo $lang[fsizelimit];?>:</td>
	<td>
		<b><?
			if ($file_size_ind >= 1048576) 
			{
				$file_size_ind_rnd = round(($file_size_ind/1024000),3) . " MB";
			} 
			elseif ($file_size_ind >= 1024) 
			{	
				$file_size_ind_rnd = round(($file_size_ind/1024),2) . " KB";
			} 
			elseif ($file_size_ind >= 0) 
			{
				$file_size_ind_rnd = $file_size_ind . " bytes";
			} 
			else 
			{
				$file_size_ind_rnd = "0 bytes";
			}
			
			echo "$file_size_ind_rnd";
		?></b>
	</td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" value="upload" class="button">&nbsp;<input type="reset" value="clear" class="button"></td>
  </tr>
  </form>
</table>
<?
		if ((!$_GET[act]||!$_GET[file])&&$_GET[act]!="delall")
		{
			$opendir = @opendir($dir_store);

			while ($readdir = @readdir($opendir))
			{
				if ($readdir<>"." && $readdir<>".." && $readdir != "index.html")
				{
					$filearr[] = $readdir;
				}
				$sort=array();
				for($i=1;$i<=count($filearr);$i++)
				{
					$key = sizeof($filearr)-$i;
					$file = $filearr[$key];

					$sort[$i]=$file;
				}
				asort($sort);
			}
?>
<br>
<table width="560" cellspacing="0" cellpadding="0" border="0" class="table_decoration" style="padding-left:5px">
  <tr>
    <td><b>admin tools:</b>
<? 
	if ($file_del_allow != 1 && $auth_ReqPass != 1)
	{
		echo"<i>none</i>";
	}

	if ($file_del_allow == 1 && $file_list_allow == 1 && (count($filearr) >= 1)) 
	{ 
		echo"<a href=\"javascript:;\" onClick=\"cf=confirm('Are you sure you want to delete ALL FILES?');if (cf)window.location='?act=delall'; return false;\" style=\"font-size: 9px;\">&lt;delete all files&gt;</a>";
	}
	
	if ($auth_ReqPass == 1) 
	{ 
		echo"&nbsp;<a href=\"$_SERVER[PHP_SELF]?logout=1\" style=\"font-size: 9px;\">&lt;log-out&gt;<a>";
	}
?>
    </td>
  </tr>
</table>
<br>
<?	
			if ($file_list_allow == 1 && (count($filearr) >= 1)) 
			{
?>
<table width="560" cellspacing="0" cellpadding="0" border="0" class="table_decoration" style="padding-left:6px">
  <tr bgcolor="#DBDBDB">
    <td align="left" width="46%"><? echo $lang[fname];?></td>
    <td align="center" width="12%"><? echo $lang[ftype];?></td>
    <td align="center" width="12%"><? echo $lang[fsize];?></td>
    <td align="center" width="30%"><? echo $lang[fcommand];?></td>
  </tr>
<?
				for($i=1;$i<=count($sort);$i++)
				{
					list($key,$value)=each($sort);

					if ($value)
					{
						$value_en = base64_encode($value);
						$value_view=$value;
						
							if (strlen($value) >= 48) 
							{ 
								$value_view = substr($value_view, 0, 45) . '...';
							}
?>
<tr>
    <td width="30%"><?="<a href=\"?act=view&file=$value_en\">$value_view</a>"?></td>
    <td align="center" width="5%"><? echo strtoupper(getlast($value)); ?></td>
    <td align="center" width="5%"><?

    	$value_full = $dir_store."/".$value;
    	$file_size = filesize($value_full);
		
		if ($file_size >= 1048576) 
		{
			$show_filesize = number_format(($file_size / 1048576),2) . " MB";
		} 
		elseif ($file_size >= 1024) 
		{
			$show_filesize = number_format(($file_size / 1024),2) . " KB";
		} 
		elseif ($file_size >= 0) 
		{
			$show_filesize = $file_size . " bytes";
		} 
		else 
		{
			$show_filesize = "0 bytes";
		}

		echo "$show_filesize";
		
?></td>
    <td align="center" width="5%"><?="<a title=\"View File\" href=\"?act=view&file=$value_en\">&lt;view&gt;</a>"?> | 
<?
	if ($file_del_allow == 1) 
	{ 
		echo"<a title=\"Download file\" href=\"?act=dl&file=$value_en\">&lt;dl&gt;</a>";
 	} 
	else 
	{ 
		echo"<a title=\"Download file\" href=\"?act=dl&file=$value_en\">&lt;download&gt;</a>"; 
	} 

	if ($file_del_allow == 1) 
	{ 
		echo"&nbsp;|&nbsp;<a title=\"Delete file\" href=\"javascript:;\" onClick=\"cf=confirm('Are you sure you want to delete this file?');if (cf)window.location='?act=del&file=$value_en'; return false;\">&lt;delete&gt;</a>";
	} 
	else 
	{ 
		echo"&nbsp;"; 
	} 
?>
    </td>
</tr>
<?
				}
				else
				{
					echo"<br>";
				}
				}
?>
</table></center>
<?
			}
		}
		elseif (($_GET[act]=="view")&&$_GET[file])
		{
			$value_de = base64_decode($_GET[file]);
			echo"<script language=\"javascript\">\nViewPopup = window.open(\"$dir_store/$value_de\", \"fum_viewfile\", \"toolbar=no,status=no,menubar=no,scrollbars=yes,resizable=yes,location=no,width=640,height=480\")\nViewPopup.document.bgColor=\"#F7F7F7\"\nViewPopup.document.close()\n</script>";
			echo"<br><img src=\"$dir_img/info.gif\" width=\"15\" height=\"15\">&nbsp;<b><font size=\"2\">file opened!</font></b><br>&laquo;<a href=\"$_SERVER[PHP_SELF]\">back</a><br><br><br>If the file did not display, you must <b>disable</b> your popup manager, or enable javascript in your browser.";
		}
		elseif (($_GET[act]=="del")&&$_GET[file])
		{
			$value_de = base64_decode($_GET[file]);
			@unlink($dir_store."/$value_de");
			echo"<br><img src=\"$dir_img/info.gif\" width=\"15\" height=\"15\">&nbsp;<b><font size=\"2\">file has been deleted!</font></b><br>�<a href=\"$_SERVER[PHP_SELF]\">back</a>";
		}
		if ($_GET[act]=="delall")
		{
			$handle = opendir($dir_store);
			while($file=readdir($handle))
			if (($file != ".")&&($file != ".."))
			@unlink($dir_store."/".$file);
			closedir($handle);

			echo"<br><img src=\"$dir_img/info.gif\" width=\"15\" height=\"15\">&nbsp;<b><font size=\"2\">all files have been deleted!</font></b><br>�<a href=\"$_SERVER[PHP_SELF]\">back</a>";
		}

	}
	else
	{
		echo"<br><br>";
		$uploadpath=$dir_store."/";
		$source=$_FILES[fileupload][tmp_name];
		$fileupload_name=$_FILES[fileupload][name];
		$weight=$_FILES[fileupload][size];

		for($i=0;$i<count($file_ext_allow);$i++)
		{
			if (getlast($fileupload_name)!=$file_ext_allow[$i])
				$test.="~~";
		}
		$exp=explode("~~",$test);

		if (count($exp)==(count($file_ext_allow)+1))
		{
			echo"<br><img src=\"$dir_img/error.gif\" width=\"15\" height=\"15\">&nbsp;<b><font size=\"2\">ERROR: your file type is not allowed (".getlast($fileupload_name).")</font>, or you didn't specify a file to upload.</b><br>�<a href=\"$_SERVER[PHP_SELF]\">back</a>";
		}
		else
		{

			if ($weight>$file_size_ind)
			{
				echo"<br><img src=\"$dir_img/error.gif\" width=\"15\" height=\"15\">&nbsp;<b><font size=\"2\">ERROR: please get the file size less than ".$file_size_ind." BYTES  (".round(($file_size_ind/1024),2)." KB)</font></b><br>�<a href=\"$_SERVER[PHP_SELF]\">back</a>";
			}
			else
			{

				foreach($_FILES[fileupload] as $key=>$value)
				{
					echo"<font color=\"#3399FF\">$key</font> : $value <br>";
				}

				echo "<br>";

				$dest = ''; 

				if (($source != 'none') && ($source != '' ))
				{
					$dest=$uploadpath.$fileupload_name;
					if ($dest != '')
					{
						if (file_exists($uploadpath.$fileupload_name))
						{
							echo"<br><img src=\"$dir_img/error.gif\" width=\"15\" height=\"15\">&nbsp;<b><font size=\"2\">ERROR: that file has already been uploaded before, please choose another file</font></b><br>�<a href=\"$_SERVER[PHP_SELF]\">back</a>";
						}
						else
						{
							if (copy($source,$dest))
							{
								if ($_POST[rename])
								{
									$_POST[rename]=replace($_POST[rename]);
									$exfile=explode(".",$fileupload_name);
									
									if (@rename("$dir_store/$fileupload_name","$dir_store/$_POST[rename].".getlast($fileupload_name))) 
									{
										echo"<br><img src=\"$dir_img/info.gif\" width=\"15\" height=\"15\">&nbsp;<b><font size=\"2\">file has been renamed to $_POST[rename].".getlast($fileupload_name)."!</font></b></font><br>";
									}
								}
								echo"<br><img src=\"$dir_img/info.gif\" width=\"15\" height=\"15\">&nbsp;<b><font size=\"2\">file has been uploaded!</font></b><br>�<a href=\"$_SERVER[PHP_SELF]\">back</a>";
							}
							else
							{
								echo"<br><img src=\"$dir_img/error.gif\" width=\"15\" height=\"15\">&nbsp;<b><font size=\"2\">ERROR: cannot upload, please chmod the dir to 777</font></b><br>�<a href=\"$_SERVER[PHP_SELF]\">back</a>";
							}
						}
					}
				}
			}
		}
	}
}

#/# end of main script, start authentication code IF user not logged in IF $auth_ReqPass is enabled

	} 
	else 
	{
		echo("<p><img src=\"$dir_img/error.gif\" width=\"15\" height=\"15\">&nbsp;Authentication error</p>" .
"<p><a href='$_SERVER[PHP_SELF]?logout=1'>Delete cookies and login again<a></p>");
	}
	} 
	else 
	{

	if (!isset($login) || isset($relogin)) {
?>
<font size="3"><b><i><? echo ($title) ? ($title) : ("File Upload Manager"); ?></i> - <? echo $lang[auth];?></b></font><br><br>
<table class="table_auth"><tr><td><center>
<? echo $lang[madmin];?>.<br>
<? echo $lang[madmin2];?>.
</center></td></tr></table>
<form action="<?=$_SERVER[PHP_SELF]?>?login=1" method="POST"><p>
Username: <input type="text" name="auth_formUser" size="20"><br>
Password: <input type="password" name="auth_formPass" size="20">
<p><input type="submit" name="submit" class="button" value="Log-In"></p>
</form></center>
<?
	} 
	elseif (isset($login)) 
	{
		echo("<p>$auth_msg</p>" . "<p><? echo $lang[ared];?></p>");
	}
	}
?>
              
              <div class="three_columns">
                <div class="box">
                  <div class="icon"><img src="images/icon_graph.png" width="27" height="27" alt="Graph" /></div>
                  <!--end icon-->
                  <div class="text">
                    <h2><? echo $lang[about];?> </h2>
                    <ul>
                      <li><a href="http://www.fileupper.eu/articles.php">Products</a></li>
                      <li><a href="http://www.fileupper.eu/forum/">Discussion Board</a></li>
                      <li><a href="http://support.fileupper.eu">Ticket Support</a></li>
                      <li><a href="http://www.fileupper.eu/contact.php">Contact Us</a></li>
                      <li> <a href="http://fileupper.eu/forum/viewforum.php?forum_id=21">FeedBack</a></li>
                    </ul>
                  </div>
                  <!--end text-->
                  <hr class="clear" />
                </div>
                <!--end box-->
                <div class="box">
                  <div class="icon"><img src="images/icon_info.png" width="27" height="27" alt="Info" /></div>
                  <!--end icon-->
                  <div class="text">
                    <h2><? echo $lang[dboard];?></h2>
                    <ul>
                      <li><a href="http://fileupper.eu/forum/viewforum.php?forum_id=12">News about AIUM </a></li>
                      <li><a href="http://fileupper.eu/forum/viewforum.php?forum_id=14">Document & Tutorials</a></li>
                      <li><a href="http://fileupper.eu/forum/viewforum.php?forum_id=20">Modification</a></li>
                      <li><a href="http://fileupper.eu/forum/viewforum.php?forum_id=15">Troubleshooting And Problems</a></li>
                      <li> <a href="http://fileupper.eu/forum/viewforum.php?forum_id=17">Hosting</a></li>
                    </ul>
                  </div>
                  <!--end text-->
                  <hr class="clear" />
                </div>
                <!--end box-->
                <div class="box">
                  <div class="icon"><img src="images/icon_blog.png" width="27" height="27" alt="Blog" /></div>
                  <!--end icon-->
                  <div class="text">
                    <h2><? echo $lang[partners];?></h2>
                    <div id="blog">
<ul>
                      <li> <a href="http://www.profisound.ro">Profi Sound Sistem</a></li>
<li> <a href="http://www.roservers.eu">M.H.N.G Servers List</a></li>
<li> <a href="http://www.upper.hi2.ro">MetroHost Upper</a></li>
</ul>
                    </div>
                  </div>
                  <!--end text-->
                  <hr class="clear" />
                </div>
                <!--end box-->
              </div>
              <!--end three_columns-->
            </div>
            <!--end right_column-->
            <hr class="clear" />
            <!--hr makes sure the bottom of the box stays at the bottom-->
          </div>
          <!-- end line down the middle -->
        </div>
        <!-- end the gradient from top to bottom -->
      </div>
      <!-- end the shadow border down left/right -->
      <div id="content_bottom"><img src="images/main_bottom.png" width="956" height="16" alt="background" /></div>
    </div>
    <!-- end content wrap -->
    <div id="footer">
      <div class="left">
        <ul>
          <li>&copy; Copyright AIUM.All rights reserved. </li>
          <li><a href="tos.php"><? echo $lang[tos];?></a> | </li>
          <li><a href="faq.php"><? echo $lang[faq];?></a> | </li>
          <li><a href="contact.php"><? echo $lang[contact];?></a></li>
        </ul>
      </div>
      <!--end left-->
      <div class="right">
        <ul>
          <li class="keep_in"> <? echo $lang[ktouch];?>:</li>
          <li><a href="<?=$link_ld?>" title="Linked In"><img src="images/icon_linkedin.png" alt="Linked In" width="25" height="25" border="0" /></a></li>
          <li><a href="<?=$link_tw?>" title="Twitter"><img src="images/icon_twitter.png" alt="Twitter" width="25" height="25" border="0" /></a></li>
          <li><a href="<?=$link_fb?>" title="Facebook"><img src="images/icon_facebook.png" alt="Facebook" width="25" height="25" border="0" /></a></li>
          <li><a href="<?=$link_rss?>" title="RSS"><img src="images/icon_rss.png" alt="RSS" width="25" height="25" border="0" /></a></li>
        </ul>
      </div>
      <!--end right-->
    </div>
    <!--end footer-->
  </div>
  <!--end wrapper-->
  <!--start side panel-->
  <div class="panel">
    <h3><? echo $lang[cus];?></h3> 
    <form action="sendit.php" method="post">
<p><strong><? echo $lang[name];?>:</strong><br> <INPUT type="text" size="25" name="name"></p>
<p><strong><? echo $lang[email];?>:</strong><br> <INPUT type="text" size="25" name="email"></p>
<p><strong><? echo $lang[message];?>:</strong><br>
<textarea name="mesaj" cols=30 rows=5></textarea></p>
<p><INPUT type="submit" value="Send"></p></form>
    <div style="clear:both;"></div>
  </div>
  <!--end side panel-->
  <a class="trigger" href="#"></a> </div>
<!--end bg_top-->
</body>
</html>
