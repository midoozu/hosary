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
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
        $appointment = Appointment::create($request->all());
        $appointment->services()->sync($request->input('services', []));
        $appointment->products()->sync($request->input('products', []));

        return redirect()->route('frontend.appointments.index');
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
        $appointment->update($request->all());
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
}
