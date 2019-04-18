<?php $__env->startSection('content'); ?>

</header>
</div>
    <div class="container">
        <div class="row">
            <h3><?php echo e($page_title); ?></h3>
            <div class="page-wrapper">
                <div class="col-md-12">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    <?php if(session('error')): ?>
                        <div class="alert alert-danger">
                            <?php echo e(session('error')); ?>

                        </div>
                    <?php endif; ?>
                    <?php if(count($errors) > 0): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="search-wrapper Videos-Listing">
                    <form method="post" role="form">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group col-md-5">
                            <input placeholder="Type tags" value="<?php echo e($tag_names); ?>"id="tag" type="text" name="tag" class="form-control">
                        </div>
                        <div class="form-group col-md-5">
                            <select class="form-control" name="category">
                                <option>---SELECT CATEGORY---</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php if( $category_name  == $category->category_name): ?> selected <?php endif; ?> ><?php echo e($category->category_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <input type="submit" name="submit" value="Search">
                        </div>
                    </form>
                </div>

                <!-- <script src="<?php echo e(asset('frontend/jwplayer/jwplayer.js')); ?>"></script>
		<script>jwplayer.key="g4fPsuTO2p03J7jp0MB28FBaHRlIYi4L56gXKg";</script>
		<div id="mainVideo"></div> -->
                <div class="clearfix"></div>
                <div class="row">
                <div id="" class="col-md-12">
                    <div class="header"><h3>Skill Development Videos</h3></div>
                    <!-- <ul class="thumbs_ul">
                        <?php if(isset($videos) && count($videos) > 0): ?>
                            <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                ​<li><a href="javascript:playTrailer('<?php echo e(asset($video->uploaded_video)); ?>', '<?php echo e(asset($video->video_image)); ?>')"><img alt="" border="0" width="150" src="<?php echo e(asset($video->video_image)); ?>" /></a>
                                    <span class="play_button"><i class="fa fa-play-circle" aria-hidden="true"></i></span>
                                    <div class="overy_buttons">
                                        <a href="<?php echo e(url('video/'.$video->id.'/view')); ?>" id="video_buy_code_<?php echo e($video->id); ?>">
                                        <?php echo e($video->video_title); ?> <br/> Purchase Now<br/>€<?php echo e($video->price); ?></a>
                                    </div>
                                </li>
                                ​<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </ul> -->

<div class="col-md-8">
<ul class="video_listing">
    <?php if(isset($videos) && count($videos) > 0): ?>
        <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li>
        <a href="<?php echo e(url('video/'.$video->id.'/view')); ?>"><img src="<?php echo e(asset($video->video_image)); ?>" alt="<?php echo e($video->video_title); ?>"></a>
        <div class="video_details">
            <h2><a href="#"><?php echo e($video->video_title); ?></a></h2>
            <span class="posted_by">In <?php echo e($video->videoCategory->category_name); ?> </span>
            <div class="video_price">€<?php echo e($video->price); ?></div>
            <div class="unit_duration"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo e($video->getDuration()); ?> </div>
            <?php if(isset($video->videoTag->tag->name)): ?>
                <?php if($video->videoTag->tag->name != null): ?>
            <div class="unit_topic_tag">
                <a href="<?php echo e(url('video/'.$video->id.'/view')); ?>"><?php echo e($video->videoTag->tag->name); ?></a>
            </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php else: ?>
            <li>
                  <span> No Video Found</span>

            </li>
    <?php endif; ?>
</ul>
    </div>
  <div class="col-md-4">
          <div class="right_service_details">
              <div class="header"><h3><a href="<?php echo e(url('/events')); ?>">Live Events/Webinar</a></h3></div>
              <div id="calendar"></div>
              <link rel="stylesheet" href="<?php echo e(URL::asset('custom/fullcalendar/fullcalendar.css')); ?>">
              <link rel="stylesheet" media="print" href="<?php echo e(URL::asset('custom/fullcalendar/fullcalendar.print.css')); ?>">
              <script src="<?php echo e(URL::asset('custom/fullcalendar/lib/moment.min.js')); ?>"></script>
              <script src="<?php echo e(URL::asset('custom/fullcalendar/fullcalendar.min.js')); ?>"></script>
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
                <script src="<?php echo e(asset('/frontend/js/jquery.ui.js')); ?>"></script>
                <script type="text/JavaScript">
                    $(document).ready(function() {
                        var events = "<?php echo e($events); ?>";

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
                    var data = "<?php echo e(json_encode($tags)); ?>";
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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('front.new_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>