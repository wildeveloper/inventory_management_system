<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $company = Company::first();
        return view('company',[
            'company' => $company,
        ]);
    }

    public function update(Request $request)
    {
        
        $company = $request->all();
        $company = Company::updateOrCreate(['id' => $request->id], $company);
        return json_encode($company);

    }
}
