<?php

namespace App\Exports;


use Illuminate\Concerns\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\User;

class UsersDataExport implements FromCollection,ShouldAutoSize
{
    use Exportable;

    private $uesrs;

    public function __construct(){

        $this->users = User::where('type', 1)->get();
    }

    public function collection()
    {
        return User::where('type', 1)->get();
    }

    public function view() : View
    {

        return view('admin.users.report',[
            'users' => $this->users
        ]);

    }
}
