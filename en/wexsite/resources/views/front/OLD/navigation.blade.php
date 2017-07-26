<div class="container">
    <?php $step=0;
    $user_id = Auth::user()->id;
    $order = \App\Order::where('user_id',$user_id)->where('item_name','Professional Kit')->first();
    $step = 0;
    if($order != null) {
       $step = $order->step_id;
    }
    ?>
    <ul class="nav navbar-nav">
        <li class="{{\Route::getCurrentRoute()->getPath() == "user/market_analysis" ? "active" : ""}} {{ $step > 0 ? "step_done" : "step_pending" }}">
            <a href="{{ $step > 0  ? url('user/market_analysis') : '#'}}">Market Analysis</a>
        </li>

        <li class="{{\Route::getCurrentRoute()->getPath() == "user/culture_match" ? "active" : ""}} {{ $step > 1 ? "step_done" : "step_pending" }}">
            <a href="{{ $step > 1 ?  url('user/culture_match') : ""}} ">Culture Match</a>
        </li>

        <li class="{{\Route::getCurrentRoute()->getPath()  == "user/dream_check_lab" ? "active" : ""}} {{ $step > 2 ? "step_done" : "step_pending" }}">
            <a href="{{ $step > 2 ?  url('user/dream_check_lab') : ""}}">Dream Check Lab</a>
        </li>

        <li class="{{\Route::getCurrentRoute()->getPath() == "user/role_play_interview" ? "active" : ""}} {{ $step > 3 ? "step_done" : "step_pending" }}">
            <a href="{{ $step > 3 ?  url('user/role_play_interview') : ""}}">Role Play Interview</a>
        </li>

        <li class="{{\Route::getCurrentRoute()->getPath() == "user/steady_aim_shoot" ? "active" : ""}} {{ $step > 4 ? "step_done" : "step_pending" }}">
            <a href="{{ $step > 4 ?  url('user/steady_aim_shoot') : ""}}">Steady Aim Shoot</a>
        </li>
        </ul>
</div>