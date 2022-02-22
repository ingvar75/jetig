@extends('navigation')

@section('content')
    <div class="jet-layout-cell jet-content">
        <article class="jet-post jet-article">
            <div class="jet-postcontent jet-postcontent-0 clearfix">
                <div class="jet-content-layout">
                    <div class="jet-content-layout-row">
                        <div class="jet-layout-cell layout-item-1" style="width: 100%">
                            <h3 style="border-bottom: 1px solid #776D50; padding-bottom: 5px">Імпорт, експорт excel</h3>
                            <div class="container">
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <form action="{{ route('import') }}" method="post"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <p>
                                                <label for="excel" class="form-label"></label>
                                                <input type="file" name="excel" class="form-control">
                                            </p>
                                            <button class="jet-button">Import User Data</button>
                                            <a href="{{ route('export') }}" class="jet-button"
                                               style="background: #0a53be;">Export User Data</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
@stop
<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

$user = Auth::user();
if (isset($_GET['to']) && $_GET['to'] === 'maint') {
    DB::table('site')->where('id', 1)->update(['site_status' => 1,
        'created_at'=>date("Y-m-d H:i:s")]);
    header('Location: ' . '/maint');
}
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
                if ($user['name'] == 'admin'){
                    if (isset($_GET['delDB']) && $_GET['delDB'] == 'del'){
                    DB::table('products')->truncate();//очистить базу товаров
                    DB::table('categories')->truncate();//очистить базу категорий
                    }
                    ?>
                <div class="jet-blockcontent">
                    <div>
                        <p>Вітаю, <?=$user['name']?></p>
                        <p>Імпорт товарів excel</p>
                        <ul>
                            <li>
                                <a href="{{ route('index') }}" title="Імпорт товарів">Завантажити контент</a>
                            </li>
                            <li>
                                <a href="?to=maint" title="Сайт на ТО">Сайт на ТО</a>
                            </li>
                            <li>
                                <a href="?delDB=del" title="Видалити товари БД">Видалити товари БД</a>
                            </li>
                            <li>
                                <a href="{{ route('translator') }}" title="Переклад">Перекласти українською</a>
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
