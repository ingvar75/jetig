<?php

use Illuminate\Support\Facades\DB;

if (isset($_GET['choose']) && $_GET['choose'] == 'category') {
    $dataCat = DB::table('categories')->select('id', 'name_group')->get();
    foreach ($dataCat as $item) {
        echo strip_tags(($item->id))."<br>";
        echo strip_tags(($item->name_group))."<br>";
    }
    exit;
}
if (isset($_GET['choose']) && $_GET['choose'] == 'products') {
    $dataProd = DB::table('products')->select('id', 'item_name', 'description')->get();
    foreach ($dataProd as $item) {
        echo strip_tags(($item->id))."<br>";
        echo strip_tags(($item->item_name))."<br>";
        echo strip_tags(($item->description))."<br>";
    }
exit;
}
?>

<form method="get" action="{{ route('translator') }}">
    <label>
        <input type="radio" name="choose" value="category">
    </label>Готуємо категорії до перекладу<br>
    <label>
        <input type="radio" name="choose" value="products">
    </label>Готуємо твари до перекладу<br>
    <label>
        <input type="radio" name="choose" value="insert">
    </label>Закачать перевод из файла в БД<br>
    <label>
        <input type="radio" name="choose" value="category">
    </label>закачать категории<br>
    <label>
        <input type="radio" name="choose" value="outofstock">
    </label>закачать "нет в наличии"<br>
    <label>
        <input type="radio" name="choose" value="del_prod">
    </label>Удалить все продукты из базы данных<br>
    <br>
    <input type="submit">
</form>
