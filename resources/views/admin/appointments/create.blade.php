@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.appointment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.appointments.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="employee_id">{{ trans('cruds.appointment.fields.employee') }}</label>
                <select class="form-control select2 {{ $errors->has('employee') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id" required>
                    @foreach($employees as $id => $entry)
                        <option value="{{ $id }}" {{ old('employee_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('employee'))
                    <span class="text-danger">{{ $errors->first('employee') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.employee_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.appointment.fields.date') }}</label>
                <input class="form-control datetime {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}" required>
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="customer_id">{{ trans('cruds.appointment.fields.customer') }}</label>
                <select class="form-control select2 {{ $errors->has('customer') ? 'is-invalid' : '' }}" name="customer_id" id="customer_id">
                    @foreach($customers as $id => $entry)
                        <option value="{{ $id }}" {{ old('customer_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('customer'))
                    <span class="text-danger">{{ $errors->first('customer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.customer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_id">{{ trans('cruds.appointment.fields.company') }}</label>
                <select class="form-control select2 {{ $errors->has('company') ? 'is-invalid' : '' }}" name="company_id" id="company_id">
                    @foreach($companies as $id => $entry)
                        <option value="{{ $id }}" {{ old('company_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('company'))
                    <span class="text-danger">{{ $errors->first('company') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.company_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="doctor_id">{{ trans('cruds.appointment.fields.doctor') }}</label>
                <select class="form-control select2 {{ $errors->has('doctor') ? 'is-invalid' : '' }}" name="doctor_id" id="doctor_id" required>
                    @foreach($doctors as $id => $entry)
                        <option value="{{ $id }}" {{ old('doctor_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('doctor'))
                    <span class="text-danger">{{ $errors->first('doctor') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.doctor_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="clinic_id">{{ trans('cruds.appointment.fields.clinic') }}</label>
                <select class="form-control select2 {{ $errors->has('clinic') ? 'is-invalid' : '' }}" name="clinic_id" id="clinic_id" required>
                    @foreach($clinics as $id => $entry)
                        <option value="{{ $id }}" {{ old('clinic_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('clinic'))
                    <span class="text-danger">{{ $errors->first('clinic') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.clinic_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="services">{{ trans('cruds.appointment.fields.service') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('services') ? 'is-invalid' : '' }}" name="services[]" id="services" multiple required>
                    @foreach($services as $id => $service)
                        <option value="{{ $id }}" {{ in_array($id, old('services', [])) ? 'selected' : '' }}>{{ $service }}</option>
                    @endforeach
                </select>
                @if($errors->has('services'))
                    <span class="text-danger">{{ $errors->first('services') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.service_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('check_out') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="check_out" value="0">
                    <input class="form-check-input" type="checkbox" name="check_out" id="check_out" value="1" {{ old('check_out', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="check_out">{{ trans('cruds.appointment.fields.check_out') }}</label>
                </div>
                @if($errors->has('check_out'))
                    <span class="text-danger">{{ $errors->first('check_out') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.check_out_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pulse_counter">{{ trans('cruds.appointment.fields.pulse_counter') }}</label>
                <input class="form-control {{ $errors->has('pulse_counter') ? 'is-invalid' : '' }}" type="number" name="pulse_counter" id="pulse_counter" value="{{ old('pulse_counter', '') }}" step="1">
                @if($errors->has('pulse_counter'))
                    <span class="text-danger">{{ $errors->first('pulse_counter') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.pulse_counter_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="used_pulse">{{ trans('cruds.appointment.fields.used_pulse') }}</label>
                <input class="form-control {{ $errors->has('used_pulse') ? 'is-invalid' : '' }}" type="number" name="used_pulse" id="used_pulse" value="{{ old('used_pulse', '') }}" step="1">
                @if($errors->has('used_pulse'))
                    <span class="text-danger">{{ $errors->first('used_pulse') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.used_pulse_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="device_pulse">{{ trans('cruds.appointment.fields.device_pulse') }}</label>
                <input class="form-control {{ $errors->has('device_pulse') ? 'is-invalid' : '' }}" type="number" name="device_pulse" id="device_pulse" value="{{ old('device_pulse', '') }}" step="1">
                @if($errors->has('device_pulse'))
                    <span class="text-danger">{{ $errors->first('device_pulse') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.device_pulse_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="products">{{ trans('cruds.appointment.fields.product') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('products') ? 'is-invalid' : '' }}" name="products[]" id="products" multiple>
                    @foreach($products as $id => $product)
                        <option value="{{ $id }}" {{ in_array($id, old('products', [])) ? 'selected' : '' }}>{{ $product }}</option>
                    @endforeach
                </select>
                @if($errors->has('products'))
                    <span class="text-danger">{{ $errors->first('products') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="branch_id">{{ trans('cruds.appointment.fields.branch') }}</label>
                <select class="form-control select2 {{ $errors->has('branch') ? 'is-invalid' : '' }}" name="branch_id" id="branch_id" required>
                    @foreach($branches as $id => $entry)
                        <option value="{{ $id }}" {{ old('branch_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('branch'))
                    <span class="text-danger">{{ $errors->first('branch') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.branch_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comment">{{ trans('cruds.appointment.fields.comment') }}</label>
                <input class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" type="text" name="comment" id="comment" value="{{ old('comment', '') }}">
                @if($errors->has('comment'))
                    <span class="text-danger">{{ $errors->first('comment') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.comment_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="other_service">{{ trans('cruds.appointment.fields.other_service') }}</label>
                <input class="form-control {{ $errors->has('other_service') ? 'is-invalid' : '' }}" type="number" name="other_service" id="other_service" value="{{ old('other_service', '') }}" step="0.01">
                @if($errors->has('other_service'))
                    <span class="text-danger">{{ $errors->first('other_service') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.appointment.fields.other_service_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_price">{{ trans('cruds.appointment.fields.total_price') }}</label>
                <input class="form-control {{ $errors->has('total_price') ? 'is-invalid' : '' }}" type="number" name="total_price" id="total_price" value="{{ old('total_price', '') }}" step="0.01">
                @if($errors->has('total_price'))
                    <span class="text-danger">{{ $errors->first('total_price') }}</span>
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



@endsection