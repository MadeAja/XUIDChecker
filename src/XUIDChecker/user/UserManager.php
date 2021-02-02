<?php

namespace XUIDChecker\user;

use XUIDChecker\Main;
use pocketmine\Player;

class UserManager {

    private static array $users = [];

    public static function init() : void {
        Main::getUsers()->query("CREATE TABLE IF NOT EXISTS 'users' (nick TEXT, uuid TEXT)");
    }

    public static function createUser(Player $user) : void {
        self::$users[$user->getName()] = new User($user->getName(), $user->getXuid());
    }

    public static function getUser(string $user) : ?User {
        return self::userExists($user) ? self::$users[$user] : null;
    }

    public static function userExists(string $user) : bool {
        return isset(self::$users[$user]);
    }

    public static function saveAllUsers() : void {
        foreach(self::$users as $row => $value) {
            $name = $value->getName();
            $uuid = $value->getUUID();
            if(empty(Main::getUsers()->query("SELECT * FROM 'users' WHERE nick = '$name'")->fetchArray()))
                Main::getUsers()->query("INSERT INTO 'users' (nick, uuid) VALUES ('$name', '$uuid')");
        }
    }
    
    public static function loadAllUsers() : void {
        $db = Main::getUsers()->query("SELECT * FROM 'users'");

        $users = [];

        while($row = $db->fetchArray(SQLITE3_ASSOC))
            $users[$row["nick"]] = new User($row["nick"], $row["uuid"]);

        self::$users = $users;
    }
}
