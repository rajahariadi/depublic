@extends('admin.index')

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <h3 class="card-title"><i class="lni lni-star"></i></i> Add Event</h3>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data"> @csrf
                        <label for="defaultFormControlInput" class="form-label">Event</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Event"
                                aria-describedby="defaultFormControlHelp" name="name">
                        </div>
                        @error('name')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label class="form-label">Event Category</label>
                        <select class="single-select" name="event_category_id">
                            <option selected value="">-- Choose --</option>
                            @foreach ($data['event_categories'] as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('event_category_id')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Description</label>
                        <div class="input-group">
                            <textarea name="description" class="form-control" placeholder="Description" id="defaultFormControlInput" cols="150"
                                rows="3"></textarea>
                        </div>
                        @error('description')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Location</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Location"
                                aria-describedby="defaultFormControlHelp" name="location">
                        </div>
                        @error('location')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Event Start</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="defaultFormControlInput"
                                aria-describedby="defaultFormControlHelp" name="start_event">
                        </div>
                        @error('start_event')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Event End</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="defaultFormControlInput"
                                aria-describedby="defaultFormControlHelp" name="end_event">
                        </div>
                        @error('end_event')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Highlight</label>
                        <div class="input-group">
                            <textarea name="highlight" class="form-control" placeholder="Highlight" id="defaultFormControlInput" cols="150"
                                rows="3"></textarea>
                        </div>
                        @error('highlight')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="gambarBukuInput" class="form-label">Image</label>
                        <input type="file" accept="image/png, image/jpeg" class="form-control"
                            id="gambarBukuInput"aria-describedby="defaultFormControlHelp" name="image"
                            onchange="previewImage(this)">
                        @error('image')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Add Event</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="text-center">
                        <br><br><br>
                        <img class="text-center" id="gambarBukuPreview" src=""
                            style="max-width: 100%; height: 500px;  display:block; margin:auto;">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
