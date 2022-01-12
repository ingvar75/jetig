@extends('navigation')

@section('content')
    <div class="jet-layout-cell jet-content">
        <article class="jet-post jet-article">
            <?php
            use Illuminate\Support\Facades\DB;
            $CatParent = DB::table('categories')->where('id_group_parent', 0)->first();
            //суперкатегорія
            ?>
            <h2 class="jet-postheader"><span class="jet-postheadericon"><?=$CatParent->name_group?></span></h2>
            <div class="jet-postcontent jet-postcontent-0 clearfix">
                <?php ////////////////////визначимо та виведемо кількість головних категорій//////////////////////////
                $CatIdParents = DB::table('categories')->where('id_group_parent', $CatParent->id_group)->get();
                //пакунок головних категорій
                $CatIdParents = $CatIdParents->toArray();
                if (count($CatIdParents) > 0){
                    $row = count($CatIdParents)/5;
                    if ($row <= 1) $row = 1;
                    if ($row <= 2) $row = 2;
                    if ($row <= 3) $row = 3;

                for ($k=1; $k < $row; $k++){
                ?>
                <div class="jet-content-layout-wrapper layout-item-0">
                    <div class="jet-content-layout layout-item-1">
                        <div class="jet-content-layout-row">
                            <?php
                            $rew = array_slice($CatIdParents, ($k-1)*5, 5);

                            for ($i = 0; $i < count($rew); $i++) {
                            ?>
                            <div class="jet-layout-cell layout-item-4" style="width: 20%">
                                <p style="text-align: center;"><img width="99" height="99" alt="" class="jet-lightbox"
                                                                    src="<?=$CatIdParents[$i+($k-1)*5]->images_pars?>"><br></p>
                                <p style="text-align: center;"><a href="#" target="_self" title="Перейти у розділ">
                                               <?=$CatIdParents[$i+($k-1)*5]->name_group?></a></p>
                            </div>
                            <?php
                            }
                            $kol = 5 - count($rew);
                            if ($kol > 0) {   // пустая ячейка если нет категории
                                for ($n=1; $n<=$kol; $n++){
                                ?>
                                <div style="width: 20%">
                                    <p style="text-align: center;"></p>
                                    <p style="text-align: center;"><a href="#" target="_self" title="Перейти у розділ"></a></p>
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
                ////////////////////////////////////////////////////////////////////////////////
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
                <div class="jet-content-layout-wrapper layout-item-0">
                    <div class="jet-content-layout layout-item-1">
                        <div class="jet-content-layout-row">
                            <div class="jet-layout-cell layout-item-4" style="width: 33%">
                                <p style="text-align: center;"><img width="250" height="169" alt="" class="jet-lightbox"
                                                                    src="images/shutterstock_26254903.jpg"><br></p>
                                <p style="text-align: justify;"><span style="font-size: 14px; color: #D4CEBF;">Баскетбольное кольцо MR 0555, кольцо 39 см</span><br>
                                </p>Код продукта: 4241864<br>Артикул: YO-MR 0555<br><br><span
                                    style="font-size: 11px; color: #69BDBF;">В наличии</span><br><span
                                    style="color: #EB9705;">582.00 грн.<br><br><a href=""
                                                                                  class="jet-button">Детальніше</a>&nbsp;</span><br>
                            </div>
                            <div class="jet-layout-cell layout-item-4" style="width: 34%">
                                <p style="text-align: center;"><img width="250" height="169"
                                                                    style="margin-top: 5px; margin-right: 5px; margin-bottom: 5px; margin-left: 5px; border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(119, 109, 80); border-right-color: rgb(119, 109, 80); border-bottom-color: rgb(119, 109, 80); border-left-color: rgb(119, 109, 80); border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; "
                                                                    alt="" class="jet-lightbox"
                                                                    src="images/5ccba998-c458-4a62-8baa-c8bccf3f0868.png">
                                </p>
                                <p style="text-align: justify;"><span
                                        style="font-size: 14px; color: rgb(212, 206, 191);">Баскетбольное кольцо MR 0555, кольцо 39 см</span><br>
                                </p>Код продукта: 4241864<br>Артикул: YO-MR 0555<br><br><span
                                    style="font-size: 11px; color: rgb(105, 189, 191);">В наличии</span><br><span
                                    style="color: rgb(235, 151, 5);">582.00 грн.<br><br><a href="" class="jet-button">Детальніше</a>&nbsp;</span>
                            </div>
                            <div class="jet-layout-cell layout-item-4" style="width: 33%">
                                <p><br></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="jet-content-layout-wrapper layout-item-0">
                    <div class="jet-content-layout layout-item-1">
                        <div class="jet-content-layout-row">
                            <div class="jet-layout-cell layout-item-4" style="width: 33%">
                                <p><br></p>
                            </div>
                            <div class="jet-layout-cell layout-item-4" style="width: 34%">
                                <p><br></p>
                            </div>
                            <div class="jet-layout-cell layout-item-4" style="width: 33%">
                                <p><br></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="jet-content-layout-wrapper layout-item-0">
                    <div class="jet-content-layout layout-item-1">
                        <div class="jet-content-layout-row">
                            <div class="jet-layout-cell layout-item-4" style="width: 33%">
                                <p><br></p>
                            </div>
                            <div class="jet-layout-cell layout-item-4" style="width: 34%">
                                <p><br></p>
                            </div>
                            <div class="jet-layout-cell layout-item-4" style="width: 33%">
                                <p><br></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="jet-content-layout-wrapper layout-item-0">
                    <div class="jet-content-layout layout-item-1">
                        <div class="jet-content-layout-row">
                            <div class="jet-layout-cell layout-item-4" style="width: 33%">
                                <p><br></p>
                            </div>
                            <div class="jet-layout-cell layout-item-4" style="width: 34%">
                                <p><br></p>
                            </div>
                            <div class="jet-layout-cell layout-item-4" style="width: 33%">
                                <p><br></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>
                <p>Нажаль в даному розділі категорії товарів відсутні.</p>
        </article>
    </div>
@stop
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
