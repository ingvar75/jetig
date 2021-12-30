@extends('layouts.main')
<?php

?>
@section('nav')
<nav class="jet-nav">
    <ul class="jet-hmenu">
        <li><a href="{{route('home')}}" class="active">Домівка</a></li>
        <!--<li><a href="new-page-2-2.html">Категорії товарів</a></li>-->
        <li><a href="{{route('contacts')}}">Контакти</a></li>
        <!--<li><a href="кошик.html">Кошик</a></li>-->
    </ul>
</nav>
@stop
