<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
	{
		$result = Company::all();
		return view('company.companyForm')->with('company', $result);
	}
	public function store(Request $request)
    {
    	$result = Company::count();
    	if ($result>0) {
    		return redirect('addCompany')->with('error','Data Already Exist');
    	}
    	$post = new Company;
    	$post->name = $request->company_name;
    	$post->phone1 = $request->p_1;
    	$post->phone2 = $request->p_2;
    	$post->status = 1;
        $post->user_id = Auth::id();
        
    	$post->save();
    	return redirect('addCompany')->with('success','Data Inserted Successfully');

    }
    public function delete($id)
    {
    	$result = Company::destroy($id);
    	return $this->index();
    }
}
