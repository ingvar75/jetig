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

        @yield('nav')

    </header>

    @yield('login')

    <div class="jet-sheet clearfix">
        <div class="jet-layout-wrapper">
            <div class="jet-content-layout">
                <div class="jet-content-layout-row">
                    @yield('content')

                    <div class="jet-layout-cell jet-sidebar1">
                        @yield('content_login')

                        <div class="jet-block clearfix">
                            <div class="jet-blockheader">
                                <h3 class="t">Пошук</h3>
                            </div>
                            <div class="jet-blockcontent">
                                <div>
                                    <form action="/search" class="jet-search" method="get" name="searchform">
                                        <input type="text" value="" name="s" maxlength="25"/>
                                        <input type="submit" class="jet-search-button"
                                               style="color: #B8AE94;"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="jet-block clearfix">
                            <div class="jet-blockheader">
                                <h3 class="t">Категорії</h3>
                            </div>
                            <div class="jet-blockcontent">
                                <div>
                                    <?php
                                    use Illuminate\Support\Facades\DB;
                                    $CatParent = DB::table('categories')->where('id_group_parent', 0)->get();
                                    $k = [];
                                    foreach ($CatParent as $key => $value) {
                                        echo "<ul>";
                                        echo "<li><a href='/subcategories?IdParent=$value->id_group' title='Перейти на сторінку'>$value->name_group</a>";
                                        $CatIdParents = DB::table('categories')->where('id_group_parent', $value->id_group)->get();
                                        echo "<ul>";
                                        $arr = [];
                                        foreach ($CatIdParents as $obj) {
                                            $randPodCat = DB::table('categories')->where('id_group_parent', $obj->id_group)->inRandomOrder()->first();
                                            $randProdImage = DB::table('products')->where('id_group', $randPodCat->id_group)->inRandomOrder()->first();
                                            $image_array = explode(',', $randProdImage->image_link);
                                            $rmdImg = array_rand($image_array, 1);//index array

                                            $var = [
                                                'NameCat' => $randPodCat->name_group,
                                                'IdCatGroup' => $randProdImage->id_group,
                                                'ProdCode' => $randProdImage->product_code,
                                                'image_link' => $image_array[$rmdImg],
                                            ];
                                            $arr[] = $var;
                                            echo "<li><a href='/subcategories?IdCat=$obj->id_group' target='_self' title='Перейти у розділ'>$obj->name_group</a>";
                                        }
                                        echo "</ul></li>";
                                        echo "</ul>";
                                        $r = array_rand($arr, 1);
                                        $k[] = $arr[$r];
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="jet-block clearfix">


                            <?php
                            foreach ($k as $item) {
                            $pieces = explode(" ", $item['NameCat']);
                            ?>

                            <div class="jet-blockheader">
                                <h3 class="t" style="font-size: 13px; cursor: progress;" title="<?=$item['NameCat']?>"><?=$pieces[0]."..."?>
                            </div>

                                <div class="jet-blockcontent">

                                <p>
                                    <a href="/subcategories?IdCatGroup=<?=$item['IdCatGroup']?>&ProdCode=<?=$item['ProdCode']?>">
                                    <img width="184" height="210" alt=""
                                                                  src="<?=$item['image_link']?>" class="">
                                    </a>
                                </p>
                                <p style="text-align: center;">
                                    <a href="/subcategories?IdCatGroup=<?=$item['IdCatGroup']?>&ProdCode=<?=$item['ProdCode']?>" style="font-size: 10px;">
                                        Детальніше »
                                    </a>
                                </p>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
{{--                        <div class="jet-block clearfix">--}}
{{--                            <div class="jet-blockheader">--}}
{{--                                <h3 class="t">Hottest Trends</h3>--}}
{{--                            </div>--}}
{{--                            <div class="jet-blockcontent"><p style="text-align:center;"><img width="181" height="181"--}}
{{--                                                                                             alt=""--}}
{{--                                                                                             src="/css/images/blockimage1.jpg"--}}
{{--                                                                                             class=""></p>--}}
{{--                                <p style="text-align: center;"><a href="#">Read more »</a></p></div>--}}
{{--                        </div>--}}
                        {{--                        <div class="jet-block clearfix">--}}
                        {{--                            <div class="jet-blockheader">--}}
                        {{--                                <h3 class="t">Поділитись</h3>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="jet-blockcontent"><p><img width="51" height="51" alt=""--}}
                        {{--                                                                  src="/css/images/1308560868_rss.png"--}}
                        {{--                                                                  class=""><img width="51" height="51" alt=""--}}
                        {{--                                                                                src="/css/images/1308647898_facebook-2.png"--}}
                        {{--                                                                                class=""><img--}}
                        {{--                                        width="51" height="51" alt="" src="/css/images/1308560877_flickr-2.png" class=""></p>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
        <footer class="jet-footer">
            <div style="position:relative;text-align:center;">
                {{--                <a title="RSS" class="jet-rss-tag-icon"--}}
                {{--                   style="position: absolute; bottom: -10px; left: -6px; line-height: 32px;"--}}
                {{--                   href="#"></a>--}}
                <p><a href="{{route('contacts')}}">A.IG</a> |
                    <a href="http://www.iconfinder.com/search/?q=iconset:web2badges">Icon set</a>
                </p>
                <p>Авторське право © 2021. Всі права захищені.</p></div>
        </footer>

    </div>
</div>
</body>
</html>
