<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\User;

class UsersExport implements FromView
{
    // use Exportable;

    public function view(): View
    {
        $users = User::where('type', 1)->get();

        return view('admin.users.table', [
            'users' => $users
        ]);
    }


}
