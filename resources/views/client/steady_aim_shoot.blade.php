@extends('layouts.dashboard_layout')
@section('content')
    @include('front.navigation')
    <div class="container user_profile_form">
        <div class="row">
            <div class="heading">
                <h3>{{ $page_title }}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <p>
                    @if(isset($steady_aim_shoot['top_description']))
                        {!! $steady_aim_shoot['top_description'] !!}
                    @endif
                </p>

                <div class="item_list">
                    <div class="item">
                        @if(!empty($steady_aim_shoot['steady_aim_shoot_pdf']))
                            <a href="{{ asset($steady_aim_shoot['steady_aim_shoot_pdf']) }}" target="_blank">
                                <img  alt="steady_aim_shoot_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                @if(isset($steady_aim_shoot['steady_aim_shoot_pdf_label']))
                                    <h4>{!! $steady_aim_shoot['steady_aim_shoot_pdf_label'] !!}</h4>
                                @endif
                            </a>
                        @endif
                    </div>
                    <div class="item">
                        @if(!empty($interest_country['interest_country_pdf']))
                            <a href="{{ asset($interest_country['interest_country_pdf']) }}" target="_blank">
                                <img alt="interest_country_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                @if(isset($interest_country['interest_country_pdf_label']))
                                    <h4>{!! $interest_country['interest_country_pdf_label'] !!}</h4>
                                @endif
                            </a>
                        @else
                            <a {{-- href=""--}} target="_blank" disabled style="cursor: not-allowed; opacity: 0.5;">
                                <img alt="interest_country_pdf" src="{{ asset('admin/custom/images/file-icon.png') }}">
                                    <h4 style="margin-top:12px;">Labour Market Situation</h4> <span style="font-size: x-small;">(soon available for  <b>{{ isset($country) ? $country : 'country of your choice' }})</b></span>
                            </a>                            
                        @endif
                    </div>
                    
                </div>

                @if(isset($steady_aim_shoot['bottom_description']))
                    <p>{!! $steady_aim_shoot['bottom_description'] !!}</p>
                @endif

                <h4>What now?</h4>
                @if(isset($steady_aim_shoot['whats_now']))
                    <p>{!! $steady_aim_shoot['whats_now'] !!}</p>
                @endif
                <a class="btn btn-primary pull-right Back-to-Dashboard" href="{{ url('user/dashboard') }}"> &lt;&lt; Back to Dashboard</a>
            </div>
        </div>
    </div>
@endsection