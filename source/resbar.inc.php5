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

  $db_resbar = new cl_extended_database;  
  if(isset($_SESSION["id"]))
  {
    
    $id = $_SESSION["id"];
    if(!isset($_SESSION["coords"]))
    {
      $_SESSION["coords"] = $db_resbar->planets_get_coords($id);
    }

    //---------------REFRESH
    $db_resbar->tasks_refresh($id);
    $db_resbar->reinit();
    $db_resbar->res_refresh($_SESSION["coords"]);
    $db_resbar->reinit();
    if(!isset($_RESBAR))
    {
      $db_resbar->ships_build_refresh($_SESSION["coords"]);
      $db_resbar->reinit();
      $db_resbar->towers_build_refresh($_SESSION["coords"]);
      $db_resbar->reinit();
      $db_resbar->transfer_refresh($_SESSION['coords']);
      $db_resbar->reinit();
      $_RESBAR = true;
    }
    //---------------------
    $smarty->assign("res",$db_resbar->planet_res_formatted($_SESSION["coords"]));
  }
  else
  {
    session_destroy();
  }
  unset($db_resbar);
  
?>

