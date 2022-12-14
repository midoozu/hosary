<?php

namespace App\Http\Controllers\Frontend\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\HR\HrEmployeeBonus;
use App\Models\HR\HrEmployee;
use App\Http\Requests\HR\BonusRequest;

class EmployeeBonusController extends Controller
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

            $all_data = HrEmployeeBonus::with(['employee'])->orderby('id','DESC')->get();

            return DataTables::of($all_data)

                ->editColumn('employee_id', function ($data) {
                    return $data->employee->name;
                })
                ->addColumn('placeholder', '&nbsp;')


                ->addColumn('actions', function ($data) {
                    $html = '';
                    if($data->pay_status == 'new'){
                        $html = "
                            <a style='float:right; margin:1px;' href='".route('frontend.HREmployeeBonus.edit', $data->id)."' class='btn mb-2 btn-secondary editButton' id='" . $data->id . "'> <i class='fa fa-edit'></i></a>
                            <form  method='post' action='".route('frontend.HREmployeeBonus.destroy', $data->id)."'>
                                <input type='hidden' name='_method' value='DELETE'>
                                <input type='hidden' name='_token' value='".csrf_token()."'>
                                <button  style='float:right; margin:1px;' class='btn mb-2 btn-danger  delete' id='" . $data->id . "'><i class='fa fa-trash'></i> </button>
                            </form>
                        ";
                    }

                    return $html;
                })
                ->rawColumns(['actions','employee_id','placeholder'])->make(true);
        }

        return view('frontend.HR.Bonus.grid')->with(['route_url'=>route('frontend.HREmployeeBonus.index'), 'page_title'=>'????????????']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $employees   = HrEmployee::get();

        $output = [
            'page_title'  => '?????????? ????????????',
            'employees'   => $employees,
            'form_action' => route('frontend.HREmployeeBonus.store')
        ];

        return view('frontend.HR.Bonus.form')->with($output);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BonusRequest $request)
    {
        $date  = explode('-', $request->month);
        $month = $date[1];
        $year  = $date[0];

        $new_data = HrEmployeeBonus::create([
                'employee_id' => $request->employee_id,
                'details'     => $request->details,
                'value'       => $request->value,
                'date'        => $request->date,
                'month'       => $month,
                'year'        => $year,
            ]);



         toastr()->success("???? ?????????? ???????????? ???????? ??????????");
         return redirect()->route('frontend.HREmployeeBonus.index');
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
        $row_data = HrEmployeeBonus::findOrFail($id);

        $employees   = HrEmployee::get();

        if($row_data->month <10)
        {
            $row_data->{'month'} = "0".$row_data->month;
        }

        $output = [
            'page_title'  => '?????????? ????????????',
            'employees'   => $employees,
            'row_data'    => $row_data,
            'form_action' => route('frontend.HREmployeeBonus.update', $id)
        ];

        return view('frontend.HR.Bonus.form')->with($output);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BonusRequest $request, $id)
    {
        $date  = explode('-', $request->month);
        $month = $date[1];
        $year  = $date[0];

        $row_data = HrEmployeeBonus::findOrFail($id);
        $new_data = [
                'employee_id' => $request->employee_id,
                'details'     => $request->details,
                'value'       => $request->value,
                'date'        => $request->date,
                'month'       => $month,
                'year'        => $year,
            ];

        $row_data->update($new_data);



         toastr()->success("???? ?????????? ???????????? ???????????? ??????????");
         return redirect()->route('frontend.HREmployeeBonus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row_data = HrEmployeeBonus::findOrFail($id);

        $row_data->delete();
        return redirect()->back()->with(['success'=>'???? ?????????? ??????????']);
    }
}
