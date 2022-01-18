@extends('layouts.main')
<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;class NavActive
{
    public function navigation()
    {
        return $_SERVER['REQUEST_URI'];
    }
}

$nav = new NavActive;
$action = $nav->navigation();

?>
@section('nav')
    <nav class="jet-nav">
        <ul class="jet-hmenu">
            <?php
            $CatParent = DB::table('categories')->where('id_group_parent', 0)->get();

            //var_dump($CatParent);exit;
            if($action == '/' || $action == '/excel/view' || $action == '/login' || $action == '/register'){?>
            <li><a href="{{route('home')}}" class="active">Домівка</a></li>
            <?php }else{?>
            <li><a href="{{route('home')}}">Домівка</a></li><?php }?>

            <?php
                if($action == 'categories'){?>
            <li><a href="{{route('home')}}" class="active">Категорії</a>
                <ul class="active">
                    <?php
                    if (count($CatParent) > 0){
                    for ($i=0; $i<count($CatParent); $i++){?>
                    <li><a href="авторизація/вхід.html"><?=$CatParent[$i]->name_group?></a></li>
                    <?php
                    }}?>
                </ul>
            </li>
            <?php }else{?>
            <li><a href="{{route('home')}}" class="link">Категорії</a>
                <ul>
                    <?php
                    if (count($CatParent) > 0){
                    for ($i=0; $i<count($CatParent); $i++){?>
                    <li><a href="авторизація/вхід.html"><?=$CatParent[$i]->name_group?></a></li>
                    <?php
                    }}?>
                </ul>
            </li><?php
                }?>

            <?php if($action == '/contacts') {?>
            <li><a href="{{route('contacts')}}" class="active">Контакти</a></li>
            <?php }else{?>
            <li><a href="{{route('contacts')}}">Контакти</a></li><?php }?>

            <?php if($action == '/contacts') {?>
            <li><a href="{{route('contacts')}}" class="active">Кошик</a></li>
            <?php }else{?>
            <li><a href="{{route('contacts')}}">Кошик</a></li><?php }?>

        </ul>
    </nav>
@stop
