@extends('layouts.frontend')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.appointment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table  class=" table table-bordered table-striped table-hover datatable datatable-Appointment" >
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.employee') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.customer') }}
                        </th>

                        <th>
                            {{ trans('cruds.appointment.fields.company') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.doctor') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.clinic') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.service') }}
                        </th>

                        <th>
                            {{ trans('cruds.appointment.fields.product') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.branch') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.comment') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.other_service') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.total_price') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.created_at') }}
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($users as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($crm_customers as $key => $item)
                                    <option value="{{ $item->first_name }}">{{ $item->first_name }}</option>
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
                                @foreach($services as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>

                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($products as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($branches as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $key => $appointment)
                        <tr data-entry-id="{{ $appointment->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $appointment->id ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->employee->name ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->date ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->customer->first_name ?? '' }}
                            </td>

                            <td>
                                {{ $appointment->company->name ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->doctor->name ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->clinic->name ?? '' }}
                            </td>
                            <td>
                                @foreach($appointment->services as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>

                            <td>
                                @foreach($appointment->products as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $appointment->branch->name ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->comment ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->other_service ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->total_price ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->created_at ?? '' }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="4" style="text-align:right">Total:</th>

                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
      footerCallback: function (row, data, start, end, display) {
          var api = this.api();

          // Remove the formatting to get integer data for summation
          var intVal = function (i) {
              return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
          };

          // Total over all pages
          total = api
              .column(1)
              .data()
              .reduce(function (a, b) {
                  return intVal(a) + intVal(b);
              }, 0);

          // Total over this page
          pageTotal = api
              .column(1, { page: 'current' })
              .data()
              .reduce(function (a, b) {
                  return intVal(a) + intVal(b);
              }, 0);

          // Update footer
          $(api.column(1).footer()).html('$' + pageTotal + ' ( $' + total + ' total)');
      },
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
