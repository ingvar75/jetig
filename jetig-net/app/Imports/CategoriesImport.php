<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Categories;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoriesImport implements ToModel
{
    /**
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $data): \Illuminate\Database\Eloquent\Model|Categories|null
    {
        return new Categories([
            'Название_группы'     => $data[1],
            'Идентификатор_группы'    => $data[2],
            'Идентификатор_родителя' => $data[4],
        ]);
    }
}
