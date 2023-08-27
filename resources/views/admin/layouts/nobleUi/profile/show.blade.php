@extends($themeLayout.'master')
@section('content')
    <div class="page-content">

        @include($themeLayout.'partials.breadcrumb')

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">@lang('Roles')</h4>
            </div>

            @include($themeLayout.'partials.top-right-items')
        </div>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        @lang('Update Profile')
                    </div>
                    <div class="card-body">

                        <x-noble-ui.alert type="success" :message="session('success')"/>

                        <form action="{{ route('admin.profile.update') }}" method="post" class="forms-sample">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">@lang('Name')</label>
                                <input type="text" name="name" value="{{ $model->name }}" class="form-control @error('name') is-invalid @enderror" id="name" autocomplete="off"
                                       placeholder="Role Name">

                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name">@lang('Email Address')</label>
                                <input type="email" name="email" value="{{ $model->email }}" class="form-control @error('email') is-invalid @enderror" id="email"
                                       autocomplete="off"
                                       placeholder="example@email.com">

                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">@lang('Update')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
