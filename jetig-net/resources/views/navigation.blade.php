@extends('layouts.main')
<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class NavActive
{
    public function navigation()
    {
        return $_SERVER['REQUEST_URI'];
    }
}

$nav = new NavActive;
$action = $nav->navigation();
$user = Auth::user();
?>
@section('nav')
    <nav class="jet-nav">
        <ul class="jet-hmenu">
            <?php
            $CatParent = DB::table('categories')->where('id_group_parent', 0)->get();

            //var_dump($CatParent);exit;
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
            <li><a href="{{route('basket')}}" class="active">Кошик</a></li>
            <?php }else{?>
            <li><a href="{{route('basket')}}">Кошик</a></li><?php }?>

            <?php
                if (!isset($user)){
                if($action == '/login' || $action == '/register') {?>
            <li><a href="{{route('login')}}" class="active">Авторизація</a>
            <ul>
                <li><a href="{{route('login')}}">Вхід</a></li>
                <li><a href="{{route('register')}}">Реєстрація</a></li>
            </ul>
            </li>
            <?php }else{?>
            <li><a href="{{route('login')}}">Авторизація</a>
                <ul>
                    <li><a href="{{route('login')}}">Вхід</a></li>
                    <li><a href="{{route('register')}}">Реєстрація</a></li>
                </ul>
            </li><?php } }?>

        </ul>
    </nav>
@stop
