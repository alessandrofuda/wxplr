@extends('layouts.dashboard_layout')
@section('content')
    <div class="container user_profile_form">
        <div class="row">
            <div class="heading">
                <h1>{{ $page_title }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <?php 

                $step=0;
                $user_id = Auth::user()->id;
                $order = \App\Order::where('user_id',$user_id)->where('item_name','Professional Kit')->first();
                $step = 0;
                if($order != null) {
                    $step = $order->step_id;
                }
                ?>
                <table class="table responsive text-center">
                    <thead>
                        <tr>
                            <th>PHASES</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="{{ $order->getKitStatus(1, true) ? 'active' : '' }}">Profile Form</span></td>
                            <td>{!! $order->getKitStatus(1) !!}</td>
                        </tr>
                        <tr>
                            <td><span class="{{ $order->getKitStatus(2, true) ? 'active' : '' }}">Market Analysis</span></td>
                            <td>{!! $order->getKitStatus(2) !!}</td>
                        </tr>
                        <tr>
                            <td><span class="{{ $order->getKitStatus(3, true) ? 'active' : '' }}">Culture Match Survey</span></td>
                            <td>{!! $order->getKitStatus(3) !!}</td>
                        </tr>
                        <tr>
                            <td><span class="{{ $order->getKitStatus(4, true) ? 'active' : '' }}">Dream check lab</span></td>
                            <td>{!! $order->getKitStatus(4) !!}</td>
                        </tr>
                        <tr>
                            <td><span class="{{ $order->getKitStatus(5, true) ? 'active' : '' }}">Career Orientation Session</span></td>
                            <td>{!! $order->getKitStatus(5) !!}</td>
                        </tr>
                        <tr>
                            <td><span class="{{ $order->getKitStatus(6, true) ? 'active' : '' }}">Steady Aim Shoot</span></td>
                            <td>{!! $order->getKitStatus(6) !!}</td>
                        </tr>
                    </tbody>
                    </table>
            </div>
        </div>
    </div>
@endsection