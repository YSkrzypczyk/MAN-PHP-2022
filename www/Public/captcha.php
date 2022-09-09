<?php
header("Content-Type: image/png");
session_start();

$image = imagecreate(200, 100);

$captcha  = substr(md5(uniqid()), 0, rand(6,8));
$_SESSION["captcha"] = $captcha;


$listOfFonts = glob("Font/*ttf");


$back = imagecolorallocate($image, rand(0,100),rand(0,100),rand(0,100));

$x = rand(10,15);
for($i=0;$i<strlen($captcha); $i++)
{

    $colorfont[] = imagecolorallocate($image, rand(150,250),rand(150,250),rand(150,250));

    imagettftext(
        $image,
        rand(20,30),
        rand(-10,10),
        $x ,
        rand(40, 60),
        $colorfont[$i],
        $listOfFonts[array_rand($listOfFonts)],
        $captcha[$i]
    );


    $x += rand(20,25);
}


for($j=0; $j< rand(4, 6); $j++){

    $form = rand(1,3);

    if($form ==1 )
        imageline($image,rand(0,200),rand(0,100),rand(0,200),rand(0,100),$colorfont[array_rand($colorfont)]);
    else if($form == 2)
        imagerectangle($image,rand(0,200),rand(0,100),rand(0,200),rand(0,100),$colorfont[array_rand($colorfont)]);
    else
        imageellipse($image,rand(0,200),rand(0,100),rand(0,200),rand(0,100),$colorfont[array_rand($colorfont)]);



}



imagepng($image);