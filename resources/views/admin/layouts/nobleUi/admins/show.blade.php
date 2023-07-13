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
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        Update Role
                    </div>
                    <div class="card-body">

                        <x-noble-ui.alert type="success" :message="session('success')"/>

                        <form action="{{ route('admin.admins.update', $admin) }}" method="post" class="forms-sample">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{ $admin->name }}" class="form-control @error('name') is-invalid @enderror" id="name" autocomplete="off"
                                       placeholder="Role Name">

                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <label for="name">Roles</label>
                            <div class="form-group">
                                @foreach($roles as $role)

                                    @php $checked = ''; @endphp

                                    @if(in_array($role,$selectedRoles,true))
                                        @php $checked = 'checked'; @endphp
                                    @endif

                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="roles[]" value="{{ $role }}" class="form-check-input" {{ $checked }} >
                                            {{ $role }}
                                            <i class="input-frame"></i></label>
                                    </div>

                                @endforeach

                            </div>

                            <div class="form-group">
                                <label for="name">Permissions</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" id="check-all-permission">
                                        Check All
                                        <i class="input-frame"></i></label>

                                    @if ($errors->has('permissions'))
                                        <span class="text-danger">{{ $errors->first('permissions') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row check-all-permission">

                                @foreach($permissionGroups as $permissionGroup => $permissions)
                                    <div class="col-12 col-md-6 col-xl-3 d-flex flex-wrap grid-margin">

                                        <div class="card flex-fill">

                                            <div class="card-header">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" onclick="checkAll('{{ $permissionGroup }}-group', this)">
                                                            Check All ({{ $permissionGroup }})
                                                            <i class="input-frame"></i></label>
                                                    </div>
                                                </div>
                                            </div> {{--card-header--}}

                                            <div class="card-body {{ $permissionGroup }}-group">
                                                <h5 class="card-title">{{ $permissionGroup }}</h5>
                                                @foreach($permissions as $permission)

                                                    @php $checked = ''; @endphp

                                                    @if(in_array($permission,$selectedPermission,true))
                                                        @php $checked = 'checked'; @endphp
                                                    @endif

                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" {{ $checked }} name="permissions[]" value="{{ $permission }}" class="form-check-input">
                                                            {{ $permission }}
                                                            <i class="input-frame"></i></label>
                                                    </div>

                                                @endforeach
                                            </div> {{--card-body--}}

                                        </div> {{--card--}}

                                    </div> {{--permission block--}}
                                @endforeach

                            </div> {{--row--}}

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include($themeLayout.'roles.list')

    </div>
@endsection

@push('script')

    <script type="text/javascript">

        $("#check-all-permission").click(function () {
            let classCheckBox = $('.check-all-permission' + ' input[type="checkbox"]');
            classCheckBox.prop('checked', $(this).is(':checked'));

        });

        function checkAll(permissionSet, checkThis) {
            let classCheckBox = $('.' + permissionSet + ' input[type="checkbox"]');
            classCheckBox.prop('checked', checkThis.checked);

            implementAllChecked();
        }

        function implementAllChecked() {
            let countPermissions = 93;
            let countPermissionGroups = 26;
            //  console.log((countPermissions + countPermissionGroups));
            //  console.log($('input[type="checkbox"]:checked').length);
            if ($('input[type="checkbox"]:checked').length >= (countPermissions + countPermissionGroups)) {
                $("#check-all-permission").prop('checked', true);
            } else {
                $("#check-all-permission").prop('checked', false);
            }
        }
    </script>

@endpush