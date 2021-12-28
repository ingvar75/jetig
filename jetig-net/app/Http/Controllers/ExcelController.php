<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\CategoriesImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
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
        $response->headers->set('Cache-Control','max-age=0');

        return $response;
    }

    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request): \Illuminate\Http\RedirectResponse
    {
        $file = $request->file('excel');
        $filename = $file->getClientOriginalName(); // image.jpg
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load("$file");
        var_dump($spreadsheet->getActiveSheet()->toArray());exit;

        return back();
    }
}

