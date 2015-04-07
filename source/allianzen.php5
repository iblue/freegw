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
    if(isset($_GET['id']) && !isset($_GET['a']) && !isset($_POST['a']))
    {
      $ally = $db->ally_select($_GET['id']);
      if($ally == -1)
        break;
      else
      {
        $m = $db->ally_member_of($_SESSION['id']);
        if($m == -1)
        {
          $ally['canjoin'] = 1;
        }
        if($m == $_GET['id'])
        {
          $ally['member'] = 1;
          $r = $db->ally_get_rank($m,$_SESSION['id']);
          if($r == 0)
          {
            $ally['admin'] = 1;
            $ally['status'] = "Administrator";
          }
          else
          {
            $ally['status'] = "Mitglied";
          }
        }
        
        $smarty->assign("ally",$ally);
        $smarty->display("ally-desc.thtml");
        die();
      }
    }
    if(!isset($_GET['a']) && !isset($_POST['a']))
    {
      $mem_of = $db->ally_member_of($_SESSION['id']);
      if($mem_of == -1)
      {
        $smarty->display("ally.thtml"); die();
      }
      else
      {
        $row = $db->ally_select($mem_of);
        $row['member'] = 1;
        $r = $db->ally_get_rank($mem_of,$_SESSION['id']);
        if($r == 0)
        {
          $row['admin'] = 1;
          $row['status'] = "Administrator";
          $smarty->assign("new_app",$db->ally_new_apps($mem_of));
        }
        else
        {
          $row['status'] = "Mitglied";
        }
        $smarty->assign("ally",$row);
        $smarty->display("ally-desc.thtml");
      }
    }
    else if(isset($_GET['a']))
    {
      $a=$_GET['a'];
      if($a == "f")
      {
        //Gruenden
        $smarty->display("ally-found.thtml");
      }
      else if($a == "v")
      {
        $mem_of = $db->ally_member_of($_SESSION['id']);
        if($mem_of == -1)
        {
          $smarty->display("ally.thtml"); die();
        }

        $row = $db->ally_select($mem_of);
        $row['member'] = 1;
        $r = $db->ally_get_rank($mem_of,$_SESSION['id']);
        if($r == 0)
        {
          $smarty->assign("ally",$row);
          $smarty->display("ally-edit.thtml");
        }
        else
        {
          $row['status'] = "Mitglied";
          $smarty->assign("ally",$row);
          $smarty->display("ally-desc.thtml");
        }
        
      }
      else if($a == "j")  //Bewerben
      {
        $smarty->assign("aid",$_GET['id']);
        $smarty->display("ally-app.thtml");
        die();
      }
      else if($a == "ar")  //Bewerbungen lesen
      {
        $smarty->assign("applist",$db->ally_app_list($db->ally_member_of($_SESSION['id'])));
        $smarty->display("ally-applist.thtml");
      
      }
      else if($a == "ay") // Bewerbung angenommen
      {
        $aid = $db->ally_member_of($_SESSION['id']);
        $db->ally_join($aid,$_GET['uid']);
        $smarty->assign("applist",$db->ally_app_list($aid));
        $smarty->assign("ay",1);
        $smarty->display("ally-applist.thtml");
      }
      else if($a == "an") // Bewerbung abgelehnt
      {
        $aid = $db->ally_member_of($_SESSION['id']);
        $db->ally_dont_join($aid,$_GET['uid']);
        $smarty->assign("applist",$db->ally_app_list($aid));
        $smarty->assign("an",1);
        $smarty->display("ally-applist.thtml");
      }
    }   
    else if(isset($_POST['a']))
    {
      $a=$_POST['a'];
      if($a == "f" && $_POST['b'] == 1) //Gruenden
      {
        //Gruenden-Formular abgschiggt
        $db->ally_found($_POST['tag'],$_POST['name'],$_SESSION['id']);
        $mem_of = $db->ally_member_of($_SESSION['id']);
        $row = $db->ally_select($mem_of);
        $row['member'] = 1;
        $r = $db->ally_get_rank($mem_of,$_SESSION['id']);
        if($r == 0)
        {
          $row['admin'] = 1;
          $row['status'] = "Administrator";
          $smarty->assign("new_app",$db->ally_new_apps($mem_of));
        }
        else
        {
          $row['status'] = "Mitglied";
        }
        $smarty->assign("ally",$row);
        $smarty->display("ally-desc.thtml");
      }
      else if($a == "e1")  //Beschreibung setzen 
      {
        $db->ally_setdesc($_POST['aid'],strip_tags($_POST['desc']));
        $row = $db->ally_select($_POST['aid']);
        $smarty->assign("ally",$row);
        $smarty->display("ally-edit.thtml");
      }
      else if($a == "e2")  //HP setzen
      {
        $db->ally_seturl($_POST['aid'],$_POST['url']);
        $row = $db->ally_select($_POST['aid']);
        $smarty->assign("ally",$row);
        $smarty->display("ally-edit.thtml");
      }
      else if($a == "l")  //Austreten/aufloesen
      {
        $alid = $db->ally_member_of($_SESSION['id']);
        $r = $db->ally_get_rank($alid,$_SESSION['id']);
        if($r == 0)
        {
          $smarty->assign("del",1);
        }
        $smarty->display("ally-leave-really.thtml");
      }
      else if($a == "lr")  //Austreten/aufloesen (bestaetigt)
      {
        $alid = $db->ally_member_of($_SESSION['id']);
        $r = $db->ally_get_rank($alid,$_SESSION['id']);
        if($r == 0)
        {
          $db->ally_del($alid);
        }
        else
        {
          $db->ally_leave($alid,$_SESSION['id']);
        }
        $smarty->display("ally.thtml"); die();
      }
      else if($a == "jr")
      {
        $db->ally_app($_POST['aid'],$_SESSION['id'],$_POST['text']);
        $smarty->display("ally-app-ok.thtml"); die();
      }
    }    
  }
  else
  {
    $smarty->display("login_warning.thtml");

  }
  
?>

