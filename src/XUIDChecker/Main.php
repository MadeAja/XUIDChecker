<?php

namespace XUIDChecker;

use pocketmine\plugin\PluginBase;
use XUIDChecker\listener\ListenerManager;
use XUIDChecker\user\UserManager;

class Main extends PluginBase{

    private static \SQLite3 $users;
    private static self $instance;

    public function onEnable() : void{

        self::$users = new \SQLite3($this->getDataFolder(). 'DataBase.db');
        self::$instance = $this;

        ListenerManager::init();
        UserManager::init();
        UserManager::loadAllUsers();
    }

    public function onDisable() : void{
        UserManager::saveAllUsers();
    }

    public static function getUsers() : \SQLite3{
        return self::$users;
    }

    public static function getInstance() : self{
        return self::$instance;
    }
}