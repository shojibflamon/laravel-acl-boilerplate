<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">All Roles</h6>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>@lang('ID')</th>
                            <th>@lang('Name')</th>
                            <th>@lang('Email')</th>
                            <th>@lang('Roles')</th>
                            <th>@lang('Email Verified At')</th>
                            <th>@lang('Created At')</th>
                            <th>@lang('Updated At')</th>
                            <th>@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($models as $model)
                            <tr>
                                <th>{{ $model->id }}</th>
                                <td>{{ $model->name }}</td>
                                <td>{{ $model->email }}</td>
                                <td>{{ join(', ', $model->getRoleNames()->all()) }}</td>
                                <td>{{ $model->email_verified_at }}</td>
                                <td>{{ $model->created_at->format('F j, Y h:i A') }}</td>
                                <td>{{ $model->updated_at->format('F j, Y h:i A') }}</td>
                                <td>
                                    <form action="{{route('admin.admins.destroy', $model->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-primary mr-2" href="{{route('admin.admins.show', $model->id)}}" role="button">Show</a>
                                        <button type="submit" class="btn btn-primary" role="button">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-foot">
                {{ $models->links('pagination') }}
            </div>
        </div>
    </div>
</div>