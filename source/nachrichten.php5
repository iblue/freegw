<?
############################################################################
#    Copyright (C) 2004 by iBlue                                           #
#    iblue@gmx.net                                                         #
#                                                                          #
#    This program is free software; you can redistribute it and#or modify  #
#    it under the terms of the GNU General Public License as published by  #
#    the Free Software Foundation; either version 2 of the License, or     #
#    (at your option) any later version.                                   #
#                                                                          #
#    This program is distributed in the hope that it will be useful,       #
#    but WITHOUT ANY WARRANTY; without even the implied warranty of        #
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         #
#    GNU General Public License for more details.                          #
#                                                                          #
#    You should have received a copy of the GNU General Public License     #
#    along with this program; if not, write to the                         #
#    Free Software Foundation, Inc.,                                       #
#    59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.             #
############################################################################
?>
<?
  error_reporting(E_ALL);
  require("config.inc.php5");
  $PATH=$CONFIG['internal']['path'];  
  require("$PATH/mysql.inc.php5");
  require("$PATH/config.inc.php5");

  define('SMARTY_DIR', $CONFIG['internal']['smarty_dir']);
  require(SMARTY_DIR.'Smarty.class.php');

  $smarty = new Smarty;
  $smarty->assign("CONFIG_game_name",$CONFIG["game"]["name"]);
  $smarty->assign("CONFIG_internal_serverpath",$CONFIG["internal"]["serverpath"]);
  session_start();
  //print_r($_SESSION);
  if(isset($_SESSION["id"]))
  {
    require('resbar.inc.php5');
    if(!isset($db))
    {
      $db = new cl_extended_database;
    }
    if(!isset($_SESSION["coords"]))
    {
      $_SESSION["coords"] = $db->planets_get_coords($id);
    }
    if(!isset($_GET) && !isset($_POST))
    {
      //keine var gesetzt: uebersicht!
      $smarty->display("msg_uebersicht.thtml");
      die();    
    }
    
    if(isset($_POST))
    {
      if(isset($_POST['to']))
      {
        //nachricht verschicken,
	$_POST['to'] = ereg_replace(":","x",$_POST['to']);
        $coords = explode("x",$_POST['to']);
        $coords['gal'] = $coords[0];
        $coords['sys'] = $coords[1];
        $coords['plan'] = $coords[2];
	if(isset($_POST['text']))
	{
	  $db->msg_write($_SESSION['id'],$_SESSION['coords'],$coords,$_POST['subject'],$_POST['text']);
	  $smarty->assign("to",$coords);
	  $smarty->display("msg_wrote.thtml");
	  die();
	}
	else
	{
	  $smarty->assign("to",$coords);
	  $smarty->display("msg_write.thtml");
	  die();
	}
        //echo "send_msg (to ???) unimplemented!<bR>";
      } 
    }  
    if(isset($_GET))
    {
      if(isset($_GET['o']))
      {
        //ordeneransicht
	if($_GET['o'] == "newmsgs")
	{
	  $msglist = $db->msglist($_SESSION['id'],0,-1,0);
	  //echo "<b>DEBUG:</b> print_r(\$msglist):<br>"; print_r($msglist); echo "<br>END OF PRINT_R";
	  $smarty->assign("msglist",$msglist);
	  $smarty->assign("foldername","Neue Nachrichten/Ereignisse");
	  $smarty->display("msg_list.thtml"); die();
	}
	else if($_GET['o'] == "events")
	{
	  $msglist = $db->msglist($_SESSION['id'],1,1,0);
	  //echo "<b>DEBUG:</b> print_r(\$msglist):<br>"; print_r($msglist); echo "<br>END OF PRINT_R";
	  $smarty->assign("msglist",$msglist);
	  $smarty->assign("foldername","Ereignisse");
	  $smarty->display("msg_list.thtml"); die();
	}
	else if($_GET['o'] == "in")
	{
	  $msglist = $db->msglist($_SESSION['id'],1,0,0);
	  //echo "<b>DEBUG:</b> print_r(\$msglist):<br>"; print_r($msglist); echo "<br>END OF PRINT_R";
	  $smarty->assign("msglist",$msglist);
	  $smarty->assign("foldername","Posteingang");
	  $smarty->display("msg_list.thtml"); die();
	}
	else if($_GET['o'] == "out")
	{
	  $msglist = $db->msglist($_SESSION['id'],1,0,1);
	  //echo "<b>DEBUG:</b> print_r(\$msglist):<br>"; print_r($msglist); echo "<br>END OF PRINT_R";
	  $smarty->assign("msglist",$msglist);
	  $smarty->assign("foldername","Postausgang");
	  $smarty->display("msg_list.thtml"); die();
	}
	else
	{
	  echo "Ordneransicht fuer Ordner '".$_GET['o']."' unimplemented<br>";
	}
      }
      else if(isset($_GET['readid']))
      {
        $msg = $db->msg_read($_GET['readid']);
        $smarty->assign("msg",$msg);
	//print_r($msg);
	$smarty->assign("userid",$_SESSION['id']);
	$smarty->display("msg_read.thtml"); die();
      }
      else if(isset($_GET['to']))
      {
        if($_GET['to'] != "")
	{ 
          $coords = explode("x",$_GET['to']);    
          $coords['gal'] = $coords[0];
          $coords['sys'] = $coords[1];
          $coords['plan'] = $coords[2];
	  $smarty->assign("to",$coords);
	}
	else
	{
	  $smarty->assign("to","none");
	}
        $smarty->display("msg_write.thtml");
	die();
      }
      else if(isset($_GET['del']))
      {
        $db->msg_del($_GET['del'],$_SESSION['id']);
	$smarty->display("msg_deleted.thtml"); die();
	//TODO: FIXME: BUGBUG: implement hacking-protection here
      }    
    }
    $smarty->display("msg_uebersicht.thtml");
  }
  else
  {
    $smarty->display("login_warning.thtml");
  }
  
  ?>