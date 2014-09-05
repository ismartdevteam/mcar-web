  <?php
     
//we tell the server to treat this file as if it wore an image
header('Content-type: image/jpeg');
//image file path
$img = 'C:\Users\Ulziiburen\Desktop\1.png';

//watermark position
$p = $_GET['p']; if(!$p) $p = 'br';
/*
p can be anything from the following list:
tl = top left
tc = top center
tr = top right
cl = center left
c = center of the image
cr = center right
bl = bottom left
bc = bottom center
br = bottom right
*/
//watermarked image quality
$q = $_GET['q'];
//if the quality field is missing or is not on the 0 to 100 scale then we set the quality to 93
if(!$q || $q<0 || $q>100) $q = '93';
 
 
$filetype = substr($img,strlen($img)-4,4);
$filetype = strtolower($filetype);
if($filetype == ".gif") $image = @imagecreatefromgif($img);
if($filetype == ".jpg") $image = @imagecreatefromjpeg($img);
if($filetype == ".png") $image = @imagecreatefrompng($img);
if (!$image) die();
 
//getting the image size for the original image
$img_w = imagesx($image);
$img_h = imagesy($image);
//if the filename has 150x150 in it's name then we don't apply the watermark
if (eregi("150x150", $img)) {
    imagejpeg($image, null, $q); die();
} else {
    $watermark = @imagecreatefrompng('C:\xampp\htdocs\mcar\watermarket.png');
}
/*
//if you want to use the watermark only on bigger images then use this instead of the condition above
if ($img_w < "150") {//if image width is less then 150 pixels
    imagejpeg($image, null, $q); die();
} else {
    $watermark = @imagecreatefrompng('watermark.png');
}
*/
 
//getting the image size for the watermark
$w_w = imagesx($watermark);
$w_h = imagesy($watermark);
 
if($p == "tl") {
    $dest_x = 0;
    $dest_y = 0;
} elseif ($p == "tc") {
    $dest_x = ($img_w - $w_w)/2;
    $dest_y = 0;
} elseif ($p == "tr") {
    $dest_x = $img_w - $w_w;
    $dest_y = 0;
} elseif ($p == "cl") {
    $dest_x = 0;
    $dest_y = ($img_h - $w_h)/2;
} elseif ($p == "c") {
    $dest_x = ($img_w - $w_w)/2;
    $dest_y = ($img_h - $w_h)/2;
} elseif ($p == "cr") {
    $dest_x = $img_w - $w_w;
    $dest_y = ($img_h - $w_h)/2;
} elseif ($p == "bl") {
    $dest_x = 0;
    $dest_y = $img_h - $w_h;
} elseif ($p == "bc") {
    $dest_x = ($img_w - $w_w)/2;
    $dest_y = $img_h - $w_h;
} elseif ($p == "br") {
    $dest_x = $img_w - $w_w;
    $dest_y = $img_h - $w_h;
}
 
imagecopy($image, $watermark, $dest_x, $dest_y, 0, 0, $w_w, $w_h);
imagejpeg($image, null, $q);
imagedestroy($image);
imagedestroy($watermark);
     ?>
