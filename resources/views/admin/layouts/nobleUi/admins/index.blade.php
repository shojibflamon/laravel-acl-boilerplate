@extends($themeLayout.'master')
@section('content')
    <div class="page-content">

        @include($themeLayout.'partials.breadcrumb')

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Users</h4>
            </div>

            @include($themeLayout.'partials.top-right-items')
        </div>

        @include($themeLayout.'admins.create')
        @include($themeLayout.'admins.list')

    </div>
@endsection