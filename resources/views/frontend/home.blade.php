@extends('layouts.frontend')
@section('content')

    <div class="row removable">
                    <div class="col-sm-3">
                        <div class="card bg-dark text-white">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title text-white opacity-9">{{'انتظار باطنه'}}</h5>
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
                                <h1 class="mt-1 mb-3 text-white">2.382</h1>
                                <div class="mb-0">
                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                                    <span class="text-white opacity-8">Since last week</span>
                                </div>
                            </div>
                        </div>


                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addnew">
                           {{'اضافه حجز جديد'}}
                        </button>
                        <!-- Modal -->
                        <div class="modal fade addnewt" id="addnew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body  ">
                                        <div class="container-fluid">
                                            <form method="POST" action="{{ route("frontend.appointments.store") }}" enctype="multipart/form-data">
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
                                                            @foreach($customers as $id => $entry)
                                                                @foreach($clinics as $id => $entry)
                                                                    <option value="{{ $id }}" >{{ $entry }}</option>
                                                                @endforeach
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

                                                  <div class="form-group col-md-6">
                                                      <label for="other_service">{{ trans('cruds.appointment.fields.other_service') }}</label>
                                                      <input class="form-control" type="number" name="other_service" id="other_service" value="{{ old('other_service', '') }}" step="0.01">
                                                      @if($errors->has('other_service'))

                                                          <div class="invalid-feedback">
                                                              {{ $errors->first('other_service') }}
                                                          </div>
                                                      @endif
                                                      <span class="help-block">{{ trans('cruds.appointment.fields.other_service_helper') }}</span>
                                                  </div>
                                                  <div class="form-group col-md-6">
                                                      <label for="total_price">{{ trans('cruds.appointment.fields.total_price') }}</label>
                                                      <input class="form-control" type="number" name="total_price" id="total_price" value="{{ old('total_price', '') }}" step="0.01">
                                                      @if($errors->has('total_price'))
                                                          <div class="invalid-feedback">
                                                              {{ $errors->first('total_price') }}
                                                          </div>
                                                      @endif
                                                      <span class="help-block">{{ trans('cruds.appointment.fields.total_price_helper') }}</span>
                                                  </div>
                                              </div>
                                                <div class="form-group">
                                                    <button class="btn btn-danger" type="submit">
                                                        {{ trans('global.save') }}
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card bg-dark text-white">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title text-white opacity-9">Visitors</h5>
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
                                <h1 class="mt-1 mb-3 text-white">14.212</h1>
                                <div class="mb-0">
                                    <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.25% </span>
                                    <span class="text-white opacity-8">Since last week</span>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Launch demo modal
                        </button>
                    </div>
                    <div class="col-sm-3">
                        <div class="card bg-dark text-white">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title text-white opacity-9">Earnings</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign align-middle">
                                                <line x1="12" y1="1" x2="12" y2="23"></line>
                                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3 text-white">$21.300</h1>
                                <div class="mb-0">
                                    <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 6.65% </span>
                                    <span class="text-white opacity-8">Since last week</span>
                                </div>
                            </div>
                        </div>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            {{'اضافه حجز'}}
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card bg-dark text-white">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title text-white opacity-9">Orders</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart align-middle">
                                                <circle cx="9" cy="21" r="1"></circle>
                                                <circle cx="20" cy="21" r="1"></circle>
                                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3 text-white">64</h1>
                                <div class="mb-0">
                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.25% </span>
                                    <span class="text-white opacity-8">Since last week</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row removable">
                    <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">

                                <h5 class="card-title mb-0">Latest Projects</h5>
                            </div>
                            <table class="table table-hover my-0">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="d-none d-xl-table-cell">Start Date</th>
                                    <th class="d-none d-xl-table-cell">End Date</th>
                                    <th>Status</th>
                                    <th class="d-none d-md-table-cell">Assignee</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Project Apollo</td>
                                    <td class="d-none d-xl-table-cell">01/01/2021</td>
                                    <td class="d-none d-xl-table-cell">31/06/2021</td>
                                    <td><span class="badge bg-success">Done</span></td>
                                    <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                                </tr>
                                <tr>
                                    <td>Project Fireball</td>
                                    <td class="d-none d-xl-table-cell">01/01/2021</td>
                                    <td class="d-none d-xl-table-cell">31/06/2021</td>
                                    <td><span class="badge bg-danger">Cancelled</span></td>
                                    <td class="d-none d-md-table-cell">William Harris</td>
                                </tr>
                                <tr>
                                    <td>Project Hades</td>
                                    <td class="d-none d-xl-table-cell">01/01/2021</td>
                                    <td class="d-none d-xl-table-cell">31/06/2021</td>
                                    <td><span class="badge bg-success">Done</span></td>
                                    <td class="d-none d-md-table-cell">Sharon Lessman</td>
                                </tr>
                                <tr>
                                    <td>Project Nitro</td>
                                    <td class="d-none d-xl-table-cell">01/01/2021</td>
                                    <td class="d-none d-xl-table-cell">31/06/2021</td>
                                    <td><span class="badge bg-warning">In progress</span></td>
                                    <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                                </tr>
                                <tr>
                                    <td>Project Phoenix</td>
                                    <td class="d-none d-xl-table-cell">01/01/2021</td>
                                    <td class="d-none d-xl-table-cell">31/06/2021</td>
                                    <td><span class="badge bg-success">Done</span></td>
                                    <td class="d-none d-md-table-cell">William Harris</td>
                                </tr>
                                <tr>
                                    <td>Project X</td>
                                    <td class="d-none d-xl-table-cell">01/01/2021</td>
                                    <td class="d-none d-xl-table-cell">31/06/2021</td>
                                    <td><span class="badge bg-success">Done</span></td>
                                    <td class="d-none d-md-table-cell">Sharon Lessman</td>
                                </tr>
                                <tr>
                                    <td>Project Romeo</td>
                                    <td class="d-none d-xl-table-cell">01/01/2021</td>
                                    <td class="d-none d-xl-table-cell">31/06/2021</td>
                                    <td><span class="badge bg-success">Done</span></td>
                                    <td class="d-none d-md-table-cell">Christina Mason</td>
                                </tr>
                                <tr>
                                    <td>Project Wombat</td>
                                    <td class="d-none d-xl-table-cell">01/01/2021</td>
                                    <td class="d-none d-xl-table-cell">31/06/2021</td>
                                    <td><span class="badge bg-warning">In progress</span></td>
                                    <td class="d-none d-md-table-cell">William Harris</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-xxl-3 d-flex">

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Sales</h5>
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
                                <h1 class="mt-1 mb-3">2.382</h1>
                                <div class="mb-0">
                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                                    <span class="text-muted">Since last week</span>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Sales</h5>
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
                                <h1 class="mt-1 mb-3">2.382</h1>
                                <div class="mb-0">
                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                                    <span class="text-muted">Since last week</span>
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
                }

            });
        });

    </script>

@endsection
