<?php
class Tamagotchi
{
    private $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    function setName($new_name)
    {
        $this->name = $new_name;
    }

    function getName()
    {
        return $this->name;
    }

    function save()
    {
        array_push($_SESSION['list_of_pets'], $this);
    }

    static function getAll()
    {
        return $_SESSION['list_of_pets'];
    }

    static function deleteAll()
    {
        $_SESSION['list_of_pets'] = array();
    }
}
 ?>
