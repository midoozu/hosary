<div class="m-3">
    @can('project_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.projects.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.project.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.project.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-projectTypeProjects">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.project.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.developer') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.delivery_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.photo') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.gov') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.finish_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.commission') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.role_commission') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.commission_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.role_commission_amount') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.installment') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.location') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.countries') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.project_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.space') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.min_installment') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.istallment_years') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.created_at') }}
                            </th>
                            <th>
                                {{ trans('cruds.project.fields.updated_at') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $key => $project)
                            <tr data-entry-id="{{ $project->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $project->id ?? '' }}
                                </td>
                                <td>
                                    {{ $project->name ?? '' }}
                                </td>
                                <td>
                                    {{ $project->developer ?? '' }}
                                </td>
                                <td>
                                    {{ $project->delivery_date ?? '' }}
                                </td>
                                <td>
                                    @foreach($project->photo as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $project->gov->name ?? '' }}
                                </td>
                                <td>
                                    {{ $project->finish_type->name ?? '' }}
                                </td>
                                <td>
                                    {{ $project->commission ?? '' }}
                                </td>
                                <td>
                                    @foreach($project->role_commissions as $key => $item)
                                        <span class="badge badge-info">{{ $item->title }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $project->commission_type->name ?? '' }}
                                </td>
                                <td>
                                    {{ $project->role_commission_amount ?? '' }}
                                </td>
                                <td>
                                    @foreach($project->installments as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($project->locations as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $project->countries->name ?? '' }}
                                </td>
                                <td>
                                    {{ $project->project_type->name ?? '' }}
                                </td>
                                <td>
                                    {{ $project->space ?? '' }}
                                </td>
                                <td>
                                    {{ $project->min_installment ?? '' }}
                                </td>
                                <td>
                                    {{ $project->istallment_years ?? '' }}
                                </td>
                                <td>
                                    {{ $project->created_at ?? '' }}
                                </td>
                                <td>
                                    {{ $project->updated_at ?? '' }}
                                </td>
                                <td>
                                    @can('project_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.projects.show', $project->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('project_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.projects.edit', $project->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('project_delete')
                                        <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('project_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.projects.massDestroy') }}",
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
  let table = $('.datatable-projectTypeProjects:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection