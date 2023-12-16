<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name' => 'Coreproc',
            'charge_amount' => '10',
            'vat_charge' => '10',
            'address' => 'Tarlac',
            'phone' => '123456789',
            'country' => 'Philippines',

        ]);
    }
}
