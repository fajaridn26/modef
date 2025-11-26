<?php

namespace App\Imports;

use App\Models\User as ModelsUser;
use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        return new ModelsUser([
            'nama' => $row['nama'],
            'email' => $row['email'],
            'role' => 'Siswa',
            'password' => Hash::make('12345'),
        ]);
    }
}