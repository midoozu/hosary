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
                    <form method="POST" action="{{ route("frontend.appointments.store_next_appointment") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group col-3 " style="display: inline-block">
                            <label class="required" for="employee_id">{{ trans('cruds.appointment.fields.employee') }}</label>
                            <select class="form-control select2" name="employee_id" id="employee_id" >
                                    <option value="{{ auth()->id() }}" >{{ auth()->user()->name }}</option>
                            </select>
                            @if($errors->has('employee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('employee') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.employee_helper') }}</span>
                        </div>
                        <div class="form-group col-3 " style="display: inline-block">
                            <label class="required" for="date">{{ trans('cruds.appointment.fields.date') }}</label>
                            <input class="form-control datetime" type="text" name="date" id="date" value="{{ now() }}" readonly>
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group col-3 " style="display: inline-block">
                            <label for="customer_id">{{ trans('cruds.appointment.fields.customer') }}</label>

                            <input  class="form-control" type="text" name="customer_id" value="{{ $appointment->customer->id }}" id="customer_id"  readonly>
                            @if($errors->has('customer'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('customer') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.customer_helper') }}</span>
                        </div>
                        <div class="form-group col-3 " style="display: inline-block">
                            <label for="company_id">{{ trans('cruds.appointment.fields.company') }}</label>
                            <select class="form-control select2" name="company_id" id="company_id">
                                @foreach($companies as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('company_id') ? old('company_id') : $appointment->company->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('company'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.company_helper') }}</span>
                        </div>
                        <div class="form-group col-3 " style="display: inline-block">
                            <label class="required" for="doctor_id">{{ trans('cruds.appointment.fields.doctor') }}</label>
                            <select class="form-control select2" name="doctor_id" id="doctor_id" required>
                                @foreach($doctors as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('doctor_id') ? old('doctor_id') : $appointment->doctor->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('doctor'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('doctor') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.doctor_helper') }}</span>
                        </div>
                        <div class="form-group col-3 " style="display: inline-block">
                            <label class="required" for="clinic_id">{{ trans('cruds.appointment.fields.clinic') }}</label>
                            <select class="form-control select2" name="clinic_id" id="clinic_id" required>
                                @foreach($clinics as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('clinic_id') ? old('clinic_id') : $appointment->clinic->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('clinic'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('clinic') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.clinic_helper') }}</span>
                        </div>
                        <div class="form-group col-3 " style="display: inline-block">
                            <label class="required" for="services">{{ trans('cruds.appointment.fields.service') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="services[]" id="services" multiple required>
                                @foreach($services as $id => $service)
                                    <option value="{{ $id }}" >{{ $service }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('services'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('services') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.service_helper') }}</span>
                        </div>
                        <div class="form-group col-3 " style="display:none">
                            <div>
                                <input type="hidden" name="check_out" value="1">
{{--                                <input type="checkbox" name="check_out" id="check_out" value="1" {{ $appointment->check_out || old('check_out', 0) === 1 ? 'checked' : '' }}>--}}
{{--                                <label for="check_out">{{ trans('cruds.appointment.fields.check_out') }}</label>--}}
                            </div>
                            @if($errors->has('check_out'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('check_out') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.check_out_helper') }}</span>
                        </div>

                        <div class="form-group col-3 " style="display: inline-block">
                            <label class="required" for="branch_id">{{ trans('cruds.appointment.fields.branch') }}</label>
                            <select class="form-control select2" name="branch_id" id="branch_id" required>
                                    <option value="{{ auth()->user()->branch->id }}" {{ (old('branch_id') ? old('branch_id') : $appointment->branch->id ?? '') == $id ? 'selected' : '' }}>{{ auth()->user()->branch->name }}</option>
                            </select>
                            @if($errors->has('branch'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('branch') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.branch_helper') }}</span>
                        </div>
                        <div class="form-group col-3 " style="display: inline-block">
                            <label for="comment">{{ trans('cruds.appointment.fields.comment') }}</label>
                            <input class="form-control" type="text" name="comment" id="comment" value="{{ old('comment', $appointment->comment) }}">
                            @if($errors->has('comment'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('comment') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.comment_helper') }}</span>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="other_service">{{ 'خدمات اضافيه' }}</label>
                                <input class="form-control" type="number" name="other_service" id="other_service" value="{{ old('other_service', '') }}" step="0.01">
                                @if($errors->has('other_service'))

                                    <div class="invalid-feedback">
                                        {{ $errors->first('other_service') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.appointment.fields.other_service_helper') }}</span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="discount">{{ 'خصم' }}</label>
                                <input class="form-control" type="number" name="discount" id="discount" value="{{ old('other_service', '') }}" step="0.01">
                                @if($errors->has('other_service'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('other_service') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.appointment.fields.other_service_helper') }}</span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="dr_supplies">{{ 'مستلزمات الدكتور' }}</label>
                                <input class="form-control" type="number" name="dr_supplies" id="dr_supplies" value="{{ old('total_price', '') }}" step="0.01">
                                @if($errors->has('total_price'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('total_price') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.appointment.fields.total_price_helper') }}</span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="clinic_supplies">{{ 'مستلزمات العياده' }}</label>
                                <input class="form-control" type="number" name="clinic_supplies" id="dr_supplies" value="{{ old('clinic_supplies', '') }}" step="0.01">
                                @if($errors->has('clinic_supplies'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('clinic_supplies') }}
                                    </div>
                                @endif
                            </div>
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
