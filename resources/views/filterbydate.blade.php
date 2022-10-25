@extends('layouts.frontend')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.edit') }} {{ trans('cruds.appointment.title_singular') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route("frontend.appointments.update", [$appointment->id]) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="form-group col-3 " style="display: inline-block">
                                <label class="required" for="fromdate">{{ 'من '}}</label>
                                <input class="form-control datetime" type="text" name="date" id="date" value="" >
                                @if($errors->has('date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('date') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-3 " style="display: inline-block">
                                <label class="required" for="todate">{{ 'الي '}}</label>
                                <input class="form-control datetime" type="text" name="date" id="date" value="" >
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
                                <button class="btn btn-warning" type="submit">
                                    {{ 'طباعه' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
