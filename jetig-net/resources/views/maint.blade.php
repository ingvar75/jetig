<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
?>
<link rel="stylesheet" href="/css/style.css" media="screen">
<link rel="stylesheet" href="/css/style.ie7.css" media="screen"/>
<link rel="stylesheet" href="/css/style.responsive.css" media="all">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<?php
if (DB::table('site')
        ->where('id', 1)
        ->where('site_status', 1)
        ->exists() == false) header('Location:'.'/home');
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
                <span style="font-size: x-large;color: #cb9610">Проводяться технічні роботи. Спробуй пізніше!</span>
            </p>
        </div>
    </div>
</div>
