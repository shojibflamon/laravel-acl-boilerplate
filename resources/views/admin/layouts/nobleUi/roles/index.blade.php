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

        @include($themeLayout.'roles.create')
        @include($themeLayout.'roles.list')

    </div>
@endsection