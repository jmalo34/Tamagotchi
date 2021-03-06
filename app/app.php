<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Tamagotchi.php";

    session_start();

    if (empty($_SESSION['list_of_pets']))
    {
        $_SESSION['list_of_pets'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get("/", function() use ($app)
    {
        return $app['twig']->render('pets.html.twig', array('pets' => Tamagotchi::getAll()));
    });

    $app->post("/pets", function() use ($app)
    {
        $pet = new Tamagotchi($_POST['name']);
        $pet->save();

        return $app['twig']->render('create_pet.html.twig', array('newpet' => $pet));
    });

    $app->post("/delete_pets", function() use ($app)
    {
        Tamagotchi::deleteAll();

        return $app['twig']->render('delete_pets.html.twig');
    });

//find out how to change so these methods can work on more than the object keyed in array at 0
    $app->post("/feeding", function () use ($app)
    {
        $pet = Tamagotchi::getAll();
        if (key($_POST) == "food")
        {
            $pet[0]->feed();
        }

        return $app['twig']->render('pets.html.twig', array('pets' => Tamagotchi::getAll()));
    });

    $app->post("/feelings", function() use ($app)
    {
        $_SESSION['list_of_pets'][0]->setMood($_SESSION['list_of_pets'][0]->getMood() + 5);

        return $app['twig']->render('pets.html.twig', array('pets' => Tamagotchi::getAll()));
    });

    return $app;
 ?>
