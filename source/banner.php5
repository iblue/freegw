 Skyscraper (120x600pixel) 
<?php
if (@include('/var/www/kazzam/adserver/www/phpadsnew.inc.php')) {
if (!isset($phpAds_context)) $phpAds_context = array();
$phpAds_raw = view_raw ('zone:2', 0, '_blank', '', '0', $phpAds_context);
echo $phpAds_raw['html'];
}
?>
Normaler Banner (468x60) 
<?php
if (@include('/var/www/kazzam/adserver/www/phpadsnew.inc.php')) {
if (!isset($phpAds_context)) $phpAds_context = array();
$phpAds_raw = view_raw ('zone:1', 0, '_blank', '', '0', $phpAds_context);
echo $phpAds_raw['html'];
}
?>
Button (120 x 60) 
<?php
if (@include('/var/www/kazzam/adserver/www/phpadsnew.inc.php')) {
if (!isset($phpAds_context)) $phpAds_context = array();
$phpAds_raw = view_raw ('zone:4', 0, '_blank', '', '0', $phpAds_context);
echo $phpAds_raw['html'];
}
?> 
Textbanner (text eben*g*, paar Wörter) 
<?php
if (@include('/var/www/kazzam/adserver/www/phpadsnew.inc.php')) {
if (!isset($phpAds_context)) $phpAds_context = array();
$phpAds_raw = view_raw ('zone:6', 0, '_blank', '', '0', $phpAds_context);
echo $phpAds_raw['html'];
}
?>
