@extends('navigation')
<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

$user = Auth::user();
$sess = Session::all();

?>
@section('content')

    <div class="jet-layout-cell jet-content">
        <article class="jet-post jet-article">

            <div class="jet-postcontent jet-postcontent-0 clearfix">
                <div class="jet-content-layout">
                    <div class="jet-content-layout-row">
                        <div class="jet-layout-cell layout-item-1" style="width: 100%">
                            <h3 style="border-bottom: 1px solid #776D50; padding-bottom: 5px">Результати пошуку</h3>
                            <?php
                            $products = DB::table('products')
                                ->select('product_code', 'item_name', 'image_link', 'id_group', 'price', 'currency')
                                ->get();
                            if (isset($_GET['s'])) {
                                $pulya = $_GET['s'];
                            } else {
                                $pulya = '';
                            }
                            $mayak = false;
                            foreach ($products as $value) {
                            $compare = similar_text($pulya, $value->product_code, $perc);
                            $image_array = explode(',', $value->image_link);
                            $imageLink = $image_array[array_rand($image_array, 1)];
                            if ($perc >= 87){
                                $mayak = true;
                            ?>
                            <p style="text-align: left;">
                                <a href="/subcategories?IdCatGroup=<?=$value->id_group?>&ProdCode=<?=$value->product_code?>"
                                   title="<?=$value->item_name?>">
                                    <img width="70" height="70" alt=""
                                         class="jet-lightbox"
                                         src="<?=$imageLink?>">
                                </a>
                                <br></p>
                            <p style="text-align: justify;"><span
                                    style="font-size: 14px; color: #D4CEBF;"><?=$value->item_name?></span><br>
                            </p>
                            Артикул: <?=$value->product_code?><br><span
                                style="font-size: 11px; color: #69BDBF;">В наявності</span><br>
                            <span
                                style="color: #EB9705;"><?=$value->price?> <?=$value->currency?><br><br>
                                            <a href="subcategories?IdCatGroup=<?=$value->id_group?>&ProdCode=<?=$value->product_code?>"
                                               class="jet-button">Детальніше</a>&nbsp;
                                        </span><br>
                            <?php
                            }else {
                                $compare = similar_text($pulya, $value->item_name, $perc);
                                if ($perc >= 60) {
                                    $mayak = true;
                            ?>
                            <p style="text-align: left;">
                                <a href="/subcategories?IdCatGroup=<?=$value->id_group?>&ProdCode=<?=$value->product_code?>"
                                   title="<?=$value->item_name?>">
                                    <img width="70" height="70" alt=""
                                         class="jet-lightbox"
                                         src="<?=$imageLink?>">
                                </a>
                                <br></p>
                            <p style="text-align: justify;"><span
                                    style="font-size: 14px; color: #D4CEBF;"><?=$value->item_name?></span><br>
                            </p>
                            Артикул: <?=$value->product_code?><br><span
                                style="font-size: 11px; color: #69BDBF;">В наявності</span><br>
                            <span
                                style="color: #EB9705;"><?=$value->price?> <?=$value->currency?><br><br>
                                            <a href="subcategories?IdCatGroup=<?=$value->id_group?>&ProdCode=<?=$value->product_code?>"
                                               class="jet-button">Детальніше</a>&nbsp;
                                        </span><br><hr style="color: #2f2a1c;">
                            <?php
                                }
                            }
                            }
                            if ($mayak !== true) echo "<p><span style='color: #842029; font-style: italic; font-size: 16px;'>За даним запитом результатів не знайдено !</span></p>";
                            ?>

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
