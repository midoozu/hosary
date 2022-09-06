@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.appointment.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.appointments.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="employee_id">{{ trans('cruds.appointment.fields.employee') }}</label>
                            <select class="form-control select2" name="employee_id" id="employee_id" required>
                                @foreach($employees as $id => $entry)
                                    <option value="{{ $id }}" {{ old('employee_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('employee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('employee') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.employee_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="date">{{ trans('cruds.appointment.fields.date') }}</label>
                            <input class="form-control datetime" type="text" name="date" id="date" value="{{ old('date') }}" required>
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="customer_id">{{ trans('cruds.appointment.fields.customer') }}</label>
                            <select class="form-control select2" name="customer_id" id="customer_id">
                                @foreach($customers as $id => $entry)
                                    <option value="{{ $id }}" {{ old('customer_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('customer'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('customer') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.customer_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="company_id">{{ trans('cruds.appointment.fields.company') }}</label>
                            <select class="form-control select2" name="company_id" id="company_id">
                                @foreach($companies as $id => $entry)
                                    <option value="{{ $id }}" {{ old('company_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('company'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.company_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="doctor_id">{{ trans('cruds.appointment.fields.doctor') }}</label>
                            <select class="form-control select2" name="doctor_id" id="doctor_id" required>
                                @foreach($doctors as $id => $entry)
                                    <option value="{{ $id }}" {{ old('doctor_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('doctor'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('doctor') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.doctor_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="clinic_id">{{ trans('cruds.appointment.fields.clinic') }}</label>
                            <select class="form-control select2" name="clinic_id" id="clinic_id" required>
                                @foreach($clinics as $id => $entry)
                                    <option value="{{ $id }}" {{ old('clinic_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('clinic'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('clinic') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.clinic_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="services">{{ trans('cruds.appointment.fields.service') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="services[]" id="services" multiple required>
                                @foreach($services as $id => $service)
                                    <option value="{{ $id }}" {{ in_array($id, old('services', [])) ? 'selected' : '' }}>{{ $service }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('services'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('services') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.service_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="check_out" value="0">
                                <input type="checkbox" name="check_out" id="check_out" value="1" {{ old('check_out', 0) == 1 ? 'checked' : '' }}>
                                <label for="check_out">{{ trans('cruds.appointment.fields.check_out') }}</label>
                            </div>
                            @if($errors->has('check_out'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('check_out') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.check_out_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="pulse_counter">{{ trans('cruds.appointment.fields.pulse_counter') }}</label>
                            <input class="form-control" type="number" name="pulse_counter" id="pulse_counter" value="{{ old('pulse_counter', '') }}" step="1">
                            @if($errors->has('pulse_counter'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pulse_counter') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.pulse_counter_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="used_pulse">{{ trans('cruds.appointment.fields.used_pulse') }}</label>
                            <input class="form-control" type="number" name="used_pulse" id="used_pulse" value="{{ old('used_pulse', '') }}" step="1">
                            @if($errors->has('used_pulse'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('used_pulse') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.used_pulse_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="device_pulse">{{ trans('cruds.appointment.fields.device_pulse') }}</label>
                            <input class="form-control" type="number" name="device_pulse" id="device_pulse" value="{{ old('device_pulse', '') }}" step="1">
                            @if($errors->has('device_pulse'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('device_pulse') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.device_pulse_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="products">{{ trans('cruds.appointment.fields.product') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="products[]" id="products" multiple>
                                @foreach($products as $id => $product)
                                    <option value="{{ $id }}" {{ in_array($id, old('products', [])) ? 'selected' : '' }}>{{ $product }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('products'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('products') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.product_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="branch_id">{{ trans('cruds.appointment.fields.branch') }}</label>
                            <select class="form-control select2" name="branch_id" id="branch_id" required>
                                @foreach($branches as $id => $entry)
                                    <option value="{{ $id }}" {{ old('branch_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('branch'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('branch') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.branch_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="comment">{{ trans('cruds.appointment.fields.comment') }}</label>
                            <input class="form-control" type="text" name="comment" id="comment" value="{{ old('comment', '') }}">
                            @if($errors->has('comment'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('comment') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.comment_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="other_service">{{ trans('cruds.appointment.fields.other_service') }}</label>
                            <input class="form-control" type="number" name="other_service" id="other_service" value="{{ old('other_service', '') }}" step="0.01">
                            @if($errors->has('other_service'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('other_service') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.other_service_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="total_price">{{ trans('cruds.appointment.fields.total_price') }}</label>
                            <input class="form-control" type="number" name="total_price" id="total_price" value="{{ old('total_price', '') }}" step="0.01">
                            @if($errors->has('total_price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.total_price_helper') }}</span>
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