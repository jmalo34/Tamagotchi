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

    $app->post("/feeding", function () use ($app)
    {
        $_SESSION['list_of_pets'][0]->setFood($_SESSION['list_of_pets'][0]->getFood() +10);
        return $app['twig']->render('pets.html.twig', array('pets' => Tamagotchi::getAll()));
    });

    return $app;
 ?>
