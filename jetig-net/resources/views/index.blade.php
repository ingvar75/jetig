@extends('navigation')

@section('content')
    <div class="jet-layout-cell jet-content">
        <article class="jet-post jet-article">
            <div class="jet-postcontent jet-postcontent-0 clearfix">
                <div class="jet-content-layout">
                    <div class="jet-content-layout-row">
                        <div class="jet-layout-cell layout-item-1" style="width: 100%">
                            <h3 style="border-bottom: 1px solid #776D50; padding-bottom: 5px">Імпорт, експорт excel</h3>
                            <div class="container">
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <form action="{{ route('import') }}" method="post"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <p>
                                                <label for="excel" class="form-label"></label>
                                                <input type="file" name="excel" class="form-control">
                                            </p>
                                            <button class="jet-button">Import User Data</button>
                                            <a href="{{ route('export') }}" class="jet-button"
                                               style="background: #0a53be;">Export User Data</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
@stop

@section('content_login')

    <div class="jet-layout-cell jet-sidebar1">
        <div class="jet-block clearfix">
            <div class="jet-blockheader">
                <h3 class="t">Кабінет</h3>
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

                    <div class="jet-blockcontent">
                        <div>
                            <p>Імпорт товарів excel</p>
                            <ul>
                                <li>
                                    <a href="#" title="Імпорт товарів">Завантажити контент</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <br>
                    <p><a href="/logout" class="jet-button">Вийти</a></p>
@stop
