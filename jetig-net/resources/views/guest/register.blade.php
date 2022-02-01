<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head><!-- Created by IG-->
    <meta charset="utf-8">
    <title>JetIG - Товари для активного відпочинку</title>
    <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">

    <!--[if lt IE 9]>
    <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link rel="stylesheet" href="/css/style.css" media="screen">
    <!--[if lte IE 7]>
    <link rel="stylesheet" href="/css/style.ie7.css" media="screen"/><![endif]-->
    <link rel="stylesheet" href="/css/style.responsive.css" media="all">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu&amp;subset=latin">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="/js/jquery-3.6.min.js"></script>
    <script src="/js/jquery.js"></script>
    <script src="/js/script.js"></script>
    <script src="/js/script.responsive.js"></script>
    <meta name="description" content="Description">
    <meta name="keywords" content="Keywords">
    <style>.jet-content .jet-postcontent-0 .layout-item-0 {
            margin-bottom: 5px;
        }

        .jet-content .jet-postcontent-0 .layout-item-1 {
            border-spacing: 10px 0px;
            border-collapse: separate;
        }

        .jet-content .jet-postcontent-0 .layout-item-2 {
            border-top-style: solid;
            border-right-style: solid;
            border-bottom-style: solid;
            border-left-style: solid;
            border-top-width: 1px;
            border-right-width: 1px;
            border-bottom-width: 1px;
            border-left-width: 1px;
            border-color: #312D21;
            padding-right: 10px;
            padding-left: 10px;
        }

        .jet-content .jet-postcontent-0 .layout-item-3 {
            border-top-style: solid;
            border-right-style: solid;
            border-bottom-style: solid;
            border-left-style: solid;
            border-width: 1px;
            border-color: #312D21;
            padding-right: 10px;
            padding-left: 10px;
        }

        .jet-content .jet-postcontent-0 .layout-item-4 {
            border-top-style: solid;
            border-right-style: solid;
            border-bottom-style: solid;
            border-left-style: solid;
            border-top-width: 1px;
            border-right-width: 1px;
            border-bottom-width: 1px;
            border-left-width: 1px;
            border-top-color: #312D21;
            border-right-color: #312D21;
            border-bottom-color: #312D21;
            border-left-color: #312D21;
            padding-right: 10px;
            padding-left: 10px;
        }

        .ie7 .jet-post .jet-layout-cell {
            border: none !important;
            padding: 0 !important;
        }

        .ie6 .jet-post .jet-layout-cell {
            border: none !important;
            padding: 0 !important;
        }

    </style>
</head>
<body>
<div id="jet-main">
    <header class="jet-header">
        <div class="jet-shapes">
        </div>
        <h1 class="jet-headline">
            <a href="{{route('home')}}">JetIG.net</a>
        </h1>
        <h2 class="jet-slogan">Товари для активного відпочинку</h2>

        <nav class="jet-nav">
            <?php

            use Illuminate\Support\Facades\DB; class NavActive
            {
                public function navigation()
                {
                    return $_SERVER['REQUEST_URI'];
                }
            }

            $nav = new NavActive;
            $action = $nav->navigation();

            ?>
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
                <li><a href="{{route('basket')}}" class="active">Кошик</a></li>
                <?php }else{?>
                <li><a href="{{route('basket')}}">Кошик</a></li><?php }?>

                <?php if($action == '/login' || $action == '/register') {?>
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
                </li><?php }?>

            </ul>
        </nav>

    </header>
    <div class="jet-sheet clearfix">
        <div class="jet-layout-wrapper">
            <div class="jet-content-layout">
                <div class="jet-content-layout-row">
                    <div class="jet-layout-cell jet-content">
                        <article class="jet-post jet-article" style="padding-top: 70px; padding-bottom: 70px;">
                            <div class="jet-block clearfix"
                                 style="width: 40%; display: block; margin-right: auto; margin-left: auto;">
                                <div class="jet-blockheader">
                                    <h3 class="t">Реєстрація</h3>
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
                                        {{ Form::open(['url' => 'register', 'method' => 'post']) }}

                                        {{ Form::label('name', 'Name') }}
                                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) }}

                                        {{ Form::label('email', 'Email') }}
                                        {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}

                                        {{ Form::label('password', 'Password') }}
                                        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}

                                        {{ Form::label('repeatPassword', 'Repeat Password') }}
                                        {{ Form::password('repeatPassword', ['class' => 'form-control', 'placeholder' => 'Repeat Password']) }}

                                        <p>
                                            <br> {{ Form::submit('Реєстрація', ['class' => 'jet-button', 'style'=>'width: 100px; background: #AE8612;']) }}
                                            <span><a href="/login">Вхід</a></span></p>

                                        {{ Form::close() }}

                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
        <footer class="jet-footer">
            <div style="position:relative;text-align:center;"><a title="RSS" class="jet-rss-tag-icon"
                                                                 style="position: absolute; bottom: -10px; left: -6px; line-height: 32px;"
                                                                 href="#"></a>
                <p><a href="#">Новини</a>|<a href="#">Галерея</a>|<a href="{{route('contacts')}}">Контакти</a>|<a
                        href="http://www.iconfinder.com/search/?q=iconset:web2badges">Icon set</a> A. <a href="#">IG</a>
                </p>
                <p>Авторське право © 2021. Всі права захищені.</p></div>
        </footer>

    </div>
</div>
</body>
</html>
