<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Branch;
use App\Models\Clinic;
use App\Models\Company;
use App\Models\CrmCustomer;
use App\Models\Doctor;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    public function index()
    {

        $employees = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customers = CrmCustomer::all();

        $companies = Company::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctors = Doctor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clinics = Clinic::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $services = Service::pluck('name', 'id');

        $products = Product::pluck('name', 'id');

        $branches = Branch::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.home' , compact('branches', 'clinics', 'companies', 'customers', 'doctors', 'employees', 'products', 'services')) ;
    }


}
