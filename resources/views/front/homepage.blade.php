@extends('front.layout')
@section('slider')
	@include('front.slider')
@endsection
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="YOU_CAN_BE_ANYTHING">
            <h2>YOU CAN BE ANYTHING YOU WANT TO BE</h2>
            <p>Just turn yourself into anything you think that you could ever be - Queen</p>
        </div>
    </div>
    <div class="col-lg-6">
       <div class="NUMBERS">
            <h2>NUMBERS</h2>
            <ul>
                <li>64% of skilled professionals would be willing to move to another country for a job opportunity</li>
                <li>73% of them think that the most frustrating issue is the lack of knowledge and support on how the process works</li>
                <li>77% find useful a dedicated career service </li>
            </ul>
        </div>
    </div>
</div>
<hr/>

<div class="row">
    <div class="INTRODUCING-WEXPLORE text-center">
        <h2>INTRODUCING WEXPLORE</h2>
        <h4>Wexplore is the only career service that supports you in finding your dream job abroad. </h4>
        <div class="WEXPLORE_items">
            <div class="col-lg-4 col-xs-12">
                <div class="Items_Wex">
                    <div class="wex-img">
                    <img alt="icon-img-1.jpg" src="{{ asset('frontend/images/icon-img-1.jpg') }}">
                    </div>
                    <div class="Wex_content">
                    <a href="#">1.Enhance your employability on the global market</a>
                    <p>Gain clarity on who you are and where you are most likely to excel and to fulfill your ambitions through our innovative mix of services. Improve your job search skills and get the recruiters’ attention. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12">
                <div class="Items_Wex">
                    <div class="wex-img">
                        <img alt="icon-img-2.jpg" src="{{ asset('frontend/images/icon-img-2.jpg') }}">
                    </div>
                    <div class="Wex_content">
                        <a href="#">2.Reinforce your global reach</a>
                        <p>Have direct contact with career experts worldwide and with a selection of the best of the best data-driven tools. Access practical insights and expand your network through our selection of webinars and e-learning materials.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12">
                <div class="Items_Wex">
                    <div class="wex-img">
                        <img alt="icon-img-3.jpg" src="{{ asset('frontend/images/icon-img-3.jpg') }}">
                    </div>
                    <div class="Wex_content">
                        <a href="#">3.Save time and get all the support you need in one stop</a>
                        <p>If you are in the process of relocating to pursue your career aspirations, let us take care for you of all the hassles of sorting through permits, finding a house, or figuring out how social security and taxation work in your new country. </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



<div class="with-us">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <h2 class="with-us-heading">CALL TO ACTION</h2>
                <p>Every journey starts with you! And if you know who you are and where your playground is, then really the horizon is your only limit! In which environment you will find the best conditions to thrive and develop?</p>
                <p>Try out our exclusive Free Global Orientation Test, and find your ideal company and your country match.</p>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 button_view">
                <a class="button" href="#">VIEW COURSES</a>
            </div>
</div>
<!--with us close-->

<!--Start how it works-->
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="heading_sec">
                <span>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star resize" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                </span>
                <h2>OUR SERVICES</h2>
                <p>Tired of spending hours applying to job offers without any result? Here’s your chance to have all those recruiters lining up to interview you! Pick the service that most fits your needs and start defining your next career move!</p>
            </div>

        </div>
        <!--col close-->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="workBoxMain Home">
		@foreach($services as $s)
                <div class="col-md-3">
                    <div class="workBox">
                        <img src="{{ asset($s->image) }}" class="img-responsive">
                        <div class="workBoxText">
                            <h3><span class="pull-left">{{ $s->name }}</span>
			    @if($s->type=="free")
			    <span class="pull-right price">Free</span>
			    @else
			    <span class="pull-right price">${{ $s->price }}</span>    
			    @endif
			    </h3>
                            <p class="clearfix"></p>
                           <!-- <p>
                                <i class="fa fa-calendar"></i> 3M 2H &nbsp;&nbsp;
                                <i class="fa fa-user"></i> 3M 2H &nbsp;&nbsp;
                                <i class="fa fa-graduation-cap"></i> 3M 2H &nbsp;&nbsp;
                            </p>-->
                            <p>{!! $s->user_dashboard_desc !!}</p>
                            <p class="readMore">
                                <a href="{{ URL::route('client/register', ['type' => 'basic']) }}">Apply Now</a>
                            </p>
                        </div>
                    </div>
                </div>
		@endforeach          
            </div>
        </div>
    </div>
    <!--row close-->
</div>
<hr/>
<!--container close-->
<!--Start key benefits-->

<div class="row">
    <div class="col-lg-8 col-sx-12">
        <div class="KEY-BENEFITS">
            <h2>KEY BENEFITS</h2>
            <ul>
                <li>Maximize your chances of securing your dream job</li>
                <li>Increase your attractiveness as a candidate at global level</li>
                <li>Take advantage of the best-in-class know how in the field of international labor market</li>
                <li>Customize your service by selecting where you want to go, what you need, and your budget: we’ll take care of the rest</li>
            </ul>
        </div>
    </div>

    <div class="col-lg-4 col-sx-12 pull-right">
        
        <div class="experience">
            <p><span>+30</span> years experience in career services a global network of over 50 countries a 100% customizable service</p>
        </div>

    </div>
</div>
<hr/>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="heading_sec">
                           <span>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star resize" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                           </span>

                <h2>Latest News</h2>

                <p>All About Wexplore Updates</p>
            </div>
            <!--heading sec-->
        </div>
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="workBoxMain latestNews">
                    @foreach($blogs as $blog)
                    <div class="col-md-3">
                        <div class="workBox">
                            <img src="{{ asset($blog->image_file) }}" alt="{{ $blog->title }}" class="img-responsive">
                            <div class="date-time-div">
                                <i class="fa fa-calendar"></i>{{ $blog->created_at }}
                            </div>
                            <div class="workBoxText">
                                <h3><a href="{{ url('blog/'.$blog->id.'/show') }}">{{ $blog->title }}</a></h3>


                                <p>{{ $blog->description}}</p>

                                <p>
                                 <i  class="fa fa-user"></i>{{ $blog->createUser->name }}&nbsp;&nbsp;
                                    <i class="fa fa-comment"></i>
                                    <span class="disqus-comment-count"
                                          data-disqus-url="{{ url('blog/'.$blog->id.'/show') }}"
                                          > <!-- Count will be inserted here --> </span>
                                    &nbsp;&nbsp;
                                </p>
                            </div>
                        </div>
                    </div>
        @endforeach
                </div>
             </div>
        </div>
    </div>
</div>

<script id="dsq-count-scr" src="//wexplore-com.disqus.com/count.js" async></script>

@endsection

