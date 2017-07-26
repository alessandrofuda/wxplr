@extends('front.new_layout')
@section('content')

</header>
</div>
    <div class="container">
        <div class="row">
            <h3>{{ $page_title }}</h3>
            <div class="page-wrapper">
                <div class="col-md-12">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="search-wrapper Videos-Listing">
                    <form method="post" role="form">
                        {{ csrf_field() }}
                        <div class="form-group col-md-5">
                            <input placeholder="Type tags" value="{{ $tag_names }}"id="tag" type="text" name="tag" class="form-control">
                        </div>
                        <div class="form-group col-md-5">
                            <select class="form-control" name="category">
                                <option>---SELECT CATEGORY---</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if( $category_name  == $category->category_name) selected @endif >{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <input type="submit" name="submit" value="Search">
                        </div>
                    </form>
                </div>

                <!-- <script src="{{ asset('frontend/jwplayer/jwplayer.js') }}"></script>
		<script>jwplayer.key="g4fPsuTO2p03J7jp0MB28FBaHRlIYi4L56gXKg";</script>
		<div id="mainVideo"></div> -->
                <div class="clearfix"></div>
                <div class="row">
                <div id="" class="col-md-12">
                    <div class="header"><h3>Skill Development Videos</h3></div>
                    <!-- <ul class="thumbs_ul">
                        @if(isset($videos) && count($videos) > 0)
                            @foreach($videos as $video)
                                ​<li><a href="javascript:playTrailer('{{ asset($video->uploaded_video) }}', '{{ asset($video->video_image) }}')"><img alt="" border="0" width="150" src="{{ asset($video->video_image) }}" /></a>
                                    <span class="play_button"><i class="fa fa-play-circle" aria-hidden="true"></i></span>
                                    <div class="overy_buttons">
                                        <a href="{{ url('video/'.$video->id.'/view') }}" id="video_buy_code_{{ $video->id }}">
                                        {{ $video->video_title }} <br/> Purchase Now<br/>€{{ $video->price }}</a>
                                    </div>
                                </li>
                                ​@endforeach
                        @endif
                    </ul> -->

<div class="col-md-8">
<ul class="video_listing">
    @if(isset($videos) && count($videos) > 0)
        @foreach($videos as $video)
    <li>
        <a href="{{ url('video/'.$video->id.'/view') }}"><img src="{{ asset($video->video_image) }}" alt="{{ $video->video_title }}"></a>
        <div class="video_details">
            <h2><a href="#">{{ $video->video_title }}</a></h2>
            <span class="posted_by">In {{ $video->videoCategory->category_name  }} </span>
            <div class="video_price">€{{ $video->price }}</div>
            <div class="unit_duration"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ $video->getDuration() }} </div>
            @if(isset($video->videoTag->tag->name))
                @if($video->videoTag->tag->name != null)
            <div class="unit_topic_tag">
                <a href="{{ url('video/'.$video->id.'/view') }}">{{ $video->videoTag->tag->name}}</a>
            </div>
                @endif
            @endif
        </div>
    </li>@endforeach @else
            <li>
                  <span> No Video Found</span>

            </li>
    @endif
</ul>
    </div>
  <div class="col-md-4">
          <div class="right_service_details">
              <div class="header"><h3><a href="{{ url('/events') }}">Live Events/Webinar</a></h3></div>
              <div id="calendar"></div>
              <link rel="stylesheet" href="{{ URL::asset('custom/fullcalendar/fullcalendar.css') }}">
              <link rel="stylesheet" media="print" href="{{ URL::asset('custom/fullcalendar/fullcalendar.print.css') }}">
              <script src="{{ URL::asset('custom/fullcalendar/lib/moment.min.js') }}"></script>
              <script src="{{ URL::asset('custom/fullcalendar/fullcalendar.min.js') }}"></script>
              <?php $events = json_encode($events_arr,JSON_HEX_QUOT);?>
          </div>

  </div>

</div>
                    </div>

                <style>
                    #calendar {
                        max-width: 900px;
                        margin: 0 auto;
                    }

                </style>

                <div id="dialog-confirm" title="Book Event Now.">
                    <p><span id="text"></span></p>
                </div>
                <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
                <script src="{{ asset('/frontend/js/jquery.ui.js') }}"></script>
                <script type="text/JavaScript">
                    $(document).ready(function() {
                        var events = "{{ $events }}";

                        var events = JSON.parse(events.replace(/&quot;/g,'"'));
                        $('#calendar').fullCalendar({
                            defaultDate: new Date(),
                            editable: true,
                            header: {
                                right: 'today prev,next',
                            },
                            contentHeight:400,
                            eventClick: function(calEvent, jsEvent, view) {
                           //     console.log(calEvent.start['_i']);
                                $("#text").html('Event: ' + calEvent.title+' on '+ calEvent.start['_i']+'-'+calEvent.end_time+'<br/><img height="100" width="100" src="'+calEvent.image+'"><p>'+calEvent.description+'</p>');
                                $( "#dialog-confirm" ).dialog({
                                    resizable: false,
                                    height: "auto",
                                    width: 400,
                                    modal: true,
                                    buttons: {
                                        Cancel: function() {
                                            $( this ).dialog( "close" );
                                            return false;
                                        },
                                        "Book Now": function() {
                                            $( this ).dialog( "close" );
                                            location.replace(calEvent.to_url);
                                        }
                                    }
                                });



                            //    alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
                               // alert('View: ' + view.name);

                                // change the border color just for fun
                                $(this).css('border-color', 'red');

                            },
                            // eventLimit: true, // allow "more" link when too many events
                            events:  events

                        });
                    });
                    var data = "{{  json_encode($tags) }}";
                    var data = JSON.parse(data.replace(/&quot;/g,'"'));

                    $("#tag").mSelectDBox({
                        "list":data,
                        "multiple": true,
                        "autoComplete": true,
                        "name" : "a",
                    });

                   /* var playerInstance = jwplayer("mainVideo");
                    playerInstance.setup({
                        file: "http://127.0.0.1/wexplore/uploads/sdvideo/test7.mp4",
                        mediaid: "MEDIAID",
                    });
                    function playTrailer(video, thumb) {
                        playerInstance.load([{
                            file: video,
                            image: thumb
                        }]);
                        playerInstance.play();
                    }*/

                </script>
            </div>
        </div>
    </div>
@endsection

