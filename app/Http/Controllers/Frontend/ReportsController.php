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
use Illuminate\Support\Facades\DB;

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


    public function todayreport(){

        $users = User::get();

        $crm_customers = CrmCustomer::get();

        $companies = Company::get();

        $doctors = Doctor::get();

        $clinics = Clinic::get();

        $services = Service::get();

        $products = Product::get();

        $branches = Branch::get();

        $appointments = Appointment::with(['employee', 'customer', 'company', 'doctor', 'clinic', 'services', 'products', 'branch'])

            ->whereDate('date', Carbon::today())->get();


return view('reports.todayreport' ,compact('appointments', 'branches', 'clinics', 'companies', 'crm_customers', 'doctors', 'products', 'services', 'users'));

    }


    public function yasterdayreport(){

        $users = User::get();

        $crm_customers = CrmCustomer::get();

        $companies = Company::get();

        $doctors = Doctor::get();

        $clinics = Clinic::get();

        $services = Service::get();

        $products = Product::get();

        $branches = Branch::get();

        $appointments = Appointment::with(['employee', 'customer', 'company', 'doctor', 'clinic', 'services', 'products', 'branch'])

            ->whereDate('date', Carbon::yesterday())->get();


        return view('reports.yasterdayreport' ,compact('appointments', 'branches', 'clinics', 'companies', 'crm_customers', 'doctors', 'products', 'services', 'users'));

    }


    public function servicesreport(){

        $users = User::get();

        $crm_customers = CrmCustomer::get();

        $companies = Company::get();

        $doctors = Doctor::get();

        $clinics = Clinic::get();

        $services = Service::get();

        $products = Product::get();

        $branches = Branch::get();



        $appointments = Service::withCount('serviceAppointments')->get()->groupBy('service.name', DB::raw('count(*) as total'));

        return view('reports.yasterdayreport' ,compact('appointments', 'branches', 'clinics', 'companies', 'crm_customers', 'doctors', 'products', 'services', 'users'));

    }



}
