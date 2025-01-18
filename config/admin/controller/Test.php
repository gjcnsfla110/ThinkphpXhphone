<?php

namespace config\admin\controller;

class Test
{
    protected $name;

    public function __construct(...$name) {
        dump($name);
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }
}