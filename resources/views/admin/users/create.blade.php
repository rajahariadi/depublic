@extends('admin.index')

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <h3 class="card-title"><i class='bx bx-group me-2'></i> Add User</h3>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('admin.users.store') }}" method="POST"> @csrf
                        <label for="defaultFormControlInput" class="form-label">Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Name"
                                aria-describedby="defaultFormControlHelp" name="name">
                        </div>
                        @error('name')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control" id="defaultFormControlInput" placeholder="Email"
                                aria-describedby="defaultFormControlHelp" name="email">
                        </div>
                        @error('email')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="myInput" placeholder="Password"
                                aria-describedby="defaultFormControlHelp" name="password">
                            <div class="input-group-text">
                                <input class="form-check-input" type="checkbox"
                                    aria-label="Checkbox for following text input" onclick="myFunction()">
                            </div>
                        </div>
                        @error('password')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <label for="defaultFormControlInput" class="form-label">Role User</label>
                        <div class="input-group">
                            <select name="role" class="single-select" id="">
                                <option selected value="">-- Choose --</option>
                                <option value="admin">Administrator</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        @error('role')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endsection
