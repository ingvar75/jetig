<?php

use Illuminate\Support\Facades\DB;

if (isset($_GET['choose']) && $_GET['choose'] == 'category') {
    $fh = fopen("jetCat.txt", 'w') or die("Failed to create file");
    $dataCat = DB::table('categories')->select('id', 'name_group')->get();
    foreach ($dataCat as $item) {
        echo strip_tags(($item->id))."<br>";
        echo strip_tags(($item->name_group))."<br>";
        fwrite($fh, strip_tags(($item->id))."\r\n") or die("Could not write to file");
        fwrite($fh, strip_tags(($item->name_group))."\r\n") or die("Could not write to file");
    }
    fclose($fh);
    exit;
}
if (isset($_GET['choose']) && $_GET['choose'] == 'products') {
    $fh = fopen("jetProd.txt", 'w') or die("Failed to create file");
    $dataProd = DB::table('products')->select('id', 'item_name', 'description')->get();
    foreach ($dataProd as $item) {
        echo strip_tags(($item->id))."<br>";
        echo strip_tags(($item->item_name))."<br>";
        echo strip_tags(($item->description))."<br>";
        fwrite($fh, strip_tags(($item->id))."\r\n") or die("Could not write to file");
        fwrite($fh, strip_tags(htmlentities($item->item_name))."\r\n") or die("Could not write to file");
        fwrite($fh, strip_tags(htmlentities($item->description))."\r\n") or die("Could not write to file");
    }
    fclose($fh);
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
