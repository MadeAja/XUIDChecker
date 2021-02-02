<?php

namespace XUIDChecker\listener\events;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerLoginEvent;
use XUIDChecker\user\UserManager;

class LoginListener implements Listener {

    /**
     * @param PlayerLoginEvent $e
     * @priority HIGHEST
     * @ignoreCancelled true
     */

    public function LoginCheckXUID(PlayerLoginEvent $e) : void{

        $player = $e->getPlayer();

        if(!UserManager::getUser($player->getName())){
            UserManager::createUser($player);
            return;
        }

        if(UserManager::getUser($player->getName())->getXUID() !== $player->getXuid()) {
            $e->setCancelled(true);
            $player->close("", "§l§4XUID ERROR§r§7!");
        }
    }
}
