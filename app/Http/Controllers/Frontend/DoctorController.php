<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDoctorRequest;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Doctor_Service;
use App\Models\Service;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DoctorController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('doctor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctors = Doctor::with(['clinics'])->get();

        $clinics = Clinic::get();

        return view('frontend.doctors.index', compact('clinics', 'doctors'));
    }

    public function create()
    {
        abort_if(Gate::denies('doctor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clinics = Clinic::pluck('name', 'id');
        $services = Service::pluck('name', 'id');


        return view('frontend.doctors.create', compact('clinics','services'));
    }

    public function store(StoreDoctorRequest $request)
    {

        $doctor = Doctor::create($request->all());
        $doctor->clinics()->sync($request->input('clinics', []));


        if ($request->service_id != 0) {
            foreach ($request->service_id as $key => $s) {

                doctor_service::create([
                    'doctor_id'=>$doctor->id,
                    'service_id'=>$request->service_id[$key],
                    'percent'=> $request->doctor_price[$key]
                ]);
            }
        }


        return redirect()->route('frontend.doctors.index');
    }

    public function edit(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clinics = Clinic::pluck('name', 'id');

        $doctor->load('clinics');

        return view('frontend.doctors.edit', compact('clinics', 'doctor'));
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $doctor->update($request->all());
        $doctor->clinics()->sync($request->input('clinics', []));

        return redirect()->route('frontend.doctors.index');
    }

    public function show(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctor->load('clinics');

        return view('frontend.doctors.show', compact('doctor'));
    }

    public function destroy(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctor->delete();

        return back();
    }

    public function massDestroy(MassDestroyDoctorRequest $request)
    {
        Doctor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
