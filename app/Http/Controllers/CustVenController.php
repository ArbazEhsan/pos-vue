<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\User;
use App\Models\Permission;


class CustVenController extends Controller
{
    public function checkPoint()
    {
        return view('account.checkPointCV');
    }
    public function viewCustomer()
    {
        $result = Account::orderBy('type')->get();
        return view('account.viewCustomer')->with('cust', $result);
    }
    public function viewVendor()
    {
        $result = Account::where('type','Vendor')->get();
        return view('account.viewVendor')->with('vend', $result);
    }
	public function form()
	{
		return view('account.addCustVen');
	}
	public function store(Request $request)
    {
    	$post = new Account;
    	$post->name = $request->cvname;
    	$post->type = $request->type;
    	$post->city = $request->city;
    	$post->address = $request->address;
    	$post->contact_person = $request->contact;
    	$post->mobile = $request->mobile;
    	$post->tel_1 = $request->tel1;
    	$post->email = $request->email;
        // $post->tel_2 = $request->tel2;
    	$post->status = 1;
        $post->user_id = Auth::id();

    	$post->save();
    	return redirect('addCustVen')->with('success','Account Created Successfully');

    }
    public function edit($id)
    {
        $cat="";
    	$result = Account::find([$id,0]);
        $data = Account::all();
        foreach ($data as $value) {
            if ($result[0]->id == $value->id) {
                $cat .= '<option selected>'.$value->type.'</option>';
            }
        }
        $cat .= '<option>Asset</option>
                <option>Capital</option>
                <option>Customer</option>
                <option>Expense</option>
                <option>Liability</option>
                <option>Vendor</option>';
    	return view('account.editCustVen')->with(['custven'=>$result,'type'=>$cat]);
    }
    public function update(Request $request)
    {
    	$id = $request->id;
    	$post = Account::find($id);
    	$post->name = $request->cvname;
    	$post->type = $request->type;
    	$post->city = $request->city;
    	$post->address = $request->address;
    	$post->contact_person = $request->contact;
    	$post->mobile = $request->mobile;
    	$post->tel_1 = $request->tel1;
        $post->email = $request->email;
    	// $post->tel_2 = $request->tel2;
    	$post->status = 1;
        $post->user_id = Auth::id();

    	$post->save();
        // if ($request->type == "Customer") {
        //     return $this->viewCustomer();
        // }
    	return $this->viewCustomer();
    }
    public function delete($id)
    {
    	$result = Account::destroy($id);
    	return $this->index();
    }

    public function statusCust($status,$id)
    {
        $post = Account::find($id);
        if ($status == 1) {
           $post->status = 0; 
        } else {
            $post->status = 1;
        }
        $post->user_id = Auth::id();
        $post->save();
        return $this->viewCustomer();
    }

    public function statusVen($status,$id)
    {
        $post = Account::find($id);
        if ($status == 1) {
           $post->status = 0; 
        } else {
            $post->status = 1;
        }
        $post->user_id = Auth::id();
        $post->save();
        return $this->viewVendor();
    }

    /* user query start */
    public function viewUser()
    {
        $result = User::whereId(Auth()->id())->get();
        $result2 = User::where('type','Employee')->get();
        return view('user.viewUser')->with(['result'=>$result,'result2'=>$result2]);
    }

    public function userRights($uid,$name)
    {
        $result = Permission::where('user_id',$uid)->get();
        return view('user.userRights')->with(['result'=>$result,'uid'=>$uid,'name'=>$name]);
    }

    public function viewUForm()
    {
        return view('user.createUser');
    }

    public function createUser(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'account_type' => $request->account_type,
            'type' => 'Employee', 
        ]);
        return redirect('viewProfile');
    }

    public function deleteUser($id)
    {
        $result = User::destroy($id);
        return redirect('viewProfile');
    }

    public function saveUserRights(Request $request)
    {
        $uid = $request->userID;
        $none = $request->pagenone;
        $vedit = $request->pageve;
        $add = $request->pageadd;
        $admin = $request->pageadmin;

        if(empty($none)!=1){
            $this->splitandPass($none,$uid);
        }
        if (empty($vedit)!=1) {
            $this->splitandPass($vedit,$uid);
        }
        if (empty($add)!=1) {
            $this->splitandPass($add,$uid);
        }
        if (empty($admin)!=1) {
            $this->splitandPass($admin,$uid);
        }
        
        echo "Inserted";
        
    }
    public function splitandPass($pages,$uid)
    {
        for ($i=0;$i<count($pages);$i++) { 
            $page = explode("/", $pages[$i]);
            $this->InsertorUpdate($page[0],$page[1],$uid);
        }
    }
    public function InsertorUpdate($page,$value,$uid)
    {   
        $count = Permission::where(['pages'=>$page,'user_id'=>$uid])->count();
        if ($count > 0) {
            Permission::where(['pages'=>$page,'user_id'=>$uid])->update(['user_id'=>$uid,'permission'=>$value]);
        }
        elseif ($count == 0) {
            Permission::insert(['user_id'=>$uid,'permission'=>$value,'pages'=>$page]);
        }
    }
    /* user query end */
}
