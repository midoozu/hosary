@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.doctor.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.doctors.update", [$doctor->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.doctor.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $doctor->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctor.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ trans('cruds.doctor.fields.phone') }}</label>
                            <input class="form-control" type="number" name="phone" id="phone" value="{{ old('phone', $doctor->phone) }}" step="1">
                            @if($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctor.fields.phone_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="address">{{ trans('cruds.doctor.fields.address') }}</label>
                            <input class="form-control" type="text" name="address" id="address" value="{{ old('address', $doctor->address) }}">
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
                                    <option value="{{ $id }}" {{ (in_array($id, old('clinics', [])) || $doctor->clinics->contains($id)) ? 'selected' : '' }}>{{ $clinic }}</option>
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
                            <input class="form-control" type="number" name="percentage" id="percentage" value="{{ old('percentage', $doctor->percentage) }}" step="0.01" required max="100">
                            @if($errors->has('percentage'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('percentage') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctor.fields.percentage_helper') }}</span>
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