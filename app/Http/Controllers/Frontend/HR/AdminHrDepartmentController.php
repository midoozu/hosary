<?php

namespace App\Http\Controllers\Frontend\HR;

use App\Http\Controllers\Controller;
use App\Models\HR\HrDepartment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminHrDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $datas = HrDepartment::orderby("id","DESC")->get();

        if ($request->ajax()){
            return DataTables::of($datas)

                ->addColumn('placeholder', '&nbsp;')

                ->addColumn('actions', function ($data) {
                    if ($data->id > 3){
                        $html = "
                    <button  class='btn mb-2 btn-secondary editButton' id='" . $data->id . "'> <i class='fa fa-edit'></i></button>
                   <button class='btn mb-2 btn-danger  delete' id='" . $data->id . "'><i class='fa fa-trash'></i> </button>";
                    }else{
                        $html = "
                    <button  class='btn mb-2 btn-secondary editButton' id='" . $data->id . "'> <i class='fa fa-edit'></i></button>";
                    }

                    return $html;
                })
                ->rawColumns(['actions','placeholder'])->make(true);
        }



        return view("frontend/HR/Setting/Departments/index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->ajax()){
            $returnHTML = view("frontend/HR/Setting/Departments/parts/create")
                ->with([
                ])
                ->render();
            return response()->json(array('success' => true, 'html'=>"$returnHTML"));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->only('title');


        $store = HrDepartment::create($data);




        return response()->json(1,200);

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
        $find = HrDepartment::find($id);




        $returnHTML = view("frontend/HR/Setting/Departments/parts/edit")
            ->with([
                'find' => $find
            ])
            ->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $old = HrDepartment::find($id);

        $data = $request->only('title');


        HrDepartment::find($id)->update($data);


        $new = HrDepartment::find($id);


        return response()->json(1,200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find = HrDepartment::destroy($id);

        return response()->json(1,200);
    }//end fun

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete_all(Request $request){
        HrDepartment::destroy($request->id);
        return response()->json(1,200);
    }//end fun
}
