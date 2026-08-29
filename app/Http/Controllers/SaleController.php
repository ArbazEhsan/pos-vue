<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Counter;
use App\Models\PCounter;
use App\Models\Company;
use App\Models\Ledger;
use App\Models\Tran;
use App\Models\Purchase;

class SaleController extends Controller
{
    public function saleForm()
    {
    	$data = "";
    	$result = Account::where(['type'=>'Customer','status'=>'1'])->get();
    	foreach ($result as $value) {
    		$data .= '<option value="'.$value->id.'">'.$value->name.'</option>';
    	}
    	return view('invoice.saleForm')->with('account',$data);
    }

    public function saleReturn($id)
    {
        $data = "";
        $result = Account::where(['type'=>'Customer','status'=>'1'])->get();
        foreach ($result as $value) {
            $data .= '<option value="'.$value->id.'">'.$value->name.'</option>';
        }

        $result2 = Counter::where('counters.id',$id)
            ->join('sales','sale_no','=','counters.id')
            ->join('products','products.barcode','=','sales.barcode')
            ->join('accounts','accounts.id','=','counters.cust_id')
        ->select('counters.*','sales.*','products.name','accounts.name as cust_name')->get();
        return view('invoice.saleReturn')->with(['account'=>$data,'result'=>$result2]);
    }

    public function purchaseForm()
    {
        $data = "";
        $result = Account::where(['type'=>'Vendor','status'=>'1'])->get();
        foreach ($result as $value) {
            $data .= '<option value="'.$value->id.'">'.$value->name.'</option>';
        }
        return view('invoice.purchaseForm')->with('account',$data);
    }
    public function getAllProduct($barcode,$name,$rowNum,$from)
    {
    	$data="";$count=$price=0;
    	if ($name=='all' && $barcode=='0') {
    		$result = Product::where('status','1')->get();
            foreach ($result as $value) {
                $price=0;
                if ($from == 'sale') {
                    $price=$value->retail;
                }
                else {
                    $price=$value->purchase;
                }
            $count++;
            $data .= '<tr>
                    <td><a href="#" onClick="addFromModal('.$value->id.','.$rowNum.')" data-dismiss="modal"><i class="now-ui-icons ui-1_simple-add"></i></a></td>
                    <td>'.$count.'</td>'.'
                    <td>'.$value->barcode.'</td>'.'
                    <td>'.$value->name.'</td>'.'
                    <td>'.$value->purchase.'</td>'.'
                    <td>'.$value->whole_sale.'</td>'.'
                    <td>'.$price.'</td></tr>';
            }
            echo $data;
    	}
    	else{
    		// $result = Product::where('name','like', '%'.$name.'%')
      //       ->orWhere('barcode','like', '%'.$barcode.'%')->get();
            $result = Product::where(['barcode'=>$barcode,'status'=>1])->get();
            if ($from == 'sale') {
                $price=$result[0]->retail;
            }
            else {
                $price=$result[0]->purchase;
            }
            echo $result[0]->id.','.$result[0]->barcode.','.$result[0]->name.','.$price;
    	}
    	
    }
	public function getDetail($id,$from)
    {
        $price=0;
    	$result = Product::whereIn('id',[$id])->get();
        if ($from == 'sale') {
            $price=$result[0]->retail;
        }
        else {
            $price=$result[0]->purchase;
        }
    	echo $result[0]->id.','.$result[0]->barcode.','.$result[0]->name.','.$price;
    }   


    

    public function saveInvc(Request $request,$e,$f,$g,$h,$from)
    {
        $post = new Counter;
        $post->day = $request->sale_day;
        $post->user_id = Auth::id();
        $post->bilty_no = $request->bilty_no;
        $post->ref = $request->reference;
        $post->cust_id = $request->cust_name;
        $post->InvDiscount = $request->discount;
        $post->InvProfit = $request->profit;
        $post->received = $request->received;
        $post->remaining = $request->remaining;
        $post->finalVal = $request->final_value;
        $post->save();

        $posts = new Sale;
        $barcode = json_decode($e, TRUE);
        $qty = json_decode($f, TRUE);
        $price = json_decode($g, TRUE);
        $final = json_decode($h, TRUE);
        foreach ($barcode as $key => $value) {
            $a = 0;
            $data = array(
                'sale_no'=>$post->id,'day'=>$request->sale_day,
                'barcode'=>$barcode[$key],'qty'=>$qty[$key],
                'price'=>$price[$key],'final'=>$final[$key],
                'type'=>'Sale'
            );
            Sale::insert($data);
            $a = Product::where('barcode',$barcode[$key])->pluck('qty');
            $a = $a[0]-$qty[$key];
            Product::where('barcode',$barcode[$key])
            ->update(['qty'=>$a]);
        }

        /* trans query */
        $post2 = new Tran;
        $post2->day = $request->sale_day;
        $post2->user_id = Auth::id();
        $post2->account_id = $request->cust_name;
        $post2->invoice_id = $post->id;
        $post2->amount = $request->final_value;
        $post2->bill_no = $request->bilty_no;
        $post2->remarks = $request->reference;
        $post2->type = "SV";
        $post2->status = 1;
        $post2->save();

        /* ledger query*/
        $post3 = new Ledger;
        $post3->dr = $request->final_value;
        $post3->day = $request->sale_day;
        $post3->account_id = $request->cust_name;
        $post3->trans_id = $post2->id;
        $post3->type = "SV";
        $post3->status = 1;
        $post3->save();

        $received = $request->received;
        if ($received>0) {
            $post4 = new Ledger;
            $post4->cr = $received;
            $post4->day = $request->sale_day;
            $post4->account_id = $request->cust_name;
            $post4->trans_id = $post2->id;
            $post4->type = "SV";
            $post4->status = 1;
            $post4->save();
        }

        echo $post->id;

    }

