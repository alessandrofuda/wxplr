@extends('front.dashboard_layout')
@section('content')
    @include('front.navigation')
    <div class="container user_profile_form">
        <div class="row">
            <div class="heading">
                <h1>{{ $page_title }}</h1>
            </div>
        </div>
        <div class="row">
            @if($dream_check_lab_status == 1)   {{-- cioè: if state_id = 5 (in db) --}}
                <div class="col-md-12 alert alert-info">
                Thank you for your confirmation! You are now being matched to your consultant. He or she will review the forms you have submitted within the next 3 working days.
                Please go to <a href="{{ url('user/mydocuments') }}" >My Documents</a> section to download Dream check lab forms.
                </div>
            @else
                <div class="col-md-12">
                <div class="dream_check_lab">
                    <p>We can almost see you there, behind your screen…growing impatient and wanting to get some action.</p>
                    <p>Now the time has come. With Wexplore’s support, you will develop your own career success action plan.</p>
                    <p>Ready? Let’s start: </p>
                    <ul class="nav nav-tabs">
                        <li id="product-li" class="{{$active == 1 ? "active" : ""}}"><a data-toggle="tab" href="#product-tab">Product</a></li>
                        <li id="price-li" class="{{$active == 2 ? "active" : ""}}"><a data-toggle="tab" href="{{$step > 0 ? "#price-tab" : ""}}">Price</a></li>
                        <li id="place-li" class="{{$active == 3 ? "active" : ""}}"><a data-toggle="tab" href="{{$step > 1 ? "#place-tab" : ""}}">Place</a></li>
                        <li id="promotion-li" class="{{$active == 4 ? "active" : ""}}"><a data-toggle="tab" href="{{$step > 2 ? "#promotion-tab" : ""}}">Promotion</a></li>
                    </ul>

                   <div class="tab-content">
                       <div id="product-tab" class="tab-pane fade {{$active == 1 ? "in active" : ""}}">
                       {{-- dd($step) --}}
                          @if(strstr($step,"5"))  {{-- strstr restituisce un valore o 'false'. 5 significa: 5 steps completati --}} 
                              {{-- in db, 'state_id': primo step --> 1, secondo step: 12, terzo step: 123, quarto step: 1234, quinto step: 5 (!) --}}
                              <h3>1. Product – Who are You</h3>
                              <div class="col-md-12">
                                <a href="{{ url($dream_check_lab['cv_file']) }}" class="btn btn-primary"><span class = "glyphicon glyphicon-download"></span> Download CV</a>
                              </div>
                          @else

                          <form id="form_1" method="post" action="{{ url('user/dream_check_lab/store') }}" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <h3>1. Product – Who are You</h3>
                              <p>Your profile is the main product you are “selling” on the market: it is therefore important to present it in the best possible way. </p>
                              <p>Please upload here your CV. Your consultant will review it and share with you his/her comments within 48 h.</p>
                              <div class="form-group cv-up">
                                  <label for="upload_cv">Upload your CV</label>
                                  <p></p>
                                  <p>NOTE: Please make sure your CV should already be in the local language, or at least in English: in this way your consultant will be able to recommend how to best adapt it to the local market. </p>
                                  <p>Also, please make sure your CV is in an editable form (either <b>.doc</b> or <b>.docx</b>), to make the review process easier. </p>
                                  <p></p>
                                  <input required type="file" name="upload_cv">
                              </div>

                              @if($dream_check_lab['cv_file'] != null)
                                   <?php
                                     $array = explode('/', $dream_check_lab['cv_file']);
                                     $name = end($array);
                                   ?>
                                    <p style="color:green;">CV uploaded: {{ $name ? : '' }}.</p>
                                    <script>
                                      jQuery('.cv-up').hide();
                                    </script>
                                  <div class="download-pdf" style="margin-bottom: 20px;">
                                    <a href="{{ url($dream_check_lab['cv_file']) }}" class="btn btn-primary"><span class = "glyphicon glyphicon-download"></span> Download CV</a>
                                    <button class="btn btn-primary cv-change"><span class = "glyphicon glyphicon-upload"></span> Change CV</button>
                                    <script>
                                      jQuery(document).ready(function () {
                                        $('.cv-change').on('click', function(){
                                          $('.cv-up').toggle();
                                          $('.ch-upl-cv').toggle();
                                          $('.download-pdf').hide();
                                        });
                                      });
                                    </script>
                                  </div>
                              {{-- @else --}}
                              @endif

                              <input type="hidden" name="state_id" value="1">

                              @if ($dream_check_lab['cv_file'] != null)
                                  <div class="form-group ch-upl-cv" style="margin-top:20px;">
                                    <input name="submit" type="submit" id="submit_1" value="Change uploaded CV">
                                  </div>
                                  <script>
                                    jQuery('.ch-upl-cv').hide();
                                  </script>    
                              @else
                                  <div class="form-group">
                                    <input name="submit" type="submit" id="submit_1" value="Upload CV">
                                  </div>
                              @endif 
                              
                          </form>

                          @endif

                               <input name="submit_1" type="submit" class="btn btn-success submit-button"  id="next_1" value="Next" {{ $dream_check_lab['cv_file'] != null ? '' : 'disabled' }}>
                               <input name="submit_1" type="submit" class="btn btn-success loading-button" style="display: none;" disabled value="Loading..">
                       </div>
                       <div id="price-tab" class="tab-pane fade {{$active == 2 ? "in active" : ""}}">
                           @if(strstr($step,"5"))
                           <h3>2. Price – What you did</h3>
                           <h4>Achievement 1:</h4>
                           <div class="col-md-12">
                               <label>Role & Organization</label>
                               <p>{{ $dream_check_lab['achievement_role_organization1'] }}</p>
                           </div>
                           <div class="col-md-12">
                               <label>Problem (issue to be solved – goal to be achieved – context)</label>
                               <p>{{ $dream_check_lab['achievement_problem1'] }}</p>
                           </div>
                           <div class="col-md-12">
                               <label>Action (what you did, how, which resources you used)</label>
                               <p>{{ $dream_check_lab['achievement_action1'] }}</p>
                           </div>
                           <div class="col-md-12">
                               <label>Result (tangible and quantifiable outcomes)</label>
                               <p>{{ $dream_check_lab['achievement_result1'] }}</p>
                           </div>
                           <div class="col-md-12">
                               <label>Which skills you have demonstrated through this achievement?</label>
                               <p>{{ $dream_check_lab['achievement_skills1'] }}</p>
                           </div>
                           <h4>Achievement 2:</h4>
                           <div class="col-md-12">
                               <label>Role & Organization</label>
                               <p>{{ $dream_check_lab['achievement_role_organization2'] }}</p>
                           </div>
                           <div class="col-md-12">
                               <label>Problem (issue to be solved – goal to be achieved – context)</label>
                               <p>{{ $dream_check_lab['achievement_problem2'] }}</p>
                           </div>
                           <div class="col-md-12">
                               <label>Action (what you did, how, which resources you used)</label>
                               <p>{{ $dream_check_lab['achievement_action2'] }}</p>
                           </div>
                           <div class="col-md-12">
                               <label>Result (tangible and quantifiable outcomes)</label>
                               <p>{{ $dream_check_lab['achievement_result2'] }}</p>
                           </div>
                           <div class="col-md-12">
                               <label>Which skills you have demonstrated through this achievement?</label>
                               <p>{{ $dream_check_lab['achievement_skills2'] }}</p>
                           </div>
                           <h4>Achievement 3:</h4>
                           <div class="col-md-12">
                               <label>Role & Organization</l<input type="hidden" name="state_id" value="1"></label>
                                   <p>{{ $dream_check_lab['achievement_role_organization3'] }}</p>
                           </div>
                           <div class="col-md-12">
                               <label>Problem (issue to be solved – goal to be achieved – context)</label>
                               <p>{{ $dream_check_lab['achievement_problem3'] }}</p>
                           </div>
                           <div class="col-md-12">
                               <label>Action (what you did, how, which resources you used)</label>
                               <p>{{ $dream_check_lab['achievement_action3'] }}</p>
                           </div>
                           <div class="col-md-12">
                               <label>Result (tangible and quantifiable outcomes)</label>
                               <p>{{ $dream_check_lab['achievement_result3'] }}</p>
                           </div>
                           <div class="col-md-12">
                               <label>Which skills you have demonstrated through this achievement?</label>
                               <p>{{ $dream_check_lab['achievement_skills3'] }}</p>
                           </div>
                           @else
                           <form id="form_2" method="post" action="{{ url('user/dream_check_lab/store') }}" enctype="multipart/form-data">
                               {{ csrf_field() }}
                               <h3>2. Price – What you did</h3>
                               <p>Have you ever heard the saying “Actions speak louder than words?”. This is especially important now, as all prospect employers want to have evidence of exactly how good you are – in other words, they are trying to see if you are worth investing their money on. The best way to do that is to provide facts.</p>
                               <p>You are a great team player, problem solver, who shows a lot of initiatives in life? That’s great: prove it!</p>
                               <p>The forms below will help you come up with great examples.</p>
                               <p>They allow you to think through some key achievements in your life, and to focus on your past success. These achievements represent a good indicator of your key strengths also to your prospect employer. The logic is: as you have already done something valuable in the past, you can do the same in the future.</p>
                               <p>Try to come up with atsubmit least 3 achievements: they can be big or small, the important thing is that they are relevant for you and emphasize your best skills.</p>
                               @for ($i=1; $i <= 3; $i++)
                                   <h4>Achievement {{ $i  }}:</h4>
                                   <div class="form-group">
                                       <label for="achievement[{{ $i }}][role_organization']">Role & Organization</label>
                                       <textarea required name="achievement[{{ $i }}][role_organization]">{{ old("achievement.".$i.".role_organization") != null ? old("achievement.".$i.".role_organization") : isset($dream_check_lab['achievement_role_organization'.$i] ) ? $dream_check_lab['achievement_role_organization'.$i] : "" }}</textarea>
                                   </div>
                                   <div class="form-group">
                                       <label for="achievement[{{ $i }}][problem]">Problem (issue to be solved – goal to be achieved – context)</label>
                                       <textarea required name="achievement[{{ $i }}][problem]">{{ old("achievement.".$i.".problem") != null ? old("achievement.".$i.".problem")  : isset($dream_check_lab['achievement_problem'.$i]) ? $dream_check_lab['achievement_problem'.$i] : "" }}</textarea>
                                   </div>
                                   <div class="form-group">
                                       <label for="achievement[{{ $i }}][action]">Action (what you did, how, which resources you used)</label>
                                       <textarea required name="achievement[{{ $i }}][action]">{{ old("achievement.".$i.".action") != null ?  old("achievement.".$i.".action") : isset( $dream_check_lab['achievement_action'.$i] ) ?  $dream_check_lab['achievement_action'.$i]  : ""}}</textarea>
                                   </div>
                                   <div class="form-group">
                                       <label for="achievement[{{ $i }}][result]">Result (tangible and quantifiable outcomes)</label>
                                       <textarea required name="achievement[{{ $i }}][result]">{{ old("achievement.".$i.".result") != null ? old("achievement.".$i.".result") : isset($dream_check_lab['achievement_result'.$i]) ? $dream_check_lab['achievement_result'.$i] : "" }}</textarea>
                                   </div>
                                   <div class="form-group">
                                       <label for="achievement[{{ $i }}][skills]">Which skills you have demonstrated through this achievement?</label>
                                       <textarea required name="achievement[{{ $i }}][skills]">{{ old("achievement.".$i.".skills") != null ? old("achievement.".$i.".skills")  : isset( $dream_check_lab['achievement_skills'.$i]) ? $dream_check_lab['achievement_skills'.$i] : "" }}</textarea>
                                   </div>
                               @endfor
                               <input type="hidden" name="state_id" value="2">
                               <p>NOTE: feel free to use this form as a template to think for more than 3 achievements. In this way, you will have a vast library of ready-made anecdotes and examples during your interviews.</p>
                               <p>Also, start by writing in your own language if it makes you more comfortable, but make sure your consultant will be able to understand what you write! </p>
                               <!--<p>Please confirm you want to submit the DreamCheck Lab forms: in other words, have you thought of all your best and most rewarding achievements? Did you nail down your USP? If you feel confident that you have presented yourself in the best possible way, please click Save Changes.</p>-->
                               <div class="form-group">
                                   <input name="submit" type="submit" id="submit_2" value="Save Changes">
                               </div>
                           </form>
                           @endif
                           <?php // se tutti i campi sono salvati in db --> attiva pulsante "next" altrimenti disattiva

                           ?>
                               <input name="back_1" type="submit" id="back_1" class="btn btn-warning" value="Back">
                               <input name="submit_2" type="submit" id="next_2" class="btn btn-success submit-button" value="Next" title="Save Changes before proceed" disabled>
                               <input name="loading_2" type="submit" class="btn btn-success loading-button" style="display: none;" disabled value="Loading..">
                       </div>
                       <div id="place-tab" class="tab-pane fade {{$active == 3 ? "in active" : ""}}">
                           @if(strstr($step,"5"))
                           <h3>3. Place – What you can do</h3>
                           <div class="col-md-12">
                               <label>Your Objective</label>
                               <p>{{ $dream_check_lab['your_objective'] }}</p>
                           </div>
                           <div class="col-md-12">
                               <label>Your Motivation (why you want to move out of your own country)</label>
                               <p>{{ isset($dream_check_lab['motivation']) ? $dream_check_lab['motivation'] : "" }}</p>
                           </div><input type="hidden" name="state_id" value="1">
                           <div class="col-md-12">
                               <label>Role/position</label>
                               <p>{{ isset($dream_check_lab['role_position']) ? $dream_check_lab['role_position'] : "" }}</p>
                           </div>
                           <div class="col-md-12">
                               <label>Industry/area of business</label>
                               <p>{{ isset($dream_check_lab['industry']) ? $dream_check_lab['industry'] : "" }}</p>
                           </div>
                           <div class="col-md-12">
                               <label>Company characteristics (size, geographical presence, markets, family owned or listed…)</label>
                               <p>{{ isset($dream_check_lab['company_characteristics']) ? $dream_check_lab['company_characteristics'] : "" }}</p>
                           </div>
                           <div class="col-md-12">
                               <label>Skills that support this objective</label>
                               <p>{{ isset($dream_check_lab['skills_support_objective']) ? $dream_check_lab['skills_support_objective'] : "" }}</p>
                           </div>
                           <div class="col-md-12">
                               <label>Areas of weakness that hinder this objective</label>
                               <p>{{ isset($dream_check_lab['weakness_area']) ? $dream_check_lab['weakness_area'] : "" }}</p>
                           </div>
                           <div class="col-md-12">
                               <label>Is the objective achievable? Why or why not?</label>
                               <p>{{ isset($dream_check_lab['achievable_objective']) ? $dream_check_lab['achievable_objective'] : "" }}</p>
                           </div>
                           <div class="col-md-12"><input type="hidden" name="state_id" value="1">
                               <label>What can you do to fill the gap?</label>
                               <p>{{ isset($dream_check_lab['fill_gap']) ? $dream_check_lab['fill_gap'] : "" }}</p>
                           </div>
                       @else
                           <form id="form_3" method="post" action="{{ url('user/dream_check_lab/store') }}" enctype="multipart/form-data">
                               {{ csrf_field() }}
                               <h3>3. Place – What you can do</h3>
                               <p>Your past achievements are a great way to introduce yourself, but still they do not tell the complete tale. They are related to the past, but what is your future plan? The key for being a successful candidate is to present in a very clear way how you can apply your skills in your next job. The best way to do so is to be very clear on this point yourself.</p>
                               <p>Let us guide you through this process through the form below.</p>
                               <div class="form-group">
                                   <label for="your_objective">Your Objective</label>
                                   <textarea required name="your_objective">{{ old('your_objective') != null ? old('your_objective') : isset($dream_check_lab['your_objective']) ? $dream_check_lab['your_objective'] : "" }}</textarea>
                               </div>
                               <div class="form-group">
                                   <label for="motivation">Your Motivation (why you want to move out of your own country)</label>
                                   <textarea required name="motivation">{{ old('motivation') != null ? old('motivation') :  isset($dream_check_lab['motivation']) ? $dream_check_lab['motivation'] : "" }}</textarea>
                               </div>
                               <div class="form-group">
                                   <label for="role_position">Role/position</label>
                                   <textarea required name="role_position">{{ old('role_position') != null ? old('role_position') :  isset($dream_check_lab['role_position']) ? $dream_check_lab['role_position'] : "" }}</textarea>
                               </div>
                               <div class="form-group">
                                   <label for="industry">Industry/area of business</label>
                                   <textarea required name="industry">{{ old('industry') != null ? old('industry') : isset($dream_check_lab['industry']) ? $dream_check_lab['industry'] : "" }}</textarea>
                               </div>
                               <div class="form-group">

                                   <label for="company_characteristics">Company characteristics (size, geographical presence, markets, family owned or listed…)</label>
                                   <textarea required name="company_characteristics">{{ old('company_characteristics') != null ? old('company_characteristics') : isset($dream_check_lab['company_characteristics']) ? $dream_check_lab['company_characteristics'] : ""}}</textarea>
                               </div>
                               <div class="form-group">
                                   <label for="skills_support_objective">Skills that support this objective</label>
                                   <textarea required name="skills_support_objective">{{ old('skills_support_objective') != null ? old('skills_support_objective') : isset($dream_check_lab['skills_support_objective']) ? $dream_check_lab['skills_support_objective'] : "" }}</textarea>
                               </div>
                               <div class="form-group">
                                   <label for="weakness_area">Areas of weakness that hinder this objective.</label>
                                   <textarea required name="weakness_area">{{ old('weakness_area') != null ? old('weakness_area') : isset($dream_check_lab['achievable_objective']) ? $dream_check_lab['weakness_area'] :  $dream_check_lab['weakness_area']  }}</textarea>
                               </div>
                               <div class="form-group">
                                   <label for="achievable_objective">Is the objective achievable? Why or why not?</label>
                                   <textarea required name="achievable_objective">{{ old('achievable_objective') != null ? old('achievable_objective') : isset($dream_check_lab['achievable_objective']) ? $dream_check_lab['achievable_objective'] :  "" }}</textarea>
                               </div>
                               <div class="form-group">
                                   <label for="fill_gap">What can you do to fill the gap?</label>
                                   <textarea required name="fill_gap">{{ old('fill_gap') != null ? old('fill_gap') : isset($dream_check_lab['fill_gap']) ? $dream_check_lab['fill_gap'] : ""  }}</textarea>
                               </div>
                               <input type="hidden" name="state_id" value="3">
                              <div class="form-group">
                                   <input name="submit" type="submit" id="submit_3"  value="Save Changes" class="submit-button">
                               </div>
                           </form>
                               <p>NOTE:</p>
                               <p>Candidates who apply to “any job” and are willing to work “anywhere”, in reality will get nowhere!</p>
                               <p>Recruiters and prospect employers will not have clear how they can use those profiles, what those profiles can do for them…so they tend to forget these candidates within 15 min!</p>
                               <p>Remember, be as specific as possible! Select an objective that is S.M.A.R.T. (Peter Drucker ©): Specific, Measurable, Achievable, Realistic, Time Related.</p>
                               <p>Also, remember that “wanting a different experience” or “I cannot find a job in my own country” are not the best indicators of your commitment to relocate. Try to come up with reasons related to the content of the job or the kind of company you are addressing. The only “acceptable” personal reason? Having a partner/spouse/family member in the target country!</p>
                               <!--<p>Please confirm you want to submit the DreamCheck Lab forms: in other words, have you thought of all your best and most rewarding achievements? Did you nail down your USP? If you feel confident that you have presented yourself in the best possible way, please click submit.</p>-->

                           @endif
                               <input name="back_2" type="submit" class="btn btn-warning" id="back_2" value="Back">
                               <input name="submit_3" id="next_3" class="btn btn-success submit-button" type="submit" value="Next" title="Save Changes before proceed" disabled>
                               <input name="loading_3" type="submit" class="btn btn-success loading-button" style="display: none;" disabled value="Loading..">
                       </div>
                       <div id="promotion-tab" class="tab-pane fade {{$active == 4  ? "in active" : ""}}">
                           @if(strstr($step,"5"))
                           <div class="col-md-12">
                               <label>why should we choose you?</label>
                               <p>{{ $dream_check_lab['promotion_usp'] }}</p>
                           </div>

                           <div class="col-md-12">
                               <label>Interested Country</label>
                               <p>{{ $dream_check_lab['interest_country'] }}</p>
                           </div>
                           @else
                              <div id="promo_form">
                                <form id="form_4" method="post" action="{{ url('user/dream_check_lab/store') }}" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <h3>4. Promotion – Your USP</h3>
                                  <p>One more step to go: use this space below to put down your Unique Selling Point. In other words, what makes you special? What would be your answer to the question “why should we choose you”?</p>
                                  <div class="form-group">
                                    <textarea required name="promotion_usp">{{ old('promotion_usp') != null ? old('promotion_usp') : isset($dream_check_lab['promotion_usp']) ? $dream_check_lab['promotion_usp'] : "" }}</textarea>
                                  </div>
                                  <input type="hidden" name="state_id" value="4">
                                  <p>NOTE: Did you know that different countries look at different things? Anglosaxon countries are all about achievements, German countries favour expertise, Latin countries appreciate soft skills (problem solving, leadership, creativity…), and Scandinavian countries would look for people skills (teamwork, initiative, motivating others…). Try to put yourself in the other’s shoes and adapt your USP to these cultural-based expectations. </p>
                                </form>
                                <div class="form-group">
                                  <input name="submit_4" id="submit_4" type="submit" value="Save Changes">
                                </div>
                                <input name="back_3" type="submit" class="btn btn-warning" id="back_3" value="Back">
                                <input name="submit_4" id="next_4" class="btn btn-success" type="submit" value="Next" disabled title="Save Changes before proceed">
                              </div>
                              <div id="outro" style="display: none;">
                                <form id="final_form" method="post" action="{{ url('user/dream_check_lab/submit') }}" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <h3>Congratulations!</h3>
                                  <p>Now is the time to meet your consultant: a career expert from our network, based in the same country that you are interested in. He or she will be your coach, and ensure you are prepared to score plenty of goals in your job search process. </p>

                                  <div class="form-group">
                                    <label for="interest_country">Please confirm your country of interest below</label>
                                    <select required name="interest_country" style="padding:8px;">
                                       <option value ="">-- Choose Country --</option>
													<option @if(old('interest_country') == 'Australia') selected="selected" @endif value="Australia">Australia</option>
                          <option @if(old('interest_country') == 'Belgium') selected="selected" @endif value="Belgium">Belgium</option>
													<option @if(old('interest_country') == 'France') selected="selected" @endif value="France">France</option>
													<option @if(old('interest_country') == 'Germany') selected="selected" @endif value="Germany">Germany</option>
													<option @if(old('interest_country') == 'Italy') selected="selected" @endif value="Italy">Italy</option>
													<option @if(old('interest_country') == 'Netherlands') selected="selected" @endif value="Netherlands">Netherlands</option>
													<option @if(old('interest_country') == 'Spain') selected="selected" @endif value="Spain">Spain</option>
                          <option @if(old('interest_country') == 'Sweden') selected="selected" @endif value="Sweden">Sweden</option>
													<option @if(old('interest_country') == 'Switzerland') selected="selected" @endif value="Switzerland">Switzerland</option>
													<option @if(old('interest_country') == 'United Kingdom') selected="selected" @endif value="United Kingdom">United Kingdom</option>

													<?php /*
                                       @foreach($country as $country_res)
                                           <option @if(old('interest_country') == $country_res['country_name']) selected="selected" @endif value = "{{  $country_res['country_name'] }}">{{  $country_res['country_name'] }}</option>
                                       @endforeach
													*/ ?>
                                   </select>
                              </div>
                              <input type="hidden" name="form_id" value="{{ isset($dream_check_lab['id']) ? $dream_check_lab['id'] : "" }}" id="form_id">
                              <input type="hidden" name="state_id" value="5">
                               <!--<p>Please confirm you want to submit the DreamCheck Lab forms: in other words, have you thought of all your best and most rewarding achievements? Did you nail down your USP? If you feel confident that you have presented yourself in the best possible way, please click submit.</p>-->
                               <p>Note: After Submitting, you will not be able to edit the forms anymore.</p>
                               <div class="form-group Submit_final_form">
                                  <input name="submit_final" id="submit_final" type="submit" value="Submit Form" class="submit-button">
                                   



                                  <div id="wait-modal" class="modal fade loading-button" style="display: none; opacity: 1!important; z-index: 999999!important;" role="dialog" title="Wait please..."> 
                                  <!--disabled-->
                                    <div class="modal-dialog" style="top:45px;">
                                      <!-- Modal content-->
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <!--button type="button" class="close" data-dismiss="modal">&times;</button-->
                                          <h4 class="modal-title text-center">..Please wait a moment..</h4>
                                        </div>
                                        <div class="modal-body text-center">
                                          <p>We are processing your inputs. It takes a few seconds to process your request.<br>Please wait for our success notification...<span id="countdown"></span></p>
                                          <p>
                                            <img src="/en/frontend/images/loading.gif" />
                                          </p>  
                                        </div>
                                        <!--div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal" disabled>Close</button>
                                        </div-->
                                      </div>

                                    </div>                                     
                                  </div><!--#wait-modal-->





                               </div>
                               </form>
                                   <input name="back_4" type="submit" class="btn btn-warning" id="back_4" value="Back">
                               </div>
                           @endif
                       </div>
                   </div>
                  </div>
                </div>
            </div>
            @endif
        </div>
    <div id="success_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center" id="modal_message"><i class="fa fa-check"></i> Successfully Saved</h4>
                </div>
            </div>
        </div>
    </div><!-- end Modal -->
    </div>

	 <script src="{{ asset('frontend/js/jquery-2.1.4.min.js') }}"></script>
	 <script src="{{ asset('frontend/js/jquery.ui.js') }}"></script>
    <script>
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery(document).ready(function () {

          jQuery("#submit_1").click(function(e) {
              if (!jQuery("#form_1")[0].checkValidity()) {
                  // If the form is invalid, submit it. The form won't actually submit;
                  // this will just cause the browser to display the native HTML5 error messages.
                  jQuery("#form_1").submit();
              }else { var has_selected_file = jQuery('input[type=file]').filter(function(){
                  return jQuery.trim(this.value) != ''
              }).length  > 0 ;

              if (has_selected_file) {
                  /* do something here */
              }
                  e.preventDefault();
                  submitForm("#form_1");
              }
          });

          jQuery("#submit_2").click(function(e) { 
              if (!jQuery("#form_2")[0].checkValidity()) {
                  // If the form is invalid, submit it. The form won't actually submit;
                  // this will just cause the browser to display the native HTML5 error messages.
                  jQuery("#form_2").submit();  // stop!
              } else {
                  e.preventDefault();
                  submitForm("#form_2"); // go! to custom func 
                  // abilita "Next" button che di default è disabilitato 
                  $('#next_2').prop('disabled', false).prop('title','Go Next Step');
              }
          });

          jQuery("#submit_3").click(function(e) {
              if (!jQuery("#form_3")[0].checkValidity()) {
                  // If the form is invalid, submit it. The form won't actually submit;
                  // this will just cause the browser to display the native HTML5 error messages.
                  jQuery("#form_3").submit();
              } else {
                  e.preventDefault();
                  submitForm("#form_3");
                  // abilita "Next" button che di default è disabilitato
                  $('#next_3').prop('disabled', false).prop('title','Go Next Step');
              }
          });

          jQuery("#submit_4").click(function(e) {
              if (!jQuery("#form_4")[0].checkValidity()) {
                  // If the form is invalid, submit it. The form won't actually submit;
                  // this will just cause the browser to display the native HTML5 error messages.
                  jQuery("#form_4").submit();
              }else {
                  e.preventDefault();
                  submitForm("#form_4");
                  // abilita "Next" button che di default è disabilitato
                  $('#next_4').prop('disabled', false).prop('title','Go Next Step');
              }
          });



          jQuery("#back_1").click(function() {
              jQuery("#product-li").find("a").attr("href","#product-tab").trigger('click');
              scrollTo(document.body, 0, 100);
          });
          jQuery("#back_2").click(function() {
              jQuery("#price-li").find("a").attr("href","#price-tab").trigger('click');
              scrollTo(document.body, 0, 100);
          });
          jQuery("#back_3").click(function() {
              jQuery("#place-li").find("a").attr("href","#place-tab").trigger('click');
              scrollTo(document.body, 0, 100);
          });
          jQuery("#back_4").click(function() {
              jQuery("#promotion-li").find("a").attr("href","#promotion-tab").trigger('click');
              jQuery("#promo_form").show();
              jQuery("#outro").hide();
              scrollTo(document.body, 0, 100);
          });



          jQuery("#next_3").click(function() {
              jQuery("#place-li").find("a").attr("href","#place-tab").trigger('click');
              scrollTo(document.body, 0, 100);
          });
          jQuery("#next_1").click(function() {
              jQuery("#price-li").find("a").attr("href","#price-tab").trigger('click');
              scrollTo(document.body, 0, 100);
          });


          jQuery("#next_2").click(function() {  
              jQuery("#place-li").find("a").attr("href","#place-tab").trigger('click');
              scrollTo(document.body, 0, 100);
          });


          jQuery("#next_3").click(function() {
              jQuery("#promotion-li").find("a").attr("href","#promotion-tab").trigger('click');
              scrollTo(document.body, 0, 100);
          });
          jQuery("#next_4").click(function() {
              jQuery("#promo_form").hide();
              jQuery("#outro").show();
          });



          jQuery("#submit_final").click(function(e) {
              e.preventDefault();
              var values = jQuery("#final_form").serialize(); // create url encoded string
              console.log('Valori passati: ' + values);

              jQuery('#submit_final').hide();
              jQuery('.loading-button').css('display', 'block');
              jQuery('#back_4').prop('disabled', true);

              // start 60 sec. countdown
              var timeLeft = 60;
              var elem = jQuery('#countdown');
              var timerId = setInterval(countdown, 1000);

              function countdown() {
                if (timeLeft == 0) {
                  clearTimeout(timerId);
                  // timeLeft = 60;
                  // elem.html(timeLeft + ' seconds remaining..');
                  timeLeft--;
                } else {
                  elem.html(' <b>'+timeLeft + ' seconds remaining..</b>');
                  timeLeft--;
                }
              }
                                          

              // submit form
              jQuery.ajax({
                  headers: {
                      'X-CSRF-TOKEN': jQuery('input[name="_token"]').attr('value')
                  },
                  url: jQuery("#final_form").attr('action'),  // http://wexplore.dev/en/user/dream_check_lab/submit"
                  type: 'POST',
                  data: values,  // token + interest_country + form_id + state_id (5 se completo)
                  success: function (data) {
                      console.log('Success - return assoc. array ($data)');
                      console.log('Status: '+data.status); // 'OK' ? ...

                      if(typeof data.status == 'undefined') {
                          jQuery('body').html(data);
                      }else if(data.status == 'NOK') {
                          var state = "{{ $dream_check_lab['state_id'] }}";
                          var missing  = '';
                          if(state.indexOf('1') <= -1 ) {
                              missing += "Step 1, ";
                          }
                          if(state.indexOf('2') <= -1 ) {
                              missing += "Step 2, ";
                          }
                          if(state.indexOf('3') <= -1 ) {
                              missing += "Step 3, ";
                          }
                          if(state.indexOf('4') <= -1 ) {
                              missing += "Step 4, ";
                          }
                          missing =  missing.slice(0, -2);
                          jQuery("#modal_message").html("<i class='fa fa-info'></i>Complete Your form first. Step " +missing+ " to be completed yet.");
                          jQuery("#success_modal").modal('show');
                         // alert('Complete Your form first. '+missing+' to be completed yet');
                      }else{
                          // console.log('redirect ...');
                          location.replace(data.url);  // redirect a pagina iniziale !!
                      }
                      scrollTo(document.body, 0, 100);
                  }
              });
          });


        function submitForm(form) {
            if (!jQuery(form)[0].checkValidity()) {
                // If the form is invalid, submit it. The form won't actually submit;
                // this will just cause the browser to display the native HTML5 error messages.
                jQuery(form).submit();
            }else {
                jQuery("#loading_button").show();
                jQuery("#submit-button").hide();

                var fd = new FormData();
                var has_selected_file = jQuery('input[type=file]').filter(function(){
                            return jQuery.trim(this.value) != ''
                        }).length  > 0 ;

                if (has_selected_file) {
                    var file_data = jQuery('input[type="file"]')[0].files; // for multiple files
                    for(var i = 0;i<file_data.length;i++){
                        fd.append("upload_cv", file_data[i]);
                    }
                }
                var other_data = jQuery(form).serializeArray();
                jQuery.each(other_data, function (key, input) {
                    fd.append(input.name, input.value);
                });
                var token = jQuery('input[name="_token"]').attr('value');
                fd.append("_token", "{{ csrf_token() }}");
                console.log(form);
                console.log(jQuery(form).attr('action'));
                console.log(token);
                jQuery.ajax({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('input[name="_token"]').attr('value')
                    },
                    url: jQuery(form).attr('action'),
                    type: 'POST',
                    data: fd,
                    async: false,
                    success: function (data) {
                        if(typeof data.html != 'undefined') {
                            jQuery("body").html(data.html);
                            jQuery("#form_id").val(data.dream_check_lab_id);
                            jQuery("#success_modal").modal('show');
                        }else{
                            jQuery("body").html(data);
                        }

                        scrollTo(document.body, 0, 100);
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    complete:function() {
                        jQuery(".loading_button").hide();
                        jQuery(".submit-button").show();
                    }
                });
                return false;
            }

        }

        });
    </script>
@endsection
