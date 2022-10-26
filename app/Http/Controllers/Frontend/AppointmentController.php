<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAppointmentRequest;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\Branch;
use App\Models\Clinic;
use App\Models\Company;
use App\Models\CrmCustomer;
use App\Models\Doctor;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use App\Notifications\DeleteNotification;
use Carbon\Carbon;
use Flasher\Laravel\Facade\Flasher;
use Gate;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;
use Flasher\Prime\FlasherInterface;

class AppointmentController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::with(['employee', 'customer', 'company', 'doctor', 'clinic', 'services', 'products', 'branch'])->get();

        $users = User::get();

        $crm_customers = CrmCustomer::get();

        $companies = Company::get();

        $doctors = Doctor::get();

        $clinics = Clinic::get();

        $services = Service::get();

        $products = Product::get();

        $branches = Branch::get();

        return view('frontend.appointments.index', compact('appointments', 'branches', 'clinics', 'companies', 'crm_customers', 'doctors', 'products', 'services', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('appointment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customers = CrmCustomer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companies = Company::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctors = Doctor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clinics = Clinic::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $services = Service::pluck('name', 'id');

        $products = Product::pluck('name', 'id');

        $branches = Branch::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.appointments.create', compact('branches', 'clinics', 'companies', 'customers', 'doctors', 'employees', 'products', 'services'));
    }

    public function store(StoreAppointmentRequest $request)
    {



        $servicePrice = Service::find($request->services)->sum('price');




        $clientCheck_number = CrmCustomer::where('phone', $request->customer_id)->first();

        if ($clientCheck_number){

            Flasher::addError('المريض موجود بالفعل برجاء الاختيار من القائمه');

            return back();
        }

        $clientCheck_id = CrmCustomer::where('id', $request->customer_id)->first();

    if ($clientCheck_id){

        $appointment = $request->all() ;
        $appointment['customer_id']  = $clientCheck_id->id ;
        $appointment['total_price'] = $servicePrice + $request->other_service;
        $appointment =   Appointment::create($appointment);

        $appointment->services()->sync($request->input('services', []));
        $appointment->products()->sync($request->input('products', []));
     Flasher::addSuccess('تم اضافه الحجز بنجاح ');
    }
    else {

        $client = CrmCustomer::Create([
            'phone' => $request->customer_id,
            'first_name' => $request->customer_name,
        ]);
        Flasher::addSuccess('تم اضافه العميل');
           $appointment = $request->all();
        $appointment['customer_id'] = $client->id;
        $appointment['total_price'] = $servicePrice + $request->other_service;
        $appointment = Appointment::create($appointment);

        $appointment->services()->sync($request->input('services', []));
        $appointment->products()->sync($request->input('products', []));
        Flasher::addSuccess('تم اضافه الحجز بنجاح');
    };

        return redirect()->back();
    }

    public function edit(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customers = CrmCustomer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companies = Company::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctors = Doctor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clinics = Clinic::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $services = Service::pluck('name', 'id');

        $products = Product::pluck('name', 'id');

        $branches = Branch::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $appointment->load('employee', 'customer', 'company', 'doctor', 'clinic', 'services', 'products', 'branch');

        return view('frontend.appointments.edit', compact('appointment', 'branches', 'clinics', 'companies', 'customers', 'doctors', 'employees', 'products', 'services'));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {

        $servicePrice = Service::find($request->services)->sum('price');
        $productPrice = Product::find($request->products)->sum('price');

        $appointment->update($request->all());
        $appointment->update( ['total_price' =>$servicePrice + $request->other_service + $productPrice]) ;
        $appointment->services()->sync($request->input('services', []));
        $appointment->products()->sync($request->input('products', []));

        return redirect()->route('frontend.appointments.index');
    }

    public function show(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->load('employee', 'customer', 'company', 'doctor', 'clinic', 'services', 'products', 'branch');

        return view('frontend.appointments.show', compact('appointment'));
    }

    public function destroy(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentRequest $request)
    {
        Appointment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getcustomername(Request $request){


        $data = CrmCustomer::findOrFail($request->customer_id);

        return $data;

    }

    public function getdoctor(Request $request){

        $id = $request->id ;

        $doctors = Doctor::WhereHas('clinics' , function($q) use ($id) {
            $q->where('id', $id);
        })->get();

        return $doctors;

    }

    public function getservicename(Request $request){


        $id = $request->id ;

        $services  = Service::WhereHas('servicesClinics' , function($q) use ($id) {
            $q->where('id', $id);
        })->get();

        return  $services;

    }
    public function getwaiting(Request $request){


        $id = $request->id ;

        $appointment = Appointment::find($request->id);

         $waiting =  Appointment::where(function ($q) use ($appointment) {

             $q->whereBetween('date',[Carbon::today(),$appointment->date]);
             $q->where('clinic_id',$appointment->clinic_id);

         } )->count();

//        $clinic_waiting = Appointment::query()->whereDate('date', Carbon::today())->where('branch_id',auth()->user()->branch->id)->get()->groupBy('clinic.name', DB::raw('count(*) as total'));

        return  $waiting ;

    }


    public function askfordelete($id){

       $appointment = Appointment::find($id);
        $appointment ->update(['pending_delete'=>1]);

        Flasher::addWarning('فانتظار الموافقه برجاء الرجوع الي المشرف');

        $users =User::whereHas('roles', function ($query) {
            $query->where('id',2);
        })->get();

        Notification::send($users, new DeleteNotification($appointment));

            return back();

    }

    public function deleted(){


//            abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

            $appointments = Appointment::onlyTrashed()->with(['employee', 'customer', 'company', 'doctor', 'clinic', 'services', 'products', 'branch'])->get();

            $users = User::get();

            $crm_customers = CrmCustomer::get();

            $companies = Company::get();

            $doctors = Doctor::get();

            $clinics = Clinic::get();

            $services = Service::get();

            $products = Product::get();

            $branches = Branch::get();

            return view('frontend.appointments.deleted', compact('appointments', 'branches', 'clinics', 'companies', 'crm_customers', 'doctors', 'products', 'services', 'users'));

    }

    public function pendingdelete(){


//            abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

            $appointments = Appointment::with(['employee', 'customer', 'company', 'doctor', 'clinic', 'services', 'products', 'branch'])->where('pending_delete','=',1)->get();



            $users = User::get();

            $crm_customers = CrmCustomer::get();

            $companies = Company::get();

            $doctors = Doctor::get();

            $clinics = Clinic::get();

            $services = Service::get();

            $products = Product::get();

            $branches = Branch::get();

            return view('frontend.appointments.pendingdelete', compact('appointments', 'branches', 'clinics', 'companies', 'crm_customers', 'doctors', 'products', 'services', 'users'));

    }

    public function restore($id){

        Appointment::withTrashed()->find($id)->restore();

        Flasher::addInfo('تم استعاده العنصر');

        return back();

    }

    public function exit($id){

        $appointment = Appointment::find($id)->update(['check_out'=>1]);

    Flasher::addInfo('تم بنجاح ');

    return back();

    }

}
