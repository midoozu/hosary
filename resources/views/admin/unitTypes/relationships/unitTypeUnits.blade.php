<div class="m-3">
    @can('unit_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.units.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.unit.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.unit.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-unitTypeUnits">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.unit.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.unit.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.unit.fields.unit_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.unit.fields.project') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.developer') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.location') }}
                            </th>
                            <th>
                                {{ trans('cruds.unit.fields.price') }}
                            </th>
                            <th>
                                {{ trans('cruds.unit.fields.unit_finish') }}
                            </th>
                            <th>
                                {{ trans('cruds.unit.fields.space') }}
                            </th>
                            <th>
                                {{ trans('cruds.unit.fields.delivery_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.unit.fields.unit_photo') }}
                            </th>
                            <th>
                                {{ trans('cruds.unit.fields.unit_no') }}
                            </th>
                            <th>
                                {{ trans('cruds.unit.fields.created_at') }}
                            </th>
                            <th>
                                {{ trans('cruds.unit.fields.updated_at') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($units as $key => $unit)
                            <tr data-entry-id="{{ $unit->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $unit->id ?? '' }}
                                </td>
                                <td>
                                    {{ $unit->name ?? '' }}
                                </td>
                                <td>
                                    {{ $unit->unit_type->name ?? '' }}
                                </td>
                                <td>
                                    {{ $unit->project->name ?? '' }}
                                </td>
                                <td>
                                    {{ $unit->project->developer ?? '' }}
                                </td>
                                <td>
                                    {{ $unit->project->location ?? '' }}
                                </td>
                                <td>
                                    {{ $unit->price ?? '' }}
                                </td>
                                <td>
                                    {{ $unit->unit_finish->name ?? '' }}
                                </td>
                                <td>
                                    {{ $unit->space ?? '' }}
                                </td>
                                <td>
                                    {{ $unit->delivery_date ?? '' }}
                                </td>
                                <td>
                                    @foreach($unit->unit_photo as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $unit->unit_no ?? '' }}
                                </td>
                                <td>
                                    {{ $unit->created_at ?? '' }}
                                </td>
                                <td>
                                    {{ $unit->updated_at ?? '' }}
                                </td>
                                <td>
                                    @can('unit_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.units.show', $unit->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('unit_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.units.edit', $unit->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('unit_delete')
                                        <form action="{{ route('admin.units.destroy', $unit->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('unit_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.units.massDestroy') }}",
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
  let table = $('.datatable-unitTypeUnits:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection