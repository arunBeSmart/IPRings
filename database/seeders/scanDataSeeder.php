<?php

namespace Database\Seeders;
use App\Models\ScanDATA_model;

use Illuminate\Database\Seeder;

class scanDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FileCopyModel::create([
            'scan_value'=>'no data'
        ]);
    }
}
