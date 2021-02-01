<?php

namespace XUIDChecker\listener;

use pocketmine\Server;
use XUIDChecker\listener\events\PreLoginListener;
use XUIDChecker\Main;

class ListenerManager {

    public static function init() : void {

        $events = [
            new PreLoginListener()
        ];

        foreach($events as $listener)
            Server::getInstance()->getPluginManager()->registerEvents($listener, Main::getInstance());
    }
}