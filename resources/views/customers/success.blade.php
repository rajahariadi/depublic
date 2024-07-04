@include('customers.component.head')

<body>

    @include('customers.component.navbar')
    <div class="container">
        <div class="card">
            <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                <img src="{{ asset('assets/success.png') }}" alt="Logo" width="100" height="100" class="">
                <h1 class="text-success">Payment Successfully</h1>
                <div class="d-flex gap-2 p-2 justify-content-between align-items-center">
                    <a href=" {{ route('customer.home') }} " class="btn"
                        style="color: #A103D3; border-color:#A103D3;">Home</a>
                    <a href="{{ route('customer.transactions.history') }}" class="btn text-white"
                        style="background-color: #A103D3;">Transaction History</a>
                </div>
            </div>
        </div>
    </div>

    @include('customers.component.script')
</body>

</html>
