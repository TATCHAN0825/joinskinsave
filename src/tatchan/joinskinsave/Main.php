<?php

declare(strict_types=1);

namespace tatchan\joinskinsave;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use tatchan\joinskinsave\Task\SkinSaveTask;

class Main extends PluginBase implements Listener
{
    /** @var Config */
    private $skinHashes;

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->skinHashes = new Config($this->getDataFolder() . "skin-hashes.yml");

    }

    public function onPlayerJoin(PlayerJoinEvent $event): void {
        $player = $event->getPlayer();
        $name = $player->getName();
        $skinData = $player->getSkin()->getSkinData();
        $skinDataHash = sha1($skinData);
        $hashes = $this->skinHashes->get($name, []);
        if (!in_array($skinDataHash, $hashes, true)) {
            $hashes[] = $skinDataHash;
            $this->skinHashes->set($name, $hashes);
            @mkdir($this->getDataFolder() . $name . "/");
            $this->getServer()->getAsyncPool()->submitTask(new SkinSaveTask($skinData, $this->getDataFolder() . $name . "/" . date("Y-m-d-H-i-s") . ".png"));
        }
    }

    public function onDisable() {
        $this->skinHashes->save();
    }

}
