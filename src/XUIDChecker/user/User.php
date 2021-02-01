<?php

namespace XUIDChecker\user;

class User {

    private string $name;
    private string $uuid;

    public function __construct(string $name, string $uuid) {
        $this->name = $name;
        $this->uuid = $uuid;
    }

    public function getUUID() : string {
        return $this->uuid;
    }

    public function getName() : string {
        return $this->name;
    }
}