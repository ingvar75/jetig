@extends('navigation')


@section('content')
    <div class="jet-layout-cell jet-content">
        <article class="jet-post jet-article">

            <?php
            use Illuminate\Support\Facades\DB;

            $CatParent = DB::table('categories')->where('id_group_parent', 0)->get();
//            var_dump($CatParent);exit;
            if (count($CatParent) > 0){

            ?>
            <h2 class="jet-postheader"><span class="jet-postheadericon">Товари для побуту та активного відпочинку</span></h2>
            <div class="jet-postcontent jet-postcontent-0 clearfix">
                <div class="jet-content-layout-wrapper layout-item-0">
                    <div class="jet-content-layout layout-item-1">
                        <div class="jet-content-layout-row">
                            <?php
                            for ($k = 0; $k < 3; $k++){
                            ?>
                            <div class="jet-layout-cell layout-item-4" style="width: 30%">
                                <p style="text-align: left;">
                                    <a href="/subcategories?IdParent=<?=$CatParent[$k]->id_group?>" title="Перейти на сторінку">
                                        <img width="200" height="200" alt="" class="jet-lightbox"
                                             src="<?=$CatParent[$k]->images_pars?>">
                                    </a>
                                    <br>
                                </p>
                                <p style="text-align: justify;">
                                    <select style="font-size: 14px;">
                                        <option><?=$CatParent[$k]->name_group?></option>

                                <?php
                                $CatIdParents = DB::table('categories')->where('id_group_parent', $CatParent[$k]->id_group)->get();
                                foreach ($CatIdParents as $key => $obj){
                                ?>
                                        <a href="/subcategories?IdCat=<?=$obj->id_group?>" target="_self" title="Перейти у розділ">
                                <option style="text-align: left;">

                                        <?=$obj->name_group?></option></a>
                                <?php
                                }
                                ?>

                                    </select><br>
                                </p>

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
                        <?php
                        if ($k > 2){
                        ?>
                        <div class="jet-content-layout-row">
                            <?php
                            for ($k = 3; $k < count($CatParent); $k++){
                            ?>
                            <div class="jet-layout-cell layout-item-4" style="width: 30%">
                                <p style="text-align: left;">
                                    <a href="/subcategories?IdParent=<?=$CatParent[$k]->id_group?>" title="Перейти на сторінку">
                                        <img width="200" height="200" alt="" class="jet-lightbox"
                                             src="<?=$CatParent[$k]->images_pars?>">
                                    </a>
                                    <br>
                                </p>
                                <p style="text-align: justify;"><span
                                        style="font-size: 14px; color: #D4CEBF;  text-decoration: underline;"><?=$CatParent[$k]->name_group?></span><br>
                                </p>
                                <?php
                                $CatIdParents = DB::table('categories')->where('id_group_parent', $CatParent[$k]->id_group)->get();
                                foreach ($CatIdParents as $key => $obj){
                                ?>
                                <p style="text-align: left;">
                                    <a href="/subcategories?IdCat=<?=$obj->id_group?>" target="_self" title="Перейти у розділ">
                                        <?=$obj->name_group?></a></p>
                                <?php
                                }
                                ?>
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
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

                <?php
                /////////////////////////відобразимо пустий блок//////////////////////////
                ?>
                <div class="jet-content-layout-wrapper layout-item-0">
                    <div class="jet-content-layout layout-item-1">
                        <div class="jet-content-layout-row">
                            <div class="jet-layout-cell layout-item-4" style="width: 100%">
                                <p><br></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            ///////////////////////////відобразимо товари випадкової підкатегорії//////////////////////////
            $CatParent = DB::table('categories')->inRandomOrder()->where('id_group_parent', 0)->first();
            $CatIdParents = DB::table('categories')->inRandomOrder()->where('id_group_parent', $CatParent->id_group)->first();
            $allProductsOfCat = [];
            while (count($allProductsOfCat) < 6) {  //шукаємо товари не меньше 6
                $podCat = DB::table('categories')->inRandomOrder()->where('id_group_parent', $CatIdParents->id_group)->first();

                $allProductsOfCat = DB::table('products')->where('id_group', $podCat->id_group)->limit(12)->get();
                //var_dump($podCat, $allProductsOfCat);
                //exit;
            }
            ?>
            <h4 class="jet-postheader"><span class="jet-postheadericon"><?=$podCat->name_group?></span></h4>
            <?php
            for ($m = 1; $m < 5; $m++){   //кількість рядків
            ?>
            <div class="jet-postcontent jet-postcontent-0 clearfix">
                <div class="jet-content-layout-wrapper layout-item-0">
                    <div class="jet-content-layout layout-item-1">
                        <div class="jet-content-layout-row">
                            <?php
                            $res = array_slice($allProductsOfCat->toArray(), ($m - 1) * 3, 3);
                            for ($j = 0; $j < count($res); $j++){
                            $image_array = explode(',', $allProductsOfCat[$j + ($m - 1) * 3]->image_link);
                            $rmdImg = array_rand($image_array, 1);
                            ?>
                            <div class="jet-layout-cell layout-item-4" style="width: 33%">
                                <p style="text-align: center;">
                                    <a href="/subcategories?IdCatGroup=<?=$allProductsOfCat[$j + ($m - 1) * 3]->id_group?>&ProdCode=<?=$allProductsOfCat[$j + ($m - 1) * 3]->product_code?>">
                                        <img width="250" height="250" alt="" class="jet-lightbox"
                                             src="<?=$image_array[$rmdImg]?>">
                                    </a> <br>
                                </p>
                                <p style="text-align: justify;"><span
                                        style="font-size: 14px; color: #D4CEBF;"><?=$allProductsOfCat[$j + ($m - 1) * 3]->item_name?></span><br>
                                </p>
                                Артикул: <?=$allProductsOfCat[$j + ($m - 1) * 3]->product_code?><br><br><span
                                    style="font-size: 11px; color: #69BDBF;">В наявності</span><br>
                                <span style="color: #EB9705;"><?=$allProductsOfCat[$j + ($m - 1) * 3]->price?><?=$allProductsOfCat[$j + ($m - 1) * 3]->currency?>
                                <br><br>
                            <a href="/subcategories?IdCatGroup=<?=$allProductsOfCat[$j + ($m - 1) * 3]->id_group?>&ProdCode=<?=$allProductsOfCat[$j + ($m - 1) * 3]->product_code?>"
                               class="jet-button">Детальніше</a>&nbsp;
                            </span><br>
                            </div>
                            <?php
                            }
                            $kol = 3 - count($res);
                            if ($kol > 0) {   // пустая ячейка если нет категории
                            for ($n = 1; $n <= $kol; $n++){
                            ?>
                            <div style="width: 33%">
                                <p style="text-align: center;"></p>
                                <p style="text-align: center;"><a href="#" target="_self" title="Перейти у розділ"></a>
                                </p>
                            </div>
                            <?php
                            }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }


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