    public function savePInvc(Request $request,$e,$f,$g,$h,$from)
    {
        $post = new PCounter;
        $post->day = $request->sale_day;
        $post->user_id = Auth::id();
        $post->bilty_no = $request->bilty_no;
        $post->ref = $request->reference;
        $post->cust_id = $request->cust_name;
        $post->InvDiscount = $request->discount;
        $post->InvProfit = $request->profit;
        $post->received = $request->received;
        $post->remaining = $request->remaining;
        $post->finalVal = $request->final_value;
        $post->save();

        $posts = new Purchase;
        $barcode = json_decode($e, TRUE);
        $qty = json_decode($f, TRUE);
        $price = json_decode($g, TRUE);
        $final = json_decode($h, TRUE);
        foreach ($barcode as $key => $value) {
            $data = array(
                'pur_no'=>$post->id,'barcode'=>$barcode[$key],
                'qty'=>$qty[$key],'price'=>$price[$key],
                'final'=>$final[$key],'type'=>'purchase'
            );
            Purchase::insert($data);
            $a = Product::where('barcode',$barcode[$key])->pluck('qty');
            $a = $a[0]+$qty[$key];
            Product::where('barcode',$barcode[$key])
            ->update(['qty'=>$a]);
        }

        /* trans query */
        $post2 = new Tran;
        $post2->day = $request->sale_day;
        $post2->user_id = Auth::id();
        $post2->account_id = $request->cust_name;
        $post2->invoice_id = $post->id;
        $post2->amount = $request->final_value;
        $post2->bill_no = $request->bilty_no;
        $post2->remarks = $request->reference;
        $post2->type = "PV";
        $post2->status = 1;
        $post2->save();

        /* ledger query*/
        $post3 = new Ledger;
        $post3->cr = $request->final_value;
        $post3->day = $request->sale_day;
        $post3->account_id = $request->cust_name;
        $post3->trans_id = $post2->id;
        $post3->type = "PV";
        $post3->status = 1;
        $post3->save();

        $received = $request->received;
        if ($received>0) {
            $post4 = new Ledger;
            $post4->dr = $received;
            $post4->day = $request->sale_day;
            $post4->account_id = $request->cust_name;
            $post4->trans_id = $post2->id;
            $post4->type = "PV";
            $post4->status = 1;
            $post4->save();
        }

        echo $post->id;

    }

    public function sPrint($value)
    {
        $result = Counter::where('counters.id',$value)
            ->join('sales','sale_no','=','counters.id')
            ->join('products','products.barcode','=','sales.barcode')
            ->join('accounts','accounts.id','=','counters.cust_id')
            ->join('users','users.id','=','counters.user_id')
        ->select('counters.*','counters.created_at as time','sales.*','products.name','accounts.name as cust_name','users.name as user')->get();

        $result2 = Company::all();
        return view('invoice.salePrint')->with(['invoice'=>$result,'company'=>$result2]);
    }

    public function pPrint($value)
    {
        $result = PCounter::where('pcounters.id',$value)
            ->join('purchases','pur_no','=','pcounters.id')
            ->join('products','products.barcode','=','purchases.barcode')
            ->join('accounts','accounts.id','=','pcounters.cust_id')
        ->select('pcounters.*','purchases.*','products.name','accounts.name as cust_name')->get();

        $result2 = Company::all();
        $user = Auth::User()->name;
        return view('invoice.purchasePrint')->with(['invoice'=>$result,'company'=>$result2,'user'=>$user]);
    }

    public function sInvoice()
    {
        $result = Counter::paginate(10);
        return view('invoice.viewInvoice')->with(['invoice'=>$result,'from'=>'Sale','url'=>'salePrint','url2'=>'saleReturn']);
    }

    public function pInvoice()
    {
        $result = PCounter::paginate(10);
        return view('invoice.viewInvoice')->with(['invoice'=>$result,'from'=>'Purchase','url'=>'purPrint','url2'=>'purchaseReturn']);
    }

    public function getSInvoice(Request $request)
    {
        $id = $request->searchInv;
        $result = Counter::where('id',$id)->get();

        $data="";
        $data .= '<tr>
                <td>'.date("d-M-y", strtotime($result[0]->day)).'</td>'.'
                <td>'.$result[0]->id.'</td>'.'
                <td>'.$result[0]->ref.'</td>'.'
                <td><a class="btn btn-primary" href="/salePrint/'.$result[0]->id.'">Print</a></td></tr>';
        echo $data;
    }
}

