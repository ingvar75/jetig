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
    <script src="/js/script.js"></script>
    <script src="/js/script.responsive.js"></script>
    <meta name="description" content="Description">
    <meta name="keywords" content="Keywords">
    <style>.jet-content .jet-postcontent-0 .layout-item-0 {
            border-top-width: 1px;
            border-top-style: solid;
            border-top-color: #776D50;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .jet-content .jet-postcontent-0 .layout-item-1 {
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
            <a href="">JetIG.net</a>
        </h1>
        <h2 class="jet-slogan">Товари для активного відпочинку</h2>

        <nav class="jet-nav">
            <ul class="jet-hmenu">
                <li><a href="{{route('home')}}" class="active">Домівка</a></li>
                <!--<li><a href="new-page-2-2.html">Категорії товарів</a></li>-->
                <li><a href="{{route('contacts')}}">Контакти</a></li>
                <!--<li><a href="кошик.html">Кошик</a></li>-->
            </ul>
        </nav>

    </header>
    <div class="jet-sheet clearfix">
        <div class="jet-layout-wrapper">
            <div class="jet-content-layout">
                <div class="jet-content-layout-row">

                    @yield('content')

                    @yield('content_login')

                </div>
            </div>
        </div>
        <div class="jet-block clearfix">
            <div class="jet-blockheader">
                <h3 class="t">Пошук</h3>
            </div>
            <div class="jet-blockcontent">
                <div>
                    <form action="#" class="jet-search" method="get" name="searchform">
                        <input type="text" value="" name="s"/>
                        <input type="submit" value="Search" name="search" class="jet-search-button" style="color: #B8AE94;"/>
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
                    <p>Lorem ipsum dolor sit amet. Nam sit amet sem. Mauris a ante.</p>
                    <ul>
                        <li>
                            <a href="#" title="All News">All News</a> (50)
                        </li>
                        <li>
                            <a href="#" title="Best of the Year">Best of the Year</a> (4)
                        </li>
                        <li>
                            <a href="#" title="Hyperlink">Hyperlink</a> (24)
                        </li>
                        <li>
                            <a href="#" title="Visited link" class="visited">Visited link</a> (17)
                        </li>
                        <li>
                            <a href="#" title="Hovered link" class="hover">Hovered link</a> (6)
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="jet-block clearfix">
            <div class="jet-blockheader">
                <h3 class="t">TODAY's Best</h3>
            </div>
            <div class="jet-blockcontent"><p><img width="184" height="210" alt="" src="images/blockimage4.jpg" class="">
                </p>
                <p style="text-align: center;"><a href="#">Read more »</a></p></div>
        </div>
        <div class="jet-block clearfix">
            <div class="jet-blockheader">
                <h3 class="t">Hottest Trends</h3>
            </div>
            <div class="jet-blockcontent"><p style="text-align:center;"><img width="181" height="181" alt=""
                                                                             src="images/blockimage1.jpg" class=""></p>
                <p style="text-align: center;"><a href="#">Read more »</a></p></div>
        </div>
        <div class="jet-block clearfix">
            <div class="jet-blockheader">
                <h3 class="t">Поділитись</h3>
            </div>
            <div class="jet-blockcontent"><p><img width="51" height="51" alt="" src="images/1308560868_rss.png"
                                                  class=""><img width="51" height="51" alt=""
                                                                src="images/1308647898_facebook-2.png" class=""><img
                        width="51" height="51" alt="" src="images/1308560877_flickr-2.png" class=""></p></div>
        </div>
    </div>
</div>
</div>
</div>
<footer class="jet-footer">
    <div style="position:relative;text-align:center;"><a title="RSS" class="jet-rss-tag-icon"
                                                         style="position: absolute; bottom: -10px; left: -6px; line-height: 32px;"
                                                         href="#"></a>
        <p><a href="#">Новини</a>|<a href="#">Галерея</a>|<a href="#">Контакти</a>|<a
                href="http://www.iconfinder.com/search/?q=iconset:web2badges">Icon set</a> A. <a href="#">IG</a></p>
        <p>Авторське право © 2021. Всі права захищені.</p></div>
</footer>

</div>
</div>
</body>
</html>
