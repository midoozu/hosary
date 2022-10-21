@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('appointment_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.appointments.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.appointment.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'Appointment', 'route' => 'admin.appointments.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.appointment.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Appointment">
                            <thead>
                                <tr>
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
                                        {{ trans('cruds.crmCustomer.fields.phone') }}
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
                                        {{ trans('cruds.appointment.fields.check_out') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.appointment.fields.pulse_counter') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.appointment.fields.used_pulse') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.appointment.fields.device_pulse') }}
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
                                    <th>
                                        {{ trans('cruds.appointment.fields.updated_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.appointment.fields.deleted_at') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}" size="2">
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
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}" size="12">
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

                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}" size="4">
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
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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
                                            {{ $appointment->customer->phone ?? '' }}
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
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $appointment->check_out ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $appointment->check_out ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $appointment->pulse_counter ?? '' }}
                                        </td>
                                        <td>
                                            {{ $appointment->used_pulse ?? '' }}
                                        </td>
                                        <td>
                                            {{ $appointment->device_pulse ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($appointment->products as $key => $item)
                                                <span>{{ $item->name }}</span>
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
                                        <td>
                                            {{ $appointment->updated_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $appointment->deleted_at ?? '' }}
                                        </td>
                                        <td>
                                            @can('appointment_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.appointments.show', $appointment->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('appointment_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.appointments.edit', $appointment->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('appointment_delete')
                                                <form action="{{ route('frontend.appointments.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
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
