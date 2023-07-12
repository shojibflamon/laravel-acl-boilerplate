<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                Create New Permission
            </div>
            <div class="card-body">

                <x-noble-ui.alert type="success" :message="session('success')"/>

                <form action="{{ route('admin.permissions.store') }}" method="post" class="forms-sample">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="name"
                               autocomplete="off"
                               placeholder="Permission Name">

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