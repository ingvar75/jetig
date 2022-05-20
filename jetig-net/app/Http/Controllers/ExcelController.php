<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Storage;

class ExcelController extends Controller
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {
        return view('index');
    }

    /**
     * @return StreamedResponse
     */
    public function export(): StreamedResponse
    {
        $categories = Categories::query()->get()->all();
        $columns = array_keys(current($categories)->toArray());
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($columns as $index => $column) {
            $sheet->setCellValueByColumnAndRow($index + 1, 1, $column);
        }
        foreach ($categories as $row => $category) {
            foreach (array_values($category->toArray()) as $column => $value) {

                $sheet->setCellValueByColumnAndRow($column + 1, $row + 2, $value);
            }
        }
        $writer = new Xlsx($spreadsheet);

        $response = new StreamedResponse(static function () use ($writer) {
            $writer->save('php://output');
        });
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', "attachment;filename=categoriesEXP.xlsx");
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }

    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function import(Request $request): \Illuminate\Http\RedirectResponse
    {
        $file = $request->file('excel');
        $reader = new Xls();
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load("$file");
        $allSheets = $spreadsheet->getAllSheets();

        foreach ($allSheets as $rew => $sheet) {
            $namePage = $spreadsheet->getSheetNames();

            var_dump($namePage[$rew]);
            if ($namePage[$rew] == 'Export Groups Sheet') {
                //DB::table('categories')->truncate();//очистить базу категорий
                $page = $sheet->toArray();
                $pageCount = count($page);
                for ($i = 1; $i < $pageCount; $i++) {
                    if ($page[$i][4] == null) $page[$i][4] = 0;
                    $in_db_categories = [
                        'name_group' => $page[$i][1],
                        'id_group' => $page[$i][2],
                        'id_group_parent' => $page[$i][4],
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                    ];
                    Categories::query()->insert($in_db_categories);
                    var_dump($in_db_categories);
                }

            }
            if ($namePage[$rew] == 'Export Products Sheet') {
                //DB::table('products')->truncate();//очистить базу товаров
                $page = $sheet->toArray();
                $pageCount = count($page);
                for ($i = 1; $i < $pageCount; $i++) {
                    if ($page[$i][12] == "+") $page[$i][12] = 1; //є в наявності
                    $in_db_product = [
                        'product_code' => $page[$i][0],
                        'item_name' => $page[$i][1],
                        'description' => $page[$i][3],
                        'price' => $page[$i][5],
                        'currency' => $page[$i][6],
                        'unit_of_measurement' => $page[$i][7],
                        'image_link' => $page[$i][11],
                        'availability' => $page[$i][12],
                        'manufacturer_tramp' => $page[$i][14],
                        'unique_identifier' => $page[$i][22],
                        'id_group' => $page[$i][24],
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                    ];
                    if (DB::table('categories')
                        ->where('id_group', $page[$i][24])
                        ->doesntExist() == true) {
                        Products::query()->insertOrIgnore($in_db_product);// вставка с игнорированием дубликата или ошибки вставки
                        var_dump($in_db_product);
                    }

                }
            }
        }
        //////////////////////знайдемо та приберемо пусті категорії//////////////////////////////////

        $CatParent = DB::table('categories')->where('id_group_parent', 0)->get();
        //суперкатегорія random
        var_dump($CatParent);
        foreach ($CatParent as $k => $superCat) {
            echo '//////////////////////////////////////////////' . $superCat->name_group;
            $categories = DB::table('categories')->where('id_group_parent', $superCat->id_group)->get();
            var_dump($categories);

            foreach ($categories as $key => $obj) {
                echo '///////////////////////////////' . $obj->name_group;
                $underCat = DB::table('categories')->where('id_group_parent', $obj->id_group)->get();
                if (count($underCat) <= 0) {
                    echo "<br>" . "<p style='color: red;'>Deleted!!! Empty undercategory!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!</p>";
                    DB::table('categories')->where('id_group', $obj->id_group)->delete();
                }
                foreach ($underCat as $m => $prod) {
                    $products = DB::table('products')->where('id_group', $prod->id_group)->get();
                    if (count($products) <= 6) {
                        echo "<br>$prod->name_group" . ":" . count($products);
                        DB::table('categories')->where('id_group', $prod->id_group)->delete();
                    }
                }

                var_dump($underCat);
            }
        }

        exit;

        return back();
    }
}

