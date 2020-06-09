<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyPostRequest;

/**
 * This class is for viewing a single company, all companies, create company view and to store company details
 * Date: 08/06/2020
 * Author: Pawan
 */
class CompanyController extends Controller
{
    /**
     * __construct middleware controller    
     *
     * @return void
     */
    public function __construct(){
        $this->middleware(['employer','verified'],['except'=>array('index','company')]);
    }

    /**
     * returns details of a particular company
     *
     * @param  int $id
     * @param  mixed $company
     * @return view
     */
    public function index($id , Company $company){
        return view('company.index',compact('company'));   
    }
   
    /**
     * returns details of a all companies
     *
     * @return view
     */
    public function company(){
        $companies = Company::paginate(10);
        return view('company.company',compact('companies'));
    }
    
    /**
     * returns a create view for company details
     *
     * @return view
     */
    public function create(){
        return view('company.create');
    }
    
    /**
     * inserts company data into database after validating the data
     *
     * @param  mixed $request
     * @return void
     */
    public function store(CompanyPostRequest $request){
               
        //$request->get('address') and request('address') are both same
        //to get information of current logged in user is using auth 
        $user_id = auth()->user()->id;
        Company::where('user_id',$user_id)->update([
            'address' => $request->get('address'),
            'phone'=> $request->get('phone'),
            'website'=> $request->get('website'),
            'slogan'=> $request->get('slogan'),
            'description'=> $request->get('description'),
          
        ]);
        return redirect()->back()->with('message','Company successfully Updated!');
    }
    
    /**
     * validate and store the coverPhoto 
     *
     * @param  mixed $request
     * @return void
     */
    public function coverPhoto(Request $request){
        $this->validate($request,[
            'cover_photo' => 'required|mimes:png,jpg,jpeg|max:2000',
        ]);
        $user_id = auth()->user()->id;
        if($request->hasfile('cover_photo')){
            $file = $request->file('cover_photo');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/coverphoto/',$filename);
            Company::where('user_id',$user_id)->update([
                'cover_photo' => $filename,
            ]);
            return redirect()->back()->with('message','Company cover photo successfully Updated!');
        }
    }
    
    /**
     * validate and store the companyLogo
     *
     * @param  mixed $request
     * @return void
     */
    public function companyLogo(Request $request){
        $this->validate($request,[
            'company_logo' => 'required|mimes:png,jpg,jpeg|max:2000',
        ]);
        $user_id = auth()->user()->id;
        if($request->hasfile('company_logo')){
            $file = $request->file('company_logo');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/logo/',$filename);
            Company::where('user_id',$user_id)->update([
                'logo' => $filename,
            ]);
            return redirect()->back()->with('message','Company logo successfully Updated!');
        }
    }
}
