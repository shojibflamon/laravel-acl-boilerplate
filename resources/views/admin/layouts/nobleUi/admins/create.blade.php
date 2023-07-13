@extends($themeLayout.'master')
@section('content')
    <div class="page-content">

        @include($themeLayout.'partials.breadcrumb')

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Admins</h4>
            </div>

            @include($themeLayout.'partials.top-right-items')
        </div>

        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        Create New Admin
                    </div>
                    <div class="card-body">

                        <x-noble-ui.alert type="success" :message="session('success')"/>

                        <form action="{{ route('admin.admins.store') }}" method="post" class="forms-sample">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="name"
                                       autocomplete="off"
                                       placeholder="Name">

                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Email Address</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="email"
                                       autocomplete="off"
                                       placeholder="example@email.com">

                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" value="" class="form-control @error('password') is-invalid @enderror" id="password"
                                       autocomplete="off"
                                       placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password">Confirm Password</label>
                                <input type="password" name="password_confirmation" value="" class="form-control @error('password') is-invalid
                                @enderror" id="password"
                                       autocomplete="off"
                                       placeholder="Confirm password">

                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>

                            <label for="name">Roles</label>
                            <div class="form-group">
                                @foreach($roles as $role)

                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="roles[]" value="{{ $role }}" class="form-check-input" >
                                            {{ $role }}
                                            <i class="input-frame"></i></label>
                                    </div>

                                @endforeach

                            </div>


                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection