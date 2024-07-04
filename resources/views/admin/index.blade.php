<!doctype html>
<html lang="en">

<!--head-->
@include('admin.component.head')
<!--end head-->

<body onload="info_noti()">
    <!--wrapper-->
    <div class="wrapper">

        <!--sidebar wrapper -->
        @include('admin.component.sidebar')
        <!--end sidebar wrapper -->

        <!--start header -->
        @include('admin.component.header')
        <!--end header -->

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">

                <!--start page wrapper -->
                @yield('content')
                <!--start page wrapper -->

            </div>
        </div>
        <!--end page wrapper -->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->

    </div>
    <!--end wrapper-->

    <!--start switcher-->
    @include('admin.component.script')
    <!--end switcher-->


</body>

</html>
