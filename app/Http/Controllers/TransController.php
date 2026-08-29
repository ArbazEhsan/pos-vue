<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Tran;
use App\Models\Account;
use App\Models\Ledger;
use App\Models\Company;

class TransController extends Controller
{
    public function menuTran()
	{
		return view('trans.viewTrans');
	}

	/* TransIn methods start */
    public function indexTransIn()
	{
        $result = Tran::join('accounts','account_id','=','accounts.id')->where('trans.type','CR')
            ->select('trans.*','accounts.name as cust_name')->get();
        return view('trans.viewTransIn')->with('transin', $result);
	}
    public function fillTransIn()
    {
        $result='';
        $count = Account::count();
        if ($count>0) {
            $data = Account::where('status','1')->orderBy('name')->get();
            foreach ($data as $value) {
                $result .= '<option value="'.$value->id.'">'.$value->name.' - '.$value->type.'</option>';
            }
        }
        else {
            $result = '<option value="0">No Customer Add</option>';
        }
        return view('trans.addTransIn')->with('customer', $result);
    }
    public function storeTransIn(Request $request)
    {
        /* trans query */
        $post = new Tran;
        $post->day = $request->day;
        $post->user_id = Auth::id();
        $post->account_id = $request->cust_id;
        $post->amount = $request->amount;
        $post->bill_no = $request->bill_no;
        $post->remarks = $request->remarks;
        $post->type = "CR";
        $post->status = 1;
        $post->save();

        /* ledger query*/
        $post2 = new Ledger;
        $post2->cr = $request->amount;
        $post2->day = $request->day;
        $post2->account_id = $request->cust_id;
        $post2->trans_id = $post->id;
        $post2->type = "CR";
        $post2->status = 1;
        $post2->save();

    	// $post = new Tran;
    	// $post->day = $request->day;
    	// $post->cust_id = $request->cust_id;
    	// $post->amount = $request->amount;
    	// $post->remarks = $request->remarks;
    	// $post->bill_no = $request->bill_no;
    	// $post->type = "i";
    	// $post->status = 1;

    	// $post->save();
        // $id = $post->id;
        // $cust_name = Account::where('id',$request->cust_id)->pluck('name');

        // $post = new Ledger;
        // $post->cr = $request->amount;
        // $post->day = $request->day;
        // $post->invoice_no = $id;
        // $post->type = 'i';
        // $post->account = $cust_name[0];
        // $post->remarks = $request->remarks;
        // $post->status = 1;

        // $post->save();
    	return redirect('addTransIn')->with('success','Data Inserted Successfully');

    }
    public function deleteTransIn($id)
    {
    	Tran::destroy($id);
        Ledger::where('trans_id',$id)->delete();
    	return $this->indexTransIn();
    }

    /* Trans out methods start */

    public function indexTransOut()
	{
        $result = Tran::join('accounts','account_id','=','accounts.id')->where('trans.type','CO')
            ->select('trans.*','accounts.name as cust_name')->get();
        return view('trans.viewTransOut')->with('transout', $result);
	}
    public function fillTransOut()
    {
        $result='';
        $count = Account::count();
        if ($count>0) {
            $data = Account::where('status','1')->orderBy('name')->get();
            foreach ($data as $value) {
                $result .= '<option value="'.$value->id.'">'.$value->name.' - '.$value->type.'</option>';
            }
        }
        else {
            $result = '<option value="0">No Vendor Add</option>';
        }
        return view('trans.addTransOut')->with('vendor', $result);
    }
    public function storeTransOut(Request $request)
    {
        /* trans query */
        $post = new Tran;
        $post->day = $request->day;
        $post->user_id = Auth::id();
        $post->account_id = $request->cust_id;
        $post->amount = $request->amount;
        $post->bill_no = $request->bill_no;
        $post->remarks = $request->remarks;
        $post->type = "CO";
        $post->status = 1;
        $post->save();

        /* ledger query*/
        $post2 = new Ledger;
        $post2->dr = $request->amount;
        $post2->day = $request->day;
        $post2->account_id = $request->cust_id;
        $post2->trans_id = $post->id;
        $post2->type = "CO";
        $post2->status = 1;
        $post2->save();
    	// $post = new Tran;
    	// $post->day = $request->day;
    	// $post->cust_id = $request->cust_id;
    	// $post->amount = $request->amount;
    	// $post->remarks = $request->remarks;
    	// $post->bill_no = $request->bill_no;
    	// $post->type = "o";
    	// $post->status = 1;

    	// $post->save();

     //    $id = $post->id;
     //    $cust_name = Account::where('id',$request->cust_id)->pluck('name');

     //    $post = new Ledger;
     //    $post->dr = $request->amount;
     //    $post->day = $request->day;
     //    $post->invoice_no = $id;
     //    $post->type = 'o';
     //    $post->account = $cust_name[0];
     //    $post->remarks = $request->remarks;
     //    $post->status = 1;

     //    $post->save();
    	return redirect('addTransOut')->with('success','Data Inserted Successfully');

    }
    public function deleteTransOut($id)
    {
    	Tran::destroy($id);
        Ledger::where('trans_id',$id)->delete();
    	return $this->indexTransOut();
    }

    public function cashPrint($value)
    {
        $result = Tran::where('trans.id',$value)
            ->join('accounts','accounts.id','=','trans.account_id')
        ->select('trans.*','accounts.name as cust_name','accounts.address')->get();

        $result2 = Company::all();
        return view('trans.cashPrint')->with(['invoice'=>$result,'company'=>$result2]);
    }
}
