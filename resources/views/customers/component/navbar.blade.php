<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a href="{{ route('customer.home') }}">
            <img src="{{ asset('design-system/assets/images/Group 191.png') }}" alt="Logo" width="45" height="40"
                class="d-inline-block align-text-top">
        </a>
        <div class="d-flex">
            @if (Auth::user() != null)
                <div class="user-box dropdown">
                    <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{(Auth::user()->profile_photo_url) }}" class="user-img" alt="user avatar">

                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.show') }}">
                                <i class="bx bx-user"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('customer.transactions.history') }}">
                                <i class='bx bx-history'></i>
                                <span>History Transaksi</span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider mb-0"></div>
                        </li>
                        <form action="{{ route('logout') }}" method="POST">@csrf
                            <li>
                                <button class="dropdown-item text-danger" type="submit">
                                    <i class="bx bx-log-out-circle"></i>
                                    <span>Logout</span>
                                </button>
                            </li>
                        </form>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn custom-button me-2">Sign In</a>
                <a href="{{ route('register') }}" class="btn custom-button2">Sign Up</a>
            @endif
        </div>
    </div>
</nav>
