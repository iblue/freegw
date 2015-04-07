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
  //session_start();
  //print_r($_SESSION);
  if(!isset($db))
  {
    $db = new cl_extended_database;
  }
  if(!isset($_GET['id']))
  {
    echo "Keine ID gesetzt, Script gestopt!<br>"; die();
  }
  $db->query("SELECT * FROM reports WHERE id='".$_GET['id']."';"); $db->err();
  $row = $db->fetch();
  print_r($row);
  $smarty->assign("str_date",date("D, j.n.Y - H:i:s",$row['time']));
  $tcoords         = explode(":",$row['tcoords']);
  $tcoords['gal']  = $tcoords[0];
  $tcoords['sys']  = $tcoords[1];
  $tcoords['plan'] = $tcoords[2];
  $tcoords['diameter'] = "<b>unimplemented</b>";
  $tcoords['templo']  = "<b>unimplemented</b>";
  $tcoords['temphi']  = "<b>unimplemented</b>";
  $fcoords         = explode(":",$row['fcoords']);
  $fcoords['gal']  = $fcoords[0];
  $fcoords['sys']  = $fcoords[1];
  $fcoords['plan'] = $fcoords[2];
  $smarty->assign("to",$tcoords);
  $smarty->assign("from",$fcoords);
  $ships_a = explode('%',$row['ships_a']);
  $ships_an =array();
  //echo "row ships_a: ".$row['ships_a']."<br>";
  foreach($ships_a as $key => $ship)
  {
    //echo "-exploded to($key): ".$ship."<br>";
    if($ship != "")
    {
      $sx = explode('!',$ship);
      //print_r($sx);
      //$ships_an[$key]['name']   = "ID: ".$sx[0];
      $sel = $db->ships_select($sx[0]);
      $ships_an[$key]['name']   = $sel['name'];
      $ships_an[$key]['gesamt'] = $sx[1];
      $ships_an[$key]['lost']   = $sx[2];
    }
  }
  //print_r($ships_an);
  $smarty->assign("ships_a",$ships_an);
  
  $ships_v = explode('%',$row['ships_v']);
  $ships_vn =array();
  //echo "row ships_a: ".$row['ships_a']."<br>";
  $f=1;
  foreach($ships_v as $key => $ship)
  {
    //echo "-exploded to($key): ".$ship."<br>";
    if($ship != "")
    {
      $sx = explode('!',$ship);
      //print_r($sx);
      //$ships_an[$key]['name']   = "ID: ".$sx[0];
      $sel = $db->ships_select($sx[0]);
      $ships_vn[$key]['name']   = $sel['name'];
      $ships_vn[$key]['gesamt'] = $sx[1];
      $ships_vn[$key]['lost']   = $sx[2];
    }
    if($ship != "")
    $f=0;
  }
  if($row['res_raided'] == "none")
  {
    $smarty->assign("raid",-1);
  }
  else
  {
    $raid = explode('x',$row['res_raided']);
    $raid['fe']  = $raid[0];
    $raid['lut'] = $raid[1];
    $raid['h2o'] = $raid[2];
    $raid['h2']  = $raid[3];
    $smarty->assign("raid",$raid);
  }
  //building_get_name($id)

  //sci_get_name($id)
  if($row['spy'] == 1)
  {
    $smarty->assign("spy_report",1);
    $to_res = explode('x',$row['res_spy']);
    $to_res['fe']   = $to_res[0];
    $to_res['lut']  = $to_res[1];
    $to_res['h2o']  = $to_res[2];
    $to_res['h2']   = $to_res[3];
    $smarty->assign("to_res",$to_res);
    $buildings = explode('%',$row['buildings']);
    $bn=array();
    foreach($buildings as $key => $bu)
    {
      //echo "-exploded to($key): ".$ship."<br>";
      if($bu != "")
      {
        $bx = explode('!',$bu);
        $bn[$key]['name']   = $db->building_get_name($bx[0]);
        $bn[$key]['level']  = $bx[1];
      }
    }
    $smarty->assign("spy_buildings",$bn);
    
    $sci = explode('%',$row['sci']);
    $sn=array();
    foreach($sci as $key => $su)
    {
      //echo "-exploded to($key): ".$ship."<br>";
      if($su != "")
      {
        $sx = explode('!',$su);
        $sn[$key]['name']   = $db->sci_get_name($sx[0]);
        $sn[$key]['level']  = $sx[1];
      }
    }
    $n=0;
    if($row['sci'] == "" && $row['buildings'] == "")
    {
      $n = 1;
    }
    $smarty->assign("nobs",$n);
    $smarty->assign("spy_sci",$sn);
  }
  else
  {
    $smarty->assign("spy_report",0);
  }
  $smarty->assign("ships_v",$ships_vn);
  
  $towers_v = explode('%',$row['towers_v']);
  $towers_vn =array();
  //echo "row ships_a: ".$row['ships_a']."<br>";
  $f=1;
  foreach($towers_v as $key => $ship)
  {
    //echo "-exploded to($key): ".$ship."<br>";
    if($ship != "")
    {
      $sx = explode('!',$ship);
      //print_r($sx);
      //$ships_an[$key]['name']   = "ID: ".$sx[0];
      $sel = $db->towers_select($sx[0]);
      $towers_vn[$key]['name']   = $sel['name'];
      $towers_vn[$key]['gesamt'] = $sx[1];
      $towers_vn[$key]['lost']   = $sx[2];
    }
    if($ship != "")
    $f=0;
  }
  
  $smarty->assign("towers_v",$towers_vn);
  $smarty->assign("st",$f);
  $smarty->display("bericht.thtml");

  
  ?>