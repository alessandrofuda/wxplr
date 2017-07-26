@extends('admin.layout')
@section('content')
<div class='row'>
    <div class="col-md-12">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
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
    <div class='col-md-12'>
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ $page_title }}</h3> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="user_update_wrapper" class="dataTables_wrapper dt-bootstrap">
                    <div class="box-body">
                      <form role="form" method="post" action="@if (isset($question)){{ url('admin/question/'.$question->id.'/edit') }}@else {{ url('admin/question/create') }}@endif">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Question</label>
                          <textarea name="question" required class="form-control" placeholder="Enter question here..." >@if (isset($question)){{ $question->question }}@endif</textarea>
                        </div>
                        <div class="form-group">
                          <label>Choice 1</label>
                          <input type="text" name="choice1" class="form-control" placeholder="Enter choice here..." value="@if (isset($question)){{ $question->questionChoices[0]->choice }}@endif">
                        </div>
						<div class="form-group">
                          <label>Choice 2</label>
                          <input type="text" name="choice2" class="form-control" placeholder="Enter choice here..." value="@if (isset($question)){{ $question->questionChoices[1]->choice }}@endif">
                        </div>
                        <div class="form-group">
                            <label>Parent Choice</label>
                            <select name="parent_choice" class="form-control">
                                <option  value="_none" @if (!isset($question) || empty($question->parent_choice)) selected @endif>-- None --</option>
                                {{--*/ $ques='' /*--}}
								{{--*/ $i=1 /*--}}
								{{--*/ $choices_count = count($choices) /*--}}
								@if (isset($choices) && count($choices) > 0)
                                    @foreach ($choices as $choice)
										@if(empty($ques))
											<optgroup value="0" label="Question: {{$choice->globalTest->question}}">
										@elseif(!empty($ques) && $ques != $choice->globalTest->id)
											</optgroup>
											<optgroup value="0" label="Question: {{$choice->globalTest->question}}">
										@endif
                                        <option @if (isset($question) && $question->parent_choice == $choice->id ) selected @endif value="{{ $choice->id }}">Choice: {{ $choice->choice }}</option>
										@if($choices_count==$i){
											</optgroup>
										@endif
										{{--*/ $ques=$choice->globalTest->id /*--}}
									@endforeach
                                @endif
                            </select>
                        </div>
                        <input type="hidden" name="question_id" value="@if (isset($question)) {{ $question->id }} @endif">
                        <input type="hidden" name="form_type" value="@if (isset($question)) edit @else create @endif">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('admin/global_test_list') }}" class="btn btn-default">Cancel</a>
                      </form>
                    </div><!-- /.box-body -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection