<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FileCopyModel;


class FileCopySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        FileCopyModel::create([
            'source'=>'\\127.0.0.1\share\data\iprings\invoices.xlsx',
            'destination'=>'d:\excel_files\invoices.xlsx'
        ]);
        FileCopyModel::create([
            'source'=>'\\127.0.0.1\share\data\iprings\workorders.xlsx',
            'destination'=>'d:\excel_files\workorders.xlsx'
        ]);
    }
}
