@extends($themeLayout.'master')
@section('content')
    <div class="page-content">

        @include($themeLayout.'partials.breadcrumb')

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Permissions</h4>
            </div>

            @include($themeLayout.'partials.top-right-items')
        </div>

        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        Update Permission
                    </div>
                    <div class="card-body">

                        <x-noble-ui.alert type="success" :message="session('success')"/>

                        <form action="{{ route('admin.permissions.update', $permission) }}" method="post" class="forms-sample">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{ $permission->name }}" class="form-control @error('name') is-invalid @enderror" id="name" autocomplete="off"
                                       placeholder="Permission Name">

                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include($themeLayout.'permissions.list')

    </div>
@endsection