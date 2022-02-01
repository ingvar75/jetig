<?php
use Illuminate\Support\Facades\DB;
$CatParent = DB::table('categories')->where('id_group_parent', 0)->first();
//суперкатегорія
$CatIdParents = DB::table('categories')->where('id_group_parent', $CatParent->id_group)->get();
//пакунок головних категорій

$CatIdParents = $CatIdParents->toArray();
for ($i = 0; $i < count($CatIdParents); $i++) {
    //var_dump($CatIdParents);exit;
    ?>
    <h3
        style="border-bottom: 1px solid #776D50; padding-bottom: 5px"><?=$CatIdParents[$i]->name_group?></h3>
    <!--назва головної категорії-->
    <?php

    foreach ($CatIdParents[$i] as $itemCat => $idCat) {

        if ($itemCat == "id_group") {

            //echo $itemCat . "=>" . $idCat . "<br>";

            $podCat = DB::table('categories')->where('id_group_parent', $idCat)->get();
            //пакунок підкатегорій які належать головній категорії
            //var_dump($podCat);exit;

            for ($j = 0; $j < count($podCat); $j++) {

                foreach ($podCat[$j] as $key => $value) {

                    if ($key == 'id_group') {

                        //echo $key . "=>" . $value . "<br>";

                        $allProductsOfCat = DB::table('products')->where('id_group', $value)->get();
                        //пакунок товарів які належать підкатегорії
                        //var_dump($allProductsOfCat);exit;
                        if (count($allProductsOfCat)>0) {
                            ?> <h4
                                style="border-bottom: 1px solid #776D50; padding-bottom: 5px"><?=$podCat[$j]->name_group?></h4>
                            <!--назва підкатегорії-->
                            <?php
                        }
                        for ($k = 0; $k < count($allProductsOfCat); $k++) {
                            //////////////////////////////////////////////////////////////////////////////////////
                            $images_array = explode(',', $allProductsOfCat[$k]->image_link);
                            $descriptions = strip_tags($allProductsOfCat[$k]->description);
                            for ($n = 0; $n < count($images_array); $n++) {
                                ?>
                                <div class="image-caption-wrapper" style="width: 10%; float: left">
                                    <img
                                        src="<?=$images_array[$n]?>" style="width: 100%; max-width: 100px; " alt="an image"
                                        class="jet-lightbox">
                                </div>
                                <?php
                            }
                            ?>
                            <div>
                                <p><span style="font-weight: bold;"><?=$allProductsOfCat[$k]->item_name?></span><br>
                                    <span><?=$allProductsOfCat[$k]->product_code?></span>
                                </p>
                            </div>

                            <div>
                                <p><span><?=$descriptions?></span><br>
                                    <span><?=$allProductsOfCat[$k]->product_code?></span>
                                </p>
                            </div>
                            <?php
                            echo $allProductsOfCat[$k]->price . "<br>";
                            echo $allProductsOfCat[$k]->currency . "<br>";
                            echo $allProductsOfCat[$k]->availability . "<br>";
                            echo $allProductsOfCat[$k]->manufacturer_tramp . "<br>";
                            echo $allProductsOfCat[$k]->updated_at . "<br>";
                            echo "<hr>";
                        }

                        //var_dump($allProductsOfCat);
                        //exit;


                    }

                    $images_group = DB::table('products')->where('id_group', $idCat)->get('image_link');
                    $images_group = $images_group->toArray();


                }
            }
        }
    }
}
//exit();
?>
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
    </div>
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

        <p><br> {{ Form::submit('Реєстрація', ['class' => 'jet-button']) }}</p>

        {{ Form::close() }}

        <p><a href="/login">Вхід</a></p>
    </div>
</div>
