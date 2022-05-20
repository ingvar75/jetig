<?php

use Illuminate\Support\Facades\DB;

if (isset($_GET['choose']) && $_GET['choose'] == 'category') {
    $fh = fopen("jetCat.txt", 'w') or die("Failed to create file");
    $dataCat = DB::table('categories')->select('id', 'name_group')->get();
    foreach ($dataCat as $item) {
        echo $item->id;
        echo "<br>";
        echo $item->name_group;
        echo "<br>";
//        fwrite($fh, strip_tags(($item->id))."\r\n") or die("Could not write to file");
//        fwrite($fh, strip_tags(($item->name_group))."\r\n") or die("Could not write to file");
    }
    fclose($fh);
//    echo "File 'jetCat.txt' written successfully!";
    exit;
}
if (isset($_GET['choose']) && $_GET['choose'] == 'nameProducts') {
    $fh = fopen("jetProdDescr.txt", 'w') or die("Failed to create file");
    $dataProd = DB::table('products')->select('id', 'item_name')->get();
    foreach ($dataProd as $item) {
        echo strip_tags(($item->id)) . "<br>";
        echo strip_tags(($item->item_name)) . "<br>";
//        fwrite($fh, strip_tags(($item->id))."\r\n") or die("Could not write to file");
//        fwrite($fh, strip_tags(htmlentities($item->item_name))."\r\n") or die("Could not write to file");
    }
    fclose($fh);
    exit;
}
if (isset($_GET['choose']) && $_GET['choose'] == 'descrProducts') {
    $fh = fopen("jetProdDescr.txt", 'w') or die("Failed to create file");
    $dataProd = DB::table('products')->select('id', 'description')->get();
    foreach ($dataProd as $item) {
        echo strip_tags(($item->id)) . "<br>";
        echo strip_tags(($item->description)) . "<br>";
        fwrite($fh, strip_tags(($item->id)) . "\r\n") or die("Could not write to file");
        fwrite($fh, strip_tags(htmlentities($item->description)) . "\r\n") or die("Could not write to file");
    }
    fclose($fh);
    exit;
}
//////////////////////////Вставка категорій///////////////////////////////////////
if (isset($_GET['choose']) && $_GET['choose'] == "insertCat") {
    $cont = file("jetCat_ru_ua.txt") or die("Файл отсутствует, создайте файл и повторите запрос.");
    $k = 0;
    $id = 0;
    foreach ($cont as $line) {
        $line = trim($line);
        if ($k == 1) {
            //$title = str_replace("'", "\'", $line);
            $title = $line;
            //$query="UPDATE wp_posts SET post_content='$discription', post_title='$title' WHERE id='$id'";
            //$result=$conn->query($query);
            //if (!$result) die ("Ошибка подключения к БД.");
            DB::table('categories')->where('id', $id)->update(['name_group' => $title]);
            echo strtoupper($title) . "<br>";
        }
        if ($k == 0) {
            $id = $line;
            $id = str_replace('+', '', $id);
            $id = str_replace('-', ' ', $id);
            if (strlen($id) > 6) {
                echo "Внимание id cодержит неверный формат:<br>";
                echo $id;
                $id_asoc = array(
                    'тисяча' => 1000,
                    'тисячу' => 1000,
                    "тисячі" => 1000,
                    "одна тисяча" => 1000,
                    'дві тисячі' => 2000,

                    'сто' => 100,
                    'двісті' => 200,
                    'триста' => 300,
                    'чотириста' => 400,
                    "п'ятьсот" => 500,
                    "п'ятсот" => 500,
                    "шістьсот" => 600,
                    "шістсот" => 600,
                    "сімсот" => 700,
                    "вісімсот" => 800,
                    "дев'ятсот" => 900,

                    "десять" => 10,
                    "двадцять" => 20,
                    "тридцять" => 30,
                    "сорок" => 40,
                    "п'ятьдесят" => 50,
                    "шістьдесят" => 60,
                    "шістдесят" => 60,
                    "сімдесят" => 70,
                    "вісімдесят" => 80,
                    "дев'яносто" => 90,

                    "один" => 1,
                    "одна" => 1,
                    "два" => 2,
                    "дві" => 2,
                    "три" => 3,
                    "чотири" => 4,
                    "п'ять" => 5,
                    "шість" => 6,
                    "сім" => 7,
                    "вісім" => 8,
                    "дев'ять" => 9
                );
                $str = explode(' ', $id);
                print_r($str);
                exit;
                foreach ($str as $elm_num => $elm) {
                    $elm = trim($elm);
                    echo $elm_num . "<br>";
                    if ($id_asoc[$elm]) {
                        if ($elm_num == 0 && $elm == "одна") $pogr = 1; //если "одна" стоит перед "тисяча"
                        if ($elm_num == 0 && $elm == "дві") $pogr = 2;
                        $ids = $ids + $id_asoc[$elm];
                    } else {
                        $ids = $ids . $elm;
                    };
                    echo $ids . "<br>";
                    echo $elm . "<br>";
                    $id = str_replace(' ', '', $ids);
                    $id = $id - $pogr;
                }
                echo "Правильный id:" . $id . "<br>";
                echo $pogr . "<br>";
                $ids = null;
                $pogr = null;
                //exit;
            }
            $k++;
            continue;
        }
        $k--;
    }

    // fclose ($f_uk);
    exit;
}
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////Вставка заголовків///////////////////////////////////////
if (isset($_GET['choose']) && $_GET['choose'] == "insertNameProd") {
    $cont = file("jetProdName.txt") or die("Файл отсутствует, создайте файл и повторите запрос.");
    $k = 0;
    $id = 0;
    foreach ($cont as $line) {
        $line = trim($line);
        if ($k == 1) {
            //$title = str_replace("'", "\'", $line);
            $title = $line;
            //$query="UPDATE wp_posts SET post_content='$discription', post_title='$title' WHERE id='$id'";
            //$result=$conn->query($query);
            //if (!$result) die ("Ошибка подключения к БД.");
            DB::table('categories')->where('id', $id)->update(['name_group' => $title]);
            echo strtoupper($title) . "<br>";
        }
        if ($k == 0) {
            $id = $line;
            $id = str_replace('+', '', $id);
            $id = str_replace('-', ' ', $id);
            if (strlen($id) > 6) {
                echo "Внимание id cодержит неверный формат:<br>";
                echo $id;
                $id_asoc = array(
                    'тисяча' => 1000,
                    'тисячу' => 1000,
                    "тисячі" => 1000,
                    "одна тисяча" => 1000,
                    'дві тисячі' => 2000,

                    'сто' => 100,
                    'двісті' => 200,
                    'триста' => 300,
                    'чотириста' => 400,
                    "п'ятьсот" => 500,
                    "п'ятсот" => 500,
                    "шістьсот" => 600,
                    "шістсот" => 600,
                    "сімсот" => 700,
                    "вісімсот" => 800,
                    "дев'ятсот" => 900,

                    "десять" => 10,
                    "двадцять" => 20,
                    "тридцять" => 30,
                    "сорок" => 40,
                    "п'ятьдесят" => 50,
                    "шістьдесят" => 60,
                    "шістдесят" => 60,
                    "сімдесят" => 70,
                    "вісімдесят" => 80,
                    "дев'яносто" => 90,

                    "один" => 1,
                    "одна" => 1,
                    "два" => 2,
                    "дві" => 2,
                    "три" => 3,
                    "чотири" => 4,
                    "п'ять" => 5,
                    "шість" => 6,
                    "сім" => 7,
                    "вісім" => 8,
                    "дев'ять" => 9
                );
                $str = explode(' ', $id);
                print_r($str);
                exit;
                foreach ($str as $elm_num => $elm) {
                    $elm = trim($elm);
                    echo $elm_num . "<br>";
                    if ($id_asoc[$elm]) {
                        if ($elm_num == 0 && $elm == "одна") $pogr = 1; //если "одна" стоит перед "тисяча"
                        if ($elm_num == 0 && $elm == "дві") $pogr = 2;
                        $ids = $ids + $id_asoc[$elm];
                    } else {
                        $ids = $ids . $elm;
                    };
                    echo $ids . "<br>";
                    echo $elm . "<br>";
                    $id = str_replace(' ', '', $ids);
                    $id = $id - $pogr;
                }
                echo "Правильный id:" . $id . "<br>";
                echo $pogr . "<br>";
                $ids = null;
                $pogr = null;
                //exit;
            }
            $k++;
            continue;
        }
        $k--;
    }

    // fclose ($f_uk);
    exit;
}
//////////////////////////////////////////////////////////////////////////////////////////
////////////////////////Втавка продуктів////////////////////////////////////////////////
if (isset($_GET['choose']) && $_GET['choose'] == "insertProd") {
    $cont = file("jetProd_ru_ua.txt") or die("Файл отсутствует, создайте файл и повторите запрос.");
    $k = "id";
    foreach ($cont as $line) {
        if ($k == "id") $id = $line;
        $id = str_replace('+', '', $id);
        $id = str_replace('-', ' ', $id);
        if (strlen($id) > 6) {
            echo "Внимание id cодержит неверный формат:<br>";
            echo $id;
            $id_asoc = array(
                'тисяча' => 1000,
                'тисячу' => 1000,
                "тисячі" => 1000,
                "одна тисяча" => 1000,
                'дві тисячі' => 2000,

                'сто' => 100,
                'двісті' => 200,
                'триста' => 300,
                'чотириста' => 400,
                "п'ятьсот" => 500,
                "п'ятсот" => 500,
                "шістьсот" => 600,
                "шістсот" => 600,
                "сімсот" => 700,
                "вісімсот" => 800,
                "дев'ятсот" => 900,

                "десять" => 10,
                "двадцять" => 20,
                "тридцять" => 30,
                "сорок" => 40,
                "п'ятьдесят" => 50,
                "шістьдесят" => 60,
                "шістдесят" => 60,
                "сімдесят" => 70,
                "вісімдесят" => 80,
                "дев'яносто" => 90,

                "один" => 1,
                "одна" => 1,
                "два" => 2,
                "дві" => 2,
                "три" => 3,
                "чотири" => 4,
                "п'ять" => 5,
                "шість" => 6,
                "сім" => 7,
                "вісім" => 8,
                "дев'ять" => 9
            );
            $str = explode(' ', $id);
            print_r($str);
            foreach ($str as $elm_num => $elm) {
                $elm = trim($elm);
                echo $elm_num . "<br>";
                if ($id_asoc[$elm]) {
                    if ($elm_num == 0 && $elm == "одна") $pogr = 1; //если "одна" стоит перед "тисяча"
                    if ($elm_num == 0 && $elm == "дві") $pogr = 2;
                    $ids = $ids + $id_asoc[$elm];
                } else {
                    $ids = $ids . $elm;
                };
                echo $ids . "<br>";
                echo $elm . "<br>";
                $id = str_replace(' ', '', $ids);
                $id = $id - $pogr;
            }
            echo "Правильный id:" . $id . "<br>";
            echo $pogr . "<br>";
            $ids = null;
            $pogr = null;
            //exit;
        }
        if ($k == "name_cat") {
            $title = str_replace("'", "\'", $line);
            //$query="UPDATE wp_posts SET post_content='$discription', post_title='$title' WHERE id='$id'";
            //$result=$conn->query($query);
            //if (!$result) die ("Ошибка подключения к БД.");
            echo $id . "<br>";
            echo $title . "<br>";
            $k = "id";
        }
        //echo $line."<br>";
        ++$k;
    }

    // fclose ($f_uk);
    exit;
}
//////////////////////////////////////////////////////////////////////////////////////////
?>

<form method="get" action="{{ route('translator') }}">
    <label>
        <input type="radio" name="choose" value="category">
    </label>Готуємо категорії до перекладу<br>
    <label>
        <input type="radio" name="choose" value="nameProducts">
    </label>Готуємо заголовки до перекладу<br>
    <label>
        <input type="radio" name="choose" value="descrProducts">
    </label>Готуємо товари до перекладу<br>
    <label>
        <input type="radio" name="choose" value="insertCat">
    </label>Закачати переклад категорій з файла в БД<br>
    <label>
        <input type="radio" name="choose" value="insertNameProd">
    </label>Закачати переклад заголовків з файла в БД<br>
    <label>
        <input type="radio" name="choose" value="insertDescrProd">
    </label>Закачати переклад опису товарів з файла в БД<br>
    {{--    <label>--}}
    {{--        <input type="radio" name="choose" value="outofstock">--}}
    {{--    </label>закачать "нет в наличии"<br>--}}
    {{--    <label>--}}
    {{--        <input type="radio" name="choose" value="del_prod">--}}
    {{--    </label>Удалить все продукты из базы данных<br>--}}
    <br>
    <input type="submit">
</form>
