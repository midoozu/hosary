<?php

namespace App\Http\Controllers\Frontend\HR;

use App\Http\Controllers\Controller;
use App\Http\Requests\HR\EmployeeVacationsRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\HR\HrEmployeeVacations;
use App\Models\HR\HrVacations;
use App\Models\HR\HrEmployee;
use App\Http\Requests\HR\EmployeeSanctionRequest;

class EmployeeVacationsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        //return all data
        if ($request->ajax()) {

            $all_data = HrEmployeeVacations::with(['employee', 'vaca`tion'])->orderby('id','DESC')->get();

            return DataTables::of($all_data)

                ->addColumn('placeholder', '&nbsp;')

                ->editColumn('vacation_id', function ($data) {
                    return $data->vacation->title;
                })
                ->editColumn('employee_id', function ($data) {
                    return $data->employee->name;
                })
                ->addColumn('actions', function ($data) {

                        $html = "
                            <a style='float:right; margin:1px;' href='".route('frontend.HREmployeeVacations.edit', $data->id)."' class='btn mb-2 btn-secondary editButton' id='" . $data->id . "'> <i class='fa fa-edit'></i></a>
                            <form  method='post' action='".route('frontend.HREmployeeVacations.destroy', $data->id)."'>
                                <input type='hidden' name='_method' value='DELETE'>
                                <input type='hidden' name='_token' value='".csrf_token()."'>
                                <button  style='float:right; margin:1px;' class='btn mb-2 btn-danger  delete' id='" . $data->id . "'><i class='fa fa-trash'></i> </button>
                            </form>
                        ";


                    return $html;
                })
                ->rawColumns(['actions','title','value'],'placeholder')->make(true);
        }

        return view('frontend.HR.Vacations.grid')->with(['route_url'=>route('frontend.HREmployeeVacations.index'), 'page_title'=>'????????????????']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $employees   = HrEmployee::get();
        $vacations   = HrVacations::get();


        $output = [
            'page_title'  => '?????????? ??????????????????',
            'employees'   => $employees,
            'vacations'   => $vacations,
            'form_action' => route('frontend.HREmployeeVacations.store')
        ];

        return view('frontend.HR.Vacations.form')->with($output);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeVacationsRequest $request)
    {
        //
        $new_vac = HrEmployeeVacations::create([
                'vacation_id' => $request->vacation_id,
                'employee_id' => $request->employee_id,
                'from_date'   => $request->from_date,
                'to_date'     => $request->to_date,
                'reason'      => $request->reason,
            ]);



         toastr()->success("???? ?????????? ??????????  ??????????");
         return redirect()->route('frontend.HREmployeeVacations.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $row_data  = HrEmployeeVacations::findOrFail($id);
        $employees = HrEmployee::get();
        $vacations = HrVacations::get();


        $output = [
            'page_title'  => '?????????? ??????????????????',
            'employees'   => $employees,
            'vacations'   => $vacations,
            'row_data'    => $row_data,
            'form_action' => route('frontend.HREmployeeVacations.update', $id)
        ];

        return view('frontend.HR.Vacations.form')->with($output);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeVacationsRequest $request, $id)
    {
        $vac_data = HrEmployeeVacations::findOrFail($id);

        $vac_data->update([
                'vacation_id' => $request->vacation_id,
                'employee_id' => $request->employee_id,
                'from_date'   => $request->from_date,
                'to_date'     => $request->to_date,
                'reason'      => $request->reason,
            ]);



         toastr()->success("???? ?????????? ?????????? ????????  ??????????");
         return redirect()->route('frontend.HREmployeeVacations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $row_data = HrEmployeeVacations::findOrFail($id);

        $row_data->delete();
        return redirect()->back()->with(['success'=>'???? ?????????? ??????????']);
    }
}
