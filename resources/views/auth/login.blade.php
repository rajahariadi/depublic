@include('customers.component.head')

<style>
    body {
        font-family: Montserrat, sans-serif;
        background-color: #FAFAFA;
    }

    .container {
        max-width: 575px;
        padding: 10px;
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .card-header {
        height: 79px;
        padding: 24px 16px;
        background-color: #FEF6E5;
        border-bottom: 1px solid #ddd;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 2;
    }

    .img-close {
        cursor: pointer;
        height: 30px;
        width: 30px;
        margin-right: 10px;
    }

    .card-body {
        padding: 20px;
        background-color: #FAFAFA;
        position: relative;
    }

    h3 {
        font-size: 20px;
        font-weight: 700;
        line-height: 30px;
        margin: 0;
    }

    .img-eye-close {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        height: 30px;
        width: 30px;
        z-index: 3;
    }

    .img-bg-icon {
        position: absolute;
        top: -20px;
        right: 0;
        z-index: 0;
    }

    .signIn-Btn {
        color: #fff;
        background-color: #A103D3;
        border-color: #A103D3;
        display: inline-block;
        font-weight: 400;
        text-align: center;
        vertical-align: middle;
        user-select: none;
        border: 1px solid transparent;
        padding: 8px 16px;
        font-size: 20px;
        height: 62px;
        font-weight: 700;
        margin-top: 30px;
    }

    .card-footer {
        padding: 16px 20px;
        background-color: #FAFAFA;
        border-top: 11px solid #EEEEEE;
        height: 300px;
    }

    .img-loading {
        height: 108px;
        width: 110px;
    }

    .loading {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        width: 500px;
        height: 233px;
    }

    input {
        display: block;
        padding: 8px 12px;
        font-size: 16px;
        height: 63px;
    }

    .blur {
        filter: blur(5px);
        pointer-events: none;
        user-select: none;
    }
</style>
</head>

<body>
    <!-- Login Form -->
    <div class="container m-0-auto">
        <div class="row justify-content-center d-flex">
            <div class="col-md-6 w-100" style="flex: 0 0 auto;">
                <div class="card">
                    <!---------C-Head---------->
                    <div class="card-header text-left">
                        <h3>Sign In</h3>
                    </div>
                    <!---------C-Body---------->
                    <div class="card-body">
                        <img class="img-bg-icon" src="assets/images/bg-icon.png" width="130px" height="204.5px">
                        <p
                            style="margin-bottom: 16px; margin-top: 30px; font-weight: 500; color: #000000; font-size: 20px; position: relative; z-index: 1;">
                            Welcome back!
                        </p>

                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form id="sign-in-form" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <input placeholder="Email" type="email" class="form-control w-100" id="email"
                                    name="email" required
                                    style="background: transparent; border: none; border-bottom: 1px solid #A6A6A6; position: relative; z-index: 1; border-radius: 0;">
                                @error('email')
                                    <p class="mt-1 text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3" style="position: relative;">
                                <input placeholder="Password" type="password" class="form-control w-100" id="password"
                                    name="password" required
                                    style="border: none; border-bottom: 1px solid #A6A6A6; border-radius: 0; background: transparent;">
                                <img class="img-eye-close" src="{{ asset('assets/images/eye.png') }}"
                                    onclick="togglePasswordVisibility()" id="eyeToggle">
                                @error('password')
                                    <p class="mt-1 text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <button type="submit" id="sign-in-button"
                                    class="signIn-Btn btn-primary w-100 rounded-4">Sign In</button>
                            </div>
                        </form>
                        <div class="text-center"
                            style="margin-top: 30px; margin-bottom: 25px; font-weight: 500; font-size: 16px;">
                            <a href="{{ route('register') }}" style="color: #A6A6A6; text-decoration: none;">Don't have
                                an Account? <span style="color: #A103D3; font-weight: bold;">Register</span></a>
                        </div>
                    </div>
                    <!---------C-Footer---------->
                    <div class="card-footer text-center">
                        <p
                            style="margin-bottom: 30px; margin-top: 50px; color: #4D4D4D; font-weight: 500; font-size: 18px;">
                            atau login dengan
                        </p>
                        <a href="{{ url('/auth/google') }}" style="margin-bottom: 20px;">
                            <img src="assets/images/google-logo.png" alt="Google" width="100px" height="100px">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Processing Box -->
    <div id="processing-box" class="loading rounded-3">
        <img class="img-loading" src="assets/images/loading.png">
        <p class="fs-5 fw-bold mt-2 mb-0">Being Processed</p>
        <p class="mt-0" style="color: #A6A6A6;">wait a moment...</p>
    </div>

    @include('customers.component.script')


    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('password');
            var eyeToggle = document.getElementById('eyeToggle');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeToggle.src = "{{ asset('assets/images/view.png') }}";
            } else {
                passwordInput.type = 'password';
                eyeToggle.src = "{{ asset('assets/images/eye.png') }}";
            }
        }
    </script>
    <script>
        document.getElementById('sign-in-button').addEventListener('click', function(event) {
            event.preventDefault();
            document.querySelector('.container').classList.add('blur');
            document.getElementById('processing-box').style.display = 'block';
            setTimeout(function() {
                document.getElementById('sign-in-form').submit();
            }, 2000);
        });
    </script>

    <!-- Include Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+F4QxA5I5rAJXgLFBEhD1QMdHxQoH" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/intlTelInput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>

</html>
