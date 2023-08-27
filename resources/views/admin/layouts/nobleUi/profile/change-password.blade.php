@extends($themeLayout.'master')
@section('content')
    <div class="page-content">

        @include($themeLayout.'partials.breadcrumb')

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">@lang('Change Password')</h4>
            </div>

            @include($themeLayout.'partials.top-right-items')
        </div>

        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        @lang('Change Password')
                    </div>
                    <div class="card-body">

                        <x-noble-ui.alert type="success" :message="session('success')"/>

                        <form action="{{ route('admin.changePassword.update') }}" method="post" class="forms-sample">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="current_password">@lang('Current Password')</label>
                                <input type="password" name="current_password" value="" class="form-control
                                        @error('current_password') is-invalid @enderror" id="current_password"
                                        autocomplete="off" placeholder="Current Password">

                                @if ($errors->has('current_password'))
                                    <span class="text-danger">{{ $errors->first('current_password') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password">@lang('New Password')</label>
                                <input type="password" name="password" value="" class="form-control
                                        @error('password') is-invalid @enderror" id="new_password"
                                        autocomplete="off" placeholder="New Password">

                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">@lang('Confirm Password')</label>
                                <input type="password" name="password_confirmation" value="" class="form-control
                                @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                                       autocomplete="off" placeholder="Confirm password">

                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">@lang('Submit')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection