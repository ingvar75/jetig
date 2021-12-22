<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $data)
    {
        return new User([
            'name'     => $data[0],
            'email'    => $data[1],
            'password' => \Hash::make($data[2]),
        ]);
    }
}
