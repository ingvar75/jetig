@extends('navigation')

@section('content')
    <div class="jet-layout-cell jet-content">
        <article class="jet-post jet-article">
            <?php
            use Illuminate\Support\Facades\DB;
            $CatParent = DB::table('categories')->inRandomOrder()->where('id_group_parent', 0)->first();
            //суперкатегорія random
            ?>
            <h2 class="jet-postheader"><span class="jet-postheadericon"><?=$CatParent->name_group?></span></h2>
            <div class="jet-postcontent jet-postcontent-0 clearfix">
                <?php ////////////////////визначимо та виведемо кількість головних категорій//////////////////////////
                $CatIdParents = DB::table('categories')->where('id_group_parent', $CatParent->id_group)->get();
                $CatIdParents = $CatIdParents->toArray();
                if (count($CatIdParents) > 0){
                $row = ceil(count($CatIdParents) / 5); //округлим до большего целого
                for ($k = 1; $k <= $row; $k++){
                ?>
                <div class="jet-content-layout-wrapper layout-item-0">
                    <div class="jet-content-layout layout-item-1">
                        <div class="jet-content-layout-row">
                            <?php
                            $rew = array_slice($CatIdParents, ($k - 1) * 5, 5);
                            foreach ($rew as $key=>$value) {
                            //завантажимо картинку для підкатегорії якщо її немає
                            $IdGroupsPodcat = DB::table('categories')
                                ->inRandomOrder()
                                ->where('id_group_parent', $value->id_group)
                                ->first();
                            if (is_null($IdGroupsPodcat)){
////////////////////////////////////////delete empty category///////////////////////////////////////////////////
                                DB::table('categories')->where('id_group', $value->id_group)->delete();
                            }else{
                                $imagesOfGroups = DB::table('products')
                                    ->inRandomOrder()
                                    ->where('id_group', $IdGroupsPodcat->id_group)
                                    ->first();
//                            var_dump($IdGroupsPodcat);
//                            var_dump($imagesOfGroups);exit;
                                $image_array = explode(',', $imagesOfGroups->image_link);
                                $imageLink = $image_array[array_rand($image_array, 1)];
                            }
                            ?>
                                <div class="jet-layout-cell layout-item-4" style="width: 20%">
                                    <p style="text-align: center;">
                                        <a href="subcategories?IdCat=<?=$value->id_group?>" target="_self" title="Перейти у розділ">
                                            <img width="99" height="99" alt="" class="jet-lightbox"
                                                 src="<?=$imageLink?>">
                                        </a><br>
                                    </p>
                                    <p style="text-align: center;">
                                        <a href="subcategories?IdCat=<?=$value->id_group?>" target="_self" title="Перейти у розділ">
                                            <?=$value->name_group?></a>
                                    </p>
                                </div>
                            <?php
                            }
                            $kol = 5 - count($rew);
                            if ($kol > 0) {   // пустая ячейка если нет категории
                            for ($n = 1; $n <= $kol; $n++){
                            ?>
                            <div style="width: 20%">
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
                <?php
                }
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
                                    </a><br>
                                </p>
                                <p style="text-align: justify;"><span
                                        style="font-size: 14px; color: #D4CEBF;"><?=$allProductsOfCat[$j + ($m - 1) * 3]->item_name?></span><br>
                                </p>
                                Артикул: <?=$allProductsOfCat[$j + ($m - 1) * 3]->product_code?><br><br><span
                                    style="font-size: 11px; color: #69BDBF;">В наявності</span><br>
                                <span
                                    style="color: #EB9705;"><?=$allProductsOfCat[$j + ($m - 1) * 3]->price?><?=$allProductsOfCat[$j + ($m - 1) * 3]->currency?><br><br>
                                    <a href="/subcategories?IdCatGroup=<?=$allProductsOfCat[$j + ($m - 1) * 3]->id_group?>&ProdCode=<?=$allProductsOfCat[$j + ($m - 1) * 3]->product_code?>"
                                       class="jet-button">Детальніше</a>
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
                <?php
                }
                ?>
            </div>

            <?php }else {
                echo "<p>Нажаль в даному розділі категорії товарів відсутні.</p>";
            }?>

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
            </div>
        </div>
    </div>

@stop
<?php
}
?>
