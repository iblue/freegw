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
  
  if(isset($_SESSION['id']))
  {    
    if(!isset($_SESSION['coords']))
    {
      $_SESSION['coords'] = $db->planets_get_coords($id);
    }
    require('resbar.inc.php5');  //Refresh Task, Res & display resbar

    if(isset($_POST['x']))
    {
      $x = $_POST['x'];
      if($x == 1)
      {
        $db->reinit();
        $homefid = $db->get_fleetid($_SESSION['coords']);
        $db->reinit();
        $fleet = 0;
        $neg   = 0;
        for($i=0;$i<500;$i++)
        {
          if(isset($_POST['c'.$i]))
          {
            if($_POST['c'.$i] >0)
            {
              $fleet = true;
              
              if($db->fleet_count_ships($homefid,$i) < $_POST['c'.$i])
              {
                $neg = 1;
              }
              $db->reinit();
            }
            if($_POST['c'.$i] < 0)
            {
              $neg = 1;
              //$fleet=0;
            }
          }
          if($neg == 1)
            break;         
        }
     //   echo "DBUG: fleet: $fleet, neg: $neg<br>";
        if($fleet == 0|| $neg == 1)
        {
          $db->reinit();
          $smarty->assign("err",1);
          $smarty->assign("transferlist",$db->fleetmenu_list($_SESSION['coords']));
          $smarty->assign("orbitlist",$db->ship_orbit_list($_SESSION['coords']));
          $smarty->display("fleets1.thtml");
          die();
        }
	$smarty->assign("startcoords",$_SESSION['coords']);
	$ar = $db->fleet_disp2($_POST);
	$smarty->assign("fleet",$ar['a_fleet']);
	$smarty->assign("ships",$ar['a_ships']);
	//print_r($ar);
	$smarty->display("fleets2.thtml");
	die();
      }
      else if($x == 2)
      {
        //FIXME: Check, ob mindestens ein Schiff!
        /*$to['gal']  = $_POST['ft1'];
	$to['sys']  = $_POST['ft2'];
	$to['plan'] = $_POST['ft3'];
	$smarty->assign("to",$to);*/
	$data = $db->fleet_disp3($_POST);
	$smarty->assign("to",$data['to']);
	$smarty->assign("ships",$data['ships']);
        if(isset($_POST['c107']) && $_POST['c107'] > 0)
        {
          $smarty->assign("kolo",1);
        }
        $smarty->display("fleets3.thtml");
      }
      else if($x == 3)
      {
        //Check und losschicken...
       // echo "Starting fleet...<br>";
        $db->start_fleet($_SESSION['coords'],$_POST);
        //die();
        $db->reinit();
        $smarty->assign("transferlist",$db->fleetmenu_list($_SESSION['coords']));
        $smarty->assign("orbitlist",$db->ship_orbit_list($_SESSION['coords']));
        $smarty->display("fleets1.thtml");
	die();
      }
      else
      {
        echo "Don't know Value '$x' for \$x. You are cheating, or this is a BUG!<br>";
      
      }
      
    }
    else
    {
      $db->reinit();
      $smarty->assign("transferlist",$db->fleetmenu_list($_SESSION['coords']));
      $smarty->assign("orbitlist",$db->ship_orbit_list($_SESSION['coords']));
      $smarty->display("fleets1.thtml");
    }
  }
  else
  {
    session_destroy();
    $smarty->display("login_warning.thtml");
  }
  
?>

