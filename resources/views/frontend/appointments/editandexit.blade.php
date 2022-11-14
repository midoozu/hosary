@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.appointment.title_singular') }} -- {{$appointment->customer->first_name}}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.appointments.exitupdate", [$appointment->id]) }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group col-3 " style="display: inline-block">
                            <label class="required" for="employee_id">{{ trans('cruds.appointment.fields.employee') }}</label>
                            <input  class="form-control" type="text" value="{{ auth()->id() }}" {{ auth()->user()->name }}  name="employee_id" id="employee_id" readonly>
                            @if($errors->has('employee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('employee') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.employee_helper') }}</span>
                        </div>
                        <div class="form-group col-3 " style="display: inline-block">
                            <label class="required" for="date">{{ trans('cruds.appointment.fields.date') }}</label>
                            <input class="form-control datetime" type="text" name="date" id="date" value="{{ old('date', $appointment->date) }}" readonly>
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group col-3 " style="display: inline-block">
                            <label for="customer_id">{{ trans('cruds.appointment.fields.customer') }}</label>
                            <input type="text" class="form-control" value="{{$appointment->customer->id}}" {{$appointment->customer->first_name}}  name="customer_id" id="customer_id" readonly>

                            @if($errors->has('customer'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('customer') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.customer_helper') }}</span>
                        </div>
                        <div class="form-group col-3 " style="display: inline-block">
                            <label for="company_id">{{ trans('cruds.appointment.fields.company') }}</label>
                            <input class="form-control" type="text" value="{{$appointment->company->id ?? '' }}" {{$appointment->company->id ?? ''}} name="company_id" id="company_id" readonly>
                            @if($errors->has('company'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.company_helper') }}</span>
                        </div>
                        <div class="form-group col-3 " style="display: inline-block">
                            <label class="required" for="doctor_id">{{ trans('cruds.appointment.fields.doctor') }}</label>
                            <input  class="form-control" type="text" value="{{$appointment->doctor->name}}" readonly>
                            @if($errors->has('doctor'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('doctor') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.doctor_helper') }}</span>
                        </div>
                        <div class="form-group col-3 " style="display: inline-block">
                            <label class="required" for="clinic_id">{{ trans('cruds.appointment.fields.clinic') }}</label>
                            <input  class="form-control" type="text"value="{{$appointment->clinic->name}} "  readonly>
                            @if($errors->has('clinic'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('clinic') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.clinic_helper') }}</span>
                        </div>
                        <div class="form-group col-3 " style="display: inline-block">
                            <label class="required" for="branch_id">{{ trans('cruds.appointment.fields.branch') }}</label>
                            <input  class="form-control" type="text" value="{{auth()->user()->branch->name}} " name="branch_id" readonly>
                            @if($errors->has('branch'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('branch') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.branch_helper') }}</span>
                        </div>
                        <div class="form-group col-3 " style="display: inline-block">
                            <label class="required " for="services">{{ 'خدمات مسبقه لا يمكن تغيرها' }}</label>

                            <select class="form-control select2" name="services[]" id="services" multiple disabled>
                                @foreach($services as $id => $service)
                                    <option value="{{ $id }}" {{ (in_array($id, old('services', [])) || $appointment->services->contains($id)) ? 'selected' : '' }}>{{ $service }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('services'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('services') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.service_helper') }}</span>
                        </div>
                        <div class="form-group col-3 " style="display: inline-block">
                            <label class="required " for="services">{{ ' اضافه خدمه جديده فقط' }}</label>

                            <select class="form-control calservice select2" name="services[]" id="services" multiple >
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

                @if($appointment->services->contains(4))
                            <div class="form-group col-3 " style="display: inline-block">
                                <label for="pulse_counter">{{ trans('cruds.appointment.fields.pulse_counter') }}</label>
                                <input class="form-control" type="number" name="pulse_counter" id="pulse_counter" value="{{ old('pulse_counter', $appointment->pulse_counter) }}" step="1">
                                @if($errors->has('pulse_counter'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('pulse_counter') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.appointment.fields.pulse_counter_helper') }}</span>
                            </div>
                            <div class="form-group col-3 " style="display: inline-block">
                                <label for="device_pulse">{{ trans('cruds.appointment.fields.device_pulse') }}</label>
                                <input class="form-control" type="number" name="device_pulse" id="device_pulse" value="{{ old('device_pulse', $appointment->device_pulse) }}" step="1">
                                @if($errors->has('device_pulse'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('device_pulse') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.appointment.fields.device_pulse_helper') }}</span>
                            </div>
                            <div class="form-group col-3 " style="display: inline-block">
                                <label for="used_pulse">{{ trans('cruds.appointment.fields.used_pulse') }}</label>
                                <input class="form-control" type="number" name="used_pulse" id="used_pulse" value="{{ old('used_pulse', $appointment->used_pulse) }}" step="1">
                                @if($errors->has('used_pulse'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('used_pulse') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.appointment.fields.used_pulse_helper') }}</span>
                            </div>
                        @endif

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

                        <div class="form-group col-md-3" style="display: inline-block" >
                            <label for="other_service">{{ 'خدمات اضافيه' }}</label>
                            <input class="form-control calc " type="number" name="other_service" id="other_service" value="{{ $appointment->other_service ?? '' }}" step="0.01">
                            @if($errors->has('other_service'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('other_service') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.other_service_helper') }}</span>
                        </div>

                        <div class="form-group col-md-3" style="display: inline-block">
                            <label for="discount">{{ 'خصم' }}</label>
                            <input class="form-control calc " type="number" name="discount" id="discount" value="{{ $appointment->discount ?? '' }}" step="0.01">
                            @if($errors->has('other_service'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('other_service') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.other_service_helper') }}</span>
                        </div>
                        <div class="form-group col-md-3" style="display: inline-block">
                            <label for="dr_supplies">{{ 'مستلزمات الدكتور' }}</label>
                            <input class="form-control calc " type="number" name="dr_supplies" id="dr_supplies" value="{{$appointment->dr_supplies }}" step="0.01">
                            @if($errors->has('total_price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.total_price_helper') }}</span>
                        </div>
                        <div class="form-group col-md-3" style="display: inline-block" >
                            <label for="clinic_supplies">{{ 'مستلزمات العياده' }}</label>
                            <input class="form-control calc " type="number" name="clinic_supplies" id="clinic_supplies" value="{{ $appointment->clinic_supplies }}" step="0.01">
                            @if($errors->has('clinic_supplies'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('clinic_supplies') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-3 " style="display: inline-block">
                            <label for="total_price">{{ trans('cruds.appointment.fields.total_price') }}</label>
                            <input class="form-control" type="number" name="total_price" id="total_price" value="{{ old('total_price', $appointment->total_price) }}" step="0.01">
                            @if($errors->has('total_price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointment.fields.total_price_helper') }}</span>
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
@section('scripts')
    @parent

    <script>
$(document).ready(function (){


        $(".calservice").select2();
        $(".calservice").on("click", function () {
            $(".calservice").prop("disabled", true);
        });

})
    </script>
@endsection


