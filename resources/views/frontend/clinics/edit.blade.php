@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.clinic.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.clinics.update", [$clinic->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.clinic.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $clinic->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.clinic.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="services">{{ trans('cruds.clinic.fields.services') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="services[]" id="services" multiple>
                                @foreach($services as $id => $service)
                                    <option value="{{ $id }}" {{ (in_array($id, old('services', [])) || $clinic->services->contains($id)) ? 'selected' : '' }}>{{ $service }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('services'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('services') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.clinic.fields.services_helper') }}</span>
                        </div>
                        <div class="form-group">
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
@endsection