@extends('guest.login')
<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;use Illuminate\Support\Facades\Session;

$nav = new NavActive;
$action = $nav->navigation();
$user = Auth::user();

if (isset($_GET['Count']) && $_GET['Count'] > 0) {
//    Session::start();
//    Session::push('ProdCode', $_GET['ProdCode']);
//    Session::push('Count', $_GET['Count']);
//    Session::save();
//    Session::flush();
    $value = Session::all();
    var_dump($user, $_GET, $_SERVER, $value, $_COOKIE);
    exit();
}
?>

@section('nav')

    <nav class="jet-nav">
        <ul class="jet-hmenu">
            <?php
            $CatParent = DB::table('categories')->where('id_group_parent', 0)->get();
            if($action == '/' || $action == '/excel/view' || $action == '/home'){?>
            <li><a href="{{route('home')}}" class="active">Домівка</a></li>
            <?php }else{?>
            <li><a href="{{route('home')}}">Домівка</a></li><?php }?>
            <?php
                if($action == '/categories' || isset($_GET['IdParent']) || isset($_GET['IdCat'])){?>
            <li><a href="{{route('categories')}}" class="active">Категорії</a>
                <ul class="active">
                    <?php
                    if (count($CatParent) > 0){
                    for ($i=0; $i<count($CatParent); $i++){?>
                    <li><a href="/subcategories?IdParent=<?=$CatParent[$i]->id_group?>"><?=$CatParent[$i]->name_group?></a></li>
                    <?php
                    }}?>
                </ul>
            </li>
            <?php }else{?>
            <li><a href="{{route('categories')}}" class="link">Категорії</a>
                <ul>
                    <?php
                    if (count($CatParent) > 0){
                    for ($i=0; $i<count($CatParent); $i++){?>
                    <li><a href="/subcategories?IdParent=<?=$CatParent[$i]->id_group?>"><?=$CatParent[$i]->name_group?></a></li>
                    <?php
                    }}?>
                </ul>
            </li><?php
                }?>
            <?php if($action == '/contacts') {?>
            <li><a href="{{route('contacts')}}" class="active">Контакти</a></li>
            <?php }else{?>
            <li><a href="{{route('contacts')}}">Контакти</a></li><?php }?>

            <?php if($action == '/basket') {?>
            <li><a href="{{'basket'}}" class="active">Кошик</a></li>
            <?php }else{?>
            <li><a href="{{'basket'}}">Кошик</a></li><?php }?>

            <?php
                if (!isset($user)){
                if($action == '/login' || $action == '/register') {?>
            <li><a id="myBtnEnter" class="active">Вхід</a>
            <ul>
                <li><a id="myBtnReg">Реєстрація</a></li>
            </ul>
            </li>
            <?php }else{?>
            <li><a id="myBtnEnter">Вхід</a>
                <ul>
                    <li><a id="myBtnReg">Реєстрація</a></li>
                </ul>
            </li><?php } }?>

        </ul>
    </nav>

@stop
{{--@include('basket')--}}
