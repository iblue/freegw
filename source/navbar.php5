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
    if(!isset($db))
    {
      $db = new cl_extended_database;
    }
    $id = $_SESSION["id"];
    if(!isset($_SESSION["name"]))
    {
      $_SESSION["name"] = $db->user_get_name($id); 
    }
    if(!isset($_SESSION["coords"]))
    {
      $_SESSION["coords"] = $db->planets_get_coords($id);
    }
    if($db->planet_count($_SESSION['id']) > 1)
    {
      $smarty->assign("mp",1);
      $smarty->assign("plist",$db->planet_list($_SESSION['id'],$_SESSION['coords']));
    }
    if(!isset($_SESSION["coords_str"]))
    {
      $_SESSION["coords_str"] = $_SESSION["coords"]["gal"].":".$_SESSION["coords"]["sys"].":".$_SESSION["coords"]["plan"];
    }
    $smarty->assign("player_coords",$_SESSION["coords_str"]);
    $smarty->display("navbar.thtml");
  }
  else
  {
    $smarty->display("login_warning.thtml");
  }
  
?>

