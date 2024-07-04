<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('assets/logo.png') }}" class="logo-icon" alt="logo icon">
            </a>
        </div>
        <div>
            <h4 class="logo-text" style="color: #A103D3">Depublic</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left' style="color: #A103D3"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li class="menu-label">Modul Data</li>
        <li>
            <a href="{{ route('admin.event-categories.index') }}" class="">
                <div class="parent-icon"><i class="lni lni-ticket-alt"></i>
                </div>
                <div class="menu-title">Event Category</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.events.index') }}" class="">
                <div class="parent-icon"><i class="lni lni-star"></i>
                </div>
                <div class="menu-title">Event</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.tickets.index') }}" class="">
                <div class="parent-icon"><i class="lni lni-ticket"></i>
                </div>
                <div class="menu-title">Ticket</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.transactions.index') }}" class="">
                <div class="parent-icon"><i class='bx bx-transfer'></i>
                </div>
                <div class="menu-title">Transaksi</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.users.index') }}" class="">
                <div class="parent-icon"><i class='bx bx-group'></i>
                </div>
                <div class="menu-title">User</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
