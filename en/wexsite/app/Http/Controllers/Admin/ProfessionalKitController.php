<?php

namespace App\Http\Controllers\Admin;

use App\ConsultantProfile;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ConsultantBooking;
use Validator;
use App\AgePdf;
use App\GenderPdf;
use App\IndustryPdf;
use App\EducationPdf;
use App\OccupationPdf;
use App\MarketAnalysis;
use App\MarketAnalysisPdf;
use App\Country;
use App\CountryPdf;
use App\SteadyAimShoot;
use DB;
use Auth;
use App\DreamCheckLab;
class ProfessionalKitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\ResponseIndustryPdf
     */
    public function index()
    {
		$data['page_title']='Booked Consultant Listing';
		$booked_consultants = ConsultantBooking::all();
		$data['booked_consultants'] = $booked_consultants;
		return view('admin.booked_consultant_list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    // Market Analysis
    public function market_analysis(){
		// Age
        $age_pdfs=AgePdf::all(['age_range','age_pdf','age_pdf_name']);
        if($age_pdfs->count()==0){
            $age_data=array();
        }
		else{
			foreach($age_pdfs as $age_pdf){
				$age_data[$age_pdf->age_range]=array('pdf_path'=>$age_pdf->age_pdf,'pdf_name'=>$age_pdf->age_pdf_name);
			}
		}
		// Gender
		$gender_pdfs=GenderPdf::all(['gender','gender_pdf','gender_pdf_name']);
        if($gender_pdfs->count()==0){
            $gender_data=array();
        }
		else{
			foreach($gender_pdfs as $gender_pdf){
				$gender_data[$gender_pdf->gender]=array('pdf_path'=>$gender_pdf->gender_pdf,'pdf_name'=>$gender_pdf->gender_pdf_name);
			}
		}
		// Education
		$education_pdfs=EducationPdf::all(['education','education_pdf','education_pdf_name']);
        if($education_pdfs->count()==0){
            $education_data=array();
        }
		else{
			foreach($education_pdfs as $education_pdf){
				$education_data[$education_pdf->education]=array('pdf_path'=>$education_pdf->education_pdf,'pdf_name'=>$education_pdf->education_pdf_name);
			}
		}
		// Occupation
		$occupation_pdfs=OccupationPdf::all(['occupation','occupation_pdf','occupation_pdf_name']);
        if($occupation_pdfs->count()==0){
            $occupation_data=[];
        }
		else{
			foreach($occupation_pdfs as $occupation_pdf){
				$occupation_data[$occupation_pdf->occupation]=array('pdf_path'=>$occupation_pdf->occupation_pdf,'pdf_name'=>$occupation_pdf->occupation_pdf_name);
			}
		}
		// Industry
		$industry_pdfs=IndustryPdf::all(['industry','industry_pdf','industry_pdf_name']);
        if($industry_pdfs->count()==0){
            $industry_data=array();
        }
		else{
			foreach($industry_pdfs as $industry_pdf){
				$industry_data[$industry_pdf->industry]=array('pdf_path'=>$industry_pdf->industry_pdf,'pdf_name'=>$industry_pdf->industry_pdf_name);
			}
		}
		// Market analysis
		$market_analysis_vals=MarketAnalysis::all();

		if($market_analysis_vals->count()==0) {
			$market_analysis_data = array();
		}else{
			foreach($market_analysis_vals as $market_analysis_val){
				$market_analysis_pdfs=$market_analysis_val->MarketAnalysisPdf;
				foreach($market_analysis_pdfs as $market_analysis_pdf){
					$market_analysis_data[$market_analysis_pdf->market_analysis_pdf_unique_name]=array(
						'desc'=>$market_analysis_val->market_analysis_desc,
						'type'=>$market_analysis_val->market_analysis_type,
						'pdfs'=>array(
							'pdf_path'=>$market_analysis_pdf->market_analysis_pdf,
							'pdf_name'=>$market_analysis_pdf->market_analysis_pdf_label,
							)
						);
				}
			}
		}
		
		$data['page_title']='Upload Market Analysis Pdf';
        $data['age_data']=$age_data;
		$data['gender_data']=$gender_data;
		$data['education_data']=$education_data;
		$data['occupation_data']=$occupation_data;
		$data['industry_data']=$industry_data;
		$data['market_analysis_data']=$market_analysis_data;
		

        return view('admin.market_analysis',$data);
	}
	public function age_pdf_store(Request $request){
        /*$validator = Validator::make($request->all(), [
            'age_20_24' => 'required',
            'age_20_24_name' => 'required',
            'age_25_29' => 'required',
            'age_25_29_name' => 'required',
            'age_30_34' => 'required',
            'age_30_34_name' => 'required',
            'age_35_39' => 'required',
            'age_35_39_name' => 'required',
            'age_40_44' => 'required',
            'age_40_44_name' => 'required',
            'age_45_49' => 'required',
            'age_45_49_name' => 'required',
            'age_50_54' => 'required',
            'age_50_54_name' => 'required',
            'age_over_55' => 'required',
            'age_over_55_name' => 'required',
        ]);
        if($validator->fails()) {
        	return redirect()->back()->withErrors($validator->errors());
        }*/
        $age_20_24_range = $request['age_20_24_range'];
        $age_20_24_pdfname = $request['age_20_24_name'];
        $age_25_29_range = $request['age_25_29_range'];
        $age_25_29_pdfname = $request['age_25_29_name'];
        $age_30_34_range = $request['age_30_34_range'];
        $age_30_34_pdfname = $request['age_30_34_name'];
        $age_35_39_range = $request['age_35_39_range'];
        $age_35_39_pdfname = $request['age_35_39_name'];
        $age_40_44_range = $request['age_40_44_range'];
        $age_40_44_pdfname = $request['age_40_44_name'];
        $age_45_49_range = $request['age_45_49_range'];
        $age_45_49_pdfname = $request['age_45_49_name'];
        $age_50_54_range = $request['age_50_54_range'];
        $age_50_54_pdfname = $request['age_50_54_name'];
        $age_over_55_range = $request['age_over_55_range'];
        $age_over_55_pdfname = $request['age_over_55_name'];
        $base_path=base_path();
        $base_path=str_replace("/wexsite", "", $base_path);
        $age_pdf_public_path = $base_path.'/uploads/agePdfs/';
        // Age 20-24
        $age_20_24_path='';
        $age_20_24_pdf=$request->file('age_20_24');
		if(!empty($age_20_24_pdf)){ 
			// save image
			$age_20_24_pdf_original_name = $age_20_24_pdf->getClientOriginalName();
			if(file_exists($base_path.'/uploads/agePdfs/'.$age_20_24_pdf_original_name)){
				$age_20_24_name = time().'-'.$age_20_24_pdf_original_name;
				//$agePdfs_image->getClientOriginalExtension();
			}
			else {
				$age_20_24_name=$age_20_24_pdf_original_name;
			}
			$age_20_24_name=str_replace(' ', '-', $age_20_24_name);
			$age_20_24_path ='/uploads/agePdfs/' . $age_20_24_name;
			$age_20_24_pdf->move($age_pdf_public_path,$age_20_24_name);
		}
        // Age 25-29
        $age_25_29_path='';
        $age_25_29_pdf=$request->file('age_25_29');
        if(!empty($age_25_29_pdf)){ 
            // save image
            $age_25_29_pdf_original_name = $age_25_29_pdf->getClientOriginalName();
            if(file_exists($base_path.'/uploads/agePdfs/'.$age_25_29_pdf_original_name)){
                $age_25_29_name = time().'-'.$age_25_29_pdf_original_name;
                //$agePdfs_image->getClientOriginalExtension();
            }
            else {
                $age_25_29_name=$age_25_29_pdf_original_name;
            }
            $age_25_29_name=str_replace(' ', '-', $age_25_29_name);
            $age_25_29_path ='/uploads/agePdfs/' . $age_25_29_name;
            $age_25_29_pdf->move($age_pdf_public_path,$age_25_29_name);
        }
        // Age 30-34
        $age_30_34_path='';
        $age_30_34_pdf=$request->file('age_30_34');
		if(!empty($age_30_34_pdf)){ 
			// save image
			$age_30_34_pdf_original_name = $age_30_34_pdf->getClientOriginalName();
			if(file_exists($base_path.'/uploads/agePdfs/'.$age_30_34_pdf_original_name)){
				$age_30_34_name = time().'-'.$age_30_34_pdf_original_name;
				//$agePdfs_image->getClientOriginalExtension();
			}
			else {
				$age_30_34_name=$age_30_34_pdf_original_name;
			}
			$age_30_34_name=str_replace(' ', '-', $age_30_34_name);
			$age_30_34_path ='/uploads/agePdfs/' . $age_30_34_name;
			$age_30_34_pdf->move($age_pdf_public_path,$age_30_34_name);
		}
        // Age 35-39
        $age_35_39_path='';
        $age_35_39_pdf=$request->file('age_35_39');
		if(!empty($age_35_39_pdf)){ 
			// save image
			$age_35_39_pdf_original_name = $age_35_39_pdf->getClientOriginalName();
			if(file_exists($base_path.'/uploads/agePdfs/'.$age_35_39_pdf_original_name)){
				$age_35_39_name = time().'-'.$age_35_39_pdf_original_name;
				//$agePdfs_image->getClientOriginalExtension();
			}
			else {
				$age_35_39_name=$age_35_39_pdf_original_name;
			}
			$age_35_39_name=str_replace(' ', '-', $age_35_39_name);
			$age_35_39_path ='/uploads/agePdfs/' . $age_35_39_name;
			$age_35_39_pdf->move($age_pdf_public_path,$age_35_39_name);
		}
        // Age 40-44
        $age_40_44_path='';
        $age_40_44_pdf=$request->file('age_40_44');
		if(!empty($age_40_44_pdf)){ 
			// save image
			$age_40_44_pdf_original_name = $age_40_44_pdf->getClientOriginalName();
			if(file_exists($base_path.'/uploads/agePdfs/'.$age_40_44_pdf_original_name)){
				$age_40_44_name = time().'-'.$age_40_44_pdf_original_name;
				//$agePdfs_image->getClientOriginalExtension();
			}
			else {
				$age_40_44_name=$age_40_44_pdf_original_name;
			}
			$age_40_44_name=str_replace(' ', '-', $age_40_44_name);
			$age_40_44_path ='/uploads/agePdfs/' . $age_40_44_name;
			$age_40_44_pdf->move($age_pdf_public_path,$age_40_44_name);
		}
        // Age 45-49
        $age_45_49_path='';
        $age_45_49_pdf=$request->file('age_45_49');
		if(!empty($age_45_49_pdf)){ 
			// save image
			$age_45_49_pdf_original_name = $age_45_49_pdf->getClientOriginalName();
			if(file_exists($base_path.'/uploads/agePdfs/'.$age_45_49_pdf_original_name)){
				$age_45_49_name = time().'-'.$age_45_49_pdf_original_name;
				//$agePdfs_image->getClientOriginalExtension();
			}
			else {
				$age_45_49_name=$age_45_49_pdf_original_name;
			}
			$age_45_49_name=str_replace(' ', '-', $age_45_49_name);
			$age_45_49_path ='/uploads/agePdfs/' . $age_45_49_name;
			$age_45_49_pdf->move($age_pdf_public_path,$age_45_49_name);
		}
        // 50-54
        $age_50_54_path='';
        $age_50_54_pdf=$request->file('age_50_54');
		if(!empty($age_50_54_pdf)){ 
			// save image
			$age_50_54_pdf_original_name = $age_50_54_pdf->getClientOriginalName();
			if(file_exists($base_path.'/uploads/agePdfs/'.$age_50_54_pdf_original_name)){
				$age_50_54_name = time().'-'.$age_50_54_pdf_original_name;
				//$agePdfs_image->getClientOriginalExtension();
			}
			else {
				$age_50_54_name=$age_50_54_pdf_original_name;
			}
			$age_50_54_name=str_replace(' ', '-', $age_50_54_name);
			$age_50_54_path ='/uploads/agePdfs/' . $age_50_54_name;
			$age_50_54_pdf->move($age_pdf_public_path,$age_50_54_name);
		}
        // Age over - 55
        $age_over_55_path='';
        $age_over_55_pdf=$request->file('age_over_55');
		if(!empty($age_over_55_pdf)){ 
			// save image
			$age_over_55_pdf_original_name = $age_over_55_pdf->getClientOriginalName();
			if(file_exists($base_path.'/uploads/agePdfs/'.$age_over_55_pdf_original_name)){
				$age_over_55_name = time().'-'.$age_over_55_pdf_original_name;
				//$agePdfs_image->getClientOriginalExtension();
			}
			else {
				$age_over_55_name=$age_over_55_pdf_original_name;
			}
			$age_over_55_name=str_replace(' ', '-', $age_over_55_name);
			$age_over_55_path ='/uploads/agePdfs/' . $age_over_55_name;
			$age_over_55_pdf->move($age_pdf_public_path,$age_over_55_name);
		}
        //$age_20_24_data['age_range']=$age_20_24_range;
        if(!empty($age_20_24_pdf)){
            $age_20_24_data['age_pdf']=$age_20_24_path;
        }
        if(!empty($age_20_24_pdfgender_pdf_storename)){
            $age_20_24_data['age_pdf_name']=$age_20_24_pdfname;
        }
        if(!empty($age_20_24_data)){
            $a=AgePdf::find(1)->update($age_20_24_data);
        }
        //$age_25_29_data['age_range']=$age_25_29_range;
        if(!empty($age_25_29_pdf)){
            $age_25_29_data[ 'age_pdf']=$age_25_29_path;
        }
        if(!empty($age_25_29_pdfname)){
            $age_25_29_data['age_pdf_name']=$age_25_29_pdfname;
        }
        if(!empty($age_25_29_data)){
            AgePdf::find(2)->update($age_25_29_data);
        }
        //$age_30_34_data['age_range']=$age_30_34_range;
        if(!empty($age_30_34_pdf)){
            $age_30_34_data['age_pdf']=$age_30_34_path;
        }
        if(!empty($age_30_34_pdfname)){
            $age_30_34_data['age_pdf_name']=$age_30_34_pdfname;
        }
        if(!empty($age_30_34_data)){
            AgePdf::find(3)->update($age_30_34_data);
        }
        //$age_35_39_data['age_range']=$age_35_39_range;
        if(!empty($age_35_39_pdf)){
            $age_35_39_data['age_pdf']=$age_35_39_path;
        }
        if(!empty($age_35_39_pdfname)){
            $age_35_39_data['age_pdf_name']=$age_35_39_pdfname;
        }
        if(!empty($age_35_39_data)){
            AgePdf::find(4)->update($age_35_39_data);
        }
        //$age_data['age_range']=$age_40_44_range;
        if(!empty($age_40_44_pdf)){
            $age_40_44_data['age_pdf']=$age_40_44_path;
        }
        if(!empty($age_40_44_pdfname)){
            $age_40_44_data['age_pdf_name']=$age_40_44_pdfname;
        }
        if(!empty($age_40_44_data)){
            AgePdf::find(5)->update($age_40_44_data);
        }
        //$age_data['age_range']=$age_45_49_range;
        if(!empty($age_45_49_pdf)){
            $age_45_49_data['age_pdf']=$age_45_49_path;
        }
        if(!empty($age_45_49_pdfname)){
            $age_45_49_data['age_pdf_name']=$age_45_49_pdfname;
        }
        if(!empty($age_45_49_data)){
            AgePdf::find(6)->update($age_45_49_data);
        }
        //$age_data['age_range']=$age_50_54_range;
        if(!empty($age_50_54_pdf)){
            $age_50_54_data['age_pdf']=$age_50_54_path;
        }
        if(!empty($age_50_54_pdfname)){
            $age_50_54_data['age_pdf_name']=$age_50_54_pdfname;
        }
        if(!empty($age_50_54_data)){
            AgePdf::find(7)->update($age_50_54_data);
        }
        //$age_data['age_range']=$age_over_55_range;
        if(!empty($age_over_55_pdf)){
            $age_over_55_data['age_pdf']=$age_over_55_path;
        }
        if(!empty($age_over_55_pdfname)){
            $age_over_55_data['age_pdf_name']=$age_over_55_pdfname;
        }
        if(!empty($age_over_55_data)){
            AgePdf::find(8)->update($age_over_55_data);
        }
        return redirect('admin/market_analysis')->with('status', 'Age pdfs has been updated!');
	}
	// Gender Pdfs
	public function gender_pdf_store(Request $request){
		$base_path=base_path();
        $base_path=str_replace("/wexsite", "", $base_path);
        $upload_dir_path='/uploads/genderPdfs/';
        $gender_public_path = $base_path.$upload_dir_path;
        // Male
		$gender_male_data=array();
		$gender_male_name = $request['gender_male_name'];
		$gender_male=$request['gender_male'];
        $gender_male_pdf_path='';
        $gender_male_pdf=$request->file('gender_male_pdf');
		if(!empty($gender_male_pdf)){ 
			// save image
			$gender_male_pdf_original_name = $gender_male_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$gender_male_pdf_original_name)){
				$gender_male_pdf_name = time().'-'.$gender_male_pdf_original_name;
				//$agePdfs_image->getClientOriginalExtension();
			}
			else {
				$gender_male_pdf_name=$gender_male_pdf_original_name;
			}
			$gender_male_pdf_name=str_replace(' ', '-', $gender_male_pdf_name);
			$gender_male_pdf_path =$upload_dir_path . $gender_male_pdf_name;
			$gender_male_pdf->move($gender_public_path,$gender_male_pdf_name);
			$gender_male_data['gender_pdf']=$gender_male_pdf_path;
		}
		if(!empty($gender_male_name)){
			$gender_male_data['gender_pdf_name']=$gender_male_name;
		}
		if(!empty($gender_male_data)){
            GenderPdf::find(1)->update($gender_male_data);
        }
		// Female
		$gender_female_data=array();
		$gender_female_name = $request['gender_female_name'];
		$gender_female=$request['gender_female'];
        $gender_female_pdf_path='';
        $gender_female_pdf=$request->file('gender_female_pdf');
		if(!empty($gender_female_pdf)){ 
			// save image
			$gender_female_pdf_original_name = $gender_female_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$gender_female_pdf_original_name)){
				$gender_female_pdf_name = time().'-'.$gender_female_pdf_original_name;
			}
			else {
				$gender_female_pdf_name=$gender_female_pdf_original_name;
			}
			$gender_female_pdf_name=str_replace(' ', '-', $gender_female_pdf_name);
			$gender_female_pdf_path =$upload_dir_path . $gender_female_pdf_name;
			$gender_female_pdf->move($gender_public_path,$gender_female_pdf_name);
			$gender_female_data['gender_pdf']=$gender_female_pdf_path;
		}
		if(!empty($gender_female_name)){
			$gender_female_data['gender_pdf_name']=$gender_female_name;
		}
		if(!empty($gender_female_data)){
            GenderPdf::find(2)->update($gender_female_data);
        }
        return redirect('admin/market_analysis')->with('status', 'Gender pdfs has been updated!');
	}
	// Education Pdfs
	public function education_pdf_store(Request $request){
        $base_path=base_path();
        $base_path=str_replace("/wexsite", "", $base_path);
        $upload_dir_path='/uploads/educationPdfs/';
        $education_public_path = $base_path.$upload_dir_path;
        // High School Diploma
		$education_highschool_diploma_data=array();
		$education_highschool_diploma_name = $request['education_highschool_diploma_name'];
		$education_highschool_diploma=$request['education_highschool_diploma'];
        $education_highschool_diploma_pdf_path='';
        $education_highschool_diploma_pdf=$request->file('education_highschool_diploma_pdf');
		if(!empty($education_highschool_diploma_pdf)){ 
			// save image
			$education_highschool_diploma_pdf_original_name = $education_highschool_diploma_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$education_highschool_diploma_pdf_original_name)){
				$education_highschool_diploma_pdf_name = time().'-'.$education_highschool_diploma_pdf_original_name;
			}
			else {
				$education_highschool_diploma_pdf_name=$education_highschool_diploma_pdf_original_name;
			}
			$education_highschool_diploma_pdf_name=str_replace(' ', '-', $education_highschool_diploma_pdf_name);
			$education_highschool_diploma_pdf_path =$upload_dir_path . $education_highschool_diploma_pdf_name;
			$education_highschool_diploma_pdf->move($education_public_path,$education_highschool_diploma_pdf_name);
			$education_highschool_diploma_data['education_pdf']=$education_highschool_diploma_pdf_path;
		}
		if(!empty($education_highschool_diploma_name)){
			$education_highschool_diploma_data['education_pdf_name']=$education_highschool_diploma_name;
		}
		if(!empty($education_highschool_diploma_data)){
			$education_highschool_diploma_data['education']=$education_highschool_diploma;
            EducationPdf::find(1)->update($education_highschool_diploma_data);
        }
		// Bachelor’s degree
		$education_bachelor_dergee_data=array();
		$education_bachelor_dergee_name = $request['education_bachelor_dergee_name'];
		$education_bachelor_dergee=$request['education_bachelor_dergee'];
        $education_bachelor_dergee_pdf_path='';
        $education_bachelor_dergee_pdf=$request->file('education_bachelor_dergee_pdf');
		if(!empty($education_bachelor_dergee_pdf)){ 
			// save image
			$education_bachelor_dergee_pdf_original_name = $education_bachelor_dergee_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$education_bachelor_dergee_pdf_original_name)){
				$education_bachelor_dergee_pdf_name = time().'-'.$education_bachelor_dergee_pdf_original_name;
			}
			else {
				$education_bachelor_dergee_pdf_name=$education_bachelor_dergee_pdf_original_name;
			}
			$education_bachelor_dergee_pdf_name=str_replace(' ', '-', $education_bachelor_dergee_pdf_name);
			$education_bachelor_dergee_pdf_path =$upload_dir_path . $education_bachelor_dergee_pdf_name;
			$education_bachelor_dergee_pdf->move($education_public_path,$education_bachelor_dergee_pdf_name);
			$education_bachelor_dergee_data['education_pdf']=$education_bachelor_dergee_pdf_path;
		}
		if(!empty($education_bachelor_dergee_name)){
			$education_bachelor_dergee_data['education_pdf_name']=$education_bachelor_dergee_name;
		}
		if(!empty($education_bachelor_dergee_data)){
			$education_bachelor_dergee_data['education']=$education_bachelor_dergee;
            EducationPdf::find(2)->update($education_bachelor_dergee_data);
        }
		// Master’s degree
		$education_master_dergee_data=array();
		$education_master_dergee_name = $request['education_master_dergee_name'];
		$education_master_dergee=$request['education_master_dergee'];
        $education_master_dergee_pdf_path='';
        $education_master_dergee_pdf=$request->file('education_master_dergee_pdf');
		if(!empty($education_master_dergee_pdf)){ 
			// save image
			$education_master_dergee_pdf_original_name = $education_master_dergee_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$education_master_dergee_pdf_original_name)){
				$education_master_dergee_pdf_name = time().'-'.$education_master_dergee_pdf_original_name;
			}
			else {
				$education_master_dergee_pdf_name=$education_master_dergee_pdf_original_name;
			}
			$education_master_dergee_pdf_name=str_replace(' ', '-', $education_master_dergee_pdf_name);
			$education_master_dergee_pdf_path =$upload_dir_path . $education_master_dergee_pdf_name;
			$education_master_dergee_pdf->move($education_public_path,$education_master_dergee_pdf_name);
			$education_master_dergee_data['education_pdf']=$education_master_dergee_pdf_path;
		}
		if(!empty($education_master_dergee_name)){
			$education_master_dergee_data['education_pdf_name']=$education_master_dergee_name;
		}
		if(!empty($education_master_dergee_data)){
			$education_master_dergee_data['education']=$education_master_dergee;
            EducationPdf::find(3)->update($education_master_dergee_data);
        }
		// Post-university education
		$education_post_university_data=array();
		$education_post_university_name = $request['education_post_university_name'];
		$education_post_university=$request['education_post_university'];
        $education_post_university_pdf_path='';
        $education_post_university_pdf=$request->file('education_post_university_pdf');
		if(!empty($education_post_university_pdf)){ 
			// save image
			$education_post_university_pdf_original_name = $education_post_university_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$education_post_university_pdf_original_name)){
				$education_post_university_pdf_name = time().'-'.$education_post_university_pdf_original_name;
			}
			else {
				$education_post_university_pdf_name=$education_post_university_pdf_original_name;
			}
			$education_post_university_pdf_name=str_replace(' ', '-', $education_post_university_pdf_name);
			$education_post_university_pdf_path =$upload_dir_path . $education_post_university_pdf_name;
			$education_post_university_pdf->move($education_public_path,$education_post_university_pdf_name);
			$education_post_university_data['education_pdf']=$education_post_university_pdf_path;
		}
		if(!empty($education_post_university_name)){
			$education_post_university_data['education_pdf_name']=$education_post_university_name;
		}
		if(!empty($education_post_university_data)){
			$education_post_university_data['education']=$education_post_university;
            EducationPdf::find(4)->update($education_post_university_data);
        }
		return redirect('admin/market_analysis')->with('status', 'Education pdfs has been updated!');
	}
	// Occupation Pdfs
	public function occupation_pdf_store(Request $request){
		$base_path=base_path();
		$base_path=str_replace("/wexsite", "", $base_path);
		$upload_dir_path='/uploads/occupationPdfs/';
		$occupation_public_path = $base_path.$upload_dir_path;
		// Managers
		$occupation_managers_data=array();
		$occupation_managers_name = $request['occupation_managers_name'];
		$occupation_managers=$request['occupation_managers'];
		$occupation_managers_pdf_path='';
		$occupation_managers_pdf=$request->file('occupation_managers_pdf');
		if(!empty($occupation_managers_pdf)){ 
			// save image
			$occupation_managers_pdf_original_name = $occupation_managers_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$occupation_managers_pdf_original_name)){
				$occupation_managers_pdf_name = time().'-'.$occupation_managers_pdf_original_name;
			}
			else {
				$occupation_managers_pdf_name=$occupation_managers_pdf_original_name;
			}
			$occupation_managers_pdf_name=str_replace(' ', '-', $occupation_managers_pdf_name);
			$occupation_managers_pdf_path =$upload_dir_path . $occupation_managers_pdf_name;
			$occupation_managers_pdf->move($occupation_public_path,$occupation_managers_pdf_name);
			$occupation_managers_data['occupation_pdf']=$occupation_managers_pdf_path;
		}
		if(!empty($occupation_managers_name)){
			$occupation_managers_data['occupation_pdf_name']=$occupation_managers_name;
		}
		if(!empty($occupation_managers_data)){
			$occupation_managers_data['occupation']=$occupation_managers;
			OccupationPdf::updateOrCreate(['occupation'=>'managers'],$occupation_managers_data);
		}
		// Professionals
		$occupation_professionals_data=array();
		$occupation_professionals_name = $request['occupation_professionals_name'];
		$occupation_professionals=$request['occupation_professionals'];
		$occupation_professionals_pdf_path='';
		$occupation_professionals_pdf=$request->file('occupation_professionals_pdf');
		if(!empty($occupation_professionals_pdf)){ 
			// save image
			$occupation_professionals_pdf_original_name = $occupation_professionals_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$occupation_professionals_pdf_original_name)){
				$occupation_professionals_pdf_name = time().'-'.$occupation_professionals_pdf_original_name;
			}
			else {
				$occupation_professionals_pdf_name=$occupation_professionals_pdf_original_name;
			}
			$occupation_professionals_pdf_name=str_replace(' ', '-', $occupation_professionals_pdf_name);
			$occupation_professionals_pdf_path =$upload_dir_path . $occupation_professionals_pdf_name;
			$occupation_professionals_pdf->move($occupation_public_path,$occupation_professionals_pdf_name);
			$occupation_professionals_data['occupation_pdf']=$occupation_professionals_pdf_path;
		}
		if(!empty($occupation_professionals_name)){
			$occupation_professionals_data['occupation_pdf_name']=$occupation_professionals_name;
		}
		if(!empty($occupation_professionals_data)){
			$occupation_professionals_data['occupation']=$occupation_professionals;
			OccupationPdf::updateOrCreate(['occupation'=>'professionals'],$occupation_professionals_data);
		}
		// Technician
		$occupation_technicians_data=array();
		$occupation_technicians_name = $request['occupation_technicians_name'];
		$occupation_technicians=$request['occupation_technicians'];
		$occupation_technicians_pdf_path='';
		$occupation_technicians_pdf=$request->file('occupation_technicians_pdf');
		if(!empty($occupation_technicians_pdf)){ 
			// save image
			$occupation_technicians_pdf_original_name = $occupation_technicians_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$occupation_technicians_pdf_original_name)){
				$occupation_technicians_pdf_name = time().'-'.$occupation_technicians_pdf_original_name;
			}
			else {
				$occupation_technicians_pdf_name=$occupation_technicians_pdf_original_name;
			}
			$occupation_technicians_pdf_name=str_replace(' ', '-', $occupation_technicians_pdf_name);
			$occupation_technicians_pdf_path =$upload_dir_path . $occupation_technicians_pdf_name;
			$occupation_technicians_pdf->move($occupation_public_path,$occupation_technicians_pdf_name);
			$occupation_technicians_data['occupation_pdf']=$occupation_technicians_pdf_path;
		}
		if(!empty($occupation_technicians_name)){
			$occupation_technicians_data['occupation_pdf_name']=$occupation_technicians_name;
		}
		if(!empty($occupation_technicians_data)){
			$occupation_technicians_data['occupation']=$occupation_technicians;
			OccupationPdf::updateOrCreate(['occupation'=>'technicians'],$occupation_technicians_data);
		}
		// Clerical
		$occupation_clerical_data=array();
		$occupation_clerical_name = $request['occupation_clerical_name'];
		$occupation_clerical=$request['occupation_clerical'];
		$occupation_clerical_pdf_path='';
		$occupation_clerical_pdf=$request->file('occupation_clerical_pdf');
		if(!empty($occupation_clerical_pdf)){ 
			// save image
			$occupation_clerical_pdf_original_name = $occupation_clerical_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$occupation_clerical_pdf_original_name)){
				$occupation_clerical_pdf_name = time().'-'.$occupation_clerical_pdf_original_name;
			}
			else {
				$occupation_clerical_pdf_name=$occupation_clerical_pdf_original_name;
			}
			$occupation_clerical_pdf_name=str_replace(' ', '-', $occupation_clerical_pdf_name);
			$occupation_clerical_pdf_path =$upload_dir_path . $occupation_clerical_pdf_name;
			$occupation_clerical_pdf->move($occupation_public_path,$occupation_clerical_pdf_name);
			$occupation_clerical_data['occupation_pdf']=$occupation_clerical_pdf_path;
		}
		if(!empty($occupation_clerical_name)){
			$occupation_clerical_data['occupation_pdf_name']=$occupation_clerical_name;
		}
		if(!empty($occupation_clerical_data)){
			$occupation_clerical_data['occupation']=$occupation_clerical;
			OccupationPdf::updateOrCreate(['occupation'=>'clerical'],$occupation_clerical_data);
		}
		// Service and Sale
		$occupation_service_and_sale_data=array();
		$occupation_service_and_sale_name = $request['occupation_service_and_sale_name'];
		$occupation_service_and_sale=$request['occupation_service_and_sale'];
		$occupation_service_and_sale_pdf_path='';
		$occupation_service_and_sale_pdf=$request->file('occupation_service_and_sale_pdf');
		if(!empty($occupation_service_and_sale_pdf)){ 
			// save image
			$occupation_service_and_sale_pdf_original_name = $occupation_service_and_sale_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$occupation_service_and_sale_pdf_original_name)){
				$occupation_service_and_sale_pdf_name = time().'-'.$occupation_service_and_sale_pdf_original_name;
			}
			else {
				$occupation_service_and_sale_pdf_name=$occupation_service_and_sale_pdf_original_name;
			}
			$occupation_service_and_sale_pdf_name=str_replace(' ', '-', $occupation_service_and_sale_pdf_name);
			$occupation_service_and_sale_pdf_path =$upload_dir_path . $occupation_service_and_sale_pdf_name;
			$occupation_service_and_sale_pdf->move($occupation_public_path,$occupation_service_and_sale_pdf_name);
			$occupation_service_and_sale_data['occupation_pdf']=$occupation_service_and_sale_pdf_path;
		}
		if(!empty($occupation_service_and_sale_name)){
			$occupation_service_and_sale_data['occupation_pdf_name']=$occupation_service_and_sale_name;
		}
		if(!empty($occupation_service_and_sale_data)){
			$occupation_service_and_sale_data['occupation']=$occupation_service_and_sale;
			OccupationPdf::updateOrCreate(['occupation'=>'service_and_sale'],$occupation_service_and_sale_data);
		}
		// Craft Related Trade
		$occupation_crafts_related_trade_data=array();
		$occupation_crafts_related_trade_name = $request['occupation_crafts_related_trade_name'];
		$occupation_crafts_related_trade=$request['occupation_crafts_related_trade'];
		$occupation_crafts_related_trade_pdf_path='';
		$occupation_crafts_related_trade_pdf=$request->file('occupation_crafts_related_trade_pdf');
		if(!empty($occupation_crafts_related_trade_pdf)){ 
			// save image
			$occupation_crafts_related_trade_pdf_original_name = $occupation_crafts_related_trade_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$occupation_crafts_related_trade_pdf_original_name)){
				$occupation_crafts_related_trade_pdf_name = time().'-'.$occupation_crafts_related_trade_pdf_original_name;
			}
			else {
				$occupation_crafts_related_trade_pdf_name=$occupation_crafts_related_trade_pdf_original_name;
			}
			$occupation_crafts_related_trade_pdf_name=str_replace(' ', '-', $occupation_crafts_related_trade_pdf_name);
			$occupation_crafts_related_trade_pdf_path =$upload_dir_path . $occupation_crafts_related_trade_pdf_name;
			$occupation_crafts_related_trade_pdf->move($occupation_public_path,$occupation_crafts_related_trade_pdf_name);
			$occupation_crafts_related_trade_data['occupation_pdf']=$occupation_crafts_related_trade_pdf_path;
		}
		if(!empty($occupation_crafts_related_trade_name)){
			$occupation_crafts_related_trade_data['occupation_pdf_name']=$occupation_crafts_related_trade_name;
		}
		if(!empty($occupation_crafts_related_trade_data)){
			$occupation_crafts_related_trade_data['occupation']=$occupation_crafts_related_trade;
			OccupationPdf::updateOrCreate(['occupation'=>'crafts_related_trade'],$occupation_crafts_related_trade_data);
		}
		// Plant Machine Operators
		$occupation_plant_machine_operators_data=array();
		$occupation_plant_machine_operators_name = $request['occupation_plant_machine_operators_name'];
		$occupation_plant_machine_operators=$request['occupation_plant_machine_operators'];
		$occupation_plant_machine_operators_pdf_path='';
		$occupation_plant_machine_operators_pdf=$request->file('occupation_plant_machine_operators_pdf');
		if(!empty($occupation_plant_machine_operators_pdf)){ 
			// save image
			$occupation_plant_machine_operators_pdf_original_name = $occupation_plant_machine_operators_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$occupation_plant_machine_operators_pdf_original_name)){
				$occupation_plant_machine_operators_pdf_name = time().'-'.$occupation_plant_machine_operators_pdf_original_name;
			}
			else {
				$occupation_plant_machine_operators_pdf_name=$occupation_plant_machine_operators_pdf_original_name;
			}
			$occupation_plant_machine_operators_pdf_name=str_replace(' ', '-', $occupation_plant_machine_operators_pdf_name);
			$occupation_plant_machine_operators_pdf_path =$upload_dir_path . $occupation_plant_machine_operators_pdf_name;
			$occupation_plant_machine_operators_pdf->move($occupation_public_path,$occupation_plant_machine_operators_pdf_name);
			$occupation_plant_machine_operators_data['occupation_pdf']=$occupation_plant_machine_operators_pdf_path;
		}
		if(!empty($occupation_plant_machine_operators_name)){
			$occupation_plant_machine_operators_data['occupation_pdf_name']=$occupation_plant_machine_operators_name;
		}
		if(!empty($occupation_plant_machine_operators_data)){
			$occupation_plant_machine_operators_data['occupation']=$occupation_plant_machine_operators;
			OccupationPdf::updateOrCreate(['occupation'=>'plant_machine_operators'],$occupation_plant_machine_operators_data);
		}
		return redirect('admin/market_analysis')->with('status', 'Occupation pdfs has been updated!');
	}
	// Industry Pdfs
	public function industry_pdf_store(Request $request){
        $base_path=base_path();
        $base_path=str_replace("/wexsite", "", $base_path);
        $upload_dir_path='/uploads/industryPdfs/';
        $industry_public_path = $base_path.$upload_dir_path;
        // Agriculture
		$agriculture_data=array();
		$industry_agriculture_name = $request['industry_agriculture_name'];
		$industry_agriculture=$request['industry_agriculture'];
        $industry_agriculture_pdf_path='';
        $industry_agriculture_pdf=$request->file('industry_agriculture_pdf');
		if(!empty($industry_agriculture_pdf)){ 
			// save image
			$industry_agriculture_pdf_original_name = $industry_agriculture_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$industry_agriculture_pdf_original_name)){
				$industry_agriculture_pdf_name = time().'-'.$industry_agriculture_pdf_original_name;
			}
			else {
				$industry_agriculture_pdf_name=$industry_agriculture_pdf_original_name;
			}
			$industry_agriculture_pdf_name=str_replace(' ', '-', $industry_agriculture_pdf_name);
			$industry_agriculture_pdf_path =$upload_dir_path . $industry_agriculture_pdf_name;
			$industry_agriculture_pdf->move($industry_public_path,$industry_agriculture_pdf_name);
			$agriculture_data['industry_pdf']=$industry_agriculture_pdf_path;
		}
		if(!empty($industry_agriculture_name)){
			$agriculture_data['industry_pdf_name']=$industry_agriculture_name;
		}
		if(!empty($agriculture_data)){
			$agriculture_data['industry']=$industry_agriculture;
			IndustryPdf::find(1)->update($agriculture_data);
		}
		// Manufacturing
		$manufacturing_data=array();
		$industry_manufacturing_name = $request['industry_manufacturing_name'];
		$industry_manufacturing=$request['industry_manufacturing'];
        $industry_manufacturing_pdf_path='';
        $industry_manufacturing_pdf=$request->file('industry_manufacturing_pdf');
		if(!empty($industry_manufacturing_pdf)){ 
			// save image
			$industry_manufacturing_pdf_original_name = $industry_manufacturing_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$industry_manufacturing_pdf_original_name)){
				$industry_manufacturing_pdf_name = time().'-'.$industry_manufacturing_pdf_original_name;
			}
			else {
				$industry_manufacturing_pdf_name=$industry_manufacturing_pdf_original_name;
			}
			$industry_manufacturing_pdf_name=str_replace(' ', '-', $industry_manufacturing_pdf_name);
			$industry_manufacturing_pdf_path =$upload_dir_path . $industry_manufacturing_pdf_name;
			$industry_manufacturing_pdf->move($industry_public_path,$industry_manufacturing_pdf_name);
			$manufacturing_data['industry_pdf']=$industry_manufacturing_pdf_path;
		}
		if(!empty($industry_manufacturing_name)){
			$manufacturing_data['industry_pdf_name']=$industry_manufacturing_name;
		}
		if(!empty($manufacturing_data)){
			$manufacturing_data['industry']=$industry_manufacturing;
			IndustryPdf::find(2)->update($manufacturing_data);
		}
		// Electricity
		$electricity_data=array();
		$industry_electricity_name = $request['industry_electricity_name'];
		$industry_electricity=$request['industry_electricity'];
        $industry_electricity_pdf_path='';
        $industry_electricity_pdf=$request->file('industry_electricity_pdf');
		if(!empty($industry_electricity_pdf)){ 
			// save image
			$industry_electricity_pdf_original_name = $industry_electricity_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$industry_electricity_pdf_original_name)){
				$industry_electricity_pdf_name = time().'-'.$industry_electricity_pdf_original_name;
			}
			else {
				$industry_electricity_pdf_name=$industry_electricity_pdf_original_name;
			}
			$industry_electricity_pdf_name=str_replace(' ', '-', $industry_electricity_pdf_name);
			$industry_electricity_pdf_path =$upload_dir_path . $industry_electricity_pdf_name;
			$industry_electricity_pdf->move($industry_public_path,$industry_electricity_pdf_name);
			$electricity_data['industry_pdf']=$industry_electricity_pdf_path;
		}
		if(!empty($industry_electricity_name)){
			$electricity_data['industry_pdf_name']=$industry_electricity_name;
		}
		if(!empty($electricity_data)){
			$electricity_data['industry']=$industry_electricity;
			IndustryPdf::find(3)->update($electricity_data);
		}
		// Wholesale
		$wholesale_data=array();
		$industry_wholesale_name = $request['industry_wholesale_name'];
		$industry_wholesale=$request['industry_wholesale'];
        $industry_wholesale_pdf_path='';
        $industry_wholesale_pdf=$request->file('industry_wholesale_pdf');
		if(!empty($industry_wholesale_pdf)){ 
			// save image
			$industry_wholesale_pdf_original_name = $industry_wholesale_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$industry_wholesale_pdf_original_name)){
				$industry_wholesale_pdf_name = time().'-'.$industry_wholesale_pdf_original_name;
			}
			else {
				$industry_wholesale_pdf_name=$industry_wholesale_pdf_original_name;
			}
			$industry_wholesale_pdf_name=str_replace(' ', '-', $industry_wholesale_pdf_name);
			$industry_wholesale_pdf_path =$upload_dir_path . $industry_wholesale_pdf_name;
			$industry_wholesale_pdf->move($industry_public_path,$industry_wholesale_pdf_name);
			$wholesale_data['industry_pdf']=$industry_wholesale_pdf_path;
		}
		if(!empty($industry_wholesale_name)){
			$wholesale_data['industry_pdf_name']=$industry_wholesale_name;
		}
		if(!empty($wholesale_data)){
			$wholesale_data['industry']=$industry_wholesale;
			IndustryPdf::find(4)->update($wholesale_data);
		}
		// Transport
		$transport_data=array();
		$industry_transport_name = $request['industry_transport_name'];
		$industry_transport=$request['industry_transport'];
        $industry_transport_pdf_path='';
        $industry_transport_pdf=$request->file('industry_transport_pdf');
		if(!empty($industry_transport_pdf)){ 
			// save image
			$industry_transport_pdf_original_name = $industry_transport_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$industry_transport_pdf_original_name)){
				$industry_transport_pdf_name = time().'-'.$industry_transport_pdf_original_name;
			}
			else {
				$industry_transport_pdf_name=$industry_transport_pdf_original_name;
			}
			$industry_transport_pdf_name=str_replace(' ', '-', $industry_transport_pdf_name);
			$industry_transport_pdf_path =$upload_dir_path . $industry_transport_pdf_name;
			$industry_transport_pdf->move($industry_public_path,$industry_transport_pdf_name);
			$transport_data['industry_pdf']=$industry_transport_pdf_path;
		}
		if(!empty($industry_transport_name)){
			$transport_data['industry_pdf_name']=$industry_transport_name;
		}
		if(!empty($transport_data)){
			$transport_data['industry']=$industry_transport;
			IndustryPdf::find(5)->update($transport_data);
		}
		// ICT
		$ICT_data=array();
		$industry_ICT_name = $request['industry_ICT_name'];
		$industry_ICT=$request['industry_ICT'];
        $industry_ICT_pdf_path='';
        $industry_ICT_pdf=$request->file('industry_ICT_pdf');
		if(!empty($industry_ICT_pdf)){ 
			// save image
			$industry_ICT_pdf_original_name = $industry_ICT_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$industry_ICT_pdf_original_name)){
				$industry_ICT_pdf_name = time().'-'.$industry_ICT_pdf_original_name;
			}
			else {
				$industry_ICT_pdf_name=$industry_ICT_pdf_original_name;
			}
			$industry_ICT_pdf_name=str_replace(' ', '-', $industry_ICT_pdf_name);
			$industry_ICT_pdf_path =$upload_dir_path . $industry_ICT_pdf_name;
			$industry_ICT_pdf->move($industry_public_path,$industry_ICT_pdf_name);
			$ICT_data['industry_pdf']=$industry_ICT_pdf_path;
		}
		if(!empty($industry_ICT_name)){
			$ICT_data['industry_pdf_name']=$industry_ICT_name;
		}
		if(!empty($ICT_data)){
			$ICT_data['industry']=$industry_ICT;
			IndustryPdf::find(6)->update($ICT_data);
		}
		// Industry Financial Services
		$financial_data=array();
		$industry_financial_services_name = $request['industry_financial_services_name'];
		$industry_financial_services=$request['industry_financial_services'];
        $industry_financial_services_pdf_path='';
        $industry_financial_services_pdf=$request->file('industry_financial_services_pdf');
		if(!empty($industry_financial_services_pdf)){ 
			// save image
			$industry_financial_services_pdf_original_name = $industry_financial_services_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$industry_financial_services_pdf_original_name)){
				$industry_financial_services_pdf_name = time().'-'.$industry_financial_services_pdf_original_name;
			}
			else {
				$industry_financial_services_pdf_name=$industry_financial_services_pdf_original_name;
			}
			$industry_financial_services_pdf_name=str_replace(' ', '-', $industry_financial_services_pdf_name);
			$industry_financial_services_pdf_path =$upload_dir_path . $industry_financial_services_pdf_name;
			$industry_financial_services_pdf->move($industry_public_path,$industry_financial_services_pdf_name);
			$financial_data['industry_pdf']=$industry_financial_services_pdf_path;
		}
		if(!empty($industry_financial_services_name)){
			$financial_data['industry_pdf_name']=$industry_financial_services_name;
		}
		if(!empty($financial_data)){
			$financial_data['industry']=$industry_financial_services;
			IndustryPdf::find(7)->update($financial_data);
		}
		// Industry Professional services
		$professional_data=array();
		$industry_professional_services_name = $request['industry_professional_services_name'];
		$industry_professional_services=$request['industry_professional_services'];
        $industry_professional_services_pdf_path='';
        $industry_professional_services_pdf=$request->file('industry_professional_services_pdf');
		if(!empty($industry_professional_services_pdf)){ 
			// save image
			$industry_professional_services_pdf_original_name = $industry_professional_services_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$industry_professional_services_pdf_original_name)){
				$industry_professional_services_pdf_name = time().'-'.$industry_professional_services_pdf_original_name;
			}
			else {
				$industry_professional_services_pdf_name=$industry_professional_services_pdf_original_name;
			}
			$industry_professional_services_pdf_name=str_replace(' ', '-', $industry_professional_services_pdf_name);
			$industry_professional_services_pdf_path =$upload_dir_path . $industry_professional_services_pdf_name;
			$industry_professional_services_pdf->move($industry_public_path,$industry_professional_services_pdf_name);
			$professional_data['industry_pdf']=$industry_professional_services_pdf_path;
		}
		if(!empty($industry_professional_services_name)){
			$professional_data['industry_pdf_name']=$industry_professional_services_name;
		}
		if(!empty($professional_data)){
			$professional_data['industry']=$industry_professional_services;
			IndustryPdf::find(8)->update($professional_data);
		}
		// Administrative Services
		$administrative_data=array();
		$industry_administrative_services_name = $request['industry_administrative_services_name'];
		$industry_administrative_services=$request['industry_administrative_services'];
        $industry_administrative_services_pdf_path='';
        $industry_administrative_services_pdf=$request->file('industry_administrative_services_pdf');
		if(!empty($industry_administrative_services_pdf)){ 
			// save image
			$industry_administrative_services_pdf_original_name = $industry_administrative_services_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$industry_administrative_services_pdf_original_name)){
				$industry_administrative_services_pdf_name = time().'-'.$industry_administrative_services_pdf_original_name;
			}
			else {
				$industry_administrative_services_pdf_name=$industry_administrative_services_pdf_original_name;
			}
			$industry_administrative_services_pdf_name=str_replace(' ', '-', $industry_administrative_services_pdf_name);
			$industry_administrative_services_pdf_path =$upload_dir_path . $industry_administrative_services_pdf_name;
			$industry_administrative_services_pdf->move($industry_public_path,$industry_administrative_services_pdf_name);
			$administrative_data['industry_pdf']=$industry_administrative_services_pdf_path;
		}
		if(!empty($industry_administrative_services_name)){
			$administrative_data['industry_pdf_name']=$industry_administrative_services_name;
		}
		if(!empty($administrative_data)){
			$administrative_data['industry']=$industry_administrative_services;
			IndustryPdf::find(9)->update($administrative_data);
		}
		// Public Administration
		$public_administrative_data=array();
		$industry_public_administration_name = $request['industry_public_administration_name'];
		$industry_public_administration=$request['industry_public_administration'];
        $industry_public_administration_pdf_path='';
        $industry_public_administration_pdf=$request->file('industry_public_administration_pdf');
		if(!empty($industry_public_administration_pdf)){ 
			// save image
			$industry_public_administration_pdf_original_name = $industry_public_administration_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$industry_public_administration_pdf_original_name)){
				$industry_public_administration_pdf_name = time().'-'.$industry_public_administration_pdf_original_name;
			}
			else {
				$industry_public_administration_pdf_name=$industry_public_administration_pdf_original_name;
			}
			$industry_public_administration_pdf_name=str_replace(' ', '-', $industry_public_administration_pdf_name);
			$industry_public_administration_pdf_path =$upload_dir_path . $industry_public_administration_pdf_name;
			$industry_public_administration_pdf->move($industry_public_path,$industry_public_administration_pdf_name);
			$public_administrative_data['industry_pdf']=$industry_public_administration_pdf_path;
		}
		if(!empty($industry_public_administration_name)){
			$public_administrative_data['industry_pdf_name']=$industry_public_administration_name;
		}
		if(!empty($public_administrative_data)){
			$public_administrative_data['industry']=$industry_public_administration;
			IndustryPdf::find(10)->update($public_administrative_data);
		}
		// Education
		$public_education_data=array();
		$industry_education_name = $request['industry_education_name'];
		$industry_education=$request['industry_education'];
        $industry_education_pdf_path='';
        $industry_education_pdf=$request->file('industry_education_pdf');
		if(!empty($industry_education_pdf)){ 
			// save image
			$industry_education_pdf_original_name = $industry_education_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$industry_education_pdf_original_name)){
				$industry_education_pdf_name = time().'-'.$industry_education_pdf_original_name;
			}
			else {
				$industry_education_pdf_name=$industry_education_pdf_original_name;
			}
			$industry_education_pdf_name=str_replace(' ', '-', $industry_education_pdf_name);
			$industry_education_pdf_path =$upload_dir_path . $industry_education_pdf_name;
			$industry_education_pdf->move($industry_public_path,$industry_education_pdf_name);
			$public_education_data['industry_pdf']=$industry_education_pdf_path;
		}
		if(!empty($industry_education_name)){
			$public_education_data['industry_pdf_name']=$industry_education_name;
		}
		if(!empty($public_education_data)){
			$public_education_data['industry']=$industry_education;
			IndustryPdf::find(11)->update($public_education_data);
		}
		// Health
		$public_health_data=array();
		$industry_health_name = $request['industry_health_name'];
		$industry_health=$request['industry_health'];
        $industry_health_pdf_path='';
        $industry_health_pdf=$request->file('industry_health_pdf');
		if(!empty($industry_health_pdf)){ 
			// save image
			$industry_health_pdf_original_name = $industry_health_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$industry_health_pdf_original_name)){
				$industry_health_pdf_name = time().'-'.$industry_health_pdf_original_name;
			}
			else {
				$industry_health_pdf_name=$industry_health_pdf_original_name;
			}
			$industry_health_pdf_name=str_replace(' ', '-', $industry_health_pdf_name);
			$industry_health_pdf_path =$upload_dir_path . $industry_health_pdf_name;
			$industry_health_pdf->move($industry_public_path,$industry_health_pdf_name);
			$public_health_data['industry_pdf']=$industry_health_pdf_path;
		}
		if(!empty($industry_health_name)){
			$public_health_data['industry_pdf_name']=$industry_health_name;
		}
		if(!empty($public_health_data)){
			$public_health_data['industry']=$industry_health;
			IndustryPdf::find(12)->update($public_health_data);
		}
		// Arts
		$public_arts_data=array();
		$industry_arts_name = $request['industry_arts_name'];
		$industry_arts=$request['industry_arts'];
        $industry_arts_pdf_path='';
        $industry_arts_pdf=$request->file('industry_arts_pdf');
		if(!empty($industry_arts_pdf)){ 
			// save image
			$industry_arts_pdf_original_name = $industry_arts_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$industry_arts_pdf_original_name)){
				$industry_arts_pdf_name = time().'-'.$industry_arts_pdf_original_name;
			}
			else {
				$industry_arts_pdf_name=$industry_arts_pdf_original_name;
			}
			$industry_arts_pdf_name=str_replace(' ', '-', $industry_arts_pdf_name);
			$industry_arts_pdf_path =$upload_dir_path . $industry_arts_pdf_name;
			$industry_arts_pdf->move($industry_public_path,$industry_arts_pdf_name);
			$public_arts_data['industry_pdf']=$industry_arts_pdf_path;
		}
		if(!empty($industry_arts_name)){
			$public_arts_data['industry_pdf_name']=$industry_arts_name;
		}
		if(!empty($public_arts_data)){
			$public_arts_data['industry']=$industry_arts;
			IndustryPdf::find(13)->update($public_arts_data);
		}
		// Other services
		$public_other_services_data=array();
		$industry_other_services_name = $request['industry_other_services_name'];
		$industry_other_services=$request['industry_other_services'];
        $industry_other_services_pdf_path='';
        $industry_other_services_pdf=$request->file('industry_other_services_pdf');
		if(!empty($industry_other_services_pdf)){ 
			// save image
			$industry_other_services_pdf_original_name = $industry_other_services_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$industry_other_services_pdf_original_name)){
				$industry_other_services_pdf_name = time().'-'.$industry_other_services_pdf_original_name;
			}
			else {
				$industry_other_services_pdf_name=$industry_other_services_pdf_original_name;
			}
			$industry_other_services_pdf_name=str_replace(' ', '-', $industry_other_services_pdf_name);
			$industry_other_services_pdf_path =$upload_dir_path . $industry_other_services_pdf_name;
			$industry_other_services_pdf->move($industry_public_path,$industry_other_services_pdf_name);
			$public_other_services_data['industry_pdf']=$industry_other_services_pdf_path;
		}
		if(!empty($industry_other_services_name)){
			$public_other_services_data['industry_pdf_name']=$industry_other_services_name;
		}
		if(!empty($public_other_services_data)){
			$public_other_services_data['industry']=$industry_other_services;
			IndustryPdf::find(14)->update($public_other_services_data);
		}
		return redirect('admin/market_analysis')->with('status', 'Industry pdfs has been updated!');
	}
	// Market analysis text content and Pdf
	public function market_analysis_content_pdf_store(Request $request){
		$base_path=base_path();
        $base_path=str_replace("/wexsite", "", $base_path);
        $upload_dir_path='/uploads/MA_ContentPdfs/';
        $mk_public_path = $base_path.$upload_dir_path;
		//Market Analysis description
		$market_analysis_data=array();
		$market_analysis_desc=$request['market_analysis_desc'];
		$market_analysis_pdf_label=$request['market_analysis_pdf_label'];
		$market_analysis_type='market_analysis';
        $market_analysis_pdf_path='';
		$market_analysis_pdf=$request->file('market_analysis_pdf');
		if(!empty($market_analysis_pdf)){
			$market_analysis_pdf_original_name = $market_analysis_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$market_analysis_pdf_original_name)){
				$market_analysis_pdf_name = time().'-'.$market_analysis_pdf_original_name;
			}
			else {
				$market_analysis_pdf_name=$market_analysis_pdf_original_name;
			}
			$market_analysis_pdf_name=str_replace(' ', '-', $market_analysis_pdf_name);
			$market_analysis_pdf_path =$upload_dir_path . $market_analysis_pdf_name;
			$market_analysis_pdf->move($mk_public_path,$market_analysis_pdf_name);
			$market_analysis_pdf_data['market_analysis_pdf']=$market_analysis_pdf_path;
			$market_analysis_pdf_data['market_analysis_pdf_unique_name']='market_analysis';
		}
		if(!empty($market_analysis_pdf_label)){
			$market_analysis_pdf_data['market_analysis_pdf_label']=$market_analysis_pdf_label;
		}
		if(!empty($market_analysis_desc)){
			$market_analysis_data['market_analysis_desc']=$market_analysis_desc;
		}
		if(!empty($market_analysis_data)){
			$market_analysis_data['market_analysis_type']=$market_analysis_type;
            $market_analysis_id=MarketAnalysis::where('market_analysis_type',$market_analysis_type)->update($market_analysis_data);
		}
		if(!empty($market_analysis_pdf_data)){
			$market_analysis=MarketAnalysis::where('market_analysis_type',$market_analysis_type)->first(['id']);
			$market_analysis_id=$market_analysis->id;
			$market_analysis_pdf_data['market_analysis_id']=$market_analysis_id;
			$mkpdfs_obj=MarketAnalysisPdf::updateOrCreate(['market_analysis_pdf_unique_name'=>'market_analysis'],$market_analysis_pdf_data);
        }
        // Labour Market Situation
		$labour_market_situation_data=array();
		$labour_market_situation_desc = $request['labour_market_situation_desc'];
		$market_analysis_type='labour_market_situation';
		$labour_market_situation_pdf_label=$request['labour_market_situation_pdf_label'];
        $labour_market_situation_pdf_path='';
        $labour_market_situation_pdf=$request->file('labour_market_situation_pdf');
		if(!empty($labour_market_situation_pdf)){ 
			$labour_market_situation_pdf_original_name = $labour_market_situation_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$labour_market_situation_pdf_original_name)){
				$labour_market_situation_pdf_name = time().'-'.$labour_market_situation_pdf_original_name;
			}
			else {
				$labour_market_situation_pdf_name=$labour_market_situation_pdf_original_name;
			}
			$labour_market_situation_pdf_name=str_replace(' ', '-', $labour_market_situation_pdf_name);
			$labour_market_situation_pdf_path =$upload_dir_path . $labour_market_situation_pdf_name;
			$labour_market_situation_pdf->move($mk_public_path,$labour_market_situation_pdf_name);
			$labour_market_situation_pdf_data['market_analysis_pdf']=$labour_market_situation_pdf_path;
			$labour_market_situation_pdf_data['market_analysis_pdf_unique_name']='labour_market_situation';
		}
		if(!empty($labour_market_situation_pdf_label)){
			$labour_market_situation_pdf_data['market_analysis_pdf_label']=$labour_market_situation_pdf_label;
		}
		if(!empty($labour_market_situation_desc)){
			$labour_market_situation_data['market_analysis_desc']=$labour_market_situation_desc;
		}
		if(!empty($labour_market_situation_data)){
			$labour_market_situation_data['market_analysis_type']=$market_analysis_type;
            MarketAnalysis::where('market_analysis_type',$market_analysis_type)->update($labour_market_situation_data);
		}
		if(!empty($labour_market_situation_pdf_data)){
			$market_analysis=MarketAnalysis::where('market_analysis_type',$market_analysis_type)->first(['id']);
			$market_analysis_id=$market_analysis->id;
			$labour_market_situation_pdf_data['market_analysis_id']=$market_analysis_id;
			$mkpdfs_obj=MarketAnalysisPdf::updateOrCreate(['market_analysis_pdf_unique_name'=>'labour_market_situation'],$labour_market_situation_pdf_data);
        }
		// Quality of work
		$quality_work_data=array();
		$quality_work_desc = $request['quality_of_work_desc'];
		$quality_work_pdf_label=$request['quality_of_work_pdf_label'];
		$market_analysis_type='quality_of_work';
		// Quality of work file
        $quality_work_pdf_path='';
        $quality_work_pdf=$request->file('quality_of_work_pdf');
		if(!empty($quality_work_pdf)){ 
			$quality_work_pdf_original_name = $quality_work_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$quality_work_pdf_original_name)){
				$quality_work_pdf_name = time().'-'.$quality_work_pdf_original_name;
			}
			else {
				$quality_work_pdf_name=$quality_work_pdf_original_name;
			}
			$quality_work_pdf_name=str_replace(' ', '-', $quality_work_pdf_name);
			$quality_work_pdf_path =$upload_dir_path . $quality_work_pdf_name;
			$quality_work_pdf->move($mk_public_path,$quality_work_pdf_name);
			$quality_work_pdf_data['market_analysis_pdf']=$quality_work_pdf_path;
			$quality_work_pdf_data['market_analysis_pdf_unique_name']='quality_of_work';
		}
		if(!empty($quality_work_pdf_label)){
			$quality_work_pdf_data['market_analysis_pdf_label']=$quality_work_pdf_label;
		}
		if(!empty($quality_work_desc)){
			$quality_work_data['market_analysis_desc']=$quality_work_desc;
		}
		if(!empty($quality_work_data)){
			$quality_work_data['market_analysis_type']=$market_analysis_type;
            MarketAnalysis::where('market_analysis_type',$market_analysis_type)->update($quality_work_data);
		}
		if(!empty($quality_work_pdf_data)){
			$market_analysis=MarketAnalysis::where('market_analysis_type',$market_analysis_type)->first(['id']);
			$market_analysis_id=$market_analysis->id;
			$quality_work_pdf_data['market_analysis_id']=$market_analysis_id;
			$mkpdfs_obj=MarketAnalysisPdf::updateOrCreate(['market_analysis_pdf_unique_name'=>'quality_of_work'],$quality_work_pdf_data);
        }
		// Employment stability File
        $employment_stability_pdf_path='';
        $employment_stability_pdf=$request->file('employment_stability_pdf');
		$employment_stability_pdf_label=$request['employment_stability_pdf_label'];
		if(!empty($employment_stability_pdf)){ 
			$employment_stability_pdf_original_name = $employment_stability_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$employment_stability_pdf_original_name)){
				$employment_stability_pdf_name = time().'-'.$employment_stability_pdf_original_name;
			}
			else {
				$employment_stability_pdf_name=$employment_stability_pdf_original_name;
			}
			$employment_stability_pdf_name=str_replace(' ', '-', $employment_stability_pdf_name);
			$employment_stability_pdf_path =$upload_dir_path . $employment_stability_pdf_name;
			$employment_stability_pdf->move($mk_public_path,$employment_stability_pdf_name);
			$employment_stability_pdf_data['market_analysis_pdf']=$employment_stability_pdf_path;
			$employment_stability_pdf_data['market_analysis_pdf_unique_name']='employment_stability';
		}
		if(!empty($employment_stability_pdf_label)){
			$employment_stability_pdf_data['market_analysis_pdf_label']=$employment_stability_pdf_label;
		}
		if(!empty($employment_stability_pdf_data)){
			$market_analysis=MarketAnalysis::where('market_analysis_type',$market_analysis_type)->first(['id']);
			$market_analysis_id=$market_analysis->id;
			$employment_stability_pdf_data['market_analysis_id']=$market_analysis_id;
			$mkpdfs_obj=MarketAnalysisPdf::updateOrCreate(['market_analysis_pdf_unique_name'=>'employment_stability'],$employment_stability_pdf_data);
        }
		// Safety at work File
        $safety_at_work_pdf_path='';
        $safety_at_work_pdf=$request->file('safety_at_work_pdf');
		$safety_at_work_pdf_label=$request['safety_at_work_pdf_label'];
		if(!empty($safety_at_work_pdf)){ 
			$safety_at_work_pdf_original_name = $safety_at_work_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$safety_at_work_pdf_original_name)){
				$safety_at_work_pdf_name = time().'-'.$safety_at_work_pdf_original_name;
			}
			else {
				$safety_at_work_pdf_name=$safety_at_work_pdf_original_name;
			}
			$safety_at_work_pdf_name=str_replace(' ', '-', $safety_at_work_pdf_name);
			$safety_at_work_pdf_path =$upload_dir_path . $safety_at_work_pdf_name;
			$safety_at_work_pdf->move($mk_public_path,$safety_at_work_pdf_name);
			$safety_at_work_pdf_data['market_analysis_pdf']=$safety_at_work_pdf_path;
			$safety_at_work_pdf_data['market_analysis_pdf_unique_name']='safety_at_work';
		}
		if(!empty($safety_at_work_pdf_label)){
			$safety_at_work_pdf_data['market_analysis_pdf_label']=$safety_at_work_pdf_label;
		}
		if(!empty($safety_at_work_pdf_data)){
			$market_analysis=MarketAnalysis::where('market_analysis_type',$market_analysis_type)->first(['id']);
			$market_analysis_id=$market_analysis->id;
			$safety_at_work_pdf_data['market_analysis_id']=$market_analysis_id;
			$mkpdfs_obj=MarketAnalysisPdf::updateOrCreate(['market_analysis_pdf_unique_name'=>'safety_at_work'],$safety_at_work_pdf_data);
        }
		// Work-life balance
        $work_life_balance_pdf_path='';
        $work_life_balance_pdf=$request->file('work_life_balance_pdf');
		$work_life_balance_pdf_label=$request['work_life_balance_pdf_label'];
		if(!empty($work_life_balance_pdf)){ 
			$work_life_balance_pdf_original_name = $work_life_balance_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$work_life_balance_pdf_original_name)){
				$work_life_balance_pdf_name = time().'-'.$work_life_balance_pdf_original_name;
			}
			else {
				$work_life_balance_pdf_name=$work_life_balance_pdf_original_name;
			}
			$work_life_balance_pdf_name=str_replace(' ', '-', $work_life_balance_pdf_name);
			$work_life_balance_pdf_path =$upload_dir_path . $work_life_balance_pdf_name;
			$work_life_balance_pdf->move($mk_public_path,$work_life_balance_pdf_name);
			$work_life_balance_pdf_data['market_analysis_pdf']=$work_life_balance_pdf_path;
			$work_life_balance_pdf_data['market_analysis_pdf_unique_name']='work_life_balance';
		}
		if(!empty($work_life_balance_pdf_label)){
			$work_life_balance_pdf_data['market_analysis_pdf_label']=$work_life_balance_pdf_label;
		}
		if(!empty($work_life_balance_pdf_data)){
			$market_analysis=MarketAnalysis::where('market_analysis_type',$market_analysis_type)->first(['id']);
			$market_analysis_id=$market_analysis->id;
			$work_life_balance_pdf_data['market_analysis_id']=$market_analysis_id;
			$mkpdfs_obj=MarketAnalysisPdf::updateOrCreate(['market_analysis_pdf_unique_name'=>'work_life_balance'],$work_life_balance_pdf_data);
        }
		// Quality Of Life
		$quality_life_data=array();
		$quality_life_desc = $request['quality_of_life_desc'];
		$quality_life_pdf_label=$request['quality_of_life_pdf_label'];
		$market_analysis_type='quality_of_life';
        $quality_life_pdf_path='';
        $quality_life_pdf=$request->file('quality_of_life_pdf');
		if(!empty($quality_life_pdf)){ 
			$quality_life_pdf_original_name = $quality_life_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$quality_life_pdf_original_name)){
				$quality_life_pdf_name = time().'-'.$quality_life_pdf_original_name;
			}
			else {
				$quality_life_pdf_name=$quality_life_pdf_original_name;
			}
			$quality_life_pdf_name=str_replace(' ', '-', $quality_life_pdf_name);
			$quality_life_pdf_path =$upload_dir_path . $quality_life_pdf_name;
			$quality_life_pdf->move($mk_public_path,$quality_life_pdf_name);
			$quality_life_pdf_data['market_analysis_pdf']=$quality_life_pdf_path;
			$quality_life_pdf_data['market_analysis_pdf_unique_name']='quality_of_life';
		}
		if(!empty($quality_life_pdf_label)){
			$quality_life_pdf_data['market_analysis_pdf_label']=$quality_life_pdf_label;
		}
		if(!empty($quality_life_desc)){
			$quality_life_data['market_analysis_desc']=$quality_life_desc;
		}
		if(!empty($quality_life_data)){
			$quality_life_data['market_analysis_type']=$market_analysis_type;
            MarketAnalysis::where('market_analysis_type',$market_analysis_type)->update($quality_life_data);
		}
		if(!empty($quality_life_pdf_data)){
			$market_analysis=MarketAnalysis::where('market_analysis_type',$market_analysis_type)->first(['id']);
			$market_analysis_id=$market_analysis->id;
			$quality_life_pdf_data['market_analysis_id']=$market_analysis_id;
			$mkpdfs_obj=MarketAnalysisPdf::updateOrCreate(['market_analysis_pdf_unique_name'=>'quality_of_life'],$quality_life_pdf_data);
        }
		// Cost of life
        $Cost_of_life_pdf_path='';
        $Cost_of_life_pdf=$request->file('cost_of_life_pdf');
		$Cost_of_life_pdf_label=$request['cost_of_life_pdf_label'];
		if(!empty($Cost_of_life_pdf)){ 
			$Cost_of_life_pdf_original_name = $Cost_of_life_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$Cost_of_life_pdf_original_name)){
				$Cost_of_life_pdf_name = time().'-'.$Cost_of_life_pdf_original_name;
			}
			else {
				$Cost_of_life_pdf_name=$Cost_of_life_pdf_original_name;
			}
			$Cost_of_life_pdf_name=str_replace(' ', '-', $Cost_of_life_pdf_name);
			$Cost_of_life_pdf_path =$upload_dir_path . $Cost_of_life_pdf_name;
			$Cost_of_life_pdf->move($mk_public_path,$Cost_of_life_pdf_name);
			$Cost_of_life_pdf_data['market_analysis_pdf']=$Cost_of_life_pdf_path;
			$Cost_of_life_pdf_data['market_analysis_pdf_unique_name']='cost_of_life';
		}
		if(!empty($Cost_of_life_pdf_label)){
			$Cost_of_life_pdf_data['market_analysis_pdf_label']=$Cost_of_life_pdf_label;
		}
		if(!empty($Cost_of_life_pdf_data)){
			$market_analysis=MarketAnalysis::where('market_analysis_type',$market_analysis_type)->first(['id']);
			$market_analysis_id=$market_analysis->id;
			$Cost_of_life_pdf_data['market_analysis_id']=$market_analysis_id;
			$mkpdfs_obj=MarketAnalysisPdf::updateOrCreate(['market_analysis_pdf_unique_name'=>'cost_of_life'],$Cost_of_life_pdf_data);
        }
		// Environmental quality
        $environmental_quality_pdf_path='';
        $environmental_quality_pdf=$request->file('environmental_quality_pdf');
		$environmental_quality_pdf_label=$request['environmental_quality_pdf_label'];
		if(!empty($environmental_quality_pdf)){ 
			$environmental_quality_pdf_original_name = $environmental_quality_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$environmental_quality_pdf_original_name)){
				$environmental_quality_pdf_name = time().'-'.$environmental_quality_pdf_original_name;
			}
			else {
				$environmental_quality_pdf_name=$environmental_quality_pdf_original_name;
			}
			$environmental_quality_pdf_name=str_replace(' ', '-', $environmental_quality_pdf_name);
			$environmental_quality_pdf_path =$upload_dir_path . $environmental_quality_pdf_name;
			$environmental_quality_pdf->move($mk_public_path,$environmental_quality_pdf_name);
			$environmental_quality_pdf_data['market_analysis_pdf']=$environmental_quality_pdf_path;
			$environmental_quality_pdf_data['market_analysis_pdf_unique_name']='environmental_quality';
		}
		if(!empty($environmental_quality_pdf_label)){
			$environmental_quality_pdf_data['market_analysis_pdf_label']=$environmental_quality_pdf_label;
		}
		if(!empty($environmental_quality_pdf_data)){
			$market_analysis=MarketAnalysis::where('market_analysis_type',$market_analysis_type)->first(['id']);
			$market_analysis_id=$market_analysis->id;
			$environmental_quality_pdf_data['market_analysis_id']=$market_analysis_id;
			$mkpdfs_obj=MarketAnalysisPdf::updateOrCreate(['market_analysis_pdf_unique_name'=>'environmental_quality'],$environmental_quality_pdf_data);
        }
		// Security
        $security_pdf_path='';
        $security_pdf=$request->file('security_pdf');
		$security_pdf_label=$request['security_pdf_label'];
		if(!empty($security_pdf)){ 
			$security_pdf_original_name = $security_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$security_pdf_original_name)){
				$security_pdf_name = time().'-'.$security_pdf_original_name;
			}
			else {
				$security_pdf_name=$security_pdf_original_name;
			}
			$security_pdf_name=str_replace(' ', '-', $security_pdf_name);
			$security_pdf_path =$upload_dir_path . $security_pdf_name;
			$security_pdf->move($mk_public_path,$security_pdf_name);
			$security_pdf_data['market_analysis_pdf']=$security_pdf_path;
			$security_pdf_data['market_analysis_pdf_unique_name']='security';
		}
		if(!empty($security_pdf_label)){
			$security_pdf_data['market_analysis_pdf_label']=$security_pdf_label;
		}
		if(!empty($security_pdf_data)){
			$market_analysis=MarketAnalysis::where('market_analysis_type',$market_analysis_type)->first(['id']);
			$market_analysis_id=$market_analysis->id;
			$security_pdf_data['market_analysis_id']=$market_analysis_id;
			$mkpdfs_obj=MarketAnalysisPdf::updateOrCreate(['market_analysis_pdf_unique_name'=>'security'],$security_pdf_data);
        }
		// Life satisfaction
        $life_satisfaction_pdf_path='';
        $life_satisfaction_pdf=$request->file('life_satisfaction_pdf');
		$life_satisfaction_pdf_label=$request['life_satisfaction_pdf_label'];
		if(!empty($life_satisfaction_pdf)){ 
			$life_satisfaction_pdf_original_name = $life_satisfaction_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$life_satisfaction_pdf_original_name)){
				$life_satisfaction_pdf_name = time().'-'.$life_satisfaction_pdf_original_name;
			}
			else {
				$life_satisfaction_pdf_name=$life_satisfaction_pdf_original_name;
			}
			$life_satisfaction_pdf_name=str_replace(' ', '-', $life_satisfaction_pdf_name);
			$life_satisfaction_pdf_path =$upload_dir_path . $life_satisfaction_pdf_name;
			$life_satisfaction_pdf->move($mk_public_path,$life_satisfaction_pdf_name);
			$life_satisfaction_pdf_data['market_analysis_pdf']=$life_satisfaction_pdf_path;
			$life_satisfaction_pdf_data['market_analysis_pdf_unique_name']='life_satisfaction';
		}
		if(!empty($life_satisfaction_pdf_label)){
			$life_satisfaction_pdf_data['market_analysis_pdf_label']=$life_satisfaction_pdf_label;
		}
		if(!empty($life_satisfaction_pdf_data)){
			$market_analysis=MarketAnalysis::where('market_analysis_type',$market_analysis_type)->first(['id']);
			$market_analysis_id=$market_analysis->id;
			$life_satisfaction_pdf_data['market_analysis_id']=$market_analysis_id;
			$mkpdfs_obj=MarketAnalysisPdf::updateOrCreate(['market_analysis_pdf_unique_name'=>'life_satisfaction'],$life_satisfaction_pdf_data);
        }
		// Health care system coverage
        $health_care_system_pdf_path='';
        $health_care_system_pdf=$request->file('health_care_system_pdf');
		$health_care_system_pdf_label=$request['health_care_system_pdf_label'];
		if(!empty($health_care_system_pdf)){ 
			$health_care_system_pdf_original_name = $health_care_system_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$health_care_system_pdf_original_name)){
				$health_care_system_pdf_name = time().'-'.$health_care_system_pdf_original_name;
			}
			else {
				$health_care_system_pdf_name=$health_care_system_pdf_original_name;
			}
			$health_care_system_pdf_name=str_replace(' ', '-', $health_care_system_pdf_name);
			$health_care_system_pdf_path =$upload_dir_path . $health_care_system_pdf_name;
			$health_care_system_pdf->move($mk_public_path,$health_care_system_pdf_name);
			$health_care_system_pdf_data['market_analysis_pdf']=$health_care_system_pdf_path;
			$health_care_system_pdf_data['market_analysis_pdf_unique_name']='health_care_system';
		}
		if(!empty($health_care_system_pdf_label)){
			$health_care_system_pdf_data['market_analysis_pdf_label']=$health_care_system_pdf_label;
		}
		if(!empty($health_care_system_pdf_data)){
			$market_analysis=MarketAnalysis::where('market_analysis_type',$market_analysis_type)->first(['id']);
			$market_analysis_id=$market_analysis->id;
			$health_care_system_pdf_data['market_analysis_id']=$market_analysis_id;
			$mkpdfs_obj=MarketAnalysisPdf::updateOrCreate(['market_analysis_pdf_unique_name'=>'health_care_system'],$health_care_system_pdf_data);
        }
		// Family friendly policies
        $family_friendly_policies_pdf_path='';
        $family_friendly_policies_pdf=$request->file('family_friendly_policies_pdf');
		$family_friendly_policies_pdf_label=$request['family_friendly_policies_pdf_label'];
		if(!empty($family_friendly_policies_pdf)){ 
			$family_friendly_policies_pdf_original_name = $family_friendly_policies_pdf->getClientOriginalName();
			if(file_exists($base_path.$upload_dir_path.$family_friendly_policies_pdf_original_name)){
				$family_friendly_policies_pdf_name = time().'-'.$family_friendly_policies_pdf_original_name;
			}
			else {
				$family_friendly_policies_pdf_name=$family_friendly_policies_pdf_original_name;
			}
			$family_friendly_policies_pdf_name=str_replace(' ', '-', $family_friendly_policies_pdf_name);
			$family_friendly_policies_pdf_path =$upload_dir_path . $family_friendly_policies_pdf_name;
			$family_friendly_policies_pdf->move($mk_public_path,$family_friendly_policies_pdf_name);
			$family_friendly_policies_pdf_data['market_analysis_pdf']=$family_friendly_policies_pdf_path;
			$family_friendly_policies_pdf_data['market_analysis_pdf_unique_name']='family_friendly_policies';
		}
		if(!empty($family_friendly_policies_pdf_label)){
			$family_friendly_policies_pdf_data['market_analysis_pdf_label']=$family_friendly_policies_pdf_label;
		}
		if(!empty($family_friendly_policies_pdf_data)){
			$market_analysis=MarketAnalysis::where('market_analysis_type',$market_analysis_type)->first(['id']);
			$market_analysis_id=$market_analysis->id;
			$family_friendly_policies_pdf_data['market_analysis_id']=$market_analysis_id;
			$mkpdfs_obj=MarketAnalysisPdf::updateOrCreate(['market_analysis_pdf_unique_name'=>'family_friendly_policies'],$family_friendly_policies_pdf_data);
        }
		return redirect('admin/market_analysis')->with('status', 'Market Analysis has been updated!');
	}

	// Country Pdfs
	public function upload_country_pdf(){
		$country_list = Country::all();
		$data['country_list'] = $country_list;
		$data['page_title']='Upload country pdf';
		return view('admin/countryPdf',$data);
	}
	// Country Pdfs store
	public function country_pdf_store(Request $request)
	{
		//echo '<pre>'; print_r($request->all()); exit;
		$form_type = trim($request['form_type']);

		$request_arr['country_name'] = 'required|max:255';
		$request_arr['country_pdf_label'] = 'max:255';
		if($form_type == 'create'){
			$request_arr['country_pdf'] = 'required';
		}
		$validator = Validator::make($request->all(), $request_arr);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator->errors());
		}
		$base_path = base_path();
		$base_path = str_replace("/wexsite", "", $base_path);
		$upload_dir_path = '/uploads/countryPdfs/';
		$country_public_path = $base_path . $upload_dir_path;

		// Managers
		$country_data = array();
		$country_pdf_id = trim($request['country_pdf_id']);
		$country_name = $request['country_name'];
		$country_pdf_lable = $request['country_pdf_label'];
		$country_pdf_path = '';
		$country_pdf = $request->file('country_pdf');
		if (!empty($country_pdf)) {
			// save image
			$country_pdf_original_name = $country_pdf->getClientOriginalName();
			if (file_exists($base_path . $upload_dir_path . $country_pdf_original_name)) {
				$country_pdf_name = time() . '-' . $country_pdf_original_name;
			} else {
				$country_pdf_name = $country_pdf_original_name;
			}
			$country_pdf_name = str_replace(' ', '-', $country_pdf_name);
			$country_pdf_path = $upload_dir_path . $country_pdf_name;
			$country_pdf->move($country_public_path, $country_pdf_name);
			$country_data['country_pdf'] = $country_pdf_path;
		}
		if (!empty($country_name)) {
			$country_data['country_name'] = $country_name;
		}
		if (!empty($country_pdf_lable)) {
			$country_data['country_pdf_label'] = $country_pdf_lable;
		}
		//echo '<pre>'; print_r($country_data); exit;
		if ($form_type == 'create') {
			if (!empty($country_data)) {
				CountryPdf::updateOrCreate(['country_name' => $country_name], $country_data);
			}
			//return redirect('admin/market_analysis')->with('status', 'country pdfs has been updated!');
			return redirect('admin/steady_aim_shoot/country_pdf')->with('status', 'country pdfs has been added!');
		}
		elseif ($form_type == 'edit') {
			//echo '<pre>'; print_r($country_data); exit();
			CountryPdf::find($country_pdf_id)->update($country_data);
			return redirect('admin/steady_aim_shoot/country_pdf/list')->with('status', 'country pdfs has been updated successfully');

		}
	}


	public function country_pdf_list()
	{
		$country_obj = CountryPdf::all();
		$country_arr = [];
		if(is_object($country_obj) && !empty($country_obj)){
			foreach($country_obj as $country)
			{
				$country_name = $country['country_name'];
				$country_pdf = $country['country_pdf'];
				$country_pdf_label = $country['country_pdf_label'];
				$country_pdf_id = $country['id'];
				$country_arr[] = [	'country_name' => $country_name,
									'country_pdf' => $country_pdf,
									'country_pdf_label' => $country_pdf_label,
									'country_pdf_id' => $country_pdf_id
								];
			}
		}
		//echo '<pre>'; print_r($country_arr);exit;
		$data['page_title'] = 'Country pdf List';
		$data['country_arr'] = $country_arr;
		return view('admin.countryList',$data);
	}

	/**
	 * edit country pdf.
	 *
	 * @return view
	 */
	public function country_pdf_edit($country_pdf_id)
	{
		$country_list = Country::all();
		if(empty($country_list)){
			$country_list = [];
		}
		$countryPdf = CountryPdf::find($country_pdf_id);
		if(empty($countryPdf)){
			$countryPdf = [];
		}

		$data['page_title']='Country pdf edit';
		$data['countryPdf']=$countryPdf;
		$data['country_list'] = $country_list;
		return view('admin.countryPdf',$data);
	}

	/**
	 * Create Change text of steady aim shot form
	 *
	 * @return view
	 */
	public function steady_aim_shoot(){
		$steady_aim_shoot = SteadyAimShoot::find(1);
		if(empty($steady_aim_shoot)){
			$steady_aim_shoot = [];
		}
		//echo '<pre>'; print_r($steady_aim_shoot->toArray()); exit;
		$data['steady_aim_shoot']=$steady_aim_shoot;
		$data['page_title']='Change Text';
		return view('admin.steadyAimShoot',$data);
	}
	// steady_aim_shoot Pdfs store
	public function steady_aim_shoot_store(Request $request)
	{
		//echo '<pre>'; print_r($request->all()); exit;
		$form_type = trim($request['form_type']);

		$request_arr['top_description'] = 'required';
		$request_arr['bottom_description'] = 'required';
		$request_arr['whats_now'] = 'required';
		$request_arr['steady_aim_shoot_pdf_label'] = 'required|max:255';
		if($form_type == 'create'){
			$request_arr['steady_aim_shoot_pdf'] = 'required';
		}
		$validator = Validator::make($request->all(), $request_arr);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator->errors());
		}
		$base_path = base_path();
		$base_path = str_replace("/wexsite", "", $base_path);
		$upload_dir_path = '/uploads/steadyAimShootPdf/';
		$steady_aim_shoot_public_path = $base_path . $upload_dir_path;

		// Managers
		$steady_aim_shoot_data = array();
		$steady_aim_shoot_id = trim($request['steady_aim_shoot_id']);
		$top_description = $request['top_description'];
		$bottom_description = $request['bottom_description'];
		$whats_now = $request['whats_now'];
		$steady_aim_shoot_pdf_label = $request['steady_aim_shoot_pdf_label'];
		$steady_aim_shoot_pdf_path = '';
		$steady_aim_shoot_pdf = $request->file('steady_aim_shoot_pdf');
		if (!empty($steady_aim_shoot_pdf)) {
			// save image
			$steady_aim_shoot_pdf_original_name = $steady_aim_shoot_pdf->getClientOriginalName();
			if (file_exists($base_path . $upload_dir_path . $steady_aim_shoot_pdf_original_name)) {
				$steady_aim_shoot_pdf_name = time() . '-' . $steady_aim_shoot_pdf_original_name;
			} else {
				$steady_aim_shoot_pdf_name = $steady_aim_shoot_pdf_original_name;
			}
			$steady_aim_shoot_pdf_name = str_replace(' ', '-', $steady_aim_shoot_pdf_name);
			$steady_aim_shoot_pdf_path = $upload_dir_path . $steady_aim_shoot_pdf_name;
			$steady_aim_shoot_pdf->move($steady_aim_shoot_public_path, $steady_aim_shoot_pdf_name);
			$steady_aim_shoot_data['steady_aim_shoot_pdf'] = $steady_aim_shoot_pdf_path;
		}
		if (!empty($steady_aim_shoot_pdf_label)) {
			$steady_aim_shoot_data['steady_aim_shoot_pdf_label'] = $steady_aim_shoot_pdf_label;
		}
		if (!empty($top_description)) {
			$steady_aim_shoot_data['top_description'] = $top_description;
		}
		if (!empty($bottom_description)) {
			$steady_aim_shoot_data['bottom_description'] = $bottom_description;
		}
		if (!empty($whats_now)) {
			$steady_aim_shoot_data['whats_now'] = $whats_now;
		}
		//echo '<pre>'; print_r($steady_aim_shoot_data); exit;

		if (!empty($steady_aim_shoot_data)) {
			SteadyAimShoot::updateOrCreate(['id' => '1'], $steady_aim_shoot_data);
		}
		//return redirect('admin/market_analysis')->with('status', 'country pdfs has been updated!');
		return redirect('admin/steady_aim_shoot')->with('status', 'country pdfs has been added!');

	}
	public function dream_check_lab_assign_consultant($dream_check_lab_id){
		$user = Auth::user();
		$user_name = $user->name. ' ' .$user->surname;
		$user_obj = DB::table('users')
			->join('user_roles', 'users.id', '=', 'user_roles.user_id')
			->select('users.name', 'users.surname', 'users.id')
			->where('user_roles.role_id', 2)
			->get();
		$consultant_data = [];
		if(!empty($user_obj))
		{
			foreach($user_obj as $user)
			{
				$consultant_name = $user->name.' '.$user->surname;
				$consultant_id = $user->id;
				$consultant_data[] = ['name' => $consultant_name, 'id' => $consultant_id];
			}
			//echo '<pre>'; print_r($consultant_data); exit;
		}
		$data['user_name'] = $user_name;
		$data['dream_check_lab_id'] = $dream_check_lab_id;
		$data['consultant_arr'] = $consultant_data;
		$data['page_title'] = "Assign Consultant";
		return view('admin.dream_check_lab_assign_consultant',$data);
	}
	public function dream_check_lab_assign_consultant_update(Request $request,$dream_check_lab_id){

		$dream_check_lab_id = trim($request['dream_check_lab_id']);
		$consultant_id = trim($request['consultant']);
		$consultant_update_arr = 	[
			'validate_by' => $consultant_id
		];
		//echo '<pre>'; print_r($consultant_update_arr); exit();
		$dreamcheck_lab_obj = DreamCheckLab::find($dream_check_lab_id);
		$dreamcheck_lab_obj->update($consultant_update_arr);
		$data['dream_check_lab_id'] = $dreamcheck_lab_obj->id;
		$consultant = ConsultantProfile::where(['user_id', $consultant_id]);
		$user = $consultant->user;
		$user_id = $user->id;
		$user_fname = $user->name;
		$user_surname = $user->surname;
		$user_name = $user_fname . ' ' . $user_surname;
		$to_email = $user->email;
		$user_array = ['user_name' => $user_name, 'user_id' => $user_id];
		//echo  '<pre>'; print_r($user_array); echo '</pre>'; die;
		Mail::send('emails.dream_check_admin_notification',
			['user_array' => $user_array,'data' => $data], function ($m) use ($to_email)  {
			$settings = Setting::find(1);
			$site_email = $settings->website_email;
			$m->from($site_email, 'Wexplore');
			$m->to($to_email, 'Wexplore')->subject('Dream Check Lab Submission!');
		});
		$consultant->increment(['email_count']);
		Mail::send('emails.dream_check_admin_notification',
			['user_array' => $user_array,'data' => $data], function ($m) use ($to_email)  {
				$settings = Setting::find(1);
				$site_email = $settings->website_email;
				$m->from($site_email, 'Wexplore');
				$m->to($to_email, 'Wexplore')->subject('Dream Check Lab Submission!');
			});
		$createUser = User::find($dreamcheck_lab_obj->user_id);
		$create_email = $createUser->email;
		Mail::send('emails.dream_check_admin_notification',
			['user_array' => $user_array,'data' => $data], function ($m) use ($create_email )  {
				$settings = Setting::find(1);
				$site_email = $settings->website_email;
				$m->from($site_email, 'Wexplore');
				$m->to($create_email , 'Wexplore')->subject('Dream Check Lab Consultant Assigned Successfully!');
			});
		//return redirect($saloon_identity.'/appointment/list')->with('status', 'Appointment has been postponed successfully');
		return redirect()->back()->with('status', 'Appointment has been postponed successfully');

	}
}
