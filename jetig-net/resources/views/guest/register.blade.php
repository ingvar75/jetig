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

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtnEnter");

        var regModal = document.getElementById("regModal");

        // Get the button that opens the modal
        var btnReg = document.getElementById("myBtnReg");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // Get the <span> element that closes the modal
        var spanReg = document.getElementsByClassName("closeReg")[0];

        var activeEnter = document.getElementsByClassName("activeEnter")[0];
        var activeReg = document.getElementsByClassName("activeReg")[0];

        var fon = document.getElementById("over");

        // When the user clicks the button, open the modal
        btn.onclick = function () {
            regModal.style.display = "none";
            modal.style.display = "block";
            fon.style.display = "block";
        }

        activeEnter.onclick = function () {
            regModal.style.display = "none";
            modal.style.display = "block";
            fon.style.display = "block";
        }
        activeReg.onclick = function () {
            regModal.style.display = "block";
            modal.style.display = "none";
            fon.style.display = "block";
        }

        // When the user clicks the button, open the modal
        btnReg.onclick = function () {
            modal.style.display = "none";
            regModal.style.display = "block";
            fon.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
            fon.style.display = "none";
        }
        // When the user clicks on <span> (x), close the modal
        spanReg.onclick = function () {
            regModal.style.display = "none";
            fon.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
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

