<?php

namespace XUIDChecker\listener\events;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerPreLoginEvent;
use XUIDChecker\user\UserManager;

class PreLoginListener implements Listener {

    /**
     * @param PlayerPreLoginEvent $e
     * @priority HIGHEST
     * @ignoreCancelled true
     */

    public function PreLoginCheckXUUID(PlayerPreLoginEvent $e) : void{

        $player = $e->getPlayer();

        if(!UserManager::getUser($player->getName())){
            UserManager::createUser($player);
            return;
        }

        if(UserManager::getUser($player->getName())->getUUID() !== $player->getXuid()) {
            $player->close("", "§l§4XUUID ERROR§r§7!");
            $e->setCancelled(true);
        }
    }
}