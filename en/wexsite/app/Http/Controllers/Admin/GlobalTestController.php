<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;
use App\GlobalTest;
use App\GlobalTestChoices;
use App\GlobalTestOutcomes;
use App\GlobalTestResult;
use App\User;

class GlobalTestController extends Controller
{
    /**
     * Display a listing of the GlobalTest.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions=GlobalTest::all();
		$child_que=array();
		foreach($questions as $question){
			$choices = array($question->questionChoices[0]->id,$question->questionChoices[1]->id);
			$parent_choices=GlobalTest::whereIn('parent_choice',$choices)->get();
			$child_que=[];
			if($parent_choices->count() > 0){
				foreach($parent_choices as $parent_choice){
					$child_que[]=$parent_choice->question;
				}
				$parent_status=1;
			}
			else {
				$parent_status=0;
			}
			$question_data[]=(object)array('id'=>$question->id,
										   'question'=>$question->question,
										   'parent_status'=>$parent_status,
										   'child_que'=>$child_que,
										   );
		}
    	$data['page_title']='Global Orientation Test';
        $data['questions']=(object)$question_data;
        return view('admin.global_test_list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$parent_choices=GlobalTest::where('parent_choice','!=','Null')->get();
		$parent_arr=array();
		foreach($parent_choices as $parent_choice){
			$parent_arr[]=$parent_choice->parent_choice;
		}
		$outcomes=GlobalTestOutcomes::all();
		foreach($outcomes as $outcome){
			$parent_arr[]=$outcome->choice_id;
		}
		$choices=GlobalTestChoices::whereNotIn('id', $parent_arr)->get();
		//echo '<pre>'; print_r($choices); die;
    	$data['page_title']='Global Orientation Test';
		$data['choices']=$choices;
        return view('admin.global_test_form',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required',
			'choice1' => 'required',
			'choice2' => 'required',
        ]);
        if ($validator->fails()) {
        	return redirect()->back()->withErrors($validator->errors());
        }
		$question_id=trim($request['question_id']);
		$question_name=trim($request['question']);
		$choice1=trim($request['choice1']);
		$choice2=trim($request['choice2']);
		$parent_choice=trim($request['parent_choice']);
		$form_type=trim($request['form_type']);
		$que_create['question']=$question_name;
		if($parent_choice != '_none') {
			$que_create['parent_choice']=$parent_choice;
		}
		// create qusetion
		$global_test=GlobalTest::create($que_create);
		$global_test_id=$global_test->id;
		// create choice
		$choice_data=array(
					array('question_id'=>$global_test_id, 'choice'=>$choice1, 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')),
					array('question_id'=>$global_test_id, 'choice'=>$choice2, 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s'))
					);
		GlobalTestChoices::insert($choice_data);
		
        return redirect('admin/questions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$question=GlobalTest::find($id);
		//$choices=GlobalTestChoices::all();
		$parent_choices=GlobalTest::where('parent_choice','!=','Null')->get();
		$parent_arr=array();
		foreach($parent_choices as $parent_choice){
			if($question->parent_choice != $parent_choice->parent_choice){
				$parent_arr[]=$parent_choice->parent_choice;
			}
		}
		$outcomes=GlobalTestOutcomes::all();
		foreach($outcomes as $outcome){
			$parent_arr[]=$outcome->choice_id;
		}
		$choices=GlobalTestChoices::whereNotIn('id', $parent_arr)->get();
        $data['page_title']='Global Orientation Test';
		$data['question']=$question;
		$data['choices']=$choices;
        return view('admin.global_test_form',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$question_name=trim($request['question']);
		$choice1=trim($request['choice1']);
		$choice2=trim($request['choice2']);
		$parent_choice=trim($request['parent_choice']);
        $global_test = GlobalTest::find($id);
		$global_test->question = $question_name;
		if($parent_choice == '_none') {
			$global_test->parent_choice = NULL;
		}else {
			$global_test->parent_choice = $parent_choice;
		}
		$global_test->save();
		// update choices
		$global_test_choices = GlobalTestChoices::where('question_id',$id)->get();
		$i=0; 
		foreach($global_test_choices as $global_test_choice){
			$i++;
			$choice_val=${'choice'.$i};
			if($global_test_choice->choice != $choice_val){
				$global_test = GlobalTestChoices::find($global_test_choice->id)->update(['choice' => $choice_val]);;
			}
		}
		return redirect('admin/questions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		// Delete Question
        $question = GlobalTest::find($id);
        $question->delete();
		// Delete Choices of this question
		$choices = GlobalTestChoices::where('question_id',$question->id);
		$choice_obj=$choices->get();
        $choices->delete();
		foreach($choice_obj as $choice){
			$choice_ids[]=$choice->id;
		}
		// Delete outcomes linked to the choices of this question
		$outcomes=GlobalTestOutcomes::whereIn('choice_id', $choice_ids);
        $outcomes->delete();
        return redirect('admin/questions')->with('status', 'Question deleted!');
    }
	/**
     * Display a listing of the Outcomes.
     *
     * @return \Illuminate\Http\Response
     */
    public function outcomes()
    {
        $outcomes=GlobalTestOutcomes::all();
    	$data['page_title']='Global Orientation Test Outcomes';
        $data['outcomes']=$outcomes;
        return view('admin.outcomes',$data);
    }
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function outcome_choices()
    {
		$parent_choices=GlobalTest::where('parent_choice','!=','Null')->get();
		$parent_arr=array();
		foreach($parent_choices as $parent_choice){
			$parent_arr[]=$parent_choice->parent_choice;
		}
		$testchoices=GlobalTestChoices::whereNotIn('id', $parent_arr)->get();
		foreach($testchoices as $choice){  
			$choices[$choice->id]=array('choice'=>$choice->choice,
										'que_id'=>$choice->question_id,
										'question'=>$choice->globalTest->question,
										'outcome'=>!empty($choice->outcome) ? $choice->outcome['outcome_name'] : '<span class="alert-danger">Outcome is not set yet!</span>',
										);
		}
    	$data['page_title']='Global Orientation Test Outcome Choices';
		$data['choices']=$choices;
        return view('admin.outcome_choices',$data);
    }
	/**
     * Show the form for creating a list of outcome choices.
     *
     * @return \Illuminate\Http\Response
     */
    public function outcome_create($choice_id,$question_id)
    {
		$outcome=array();
		// get outcome data
		$outcomes=GlobalTestOutcomes::where('choice_id',$choice_id)->first();
		if(count($outcomes)>0){
			$outcome['outcome_id']=$outcomes->id;
			$outcome['outcome_name']=$outcomes->outcome_name;
			$outcome['outcome_image']=$outcomes->outcome_image;
			$outcome['outcome_file']=$outcomes->outcome_file;
			$outcome['description']=$outcomes->description;
		}
		// get test question tree
		$que_arr=array();
		$choices_arr=array(); 
		$questions=GlobalTest::all();
		if(count($questions)>0){
			foreach($questions as $que){
				$que_arr[$que->id]=array(
								'question' => $que->question,
								'parent_choice'=>$que->parent_choice,
								);
			}
		}
		$que_choices=GlobalTestChoices::all();
		if(count($que_choices)>0){
			foreach($que_choices as $que_choice){
				$choices_arr[$que_choice->id]=array(
											'question_id'=>$que_choice->question_id,
											'choice'=>$que_choice->choice,
											);
			}
		}
		$que_id=$question_id;
		$que_parent=$que_arr[$que_id]['parent_choice'];
		$que_selected_choice=$choice_id;
		while($que_parent != NULL){
			$ch=$que_arr[$que_id]['parent_choice'];
			$qu=$choices_arr[$ch]['question_id'];
			// get question tree
			$que_tree[]=array(
						'que_id'=>$que_id,
						'question'=>$que_arr[$que_id]['question'],
						'choice'=>$choices_arr[$que_selected_choice]['choice'],
						);
			$que_id=$qu;
			$que_parent=$que_arr[$que_id]['parent_choice'];
			$que_selected_choice=$ch;
		}
		$que_tree[]=array(
					'que_id'=>$que_id,
					'question'=>$que_arr[$que_id]['question'],
					'choice'=>$choices_arr[$que_selected_choice]['choice'],
					);
		//echo '<pre>'; print_r($que_tree); die;
		$que_tree=array_reverse($que_tree);
		// set variables to pass on view
    	$data['page_title']='Global Orientation Test Outcome';
		$data['outcome']=$outcome;
		$data['choice_id']=$choice_id;
		$data['que_tree']=$que_tree;
        return view('admin.outcome_form',$data);
    }
	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function outcome_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'outcome_name' => 'required|max:255',
			'outcome_image' => 'image',
			'outcome_file' => 'mimes:pdf',
			'desc' => 'required',
        ]);
        if ($validator->fails()) {
        	return redirect()->back()->withErrors($validator->errors());
        }
		$outcome_id=trim($request['outcome_id']);
		$outcome_name=trim($request['outcome_name']);
		$desc=trim($request['desc']);
		$choice_id=trim($request['choice_id']);
		$form_type=trim($request['form_type']);
		$global_test_data=array('outcome_name'=>$outcome_name,
							'choice_id'=>$choice_id,
							'description'=>$desc
							);
		$outcome_image = $request->file('outcome_image');
		$outcome_file = $request->file('outcome_file');

		if($form_type=='create'){
			$global_test_data['outcome_image'] = Setting::saveUploadedImage($outcome_image);
			$global_test_data['outcome_file'] = Setting::saveUploadedImage($outcome_file);
			// create outcome
			$global_test=GlobalTestOutcomes::create($global_test_data);
		}
		elseif($form_type=='edit'){
			$global_test = GlobalTestOutcomes::find($outcome_id);
			$global_test_data['outcome_image'] = Setting::saveUploadedImage($outcome_image,$global_test->outcome_image);
			$global_test_data['outcome_file'] = Setting::saveUploadedImage($outcome_file,$global_test->outcome_file);
			// update outcome
			$global_test->update($global_test_data);
		}
		return redirect('admin/outcome/choices');
    }
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function outcomes_destroy($id)
    {
        $outcome = GlobalTestOutcomes::find($id);
        $outcome->delete();
        return redirect('admin/outcomes')->with('status', 'Outcome deleted!');
    }
	// who does the test
	public function who_does_the_test(){
		$test_result = GlobalTestResult::all();
		$result=array();
		if(isset($test_result) && !empty($test_result)){
			foreach($test_result as $res){
				$user = User::find($res->user_id);
				if(isset($user) && !empty($user)){
					$user_name=$user->name;
					if(!empty($user->surname)){
						$user_name=$user_name.' '.$user->surname;
					}
					$outcome=GlobalTestOutcomes::find($res->outcome_id);
					$outcome_name = '';
					$outcome_created_date = '';
					if($outcome) {
						$outcome_name = $outcome->outcome_name;
						$outcome_created_date = $res->created_at;
					}
					$result[]=array('user_name'=>$user_name,'outcome_created_date'=>$outcome_created_date,'outcome_name'=>$outcome_name);
				}
			}
		}
		$data['page_title']='Who does the test';
        $data['result']=$result;
        return view('admin.who_does_the_test',$data);
	}
}
