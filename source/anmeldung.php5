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
  if(isset($_POST["s"]) && $_POST["s"]==1)
  {
    if(isset($_POST["ln"])) { $smarty->assign("val_ln",$_POST["ln"]); }
    if(isset($_POST["m1"])) { $smarty->assign("val_m1",$_POST["m1"]); }
    if(isset($_POST["m2"])) { $smarty->assign("val_m2",$_POST["m2"]); }
    if(isset($_POST["pname"])) { $smarty->assign("val_pname",$_POST["pname"]); }
    $error = "";
    if($_POST["m1"] != $_POST["m2"])
    {
      //die("m1 != m2 not implemented!");
      $error .= "Die Email-Adressen stimmen nicht ueberein!<br>";
    }
    if($_POST["m1"] == "")
    {
      $error .= "Bitte geben sie eine Email-Adresse an<br>";
    }
    if($_POST["ln"] == "")
    {
      $error .= "Bitte geben sie einen Login-Namen an<br>";
    }
    if(!isset($_POST["agb"]))
    {
      //die("agb == false not implemented!");
      $error .= "Sie muessen die AGB akzeptieren um sich bei ".$CONFIG["game"]["name"]." anzumelden<br>"; 
    }
    $db = new cl_extended_database;
    if($db->user_name_existing($_POST['ln']))
    {
      $error .= "Der Name '".$_POST['ln']."' ist bereits vergeben!<br>";
    }
    if($db->user_info_emailexisting($_POST['m1']))
    {
      $error .= "Die eMail-Adresse '".$_POST['m1']."' wird bereits von jemandem anders benutzt!<br>";
    }
    if($error != "")
    {
      $smarty->assign("msg",$error);
      $smarty->display("anmeldung.thtml");
    }
    else
    {

      $db->user_add($_POST['ln'],$_POST["m1"],$_POST['pname']) or $db->getError();
      $id = $db->user_get_id($_POST['ln']);
      $pass = $db->user_get_pass($id);
      $co = $db->planets_get_coords($id);
      $smarty->assign("name",$_POST['ln']);
      $smarty->assign("pass",$pass);
      $smarty->assign("coords",$co['gal'].":".$co['sys'].":".$co['plan']);
      $smarty->display("anmeldung-ok.thtml");

    }
  }
  else
  {  
    $smarty->display("anmeldung.thtml");
  }
  
?>

