<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                Create New Role
            </div>

            <div class="card-body">

                <x-noble-ui.alert type="success" :message="session('success')"/>

                <form action="{{ route('admin.roles.store') }}" method="post" class="forms-sample">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="name" autocomplete="off"
                               placeholder="Role Name">

                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="name">Permissions</label>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" id="checkPermissionAll">
                                Check All
                                <i class="input-frame"></i></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 col-xl-3 d-flex flex-wrap">

                            <div class="card flex-fill">

                                <div class="card-header">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" onclick="checkAll('permissionSet-1', this)">
                                                Check All
                                                <i class="input-frame"></i></label>
                                        </div>
                                    </div>
                                </div> {{--card-header--}}

                                <div class="card-body permissionSet-1">
                                    <h5 class="card-title">Orders</h5>
                                    @foreach($permissions as $permission)
                                        @php
                                            $name = explode('-',$permission->name)[0];
                                        @endphp
                                        @if ($name === 'Order')
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="form-check-input">
                                                    {{ $permission->name }}
                                                    <i class="input-frame"></i></label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div> {{--card-body--}}

                            </div> {{--card--}}

                        </div> {{--permission block--}}


                        <div class="col-12 col-md-6 col-xl-3 d-flex flex-wrap">

                            <div class="card flex-fill">

                                <div class="card-header">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" onclick="checkAll('permissionSet-2', this)">
                                                Check All Permissions
                                                <i class="input-frame"></i></label>
                                        </div>
                                    </div>
                                </div> {{--card-header--}}

                                <div class="card-body permissionSet-2">
                                    <h5 class="card-title">Categories</h5>
                                    @foreach($permissions as $permission)
                                        @php
                                            $name = explode('-',$permission->name)[0];
                                        @endphp
                                        @if ($name === 'Category')
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="form-check-input">
                                                    {{ $permission->name }}
                                                    <i class="input-frame"></i></label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div> {{--card-body--}}

                            </div> {{--card--}}

                        </div> {{--permission block--}}


                        <div class="col-12 col-md-6 col-xl-3 d-flex flex-wrap">

                            <div class="card flex-fill">

                                <div class="card-header">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" onclick="checkAll('permissionSet-3', this)">
                                                Check All Permissions
                                                <i class="input-frame"></i></label>
                                        </div>
                                    </div>
                                </div> {{--card-header--}}

                                <div class="card-body permissionSet-3">
                                    <h5 class="card-title">Notifications</h5>
                                    @foreach($permissions as $permission)
                                        @php
                                            $name = explode('-',$permission->name)[0];
                                        @endphp
                                        @if ($name === 'Notification')
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="form-check-input">
                                                    {{ $permission->name }}
                                                    <i class="input-frame"></i></label>
                                            </div>
                                        @endif
                                    @endforeach

                                </div> {{--card-body--}}

                            </div> {{--card--}}

                        </div> {{--permission block--}}

                    </div> {{--row--}}

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
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

    /**
     * Check all the permissions
     */
    $("#checkPermissionAll").click(function(){
        $('input[type=checkbox]').prop('checked', $(this).is(':checked'));
    });

    function checkAll(permissionSet, checkThis){
        let classCheckBox = $('.' + permissionSet + ' input[type="checkbox"]');
        classCheckBox.prop('checked', checkThis.checked);

        implementAllChecked();
    }

    function implementAllChecked() {
        let countPermissions = 93;
        let countPermissionGroups = 26;
        //  console.log((countPermissions + countPermissionGroups));
        //  console.log($('input[type="checkbox"]:checked').length);
        if($('input[type="checkbox"]:checked').length >= (countPermissions + countPermissionGroups)){
            $("#checkPermissionAll").prop('checked', true);
        }else{
            $("#checkPermissionAll").prop('checked', false);
        }
    }
</script>

@endpush