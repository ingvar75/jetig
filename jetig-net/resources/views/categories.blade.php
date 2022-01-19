@extends('navigation')


@section('content')
    <div class="jet-layout-cell jet-content">
        <article class="jet-post jet-article">
            <h2 class="jet-postheader"><span class="jet-postheadericon">Категорії товарів</span></h2>
            <?php
            use Illuminate\Support\Facades\DB;
            $CatParent = DB::table('categories')->where('id_group_parent', 0)->get();
            if (count($CatParent) > 0){

            ?>
            <div class="jet-postcontent jet-postcontent-0 clearfix">
            <div class="jet-content-layout-wrapper layout-item-0">
                <div class="jet-content-layout layout-item-1">
                    <div class="jet-content-layout-row">
                        <?php
                        for ($k = 0; $k < count($CatParent); $k++){
                        ?>
                        <div class="jet-layout-cell layout-item-4" style="width: 30%">
                            <p style="text-align: justify;"><span
                                    style="font-size: 14px; color: #D4CEBF;"><?=$CatParent[$k]->name_group?></span><br>
                            </p>

                            <p style="text-align: center;"><a href="" target="_self" title="Перейти у розділ">
                                </a></p>
                        </div>
                        <?php

                               $kol = 3 - count($CatParent);
                               if ($kol > 0) {   // пустая ячейка если нет категории
                               for ($n = 1; $n <= $kol; $n++){
                               ?>
                               <div style="width: 30%">
                                   <p style="text-align: center;"></p>
                                   <p style="text-align: center;"><a href="#" target="_self" title="Перейти у розділ"></a>
                                   </p>
                               </div>
                               <?php
                               }
                               }
                        } ?>
                    </div>
                </div>
            </div>
            </div>
            <?php



            }else {
                echo "<p>Нажаль наразі не має доступних категорій, спробуйте зайти пізніше.</p>";
            }
            //суперкатегорії
            ?>

        </article>
    </div>
@stop

<?php
use Illuminate\Support\Facades\Auth;

$user = Auth::user();
if (isset($user)){
?>
@section('content_login')

    <div class="jet-layout-cell jet-sidebar1">
        <div class="jet-block clearfix">
            <div class="jet-blockheader">
                <h3 class="t">Кабінет</h3>
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

                    <?php
                    if ($user['name'] == 'admin'){ ?>
                    <div class="jet-blockcontent">
                        <div>
                            <p>Вітаю, <?=$user['name']?></p>
                            <p>Імпорт товарів excel</p>
                            <ul>
                                <li>
                                    <a href="{{ route('index') }}" title="Імпорт товарів">Завантажити контент</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php }else{ ?>
                    <div class="jet-blockcontent">
                        <div>
                            <p style="color: #cbae57">Вітаю, <?=$user['name']?> !</p>
                            <ul>
                                <li>
                                    <a href="{{ route('home') }}" title="Ваш кошик">Кошик</a>
                                </li>
                                <li>
                                    <a href="{{ route('home') }}" title="Ваші замовлення">Історія замовлень</a>
                                </li>
                                <li>
                                    <a href="{{ route('home') }}" title="Ваші дані">Керувати даними</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>
                    <br>
                    <p><a href="/logout" class="jet-button">Вийти</a></p>
                    @stop
                    <?php
                    }else {
                    ?>
                    @section('content_login')

                        <div class="jet-layout-cell jet-sidebar1">
                            <div class="jet-block clearfix">
                                <div class="jet-blockheader">
                                    <h3 class="t">Авторизація</h3>
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

                                        <p><br>{{ Form::submit('Вхід', ['class' => 'jet-button']) }}</p>

                                        {{ Form::close() }}

                                        <p><a href="/register">Реєстрація</a></p>
@stop

<?php
}


?>
