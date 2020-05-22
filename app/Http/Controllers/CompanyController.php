<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //middleware controller
    public function __construct(){
        $this->middleware(['employer','verified'],['except'=>array('index','company')]);
    }

    //the $name parameter is route model binding the advantage is no need to find the company detail we can get it directly by skipping one line
    public function index($id , Company $company){
        return view('company.index',compact('company'));   
    }

    //to view all companies
    public function company(){
        $companies = Company::paginate(10);
        return view('company.company',compact('companies'));
    }

    public function create(){
        return view('company.create');
    }

    public function store(Request $request){
        //validate the data
        $this->validate($request,[
            'address' => 'required',
            'phone'=> 'regex:/[0-9]{10}/',
            'website'=> 'required|regex:/[a-zA-Z]{3,}[.][a-zA-Z]{3,}/',
            'slogan'=> 'required|min:10',
            'description'=> 'required|min:10',
        ]);
        
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
