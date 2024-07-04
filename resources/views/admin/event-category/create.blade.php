@extends('admin.index')

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <h3 class="card-title"><i class='lni lni-ticket-alt'></i> Add Event Category</h3>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('admin.event-categories.store') }}" method="POST"> @csrf
                        <label for="defaultFormControlInput" class="form-label">Event Category</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="defaultFormControlInput"
                                placeholder="Event Category" aria-describedby="defaultFormControlHelp" name="name">
                        </div>
                        @error('name')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <a href="{{ route('admin.event-categories.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Add Event Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
