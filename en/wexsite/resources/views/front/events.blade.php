@extends('front.new_layout')
@section('content')

</header>
</div>
<div class="container" xmlns="http://www.w3.org/1999/html">
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
            <div id="dialog-confirm" title="Book Event Now.">
                <p><span id="text"></span></p>
            </div>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
            <script src="{{ asset('/frontend/js/jquery.ui.js') }}"></script>
		<div id="calendar"></div>

            <link rel="stylesheet" href="{{ URL::asset('custom/fullcalendar/fullcalendar.css') }}">
            <link rel="stylesheet" media="print" href="{{ URL::asset('custom/fullcalendar/fullcalendar.print.css') }}">
            <script src="{{ URL::asset('custom/fullcalendar/lib/moment.min.js') }}"></script>
            <script src="{{ URL::asset('custom/fullcalendar/fullcalendar.min.js') }}"></script>
            <?php $events = json_encode($events_arr,JSON_HEX_QUOT);?>
            <script>
                $(document).ready(function() {
                    var events = "{{ $events }}";

                    var events = JSON.parse(events.replace(/&quot;/g,'"'));
                    $('#calendar').fullCalendar({
                        defaultDate: new Date(),
                        editable: true,
                        header: {
                            right: 'today prev,next',
                        },
                       // eventLimit: true, // allow "more" link when too many events
                        events:  events,
                        eventClick: function(calEvent, jsEvent, view) {
                            //     console.log(calEvent.start['_i']);
                            $("#text").html('Event: ' + calEvent.title+' on '+calEvent.start['_i']+'<br/><img alt="'+calEvent.title+'" height="100" width="100" src="'+calEvent.image+'"><p>'+calEvent.description+'</p>');
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

                        }
                    });
                });
            </script>

          <style>
                #calendar {
                    max-width: 900px;
                    margin: 0 auto;
                }

            </style>

		</div>		
	</div>
</div>
@endsection

