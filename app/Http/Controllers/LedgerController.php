<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ledger;
use App\Models\Account;
use App\Models\Company;
use App\Models\Tran;
use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Product;

class LedgerController extends Controller
{
    public function checkPoint()
 	{
 	   	return view('ledger.checkPoint');
 	}  
 	public function custForm()
 	{
 		$data = "";
 		$result = Account::orderBy('name')->pluck('name','id');
 		foreach ($result as $key => $value) {
 			$data .= '<option value="'.$key.'">'.$value.'</option>';
 		}
 	 	return view('ledger.custForm')->with('customer',$data);
 	} 
 	public function venForm()
 	{
 		$data = "";
 		$result = Account::orderBy('name')->pluck('name','id');
 		foreach ($result as $key => $value) {
 			$data .= '<option value="'.$key.'">'.$value.'</option>';
 		}
 	 	return view('ledger.venForm')->with('vendor',$data);
 	}
 	public function Ledger(Request $request)
 	{
 		$from = $request->from;
 		$to = $request->to;
 		$id = $request->cust_id;
        $source = $request->source;
 		$cust = Account::where('id',$id)->get();
 		$company = Company::all();
        $checkLedger = Ledger::where('account_id',$id)->count();
        $remarks101 = array();
        $remarks102 = '';
        $result2 = '';    
        if($checkLedger > 0){

 		if(date('Y', strtotime($from))=='1970' && date('Y', strtotime($to))=='1970') {
            $result = Ledger::where('ledgers.account_id',$id)
                ->join('trans','trans.id','=','ledgers.trans_id')
                ->select('ledgers.*','trans.*')
                ->get();

            $from = "All";
            $to = "All";
            $opb = Ledger::where('account_id',$id)->oldest()->get();
            $debit = $cr = 0;
            if(empty($opb[0]->cr))
            {
                $Bal = $opb[0]->dr;
                $debit= $opb[0]->dr-$cr;
                $text = 'Rcvble';
            }
            else
            {
                $cr = $Bal = $debit - $opb[0]->cr;
            	$text = 'Payable';
            } 
            $opBal = array(
              	'bal'=>$Bal,
            	'text'=>$text
            );
        }
        else {
            $dr = Ledger::where([['account_id',$id],['day','<',$from]])->sum('dr');
            $cr = Ledger::where([['account_id',$id],['day','<',$from]])->sum('cr');
            $Bal = $dr - $cr + 0;
            if($Bal>0)
            	$text = 'Rcvble';
            else
            	$text = 'Payable';
            $opBal = array(
            	'bal'=>$Bal,
            	'text'=>$text
            );

            $result = Ledger::where('ledgers.account_id',$id)
                    ->whereBetween('ledgers.day',[$from,$to])
                    ->join('trans','trans.id','=','ledgers.trans_id')
                    ->select('ledgers.*','trans.*')
                    ->get();
            $from = date('d/m/Y', strtotime($from));
            $to = date('d/m/Y', strtotime($to));
 		
        } 
            foreach ($result as $value) {
               if ($value->type!='CR' && $value->type!='CO') {
                    if ($value->type=='SV') {
        
                    $result2 = Sale::where('sales.sale_no',$value->invoice_id)
                    ->join('products','products.barcode','=','sales.barcode')
                    ->select('sales.qty','sales.price','products.name')
                    ->get();
                    }
                    elseif ($value->type=='PV') {
                        $result2 = Purchase::where('purchases.pur_no',$value->invoice_id)
                        ->join('products','products.barcode','=','purchases.barcode')
                        ->select('purchases.qty','purchases.price','products.name')
                        ->get(); 
                    }
                    foreach ($result2 as $value2) {
                        $remarks102 .= $value2->name.'-'.$value2->qty.'@'.$value2->price.', ';
                    }
                    array_push($remarks101, $remarks102);
                    $remarks102 = '';
                }
                else {
                    array_push($remarks101,'Bill#.'.$value->bill_no.'/'.$value->remarks);
                }
            }

            return view('ledger.ledger')->with(['ledger'=>$result, 'cust'=>$cust, 'to'=>$to, 'from'=>$from, 'company'=>$company, 'opb'=>$opBal,'source'=>$source,'remarks101'=>$remarks101]);
        }
        else {
            echo "<center>Please make any Transaction or Invoice to Generate Ledger<br><a href='#' onClick='javascript:history.go(-1)'>Click here to Go Back</a></center>";
        }
 	}
 	public function printTrans($f,$id)
 	{
 		if ($f=='i') {
 			$txt = "Cashin";
 		} elseif($f=='o') {
 			$txt = "Cashout";
 		}
 		$company = Company::all();
 		$result = Tran::where([
 			['bill_no', $id],
 			['type', $f]
 		])->get();
 		$account = Account::find($result[0]->cust_id);
 		return view('ledger.print')->with(['trans'=> $result, 'company'=> $company, 'from'=> $txt, 'account'=>$account->name]);
 	}
}
