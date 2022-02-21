<?php

use App\Models\User;use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
     style="width: 33%; display: block; position: fixed; z-index: 305;top: 10%; left: 33%;">

    <div class="jet-blockheader" style="color: #f1771a">
        <h3 class="t">Заміна пароля
            <a href="/categories" class="close" title="Закрити"
               style=" color: silver;float: right;font-size: 28px;font-weight: bold;cursor: pointer; text-decoration: inherit">&times;
            </a>
        </h3>
    </div>
    <hr>

    <div class="jet-blockcontent" style="overflow: auto; max-height: 400px;">
        <?php
        if (isset($_POST['password']) && isset($_POST['conf_password']) && $_POST['password'] === $_POST['conf_password']) {
            $password = Hash::make($_POST['password']);
            User::query()->where('id', $user['id'])->update(['password' => $password]);

            echo "<p> <spanstyle=\'color: #0a53be; font-size: 16px; font-style: italic;\'>
Пароль успішно змінено. При наступнй авторизації використовуйте новий пароль.</span>
</p></div></div>";
            exit();
        }
        ?>
        <form method="post" action="">
            @csrf
            <p>Новий пароль</p>
            <label>
                <p><input type="password" class="form-control" name="password" value=""></p>
            </label>
            <p>Повторіть пароль</p>
            <label>
                <p><input type="password" class="form-control" name="conf_password" value=""></p>
            </label>
            <br>
            <p style="padding-left: 10px;">
                <span><input type="submit" class="jet-button" style="background: #f1771a;"
                             value="Замінити пароль"></span>
                <span><a href="/categories" class="jet-button" style="background: #0b5ed7;">Вийти</a></span>
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
