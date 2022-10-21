@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.doctor.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.doctors.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.doctor.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctor.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ trans('cruds.doctor.fields.phone') }}</label>
                            <input class="form-control" type="number" name="phone" id="phone" value="{{ old('phone', '') }}" step="1">
                            @if($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctor.fields.phone_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="address">{{ trans('cruds.doctor.fields.address') }}</label>
                            <input class="form-control" type="text" name="address" id="address" value="{{ old('address', '') }}">
                            @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctor.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="clinics">{{ trans('cruds.doctor.fields.clinic') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="clinics[]" id="clinics" multiple>
                                @foreach($clinics as $id => $clinic)
                                    <option value="{{ $id }}" {{ in_array($id, old('clinics', [])) ? 'selected' : '' }}>{{ $clinic }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('clinics'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('clinics') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctor.fields.clinic_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="percentage">{{ trans('cruds.doctor.fields.percentage') }}</label>
                            <input class="form-control" type="number" name="percentage" id="percentage" value="{{ old('percentage', '') }}" step="0.01" required max="100">
                            @if($errors->has('percentage'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('percentage') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctor.fields.percentage_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <table class="table table-bordered">
                                <thead>
                                <th> {{'service id '}}</th>
                                <th>{{'service name'}}</th>
                                <th>{{' doctor pecent'}}</th>
                                </thead>
                                <tbody>
                                @foreach($services as $id => $service)
                                    <tr>
                                        <td><input id="service_id[]" name="service_id[]" type="text" value="{{$id}}" style="border: none"> </td>
                                        <td><input type="text" value="{{$service }}" style="border: none" ></td>
                                        <td><input id="doctor_price[]" name="doctor_price[]" type="number" value=""></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group">
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
