<?php

namespace App\Http\Controllers\Frontend;

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
use Illuminate\Support\Facades\DB;
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

        $services = Service::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id');

        $branches = Branch::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');


        $appointments = Appointment::with([ 'customer', 'company', 'doctor', 'clinic', 'services', 'branch'])

            ->whereDate('date', Carbon::today())->where('branch_id',auth()->user()->branch->id)->get();



        $mappedcollection = $appointments->map(function($name, $key) use ($appointments) {

        return [ $appointments->where('date','<',$name->date )->count() , $name];


        });


//        $user_info = DB::table('appointments')
//            ->select('clinic_id', DB::raw('count(*) as total'))
//            ->groupBy('clinic_id')
//            ->get();

//        $test = Appointment::with('clinic')->groupBy('clinics.name');
//        dd($test);

//      $r =  Appointment::with(['clinic' => function($query){
//            $query->groupBy('name');
//        }])->get();



       $clinic_waiting = Appointment::query()->whereDate('date', Carbon::today())->where('branch_id',auth()->user()->branch->id)->get()->groupBy('clinic.name', DB::raw('count(*) as total'));


        return view('frontend.home' , compact('branches', 'clinics', 'companies', 'customers', 'doctors', 'employees', 'products','appointments', 'services','clinic_waiting')) ;
    }


}
