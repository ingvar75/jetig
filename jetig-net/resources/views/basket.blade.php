<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

$user = Auth::user();
$sess = Session::all();

?>
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
        display: block; /* в обычном состоянии скрыта */
    }
</style>
<link rel="stylesheet" href="/css/style.css" media="screen">
<script src="/js/jquery-3.6.min.js"></script>
<script src="/js/jquery.js"></script>
<script src="/js/maskinput.js"></script>
<div id="over" class="overlay"></div>
<div id="bModal" class="jet-block clearfix"
     style="width: 50%; display: block; position: fixed; z-index: 305;top: 10%; left: 25%;">

    <div class="jet-blockheader">
        <h3 class="t">Ваш кошик
            <a href="/categories" class="close" title="Закрити"
               style=" color: silver;float: right;font-size: 28px;font-weight: bold;cursor: pointer; text-decoration: inherit">&times;
            </a>
        </h3>
    </div>
    <hr>

    <div class="jet-blockcontent" style="overflow: auto; max-height: 400px;">
        <?php
        if (!isset($user)) {
        //////////////////////////////////////////Якщо неавторизований//////////////////////////////////////////////
        if (isset($_GET['DelProd'])) {
            DB::table('basket_guest')
                ->where('ses_token', $sess['_token'])
                ->where('product_code', $_GET['ProdCode'])
                ->delete();
        }
        if (DB::table('basket_guest')
            ->where('ses_token', $sess['_token'])
            ->where('b_status', 'addition')
            ->doesntExist() == false) {
        $basket = DB::table('basket_guest')->where('ses_token', $sess['_token'])->get();
        $total = 0;
        foreach ($basket as $point => $key){
        $goods = DB::table('products')
            ->where('product_code', $key->product_code)
            ->where('id_group', $key->id_group)
            ->get();
        $image_link = explode(',', $goods[0]->image_link);
        ?>
        <form method="get" action="">
            <p>
            <span>
            <a href="/subcategories?Count=<?=$key->count?>&IdCatGroup=<?=$goods[0]->id_group?>&ProdCode=<?=$goods[0]->product_code?>">
                <img width="70" height="70" class="jet-lightbox" src="<?=$image_link[0]?>">
            </a>
            </span>
                <span style="float: right;">
                    <input type="hidden" name="DelProd" value="del">
                    <input type="hidden" name="ProdCode" value="<?=$goods[0]->product_code?>">
                    <input type="submit" style="background: #ef3344; cursor: pointer;" value="Вилучити">
                </span>
            </p>
        </form>

        <p>
            <span style="text-decoration: underline; font-weight: bold; color: #6b9be2;">Артикул:</span>
            <span><?=$goods[0]->product_code?></span></p>
        <p style="padding-top: 5px;">
            <span style="padding-top: 5px;">Ціна: </span>
            <span><?=$goods[0]->price?></span>
            <span><?=$goods[0]->currency?></span>
        </p>

        <p>
            <span>Кількість: </span>
            <span><?=$key->count?></span>

        </p>
        <p>
                <span style="font-weight: bold; color: #eeb95d;">
                    <a href="/subcategories?Count=<?=$key->count?>&IdCatGroup=<?=$goods[0]->id_group?>&ProdCode=<?=$goods[0]->product_code?>"
                       style="text-decoration: initial;" title="Перейти до товару"><?=$goods[0]->item_name?>
                    </a>
                </span>
        </p>
        <hr style="border-color: #5C543D;">
        <br>

        <?php
        $total = $total + $key->count * $goods[0]->price;
        }

        }else {
        ?>
        <p style="padding-bottom: 10px;">
            <span style="color: #bb2d3b; font-size: medium;">Ваш кошик порожній</span>
            <a href="/categories" class="jet-button"
               style="background: #dead1b;
                      color: #184943;
                      float: right;
                      margin-bottom: 5px;">Перейти до покупок
            </a>
        </p>
        <?php
        exit;
        }
        }else{
        ///////////////////////////////////////Якщо користувач авторизований///////////////////////////////////////////////////
        if (isset($_GET['DelProd'])) {
            DB::table('basket_user')
                ->where('user_id', $user['id'])
                ->where('ses_token', $sess['_token'])
                ->where('product_code', $_GET['ProdCode'])
                ->where('b_status', 'addition')
                ->delete();
        }
        if (DB::table('basket_user')
            ->where('user_id', $user['id'])
            ->where('ses_token', $sess['_token'])
            ->where('b_status', 'addition')
            ->doesntExist() == false) {
        $basket = DB::table('basket_user')
            ->where('user_id', $user['id'])
            ->where('ses_token', $sess['_token'])
            ->where('b_status', 'addition')
            ->get();
        $total = 0;
        foreach ($basket as $point => $key){
        $goods = DB::table('products')
            ->where('product_code', $key->product_code)
            ->where('id_group', $key->id_group)
            ->get();
        $image_link = explode(',', $goods[0]->image_link);
        ?>

        <form method="get" action="">
            <p>
            <span>
            <a href="/subcategories?Count=<?=$key->count?>&IdCatGroup=<?=$goods[0]->id_group?>&ProdCode=<?=$goods[0]->product_code?>"
               title="Перейти до товару">
                <img width="70" height="70" class="jet-lightbox" src="<?=$image_link[0]?>">
            </a>
            </span>
                <span style="float: right;">
                    <input type="hidden" name="DelProd" value="del">
                    <input type="hidden" name="ProdCode" value="<?=$goods[0]->product_code?>">
                    <input type="submit" class="jet-button" style="cursor: pointer; background: #931c27" value="Вилучити">
                </span>
            </p>
        </form>

        <p>
            <span style="text-decoration: underline; font-weight: bold; color: #6b9be2;">Артикул:</span>
            <span><?=$goods[0]->product_code?></span></p>
        <p style="padding-top: 5px;">
            <span style="padding-top: 5px;">Ціна: </span>
            <span><?=$goods[0]->price?></span>
            <span><?=$goods[0]->currency?></span>
        </p>

        <p>
            <span>Кількість: </span>
            <span><?=$key->count?></span>

        </p>
        <p>
                <span style="font-weight: bold; color: #eeb95d;">
                    <a href="/subcategories?Count=<?=$key->count?>&IdCatGroup=<?=$goods[0]->id_group?>&ProdCode=<?=$goods[0]->product_code?>"
                       style="text-decoration: initial;" title="Перейти до товару"><?=$goods[0]->item_name?>
                    </a>
                </span>
        </p>
        <hr style="border-color: #5C543D;">
        <br>

        <?php
        $total = $total + $key->count * $goods[0]->price;
        }

        }else {
        ?>
        <p style="padding-bottom: 10px;">
            <span style="color: #bb2d3b; font-size: medium;">Ваш кошик порожній</span>
            <a href="/categories" class="jet-button"
               style="background: #dead1b;
                      color: #184943;
                      float: right;
                      margin-bottom: 5px;">Перейти до покупок
            </a>
        </p>
        <?php
        exit;
        }

        }
        ?>
        <hr>
        <?php
        if (isset($_GET['zakaz'])) {
        if (!isset($user)) {
            DB::table('basket_guest')
                ->where('ses_token', $sess['_token'])
                ->update(['mob_tel' => $_GET['usertel'],
                    'b_status' => 'ordered',
                    'updated_at' => date("Y-m-d H:i:s")]);
        } else {
            DB::table('basket_user')
                ->where('user_id', $user['id'])
                ->where('user_email', $user['email'])
                ->where('ses_token', $sess['_token'])
                ->update(['mob_tel' => $_GET['usertel'],
                    'b_status' => 'ordered',
                    'updated_at' => date("Y-m-d H:i:s")]);
        }
        ?>
        <p><span
                style="color: #D1AF29;font-size: large; font-style: italic;">Замовлення успішно відправлено!</span>
        </p>
        <p><span>Чекайте, найближчим часом наш оператор зв'яжеться з вами.</span></p>
        <p>
            <span>Зв'язок буде встановлено за телефоном: </span>
            <span style="color: #74b2e2;"><?=$_GET['usertel']?></span>
        </p>

        <br>
        <p>
            <span>
            <a href="/subcategories?Count=<?=$key->count?>&IdCatGroup=<?=$goods[0]->id_group?>&ProdCode=<?=$goods[0]->product_code?>"
               class="jet-button" style="background: #0480c3;">
                Продовжити покупки
            </a>
            </span>
        </p>
        <?php
        echo "</div></div>";exit;
        }
        ?>
        <p>
        <form name="zakaz" method="get" action="#" onsubmit="return Zakaz();">
            <p>
                <span>Ваш телефон:</span>
                <span title="Поле обов'язкове для оформлення замовлення."
                      style="color:#dc2121; font-size: 16px; cursor: progress;">
                    *
                </span>
            </p>
            <p><label for="tel"></label>
                <input style="width: 20%; padding: 2px;" type="text" name="usertel" id="tel"
                       placeholder="+38(___) ___-____" value="">
            </p>
            <br>
            <script>
                function Zakaz() {
                    if (document.zakaz.usertel.value == "") {
                        alert('Вкажіть правильно номер мобільного телефону.');
                        document.zakaz.usertel.focus();
                        return false;
                    } else
                        document.zakaz.submit();
                    return true;
                }

                jQuery(function ($) {
                    $("#tel").mask("+38(999) 999-9999");
                    $("#date").mask("99/99/2020");
                });
            </script>
            </p>
            <p>
            <span>
            <input type="hidden" name="zakaz" value="ok">
            <input type="submit" class="jet-button" name="obrobka" style="background: #C37D04;"
                   value="Оформити замовлення">
            </span>
                <span>
            <a href="/subcategories?Count=<?=$key->count?>&IdCatGroup=<?=$goods[0]->id_group?>&ProdCode=<?=$goods[0]->product_code?>"
               class="jet-button" style="background: #0480c3;">
                Продовжити покупки
            </a>
            </span>
                <span style="float: right;">
                Сума:  <?=$total?> <?=$goods[0]->currency?>
            </span>
            </p>
        </form>

    </div>
</div>


<script>
    // Get the modal
    var bModal = document.getElementById("bModal");

    // Get the button that opens the modal
    var basketBtn = document.getElementById("basketBtn");

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
    basketBtn.onclick = function () {
        bModal.style.display = "block";
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

