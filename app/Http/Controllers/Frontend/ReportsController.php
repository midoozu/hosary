<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Branch;
use App\Models\Clinic;
use App\Models\Company;
use App\Models\CrmCustomer;
use App\Models\Doctor;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function filterbydate(){


                return view('filterbydate');
    }

    public function reportresult(Request $request){

        $users = User::get();

        $crm_customers = CrmCustomer::get();

        $companies = Company::get();

        $doctors = Doctor::get();

        $clinics = Clinic::get();

        $services = Service::get();

        $products = Product::get();

        $branches = Branch::get();

       $appointments = Appointment::with(['employee', 'customer', 'company', 'doctor', 'clinic', 'services', 'products', 'branch'])

           ->whereBetween('date', [$request->fromdate,$request->todate])->withSum('services','price')->get();


return view('reports.incomereport' ,compact('appointments', 'branches', 'clinics', 'companies', 'crm_customers', 'doctors', 'products', 'services', 'users'));

    }
}
