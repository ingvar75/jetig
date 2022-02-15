@extends('navigation')
<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

$user = Auth::user();
$sess = Session::all();
?>
@csrf
@section('content')
    <div class="jet-layout-cell jet-content">
        <article class="jet-post jet-article">

            <div class="jet-postcontent jet-postcontent-0 clearfix">
                <div class="jet-content-layout">
                    <div class="jet-content-layout-row">
                        <div class="jet-layout-cell layout-item-1" style="width: 100%">
                            <h3 style="border-bottom: 1px solid #776D50; padding-bottom: 5px">Контакти</h3>
                            <p><span style="font-weight: bold; color: #0a53be;">Пн-Пт 10:00-18:00:</span></p>
                            <p>+380679185706</p>
                            <p>+380733059806</p>
                            <p><span style="font-weight: bold; color: #0a53be">Email:</span></p>
                            <p>mail@jetig.net</p>
                            <form action="" method="post">
                            <?php
                                if (isset($user)) {
                                    ?>
                                <p>
                                    <label>
                                        <input type="email" style="width: 25%;" name="email" value="<?=$user['email']?>">
                                    </label>
                                <p><input type="hidden" name="key" value="<?=$sess['_token']?>"></p>
                                </p>
                                <?php
                                }else {
                                ?>
                                <p>
                                    <label>
                                        <input type="email" style="width: 25%;" placeholder="Ваш Email">
                                    </label>
                                </p>
                                <p><input type="hidden" name="key" value="<?=$sess['_token']?>"></p>
                                <?php
                                }
                                ?>
                                <p>
                                    <label>
                                        <textarea style="width: 50%;" name="comment" cols="40" rows="10"
                                                  placeholder="Текст повідомлення"></textarea>
                                    </label>
                                </p>
                                @csrf
                                <p><input type="submit" class="jet-button" value="Відправити повідомлення"></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </article>
    </div>
@stop
<?php

if (isset($user)){
?>
@section('content_login')
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
                                <a href="{{ route('basket') }}" title="Ваш кошик">Кошик</a>
                            </li>
                            <li>
                                <a href="{{ route('history') }}" title="Ваші замовлення">Історія замовлень</a>
                            </li>
                            <li>
                                <a href="{{ route('passreset') }}" title="Замінити пароль">Заміна пароля</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php } ?>
                <br>
                <p><a href="/logout" class="jet-button">Вийти</a></p>
            </div>
        </div>
    </div>

@stop
<?php
}
?>




