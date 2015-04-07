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
    $id = $_SESSION["id"];
    //print_r($_SESSION);
    $_SESSION["coords_str"] = $_SESSION["coords"]["gal"].":".$_SESSION["coords"]["sys"].":".$_SESSION["coords"]["plan"];
    $_SESSION["name"] = $db->user_get_name($id); 
    $_SESSION["pname"] = $db->planets_get_pname($_SESSION["coords"]["gal"],$_SESSION["coords"]["sys"],$_SESSION["coords"]["plan"]);

    $servertime_str = date("D, j.n.Y - H:i:s");
    $smarty->assign("servertime_str",$servertime_str);
    $smarty->assign("planetname",$_SESSION["pname"]);
    $smarty->assign("username",$_SESSION["name"]);
    $smarty->assign("coords_str",$_SESSION["coords_str"]);
    $smarty->assign("temp_lo",$db->planets_info_get_temp_lo($_SESSION["coords"]));
    $smarty->assign("temp_hi",$db->planets_info_get_temp_hi($_SESSION["coords"]));
    $smarty->assign("diameter",$db->planets_info_get_diameter($_SESSION["coords"]));
    $smarty->assign("planet_count",$db->planet_count($_SESSION['id']));
    $smarty->assign("planet_points",$db->planets_info_get_points($_SESSION["coords"]));
    $sp = $db->sci_points($_SESSION["id"]);
    $bp = $db->planets_info_get_points($_SESSION["coords"]); //FIXME: build_points-function
    $ap = $sp+$bp;
    $smarty->assign("build_points",$bp);
    $smarty->assign("sci_points",$sp);
    $smarty->assign("all_points",$ap);
    $smarty->assign("new_msg",$db->msg_new_for($_SESSION['id']));
    $transferlist = $db->transfer_list($_SESSION['coords']);
    $smarty->assign("transferlist",$transferlist);
    $smarty->assign("cnt_transferlist",count($transferlist));
    $smarty->display("uebersicht.thtml");
  }
  else
  {
    $smarty->display("login_warning.thtml");
  }
  
?>

