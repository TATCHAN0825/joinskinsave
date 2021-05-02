<?php

namespace tatchan\joinskinsave\Task;

use pocketmine\scheduler\AsyncTask;

class SkinSaveTask extends AsyncTask
{
    private $skindata, $filepath;

    public function __construct(string $skindata, string $filepath) {
        $this->skindata = $skindata;
        $this->filepath = $filepath;
    }

    public function onRun() {
        $height = 64;
        $width = 64;
        switch (strlen($this->skindata)) {
            case 64 * 32 * 4:
                $height = 32;
                $width = 64;
                break;
            case 64 * 64 * 4:
                $height = 64;
                $width = 64;
                break;
            case 128 * 64 * 4:
                $height = 64;
                $width = 128;
                break;
            case 128 * 128 * 4:
                $height = 128;
                $width = 128;
                break;
        }

        $img = imagecreatetruecolor($width, $height);
        imagealphablending($img, false);
        imagesavealpha($img, true);

        $index = 0;
        for ($y = 0; $y < $height; ++$y) {
            for ($x = 0; $x < $width; ++$x) {
                $list = substr($this->skindata, $index, 4);
                $r = ord($list[0]);
                $g = ord($list[1]);
                $b = ord($list[2]);
                $a = 127 - (ord($list[3]) >> 1);
                $index += 4;
                $color = imagecolorallocatealpha($img, $r, $g, $b, $a);
                imagesetpixel($img, $x, $y, $color);
            }
        }

        imagepng($img, $this->filepath);
        imagedestroy($img);
    }

}