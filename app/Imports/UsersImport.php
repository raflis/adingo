<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithStartRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        //dd($row[0]);
        if(count(User::where('email', $row[3])->get()) < 1):
            return (new User)->create([
                'name' => $row[0],
                'lastname' => $row[1],
                'company' => $row[2],
                'email' => $row[3],
                'role' => 1,
                'avatar' => 'avatar.png',
                'password' => bcrypt('adingo'),
            ]);
        endif;
    }
}
