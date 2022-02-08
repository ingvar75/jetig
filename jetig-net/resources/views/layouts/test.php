<?php
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}

        /* Модальный (фон) */
        .modal {
            display: none; /* Скрыто по умолчанию */
            position: fixed; /* Оставаться на месте */
            z-index: 1; /* Сидеть на вершине */
            padding-top: 100px; /* Расположение коробки */
            left: 0;
            top: 0;
            width: 100%; /* Полная ширина */
            height: 100%; /* Полная высота */
            overflow: auto; /* Включите прокрутку, если это необходимо */
            background-color: rgb(0,0,0); /* Цвет запасной вариант  */
            background-color: rgba(0,0,0,0.4); /*Черный с непрозрачностью */
        }

        /* Модальное содержание */
        .modal-content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            width: 80%;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s
        }

        /* Добавить анимацию */
        @-webkit-keyframes animatetop {
            from {top:-300px; opacity:0}
            to {top:0; opacity:1}
        }

        @keyframes animatetop {
            from {top:-300px; opacity:0}
            to {top:0; opacity:1}
        }

        /* Кнопка закрытия */
        .close {
            color: white;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-header {
            padding: 2px 16px;
            background-color: #5cb85c;
            color: white;
        }

        .modal-body {padding: 2px 16px;}

        .modal-footer {
            padding: 2px 16px;
            background-color: #5cb85c;
            color: white;
        }
    </style>
</head>
<body>
<h1>Модальное в заголовке и подвале</h1>

<h2>Анимированные модальные окна в заголовке и нижнем колонтитуле</h2>

<!-- Trigger/Open The Modal -->
<button id="myBtn">Открыть модальном окно</button>

<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Модальное содержание -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Модальный заголовок</h2>
        </div>
        <div class="modal-body">
            <p>Некоторый текст в модальном теле</p>
            <p>Какой-то другой текст...</p>
        </div>
        <div class="modal-footer">
            <h3>Модальный подвал</h3>
        </div>
    </div>

</div>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</body>
</html>


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
        <br> {{ Form::submit('Реєстрація', ['class' => 'jet-button', 'style'=>'width: 100px; background: #AE8612;']) }}
        <span><a href="/login">Вхід</a></span></p>

    {{ Form::close() }}

    <p></p>
</div>
