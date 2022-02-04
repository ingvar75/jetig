<?php
use Illuminate\Support\Facades\Session;
?>
<link rel="stylesheet" href="/css/style.css" media="screen">
<link rel="stylesheet" href="/css/style.ie7.css" media="screen"/>
<link rel="stylesheet" href="/css/style.responsive.css" media="all">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <?php
    $value = Session::all();
    if (count($value['_flash']['old']) > 0) {
        $status = $value['status'];
    } else {
        $status = 0;
    }
    if ($status == 'Task was successful!') {
    ?>
    <style>
        .overlay {
            z-index: 300; /* подложка должна быть выше слоев элементов сайта, но ниже слоя модального окна */
            position: fixed; /* всегда перекрывает весь сайт */
            background-color: #000; /* черная */
            opacity: 1.0; /* но немного прозрачна */
            width: 100%;
            height: 100%; /* размером во весь экран */
            top: 0;
            left: 0; /* сверху и слева 0, обязательные свойства! */
            /*cursor: pointer;*/
            display: block; /* в обычном состоянии скрыта */
        }
    </style>
    <div id="over" class="overlay"></div>
    <div id="myModal" class="jet-block clearfix"
         style="width: 33%; display: block; position: fixed; z-index: 305;top: 25%; left: 33%;">

        <div class="jet-blockcontent">
            <div>
                <p style="text-align: center;">
                    <span style="font-size: x-large;color: limegreen">Ви успішно зареєструвались!</span>
                </p>
                <br>
                <p style="text-align: center;">
                    <a href="/home" class="jet-button"
                       style="cursor: pointer; background: #736336;">Перейти на сайт</a>
                </p>
            </div>
        </div>
    </div>
 <?php

    }else{
    ?>
    <style>
        .overlay {
            z-index: 300; /* подложка должна быть выше слоев элементов сайта, но ниже слоя модального окна */
            position: fixed; /* всегда перекрывает весь сайт */
            background-color: #000; /* черная */
            opacity: 1.0; /* но немного прозрачна */
            width: 100%;
            height: 100%; /* размером во весь экран */
            top: 0;
            left: 0; /* сверху и слева 0, обязательные свойства! */
            /*cursor: pointer;*/
            display: block; /* в обычном состоянии скрыта */
        }
    </style>
    <div id="over" class="overlay"></div>
    <div id="myModal" class="jet-block clearfix"
         style="width: 33%; display: block; position: fixed; z-index: 305;top: 25%; left: 33%;">

        <div class="jet-blockcontent">
            <div>
                <p style="text-align: center;">
                    <span style="font-size: x-large;color: red">Невідома помилка!</span>
                </p>
                <br>
                <p style="text-align: center;">
                    <a href="/home" class="jet-button"
                       style="cursor: pointer; background: #736336;">Перейти на сайт</a>
                </p>
            </div>
        </div>
    </div>
    <?php
    }
    var_dump($value);exit;
    ?>

