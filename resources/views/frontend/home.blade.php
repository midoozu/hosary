@extends('layouts.frontend')
@section('content')

    <div class="row removable">

        @foreach($clinic_waiting as $clinic_name => $itsAppointment)
                    <div class="col-2">
                        <div class="card bg-dark text-white" >
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title text-white opacity-9">{{' انتظار '.$clinic_name}}</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users align-middle">
                                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="9" cy="7" r="4"></circle>
                                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3 text-white">{{$itsAppointment->count()}}</h1>
                            </div>
                        </div>
                    </div>
        @endforeach
                </div>
    <div>
    </div>
    <div class="container">

        <div class="row">
            <div class="col-12">
                <!-- Button trigger modal -->
               <div class="col-3" style="display: inline">

                   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addnew">
                       {{'اضافه حجز حالي'}}
                   </button>
                   <!-- Modal -->
                   <div class="modal fade addnewt" id="addnew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <div class="modal-dialog">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                               </div>
                               <div class="modal-body">
                                   <div class="container-fluid">
                                       <form method="POST" action="{{ route("frontend.appointments.store") }}" enctype="multipart/form-data">
                                           @method('POST')
                                           @csrf
                                           <div class="form-group">
                                               <label class="required" for="date">{{ trans('cruds.appointment.fields.date') }}</label>
                                               <input class="form-control datetime" type="text" name="date" id="date" value="{{ now() }}" readonly>
                                               @if($errors->has('date'))
                                                   <div class="invalid-feedback">
                                                       {{ $errors->first('date') }}
                                                   </div>
                                               @endif
                                               <span class="help-block">{{ trans('cruds.appointment.fields.date_helper') }}</span>
                                           </div>
                                           <div class="row">
                                               <div class="form-group col-md-6 ">
                                                   <label class="required" for="user_id">{{ 'كود الموظف' }}</label>
                                                   <input class="form-control"  name="user_id" id="user_id" value="{{ auth()->id() }}" readonly>
                                               </div>
                                               <div class="form-group col-md-6">
                                                   <label class="required" for="employee_id">{{ 'اسم الموظف' }}</label>
                                                   <select class="form-control " name="employee_id" id="employee_id" required>
                                                       <option value="{{ auth()->id() }}"  >{{ auth()->user()->name }}</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="row">
                                               <div class="form-group col-md-6">
                                                   <label for="customer_id">{{ 'رقم العميل' }}</label>
                                                   <input list="customer" id="customer_id" name="customer_id" class="form-control">
                                                   <datalist id="customer">
                                                       @foreach($customers as $id => $entry)
                                                           <option value="{{ $entry->id }}" >{{ $entry->phone }} {{$entry->first_name}}</option>
                                                       @endforeach
                                                   </datalist>

                                               </div>
                                               <div class="form-group col-md-6" >
                                                   <label for="">{{ 'اسم العميل' }}</label>
                                                   <input class="form-control"  name="customer_name" id="customer_name" value="">

                                               </div>
                                           </div>
                                           <div class="row">

                                               <div class="form-group col-md-6">
                                                   <label class="required" for="clinic_id">{{ trans('cruds.appointment.fields.clinic') }}</label>

                                                   <input list="clinic_list"  class="form-control" name="clinic_id" id="clinic_id" >
                                                   <datalist id="clinic_list">
                                                       @foreach($clinics as $id => $entry)
                                                           <option value="{{ $id }}" >{{ $entry }}</option>
                                                       @endforeach
                                                   </datalist>

                                               </div>

                                               <div class="form-group col-md-6">
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
                                           </div>
                                           <div class="form-group ">
                                               <label class="required" for="services">{{ trans('cruds.appointment.fields.service') }}</label>
                                               <div style="padding-bottom: 4px">
                                                   <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                                   <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                               </div>

                                               <div class="row">
                                                   <div class="col-12">
                                                       <select class="form-control select2" name="services[]" id="services" multiple required>
                                                           @foreach($services as $id => $service)
                                                               <option value="{{ $id }}" {{ in_array($id, old('services', [])) ? 'selected' : '' }}>{{ $service }}</option>
                                                           @endforeach
                                                       </select>
                                                   </div>
                                               </div>
                                               @if($errors->has('services'))
                                                   <div class="invalid-feedback">
                                                       {{ $errors->first('services') }}
                                                   </div>
                                               @endif
                                               <span class="help-block">{{ trans('cruds.appointment.fields.service_helper') }}</span>
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
                                               <input type="text" name="branch_id" id="branch_id" value="{{auth()->user()->branch->id}}" hidden>
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
                                           <div class="modal-footer">
                                               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                               <button type="button" class="btn btn-primary">{{'حفظ و طباعه'}}</button>

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

               </div>
               <div class="col-3" style="display: inline">
                   <a href="{{ route('frontend.appointments.index') }}" class="btn btn-success">{{'جميع الحجوزات'}}</a>

               </div>

            <div class="col-3" style="display: inline">
                <a href="{{ route('frontend.appointments.nextIndex') }}" class="btn btn-outline-danger">{{'الحجز القادم'}}</a>
            </div>

           <div class="col-3" style="display: inline">

               <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addnew">
                   {{'جرد مستهلكات'}}
               </button>
           </div>
                <div class="col-3" style="display: inline">
               <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addnew">
                   {{'استقبال مخزون'}}
               </button>
                </div>
                <div class="col-3" style="display: inline">
               <button type="button" class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#addnext">
                   {{'اضافه حجز قادم'}}
               </button>
               <div class="modal fade addnext" id="addnext" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                   <div class="modal-dialog">
                       <div class="modal-content">
                           <div class="modal-header">
                               <h5 class="modal-title" id="exampleModalLabel">اضافه حجز قادم </h5>
                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body  ">
                               <div class="container-fluid">
                                   <form method="POST" action="{{ route("frontend.appointments.next") }}" enctype="multipart/form-data">
                                       @method('POST')
                                       @csrf
                                       <div class="form-group">
                                           <label class="required" for="date">{{ trans('cruds.appointment.fields.date') }}</label>
                                           <input class="form-control datetime" type="text" name="date" id="date" value="{{ now() }}" required>
                                           @if($errors->has('date'))
                                               <div class="invalid-feedback">
                                                   {{ $errors->first('date') }}
                                               </div>
                                           @endif
                                           <span class="help-block">{{ trans('cruds.appointment.fields.date_helper') }}</span>
                                       </div>
                                       <div class="row">
                                           <div class="form-group col-md-6 ">
                                               <label class="required" for="user_id">{{ 'كود الموظف' }}</label>
                                               <input class="form-control"  name="user_id" id="user_id" value="{{ auth()->id() }}" readonly>
                                           </div>
                                           <div class="form-group col-md-6">
                                               <label class="required" for="employee_id">{{ 'اسم الموظف' }}</label>
                                               <select class="form-control " name="employee_id" id="employee_id" required>
                                                   <option value="{{ auth()->id() }}"  >{{ auth()->user()->name }}</option>
                                               </select>
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="form-group col-md-6">
                                               <label for="customer_id">{{ 'رقم العميل' }}</label>
                                               <input list="customer" id="customer_id" name="customer_id" class="form-control">
                                               <datalist id="customer">
                                                   @foreach($customers as $id => $entry)
                                                       <option value="{{ $entry->id }}" >{{ $entry->phone }} {{$entry->first_name}}</option>
                                                   @endforeach
                                               </datalist>
                                           </div>
                                           <div class="form-group col-md-6" >
                                               <label for="">{{ 'اسم العميل' }}</label>
                                               <input class="form-control"  name="customer_name" id="customer_name" value="">
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="form-group col-md-6">
                                               <label class="required" for="clinic_id">{{ trans('cruds.appointment.fields.clinic') }}</label>

                                               <input list="clinic_list"  class="form-control" name="clinic_id" id="clinic_id" >
                                               <datalist id="clinic_list">
                                                   @foreach($clinics as $id => $entry)
                                                       <option value="{{ $id }}" >{{ $entry }}</option>
                                                   @endforeach
                                               </datalist>
                                           </div>
                                           <div class="form-group col-md-6">
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
                                           <input type="text" name="branch_id" id="branch_id" value="{{auth()->user()->branch->id}}" hidden>
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
                                       <div class="row">

                                       </div>
                                       <div class="modal-footer">
                                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                </div>
            </div>
        </div>
    </div>

    <br>
                <div class="row removable">
                    <div class="col-12 col-lg-9 col-xxl-10 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <h5 class="card-title mb-0">{{'الحجز الحالي '}}</h5>
                            </div>
                            <div class="card-body">
                            <table class="table table-hover my-0  datatable datatable-Appointment "  >
                                <thead>
                                <tr >

                                    <th>
                                        {{ trans('cruds.appointment.fields.id') }}
                                    </th>

                                    <th>
                                        {{ trans('cruds.appointment.fields.customer') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.appointment.fields.clinic') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.appointment.fields.doctor') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.appointment.fields.service') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.appointment.fields.comment') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.appointment.fields.date') }}
                                    </th>
                                    <th>

                                    </th>
                                </tr>


                                <tr>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}" size="2">
                                    </td>

                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($customers as $key => $item)
                                                <option value="{{ $key }}">{{ $item->fisrt_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($clinics as $key => $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($doctors as $key => $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($services as $key => $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}" size="2">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}" size="8">
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($appointments as $key => $appointment)
                                    <tr data-entry-id="{{ $appointment->id }}">

                                        <td>
                                            {{ $appointment->id ?? '' }}
                                        </td>
                                        <td class="waiting">
                                            <a data-id="{{$appointment->id}}" href="#" class="addCart">{{ $appointment->customer->first_name ?? '' }}  </a>
                                        </td>
                                        <td>
                                            {{ $appointment->clinic->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $appointment->doctor->name ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($appointment->services as $key => $item)
                                                <span class="badge badge-info">{{ $item->name }}</span>
                                                <span class="badge badge-warning ">{{ count([$item]) }}</span>
                                                <span class="badge badge-success ">{{ $item->price }}</span>
                                            @endforeach
                                                <span class="badge badge-danger">{{ $appointment->total_price }}</span>
                                        </td>
                                        <td>
                                            {{ $appointment->comment ?? '' }}
                                        </td>
                                        <td>
                                            {{ $appointment->date ?? '' }}
                                        </td>
                                        <td>
                                            @can('appointment_show')
                                                <a class="fas fa-eye" href="{{ route('frontend.appointments.show', $appointment->id) }}">
                                                </a>
                                                <a class="fa fa-sign-out" aria-hidden="true" href="#" type="button"  data-bs-toggle="modal" data-bs-target="#exit-{{$appointment->id}}"></a>
                                                <div class="modal fade exit" id="exit-{{$appointment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">{{"خروج"}}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body  ">
                                                                <div class="container-fluid">

                                                                        <div class="row">
                                                                           <p> {{' هل تم استهلاك منتجات او تغير بالخدمات '}}</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <a class="btn btn-xs btn-info" href="{{ route('frontend.appointments.editandexit', $appointment->id) }}">
                                                                                {{ trans('global.edit') }}
                                                                            </a>

                                                                            <a class="btn btn-xs btn-danger" href="{{ route('frontend.appointments.exit', $appointment->id) }}">
                                                                                {{ 'خروج' }}
                                                                            </a>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a class="fas fa-print btn-outline-warning" href="{{ route('frontend.appointments.print')}}">
                                                </a>
                                            @endcan
                                            @can('appointment_edit')
                                                <a class="far fa-edit btn-outline-info" href="{{ route('frontend.appointments.edit', $appointment->id) }}">
                                                </a>
                                                @endcan
                                            @can('appointment_delete')
                                                    <a class="fas fa-trash-alt" href="{{ route('frontend.appointments.askfordelete', $appointment->id) }}" style="color: red"></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3 col-xxl-2 ">

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">{{'الحجز السابق'}}</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck align-middle">
                                                <rect x="1" y="3" width="15" height="13"></rect>
                                                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                                <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{$TotalPreviousAppointments}}</h1>
                                <div class="mb-0">
{{--                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>--}}
                                    <span class="text-muted">احمالي عدد الحجز المسبق</span>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title"> الدخل</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck align-middle">
                                                <rect x="1" y="3" width="15" height="13"></rect>
                                                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                                <circle cx="5.5" cy="18.5" r="2.5"></circle>units
                                                <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{$appointments->sum('total_price')}}</h1>
                                <div class="mb-0">
                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                                    <span class="text-muted">اجمالي تحصيل اليوم</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
@section('scripts')
    <script>
        $('#customer_id').on('keyup', function () {

            let customer_id = $(this).val();
            $.ajax({
                url: '{{route('frontend.appointments.getcustomername')}}',
                method: 'GET',
                data: {
                    'customer_id' : customer_id,

                },
                success: function (data) {
                    $('#customer_name').val(data.first_name);

                        $('#customer_name').attr('disabled', 'disabled');
                },
                error: function (){
                    $('#customer_name').attr('disabled', false);

                },
            });
        });

    </script>
    <script>

        $('#clinic_id').change(function () {

            var id = $('#clinic_id').val()
            var dataid={'id': id};

            $.ajax({
                type : 'GET',
                url: "{{ route('frontend.appointments.getdoctor') }}",
                data : dataid ,

                success:function (doctors){


                    select = '<select name="doctor_id" class="form-control input-sm " required id="doctor_id" >';
                    $.each(doctors, function(i,doctors)
                    {
                        select +='<option value="'+doctors.id+'">'+doctors.name +'</option>';
                    });
                    select += '</select>';

                    $("#doctor_id").html(select);
                    $("#doctor_id").prepend("<option value=''></option>").val('');
                    $('.select2-container').attr('width',60);

                }

            });
            $.ajax({
                type : 'GET',
                url: "{{ route('frontend.appointments.getservicename') }}",
                data : dataid ,


                success:function (services){

                    select = '<select name="services[]" class="form-control input-sm " required id="services" >';
                    $.each(services, function(i,services)
                    {
                        select +='<option value="'+services.id+'">'+services.name +'</option>';
                    });
                    select += '</select>';
                    $("#services").html(select);
                    $('.select2-container .select2-selection--multiple ').attr('width',60);
                }


            });
        });

    </script>

    <script>
    $( document ).ready(function() {
    $('.select2-container').width('100%')
    });
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

    $( '.addCart' ).click(function(e) {

        var id = $(this).attr('data-id');
        var dataid={'id': id};

        $.ajax({
            type : 'GET',
            url: "{{ route('frontend.appointments.getwaiting') }}",
            data : dataid ,

            success:function (waiting){

                Swal.fire(
                    'عدد الانتظار ',
                        waiting
                )
            }
        });

    });
    </script>

    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('appointment_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('frontend.appointments.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')

                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: { ids: ids, _method: 'DELETE' }})
                            .done(function () { location.reload() })
                    }
                }
            }
            dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            });
            let table = $('.datatable-Appointment:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

            let visibleColumnsIndexes = null;
            $('.datatable thead').on('input', '.search', function () {
                let strict = $(this).attr('strict') || false
                let value = strict && this.value ? "^" + this.value + "$" : this.value

                let index = $(this).parent().index()
                if (visibleColumnsIndexes !== null) {
                    index = visibleColumnsIndexes[index]
                }

                table
                    .column(index)
                    .search(value, strict)
                    .draw()
            });
            table.on('column-visibility.dt', function(e, settings, column, state) {
                visibleColumnsIndexes = []
                table.columns(":visible").every(function(colIdx) {
                    visibleColumnsIndexes.push(colIdx);
                });
            })
        })

    </script>
@endsection

