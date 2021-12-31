@extends('layouts.main')
<?php

namespace App\Http\Controllers;
class NavActive
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
            <?php if($action == '/' || $action == '/excel/view'|| $action == '/login'|| $action == '/register'){?>
            <li><a href="{{route('home')}}" class="active">Домівка</a></li>
            <?php }else{?>
            <li><a href="{{route('home')}}">Домівка</a></li><?php }?>

            <?php if($action == '/contacts') {?>
            <li><a href="{{route('contacts')}}" class="active">Контакти</a></li>
            <?php }else{?>
            <li><a href="{{route('contacts')}}">Контакти</a></li><?php }?>

        </ul>
    </nav>
@stop
