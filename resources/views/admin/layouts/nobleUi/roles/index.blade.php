@extends($themeLayout.'master')
@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Roles</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Roles</h4>
            </div>

            <div class="d-flex align-items-center flex-wrap text-nowrap">
                <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex" id="dashboardDate">
                    <span class="input-group-addon bg-transparent"><i data-feather="calendar" class=" text-primary"></i></span>
                    <input type="text" class="form-control">
                </div>
                <button type="button" class="btn btn-outline-info btn-icon-text mr-2 d-none d-md-block">
                    <i class="btn-icon-prepend" data-feather="download"></i>
                    Import
                </button>
                <button type="button" class="btn btn-outline-primary btn-icon-text mr-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="printer"></i>
                    Print
                </button>
                <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                    Download Report
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <x-noble-ui.alert type="success" :message="session('success')"/>

                        <h6 class="card-title">Create New Role</h6>
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

                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include($themeLayout.'roles.list')

    </div>
@endsection