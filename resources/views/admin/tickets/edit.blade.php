@extends('admin.index')

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <h3 class="card-title"><i class='lni lni-ticket-alt'></i> Add Ticket </h3>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('admin.tickets.update', $data->id) }}" method="POST"> @csrf @method('PUT')
                        <label class="form-label">Select Event</label>
                        <select class="single-select" name="event_id">
                            @foreach ($events as $event)
                                <option value="{{ $event->id }}" {{ $data->event_id == $event->id ? 'selected' : '' }}>
                                    {{ $event->name }}</option>
                            @endforeach
                        </select>
                        @error('event_id')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Type</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Type"
                                aria-describedby="defaultFormControlHelp" name="type" value="{{ $data->type }}">
                        </div>
                        @error('type')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Price</label>
                        <div class="input-group">
                            <input type="text" class="form-control rupiah" id="defaultFormControlInput" placeholder="Price"
                                aria-describedby="defaultFormControlHelp" name="price" value="{{ $data->price }}">
                        </div>
                        @error('price')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Add Ticket</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
