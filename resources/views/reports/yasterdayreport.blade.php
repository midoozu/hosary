@extends('layouts.frontend')
@section('content')

    <div class="card">
        <div class="card-header">
          {{'اجمالي لا يشمل مستلزمات الطبيب '}}  {{ ' تقرير اليوميه' }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table  class=" table table-bordered table-striped table-hover datatable datatable-Appointment" >
                    <thead>
                    <tr>
                        <th width="10">

                        </th>

                        <th>
                            {{ trans('cruds.appointment.fields.employee') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.doctor') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.clinic') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.company') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.service') }}
                        </th>
                        <th>
                            {{' اجمالي الخدمات '}}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.other_service') }}
                        </th>
                        <th>
                            {{ 'خصم' }}
                        </th>
                        <th>
                            {{ 'مستلزمات الدكتور '}}
                        </th>
                        <th>
                            {{ 'مستلزمات العياده '}}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.total_price') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.comment') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.branch') }}
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($users as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td >
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}" >
                        </td>
                        <td>
                            <input  type="text" size="2">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($doctors as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($clinics as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($companies as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($services as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($branches as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($appointments as $key => $appointment)

                        <tr data-entry-id="{{ $appointment->id }}"  class="change">
                            <td>

                            </td>
                            <td>
                                {{ $appointment->employee->name ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->date ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->id ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->doctor->name ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->clinic->name ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->company->name ?? '' }}
                            </td>
                            <td>
                                @foreach($appointment->services as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                    <span class="badge badge-danger">{{ $item->price }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{$appointment->services->sum('price') }}
                            </td>
                            <td>
                                {{ $appointment->other_service ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->discount ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->dr_supplies ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->clinic_supplies  ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->total_price -$appointment->dr_supplies ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->comment ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->branch->name ?? '' }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="color: red"></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


@endsection
@section('scripts')

    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.11.5/api/sum().js"></script>
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 100,
                //     footerCallback: function (row, data, start, end, display) {
                //         var api = this.api();
                //
                //         // Remove the formatting to get integer data for summation
                //         var intVal = function (i) {
                //             return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                //         };
                //
                //         // Total over all pages
                //         total = api
                //             .column(1)
                //             .data()
                //             .reduce(function (a, b) {
                //                 return intVal(a) + intVal(b);
                //             }, 0);
                //
                //         // Total over this page
                //         pageTotal = api
                //             .column(1, { page: 'current' })
                //             .data()
                //             .reduce(function (a, b) {
                //                 return intVal(a) + intVal(b);
                //             }, 0);
                //
                //         // Update footer
                //         $(api.column(1).footer()).html('$' + pageTotal + ' ( $' + total + ' total)');
                //     },



                drawCallback: function () {
                    var api = this.api();
                    var sum = 0;
                    var formated = 0;
                    //to show first th
                    $(api.column(0).footer()).html('Total');


                    for(var i=8; i<=14;i++)
                    {
                        sum = api.column(i, {page:'current'}).data().sum();

                        //to format this sum
                        formated = parseFloat(sum).toLocaleString(undefined, {minimumFractionDigits:2});
                        $(api.column(i).footer()).html(formated);
                    }

                }


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
