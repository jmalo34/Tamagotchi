<?php
class Tamagotchi
{
    private $name;
    private $food;
    private $mood;

    function __construct($name, $food = 100, $mood = 100)
    {
        $this->name = $name;
        $this->food = $food;
        $this->mood = $mood;
    }

    function setName($new_name)
    {
        $this->name = $new_name;
    }

    function getName()
    {
        return $this->name;
    }

    function setFood($new_food)
    {
        $this->food = $new_food;
    }

    function getFood()
    {
        return $this->food;
    }

    function setMood($new_mood)
    {
        $this->mood = $new_mood;
    }

    function getMood()
    {
        return $this->mood;
    }

    function feed()
 {
    $this->food++;
 }
    // function feed ()
    // {
    //     $hunger = $_GET['food'];
    //     if ($hunger != 0)
    //     {
    //         return $hunger + 10;
    //     }
    //     else
    //     {
    //         return "Your pet died of hunger.";
    //     }
    // }

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
