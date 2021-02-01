<?php

namespace XUIDChecker\listener;

use pocketmine\Server;
use XUIDChecker\listener\events\LoginListener;
use XUIDChecker\Main;

class ListenerManager {

    public static function init() : void {

        $events = [
            new LoginListener()
        ];

        foreach($events as $listener)
            Server::getInstance()->getPluginManager()->registerEvents($listener, Main::getInstance());
    }
}