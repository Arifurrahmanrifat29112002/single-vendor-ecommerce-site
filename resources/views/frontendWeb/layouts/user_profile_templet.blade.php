@extends('frontendWeb.layouts.webtemp')
@section('webpag')
<div class="container p-5">
    <div class="row">
        <div class="col-lg-4">
            <div class="box_main">
                <ul>
                    <li><a href="">Dashboard</a></li>
                    <li><a href="{{ route('pendingorders') }}">Pending Orders</a></li>
                    <li><a href="{{ route('history') }}">History</a></li>
                    <li>
                        <form action="" method="post">
                            <a href="">Logout</a>
                        </form>

                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="box_main">
                @yield('user')
            </div>
        </div>
    </div>
</div>
@endsection
