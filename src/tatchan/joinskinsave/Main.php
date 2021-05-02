<?php

declare(strict_types=1);

namespace tatchan\joinskinsave;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {
    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onJoin(PlayerJoinEvent $event) {
        $player = $event->getPlayer();
        $skin_raw = $player->getSkin()->getSkinData();

        $height = 64;
        $width = 64;
        switch (strlen($skin_raw)) {
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
                $list = substr($skin_raw, $index, 4);
                $r = ord($list[0]);
                $g = ord($list[1]);
                $b = ord($list[2]);
                $a = 127 - (ord($list[3]) >> 1);
                $index += 4;
                $color = imagecolorallocatealpha($img, $r, $g, $b, $a);
                imagesetpixel($img, $x, $y, $color);
            }
        }

        imagepng($img, $this->getDataFolder() . $player->getName() . ".png");
        imagedestroy($img);
    }
}
