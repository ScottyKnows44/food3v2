<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

require_once('vendor/autoload.php');
//this takes and reads the validation
require_once("model/data-layer.php");
require_once("model/validate.php");

//Instantiate the F3 Base class
$f3 = Base::instance();

//run $f3

$f3->route('GET / ', function(){
    //echo '<h1>It is raining today</h1>';
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET|POST /order ', function($f3){
    $meals = getMeals();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    /*
        if(empty($_POST['food']) || !in_array($_POST['meal'], $meals)){
            echo "<p>Please enter a meal</p>";
        }
    */
        if(!validFood($_POST['food'])){
            $f3->set('errors["food"]', "Invalid food item");
        }
        else{
            $_SESSION['food'] = $_POST['food'];
            $_SESSION['meal'] = $_POST['meal'];
            $f3->reroute('order2');
        }
    }


    $f3->set('meals', $meals);

    $view = new Template();
    echo $view->render('views/order.html');

});

$f3->route('GET /summary ', function(){
    $view = new Template();
    echo $view->render('views/summary.html');
    session_destroy();
});

$f3->route('GET|POST /order2 ', function($f3){
    $condiments = getCondiment();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $_SESSION['condiment'] = $_POST['condiment'];
            $f3->reroute('summary');

    }

    $f3->set('condiments', $condiments);
    $view = new Template();
    echo $view->render('views/order2.html');
});

$f3-> run();