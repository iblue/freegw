<?// phpinfo() ?>
<?

 header('Content-type: image/png');
  $image = imagecreate(640, 480);
  imagecolorallocate($image, 255, 255, 255); 
  $line_color = imagecolorallocate($image, 0, 0, 0);
  $pxl_color = imagecolorallocate($image,255,0,0);
  function ks_formula($ag_a,$vt_a,$ag_v,$vt_v)
  {
    $ag = max(($ag_a+$vt_a),1);
    $vt = ($ag_v+$vt_v);
    $x= $ag-$vt;
    $ret = 1/(1+pow(4.2,-$x/500));
    return $ret;
  }
  for($i=-320;$i<320;$i++)
  {
    $x=$i+320;
    $x_1=$i+320-1;
    $y=ks_formula(($i+320)*2,($i+320),500,250)*480;
    $y_1=ks_formula((($i-1)+320)*2,(($i-1)+320),500,250)*480;
    imageline($image,(int)$x,(int)$y,(int)$x_1,(int)$y_1,$line_color);
  }
  imageline($image,0,240,640,240,$pxl_color);
  imageline($image,320,0,320,480,$pxl_color);
  //
/*  imagesetpixel($image,3,3,$pxl_color);
  imagesetpixel($image,3,4,$pxl_color);
  imagesetpixel($image,3,5,$pxl_color);
  imagesetpixel($image,3,6,$pxl_color); */
  //imageline
  imagepng($image);
?>