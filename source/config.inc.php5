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

$CONFIG['mysql']['host'] = "localhost";      //Your MySQL-Server.
$CONFIG['mysql']['user'] = "root";           //Your MySQL-Username
$CONFIG['mysql']['pass'] = "";               //Your MySQL-Password
$CONFIG['mysql']['db']   = "freegw";         //Your MySQL-Database
  
//Der Pfad des Servers, ohne "/" am Ende
$CONFIG['internal']['serverpath'] = "http://192.168.1.235/freegw-devel";
//Der Pfad zu Smarty, mit "/" am Ende
$CONFIG['internal']['smarty_dir'] = "/usr/lib/php/smarty/";
//Der Pfad zum FreeGW-Verzeichnis ohne "/" am Ende
$CONFIG['internal']['path'] = "/var/www/htdocs/freegw-devel";

//------------------------------------------------------------------------
$CONFIG['game']['name']   = "FreeGW";
$CONFIG['game']['int_version'] = "0.8";
$CONFIG['game']['ext_version'] = "02";


//thx to fehlermeldung ;)

$CONFIG["planets"]["max_gal"] = 5;  //0-255!
$CONFIG["planets"]["max_sys"] = 200; //0-65535
$CONFIG["planets"]["min_plan"] = 3;  //Minimum planets in a system
$CONFIG["planets"]["max_plan"] = 12;  //Maximum planets in a system

$CONFIG["planets"]["new_user_range"] = 3;  //new user starts max 3 systems away from existing user

$CONFIG["planets_info"]["max_dia"] = 10000;
$CONFIG["planets_info"]["min_dia"] = 1000;
$CONFIG["planets_info"]["max_temp"] = 200;
$CONFIG["planets_info"]["min_temp"] = -120;

$CONFIG["res"]["start"]["fe"] = 500;
$CONFIG["res"]["start"]["lut"] = 500;
$CONFIG["res"]["start"]["h2o"] = 500;
$CONFIG["res"]["start"]["h2"] = 0;



?>
