<?php
namespace tests\ajaxEspacemembre\Model;
class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=chat;charset=utf8', 'root', '');
        return $db;
    }
}