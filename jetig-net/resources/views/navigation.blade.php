@extends('guest.login')
<?php

namespace App\Http\Controllers;
use App\Models\BasketGuest;use App\Models\BasketUser;use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;use Illuminate\Support\Facades\Session;

$nav = new NavActive;
$action = $nav->navigation();
$user = Auth::user();
$sess = Session::all();


if (isset($_GET['Count']) && $_GET['Count'] > 0) {

    if (!isset($user)) {
        $in_user_basket = [];
        if (DB::table('basket_guest')
                ->where('ses_token', $sess['_token'])
                ->where('product_code', $_GET['ProdCode'])
                ->exists() == true) {

            DB::table('basket_guest')
                ->where('ses_token', $sess['_token'])
                ->where('product_code', $_GET['ProdCode'])
                ->update(['count' => $_GET['Count']]);

        } else {
            $in_guest_basket = [
                'user_id' => null,
                'user_email' => null,
                'mob_tel' => null,
                'ses_token' => $sess['_token'],
                'xsrf_token' => $_SERVER['REMOTE_ADDR'],
                'b_status' => 'addition',
                'product_code' => $_GET['ProdCode'],
                'id_group' => $_GET['IdCatGroup'],
                'count' => $_GET['Count'],
            ];
            BasketGuest::query()->insertOrIgnore($in_guest_basket);
        }

    } else {
        $in_guest_basket = [];
        if (DB::table('basket_user')
                ->where('ses_token', $sess['_token'])
                ->where('product_code', $_GET['ProdCode'])
                ->exists() == true) {

            DB::table('basket_user')
                ->where('ses_token', $sess['_token'])
                ->where('product_code', $_GET['ProdCode'])
                ->update(['count' => $_GET['Count']]);

        } else {
            $in_user_basket = [
                'user_id' => $user['id'],
                'user_email' => $user['email'],
                'mob_tel' => null,
                'ses_token' => $sess['_token'],
                'xsrf_token' => $_SERVER['REMOTE_ADDR'],
                'b_status' => 'addition',
                'product_code' => $_GET['ProdCode'],
                'id_group' => $_GET['IdCatGroup'],
                'count' => $_GET['Count'],
            ];
            BasketUser::query()->insertOrIgnore($in_user_basket);
        }

    }
}

if (!isset($user)) {
    $b_count = null;
    $basket = DB::table('basket_guest')
        ->where('ses_token', $sess['_token'])
        ->where('b_status', 'addition')
        ->get();
    foreach ($basket as $item => $value) {
        $b_count = $b_count + $value->count;
    }
}else {
    $b_count = null;
    $basket = DB::table('basket_user')
        ->where('user_id', $user['id'])
        ->where('b_status', 'addition')
        ->get();
    foreach ($basket as $item => $value) {
        $b_count = $b_count + $value->count;
    }
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
                    for ($i = 0; $i < count($CatParent); $i++){?>
                    <li>
                        <a href="/subcategories?IdParent=<?=$CatParent[$i]->id_group?>"><?=$CatParent[$i]->name_group?></a>
                    </li>
                    <?php
                    }}?>
                </ul>
            </li>
            <?php }else{?>
            <li><a href="{{route('categories')}}" class="link">Категорії</a>
                <ul>
                    <?php
                    if (count($CatParent) > 0){
                    for ($i = 0; $i < count($CatParent); $i++){?>
                    <li>
                        <a href="/subcategories?IdParent=<?=$CatParent[$i]->id_group?>"><?=$CatParent[$i]->name_group?></a>
                    </li>
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
            <li><a href="{{'basket'}}" class="active">Кошик (<?=$b_count?>)</a></li>
            <?php }else{?>
            <li><a href="{{'basket'}}">Кошик (<?=$b_count?>)</a></li><?php }?>

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
