<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $name, $lastname, $company;

    public function __construct($name, $lastname, $company)
    {
        $this->name = $name;
        $this->lastname = $lastname;
        $this->company = $company;
    }

    public function view(): View
    {
        return view('admin.excels.user', [
            'users' => User::orderBy('id','Desc')
                                ->company($this->company)
                                ->name($this->name)
                                ->lastname($this->lastname)
                                ->get()
        ]);
    }
}
