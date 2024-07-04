<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu">
                <i class='bx bx-menu'></i>
            </div>
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">
                    <div class="header-notifications-list">
                    </div>
                    <div class="header-message-list">
                    </div>
                </ul>
            </div>
            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('assets/image/Profile.png') }}" class="user-img" alt="user avatar">
                    <div class="user-info ps-3">
                        <p class="user-name mb-0">{{ Auth::user()->name }}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
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
        </nav>
    </div>
</header>
