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
  $db = new cl_extended_database;
  
  if(isset($_SESSION["id"]))
  {
    
    $id = $_SESSION["id"];
    if(!isset($_SESSION["coords"]))
    {
      $_SESSION["coords"] = $db->planets_get_coords($id);
    }
    require('resbar.inc.php5');  //Refresh Task, Res & display resbar
    if(!$db->planets_building_has($_SESSION['coords'],13,1)) //hat keine schiffsfabrik
    {
      $smarty->assign("menu","Verteidigung");
      $smarty->assign("you_need","Sie ben&ouml;tigen eine Orbitale Verteidigungssation");
      $smarty->display("need_a.thtml");
      die();
    }
  /*  echo "<br>-------<br>";
    print_r($_POST);
    print_r($_GET);
    echo "<br>--------<br>"; */
  if(isset($_GET['a']))
    {
      $db->reinit();
      if($_GET['a'] == "del")
      {
        $db->towers_build_delete($_GET['id']);
      }
      else if($_GET['a'] == "down")
      {
        $db->towers_build_down($_GET['id']);
      }
      else
      {
        echo "don't know action. Error in ".__FILE__.": Line".__LINE__."<bR><b>Bitte als Bug melden, thx<br>iBlue</b>";
      }     
    }
    if(isset($_POST))
    {
      for($i=0;$i<500;$i++)
      {
        if(isset($_POST['p'.$i]) && ($_POST['p'.$i] >0))
	{
	  //echo "baue ".$_POST['p'.$i]." stk. von ID $i<br>";
	  $db->towers_build($i,$_POST['p'.$i],$_SESSION['coords']);
	}
      }
    } 
    $db->reinit();
    $shiplist = $db->towerlist($_SESSION['coords'],$_SESSION['id']);
    $db->reinit();
    $buildlist = $db->tower_buildlist($_SESSION['coords']);
    //$build = $db->ship_buildstats($_SESSION['coords']);
    $smarty->assign("shiplist",$shiplist);
    $smarty->assign("buildlist",$buildlist);
    $smarty->assign("orbitlist",$db->tower_orbit_list($_SESSION['coords']));
    //$smarty->assign("build",$build);
    require('resbar.inc.php5');  //Again, perhaps res refreshed
    $smarty->display("verteidigung.thtml");
  }
  else
  {
    session_destroy();
    $smarty->display("login_warning.thtml");
  }
  
?>

