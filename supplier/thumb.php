<?php
//////////////FUNCTION  TO Create THUMB IMAGE///////////////////////////////////
function createthumb1($name,$filename,$new_w,$new_h){
	$system=explode('.',$name);
	if ($system[1]=='jpg' || $system[1]=='JPG' || $system[1]=='jpeg' || $system[1]=='JPEG')
	{
		$src_img=imagecreatefromjpeg($name);
	}
	if (preg_match('/png/',$system[1])){
		$src_img=imagecreatefrompng($name);
	}
	if (preg_match('/gif/',$system[1])){
		$src_img=imagecreatefromgif($name);
	}
	
$old_x=imageSX($src_img);
$old_y=imageSY($src_img);
$thumb_w=$new_w;
$thumb_h=$new_h;

if ($old_x > $old_y) {
    if($old_x >$new_w)
	  $thumb_w=$new_w;
	 else
	    $thumb_w=$old_x;
		
	$ratio=$old_x/$old_y;
    if($old_y >$new_h)
	  $thumb_h=$new_w/$ratio;
	 else
	    $thumb_h=$old_y; 
}
if ($old_x < $old_y) {
    $ratio=$old_x/$old_y;
  if($old_x >$new_w)
	$thumb_w=$new_h*$ratio;
	else
	    $thumb_w=$old_x;
	//$thumb_w=$old_x*($new_w/$old_y);
	 if($old_y >$new_h)
	   $thumb_h=$new_h;
	 else
	    $thumb_h=$old_y;
	
}
if ($old_x == $old_y) {
	$thumb_w=$new_w;
	$thumb_h=$new_h;
}

$dst_img=imagecreatetruecolor($thumb_w,$thumb_h);

		
	
	//imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
	if (preg_match("/png/",$system[1]))
     {
	
	
	
	
	/////////////////////
	imagealphablending($dst_img, true); 
	$transparent = imagecolorallocatealpha($dst_img, 0, 0, 0, 127);
	imagefill($image, 0, 0, $transparent);
	$black = imagecolorallocate($dst_img, 0, 0, 0);
	imagecolortransparent($dst_img, $black);
	imagealphablending($dst_img, true); 
	/////////////////////
	
		//header( "Content-type: image/png" );
	   imagepng($dst_img,$filename); 
	   
      }
	  elseif (preg_match("/gif/",$system[1]))
     {
	   imagegif($dst_img,$filename); 
      }
	 else 
	 {
	  imagejpeg($dst_img,$filename); 
     }
imagedestroy($dst_img); 
imagedestroy($src_img); 
}

//////////////////////////////////////////////////////////////


function createthumb11($name,$filename,$new_w,$new_h){
	$system=explode('.',$name);
	if ($system[1]=='jpg' || $system[1]=='JPG' || $system[1]=='jpeg' || $system[1]=='JPEG')
	{
		$src_img=imagecreatefromjpeg($name);
	}
	if (preg_match('/png/',$system[1])){
		$src_img=imagecreatefrompng($name);
	}
	if (preg_match('/gif/',$system[1])){
		$src_img=imagecreatefromgif($name);
	}
	
$old_x=imageSX($src_img);
$old_y=imageSY($src_img);
$thumb_w=$new_w;
$thumb_h=$new_h;

if ($old_x > $old_y) {
    if($old_x >$new_w)
	  $thumb_w=$new_w;
	 else
	    $thumb_w=$old_x;
		
	$ratio=$old_x/$old_y;
    if($old_y >$new_h)
	  $thumb_h=$new_w/$ratio;
	 else
	    $thumb_h=$old_y; 
}
if ($old_x < $old_y) {
    $ratio=$old_x/$old_y;
  if($old_x >$new_w)
	$thumb_w=$new_h*$ratio;
	else
	    $thumb_w=$old_x;
	//$thumb_w=$old_x*($new_w/$old_y);
	 if($old_y >$new_h)
	   $thumb_h=$new_h;
	 else
	    $thumb_h=$old_y;
	
}
if ($old_x == $old_y) {
	$thumb_w=$new_w;
	$thumb_h=$new_h;
}

$dst_img=imagecreatetruecolor($thumb_w,$thumb_h);
	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
	if (preg_match("/png/",$system[1]))
     {
	   
/////////////////////
	imagealphablending($dst_img, true); 
	$transparent = imagecolorallocatealpha($dst_img, 0, 0, 0, 127);
	imagefill($image, 0, 0, $transparent);
		$black = imagecolorallocate($dst_img, 0, 0, 0);
	imagecolortransparent($dst_img, $black);
	imagealphablending($dst_img, true); 
	/////////////////////
	   imagepng($dst_img,$filename); 
      }
	  elseif (preg_match("/gif/",$system[1]))
     {
	   imagegif($dst_img,$filename); 
      }
	 else 
	 {
	  imagejpeg($dst_img,$filename); 
     }
imagedestroy($dst_img); 
imagedestroy($src_img); 
}

//////////////////////////////////////////////////////////////
?>