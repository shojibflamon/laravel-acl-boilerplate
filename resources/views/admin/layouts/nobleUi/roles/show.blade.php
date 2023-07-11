@extends($themeLayout.'master')
@section('content')
    <div class="page-content">

        @include($themeLayout.'partials.breadcrumb')

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Roles</h4>
            </div>

            @include($themeLayout.'partials.top-right-items')
        </div>

        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        Update Role
                    </div>
                    <div class="card-body">

                        <x-noble-ui.alert type="success" :message="session('success')"/>

                        <form action="{{ route('admin.roles.update', $role) }}" method="post" class="forms-sample">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{ $role->name }}" class="form-control @error('name') is-invalid @enderror" id="name" autocomplete="off"
                                       placeholder="Role Name">

                                Attached Permissions:
                                @if($role->permissions)
                                    @foreach($role->permissions as $permission)
                                        <span>{{ $permission->name }}</span>
                                    @endforeach
                                @endif

                                <div class="mb-3">
                                    <label for="permissions" class="form-label">Select Permission</label>
                                    <select name="selectedPermission" class="form-select" id="permissions">
                                        <option selected="" disabled="">Select your permission</option
                                        @foreach($permissions as $permission)
                                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                        @endforeach

                                    </select>
                                </div>


                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include($themeLayout.'roles.list')

    </div>
@endsection