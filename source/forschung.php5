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
    if(!$db->planets_building_has($_SESSION['coords'],2,1)) //hat kein forschungslabor
    {
      $smarty->assign("menu","Forschung");
      $smarty->assign("you_need","Sie ben&ouml;tigen ein Forschungslabor");
      $smarty->display("need_a.thtml");
      die();
    }
    $cantbuild = -1;
    $db->reinit();
    $somethingonbuild=$db->tasks_somethingonsci($_SESSION["coords"]);
    $db->reinit();
    if(isset($_GET['B'])&&$somethingonbuild==-1)
    {

      //echo "DEBUG: build_request ID:".$_GET['B']."<br>";
      if($db->sci_can_build($_SESSION["coords"],$_SESSION['id'],$_GET['B']))
      {
        //echo "can build";
	unset($db); $db = new cl_extended_database;
        $level = $db->sci_building_level($_SESSION['id'],$_GET['B']);
        $coords = $_SESSION['coords'];
	$buildingid = $_GET['B'];
	$userid = $id;
	unset($db); $db = new cl_extended_database;
	$endtime = time() + $db->sci_get_time($buildingid,$level,$coords);
	unset($db); $db = new cl_extended_database;
        $db->tasks_sci_build($userid,$coords,$buildingid,($level+1),$endtime);
	$db->reinit();
	//echo "<br>in table!";
      }
      else
      {
        $cantbuild = $_GET['B'];
      }
    }
    if(isset($_GET['s']) && $somethingonbuild==1)
    {
      //stop task
      $db->reinit();
      $taskid = $db->tasks_id_sci_on_build($_SESSION["coords"],$_GET['s']);  //get taskid
      //echo "stopping taskid: $taskid<br>";
      $db->task_kill($taskid);   
      $somethingonbuild=-1;   
    }
    unset($db); $db = new cl_extended_database;
    $buildlist = $db->planet_scilist($_SESSION["coords"]);
    //$smarty->display("konstruktion.thtml");
    unset($db); $db = new cl_extended_database;
    $smarty_buildlist = array();
    $j=0;
    foreach($buildlist as $id => $lev)
    {
      $smarty_buildlist[$j]['id'] = $id;
      $smarty_buildlist[$j]['name'] = $db->sci_get_name($id);
      $smarty_buildlist[$j]['level'] = $lev-1;
      $smarty_buildlist[$j]['buildlevel'] = $lev;
      $smarty_buildlist[$j]['desc'] = $db->sci_get_desc($id);
      $smarty_buildlist[$j]['need_res'] = $db->formatted_sci_get_costs($id,$lev);
      $smarty_buildlist[$j]['need_time'] = $db->formatted_sci_get_time($id,$lev,$_SESSION["coords"]);
      $smarty_buildlist[$j]['color'] = "#FFFF00";
      if($db->sci_can_build($_SESSION["coords"],$_SESSION['id'],$id))
      {
        $smarty_buildlist[$j]['color'] = "#00FF00";
      }
      else
      {
        $smarty_buildlist[$j]['color'] = "#FF0000";
      }
      $db->reinit();
      $taskid = $db->tasks_id_sci_on_build($_SESSION["coords"],$id);
      if($taskid != -1)
      {
        $smarty_buildlist[$j]['onbuild'] = 1;
	$db->reinit();
	$smarty_buildlist[$j]['resttime'] = $db->tasks_endtime($taskid)-time();
	$db->reinit();
	$smarty_buildlist[$j]['resttime_formatted'] = date("H:i:s",$smarty_buildlist[$j]['resttime']);
	$smarty_buildlist[$j]['color'] = "#FFFFFF";
	$somethingonbuild=1;
      }
      unset($db); $db = new cl_extended_database;
      $j++;
    }
    //echo "In <b>".__FILE__."</b> Line <b>".__LINE__."</b>:<br>"; print_r($smarty_buildlist); echo "<br>";
    $smarty->assign("scilist",$smarty_buildlist);
    $smarty->assign("cantbuild",$cantbuild);
    //echo "DEBUG: something on build: $somethingonbuild<br>";
    $smarty->assign("somethingonbuild",$somethingonbuild);
    require('resbar.inc.php5');  //Again, perhaps res refreshed
    $smarty->display("forschung.thtml");
  }
  else
  {
    session_destroy();
    $smarty->display("login_warning.thtml");
  }
  
?>

