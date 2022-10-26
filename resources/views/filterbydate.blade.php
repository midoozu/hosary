@extends('layouts.frontend')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ 'اختار فتره التقرير' }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('frontend.reports.reportresult') }}" enctype="multipart/form-data">
                            @method('POST')
                            @csrf

                            <div class="form-group col-3 " style="display: inline-block">
                                <label class="required" for="fromdate">{{ 'من '}}</label>
                                <input class="form-control datetime" type="text" name="fromdate" id="fromdate" value="" >
                                @if($errors->has('date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('date') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-3 " style="display: inline-block">
                                <label class="required" for="todate">{{ 'الي '}}</label>
                                <input class="form-control datetime" type="text" name="todate" id="todate" value="" >
                                @if($errors->has('date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('date') }}
                                    </div>
                                @endif
                            </div>


                            <div class="form-group col-3 " style="display: inline-block">
                                <button class="btn btn-danger" type="submit">
                                    {{ trans('global.save') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
