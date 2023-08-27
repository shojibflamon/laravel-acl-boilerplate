<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                @lang('Create New Role')
            </div>

            <div class="card-body">

                <x-noble-ui.alert type="success" :message="session('success')"/>

                <form action="{{ route('admin.roles.store') }}" method="post" class="forms-sample">
                    @csrf

                    <div class="form-group">
                        <label for="name">@lang('Name')</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="name" autocomplete="off"
                               placeholder="Role Name">

                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="name">@lang('Permissions')</label>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" id="check-all-permission">
                                @lang('Check All')
                                <i class="input-frame"></i></label>

                            @if ($errors->has('permissions'))
                                <span class="text-danger">{{ $errors->first('permissions') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="row">

                        @foreach($permissionGroups as $permissionGroup => $permissions)
                            <div class="col-12 col-md-6 col-xl-3 d-flex flex-wrap grid-margin">

                                <div class="card flex-fill">

                                    <div class="card-header">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" onclick="checkAll('{{ $permissionGroup }}-group', this)">
                                                    @lang('Check All') ({{ $permissionGroup }})
                                                    <i class="input-frame"></i></label>
                                            </div>
                                        </div>
                                    </div> {{--card-header--}}

                                    <div class="card-body {{ $permissionGroup }}-group">
                                        <h5 class="card-title">{{ $permissionGroup }}</h5>
                                        @foreach($permissions as $permission)

                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" name="permissions[]" value="{{ $permission }}" class="form-check-input">
                                                    {{ $permission }}
                                                    <i class="input-frame"></i></label>
                                            </div>

                                        @endforeach
                                    </div> {{--card-body--}}

                                </div> {{--card--}}

                            </div> {{--permission block--}}
                        @endforeach

                    </div> {{--row--}}

                    <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                </form>

            </div>

            <div class="card-footer text-right text-muted">
                Last updated 2 min ago.
            </div>
        </div>
    </div>
</div>

@push('script')

    <script type="text/javascript">

        $("#check-all-permission").click(function () {
            $('input[type=checkbox]').prop('checked', $(this).is(':checked'));
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