@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('appointment_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
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
                                        {{ trans('cruds.appointment.fields.branch') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.appointment.fields.comment') }}
                                    </th>

                                    <th>
                                        &nbsp;
                                    </th>
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

                                        <td>
                                            {{ $appointment->branch->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $appointment->comment ?? '' }}
                                        </td>

                                        <td>
                                            @if($appointment->pending_delete !== 1 )
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.appointments.next_transfer', $appointment->id) }}">
                                                    {{ 'تحويل للحالي ' }}
                                                </a>
@endif
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
