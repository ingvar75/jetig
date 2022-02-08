<?php

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

<div id="over" class="overlay"></div>
<div id="bModal" class="jet-postcontent jet-postcontent-0 clearfix"
     style="width: 33%; display: block; position: fixed; z-index: 305;top: 25%; left: 33%;">
    <div class="jet-content-layout">
        <div class="jet-content-layout-row">
            <div class="jet-layout-cell layout-item-1" style="width: 100%">
                <h3 style="border-bottom: 1px solid #776D50; padding-bottom: 5px">Кошик</h3>
                <p><span style="font-weight: bold; color: #0a53be;">Пн-Пт 10:00-18:00:</span></p>
                <p>+380679185706</p>
                <p>+380733059806</p>
                <p><span style="font-weight: bold; color: #0a53be">Email:</span></p>
                <p>mail@jetig.net</p>
                <p><a href="#" class="jet-button">Відправити повідомлення</a></p>
            </div>
        </div>
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

