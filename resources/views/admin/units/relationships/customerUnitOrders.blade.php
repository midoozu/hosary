<div class="m-3">
    @can('order_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.orders.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.order.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.order.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-customerUnitOrders">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.order.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.order.fields.customer') }}
                            </th>
                            <th>
                                {{ trans('cruds.order.fields.customer_phone') }}
                            </th>
                            <th>
                                {{ trans('cruds.order.fields.customer_phone_2') }}
                            </th>
                            <th>
                                {{ trans('cruds.order.fields.customer_page') }}
                            </th>
                            <th>
                                {{ trans('cruds.order.fields.project') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.developer') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.delivery_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.order.fields.customer_unit') }}
                            </th>
                            <th>
                                {{ trans('cruds.unit.fields.price') }}
                            </th>
                            <th>
                                {{ trans('cruds.unit.fields.space') }}
                            </th>
                            <th>
                                {{ trans('cruds.unit.fields.delivery_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.unit.fields.unit_no') }}
                            </th>
                            <th>
                                {{ trans('cruds.order.fields.order_status') }}
                            </th>
                            <th>
                                {{ trans('cruds.order.fields.commission') }}
                            </th>
                            <th>
                                {{ trans('cruds.order.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.order.fields.available_units') }}
                            </th>
                            <th>
                                {{ trans('cruds.order.fields.created_at') }}
                            </th>
                            <th>
                                {{ trans('cruds.order.fields.notes_sales') }}
                            </th>
                            <th>
                                {{ trans('cruds.order.fields.updated_at') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $key => $order)
                            <tr data-entry-id="{{ $order->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $order->id ?? '' }}
                                </td>
                                <td>
                                    {{ $order->customer ?? '' }}
                                </td>
                                <td>
                                    {{ $order->customer_phone ?? '' }}
                                </td>
                                <td>
                                    {{ $order->customer_phone_2 ?? '' }}
                                </td>
                                <td>
                                    {{ $order->customer_page ?? '' }}
                                </td>
                                <td>
                                    {{ $order->project->name ?? '' }}
                                </td>
                                <td>
                                    {{ $order->project->developer ?? '' }}
                                </td>
                                <td>
                                    {{ $order->project->delivery_date ?? '' }}
                                </td>
                                <td>
                                    {{ $order->customer_unit->name ?? '' }}
                                </td>
                                <td>
                                    {{ $order->customer_unit->price ?? '' }}
                                </td>
                                <td>
                                    {{ $order->customer_unit->space ?? '' }}
                                </td>
                                <td>
                                    {{ $order->customer_unit->delivery_date ?? '' }}
                                </td>
                                <td>
                                    {{ $order->customer_unit->unit_no ?? '' }}
                                </td>
                                <td>
                                    {{ $order->order_status->status ?? '' }}
                                </td>
                                <td>
                                    {{ $order->commission ?? '' }}
                                </td>
                                <td>
                                    {{ $order->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $order->available_units ?? '' }}
                                </td>
                                <td>
                                    {{ $order->created_at ?? '' }}
                                </td>
                                <td>
                                    {{ $order->notes_sales ?? '' }}
                                </td>
                                <td>
                                    {{ $order->updated_at ?? '' }}
                                </td>
                                <td>
                                    @can('order_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.orders.show', $order->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('order_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.orders.edit', $order->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('order_delete')
                                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('order_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.orders.massDestroy') }}",
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
  let table = $('.datatable-customerUnitOrders:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection