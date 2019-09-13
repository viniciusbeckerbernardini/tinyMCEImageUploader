<?php
DEFINE('IMAGES_PATH','./images/');

if(!is_dir(IMAGES_PATH)){
    mkdir(IMAGES_PATH);
}

$image = current($_FILES);
$imageName = $image["name"];

$extension = ".".end(explode('.',$imageName));
switch ($extension) {
    case '.jpeg':
    case '.jpg':
        $createImage = imagecreatefromjpeg($image["tmp_name"]);
        $pathToSave = IMAGES_PATH.md5(microtime()).$extension;
        imagejpeg($createImage,$pathToSave);
        imagedestroy($createImage);
        echo json_encode(array("location"=>$pathToSave));
        exit();
        break;
    case '.png':
        $createImage = imagecreatefrompng($image["tmp_name"]);
        imagealphablending($createImage, false);
        imagesavealpha($createImage, true);
        $pathToSave = IMAGES_PATH.md5(microtime()).$extension;
        imagepng($createImage,$pathToSave);
        imagedestroy($createImage);
        echo json_encode(array("location"=>$pathToSave));
        exit();
        break;
    case '.gif':
        $createImage = imagecreatefromgif($image["tmp_name"]);
        $pathToSave = IMAGES_PATH.md5(microtime()).$extension;
        imagegif($createImage,$pathToSave);
        imagedestroy($createImage);
        echo json_encode(array("location"=>$pathToSave));
        exit();
        break;
    default:
        header("HTTP/1.1 400 Invalid extension.");
        exit();
        break;
}



