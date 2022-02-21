<?php
use App\Http\Controllers\NavActive;
use Illuminate\Support\Facades\Session;

$nav = new NavActive;
$action = $nav->navigation();
if ($action == '/login') header('Location: /register');
?>
@extends('layouts.main')
@section('login')
    @if ($errors->any())
        <?php
        $value = Session::get('_old_input');
        if (count($value) > 2) {$rModal = "block"; $aModal = "none";}else{$rModal = "none"; $aModal = "block";}
        $dModal = "block";
        ?> @else <?php $dModal = "none"; $aModal = "none"; $rModal = "none";?>
    @endif


    <style>
        .overlay {
            z-index: 300; /* подложка должна быть выше слоев элементов сайта, но ниже слоя модального окна */
            position: fixed; /* всегда перекрывает весь сайт */
            background-color: #000; /* черная */
            opacity: 0.8; /* но немного прозрачна */
            width: 100%;
            height: 100%; /* размером во весь экран */
            top: 0;
            left: 0; /* сверху и слева 0, обязательные свойства! */
            /*cursor: pointer;*/
            display: <?=$dModal?>; /* в обычном состоянии скрыта */
        }
    </style>
    <div id="over" class="overlay"></div>
    <div id="myModal" class="jet-block clearfix"
         style="width: 33%; display: <?=$aModal?>; position: fixed; z-index: 305;top: 25%; left: 33%;">
        <div class="jet-blockheader">

            <h3 class="t">Вхід
                <span class="close" title="Закрити"
                      style=" color: silver;float: right;font-size: 28px;font-weight: bold;cursor: pointer;">&times;
                                        </span>
            </h3>
        </div>

        <div class="jet-blockcontent">
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li style="color: #800000; /* Цвет текста */
                                           padding: 2px; /* Поля вокруг текста */">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <br>
                @endif

                {{ Form::open(['url' => 'login', 'method' => 'post']) }}
                {{ Form::label('email', 'Email') }}
                {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}

                {{ Form::label('password', 'Password') }}
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
                <p>
                    <br>{{ Form::submit('Увійти', ['class' => 'jet-button', 'style' => 'background: #C37D04;']) }}
                    <a class="activeReg" style="cursor: pointer;">Реєстрація</a>
                </p>
                {{ Form::close() }}

            </div>
        </div>
    </div>

    <div id="regModal" class="jet-block clearfix"
         style="width: 33%; display: <?=$rModal?>; position: fixed; z-index: 305;top: 25%; left: 33%;">
        <div class="jet-blockheader">

            <h3 class="t">Реєстрація
                <span class="closeReg" title="Закрити"
                      style=" color: silver;float: right;font-size: 28px;font-weight: bold;cursor: pointer;">&times;
                                        </span>
            </h3>
        </div>
        <div class="jet-blockcontent">
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li style="color: #800000; /* Цвет текста */
                                                               padding: 2px; /* Поля вокруг текста */">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <br>
                @endif
                {{ Form::open(['url' => 'register', 'method' => 'post']) }}

                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) }}

                {{ Form::label('email', 'Email') }}
                {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}

                {{ Form::label('password', 'Password') }}
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}

                {{ Form::label('repeatPassword', 'Repeat Password') }}
                {{ Form::password('repeatPassword', ['class' => 'form-control', 'placeholder' => 'Repeat Password']) }}
                <p>
                    <br> {{ Form::submit('Реєстрація', ['class' => 'jet-button', 'style'=>'background: #AE8612;']) }}
                    <span><a class="activeEnter" style="cursor: pointer;">Вхід</a></span></p>

                {{ Form::close() }}

                <p></p>
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
@stop
