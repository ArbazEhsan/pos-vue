<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tran;
use App\Models\Ledger;
use App\Models\Account;
use App\Models\Counter;
use App\Models\PCounter;
use App\Models\Product;
use App\Models\Category;
use App\Models\Stock;
use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Company;


class ReportController extends Controller
{
    public function cashinReport()
    {
        $result = Company::pluck('name');
        $uname = Auth::User()->name;
    	return view('report.cashinReport')->with(['company'=>$result,'uname'=>$uname]);
    }

    public function cashoutReport()
    {
        $result = Company::pluck('name');
        $uname = Auth::User()->name;
    	return view('report.cashoutReport')->with(['company'=>$result,'uname'=>$uname]);
    }

    public function receivableReport()
    {
        $result = Company::pluck('name');
        $uname = Auth::User()->name;
    	return view('report.receivableReport')->with(['company'=>$result,'uname'=>$uname]);
    }

    public function dayendReport()
    {
        $result = Company::pluck('name');
        $uname = Auth::User()->name;
        return view('report.dayendReport')->with(['company'=>$result,'uname'=>$uname]);
    }

    public function dayendDetailReport()
    {
        $result = Company::pluck('name');
        $uname = Auth::User()->name;
        return view('report.dayendDetailReport')->with(['company'=>$result,'uname'=>$uname]);
    }

    public function payableReport()
    {
        $result = Company::pluck('name');
        $uname = Auth::User()->name;
        return view('report.payableReport')->with(['company'=>$result,'uname'=>$uname]);
    }

    public function stockReport()
    {
        $result = Company::pluck('name');
        $uname = Auth::User()->name;
        return view('report.stockReport')->with(['company'=>$result,'uname'=>$uname]);
    }

    public function stockTrack()
    {   
        $uname = Auth::User()->name;
        $result = Stock::join('products','products.id','=','stocks.barcode')
            ->join('users','users.id','=','stocks.user_id')
            ->select('products.name','users.name as u_name','stocks.*')
            ->paginate(20);
        $result2 = Company::pluck('name');
        return view('report.stockTrackingReport')->with(['product'=>$result,'company'=>$result2,'uname'=>$uname]);
    }
    
    public function palReport()
    {
        $result = Company::pluck('name');
        $uname = Auth::User()->name;
        return view('report.palReport')->with(['company'=>$result,'uname'=>$uname]);
    }
    
    public function getCashinReport(Request $request)
    {
    	$from = $request->startdate;
    	$to = $request->enddate;

    	if(date('Y', strtotime($from))=='1970' && date('Y', strtotime($to))=='1970'){
    		$result = Tran::where([['trans.type','!=','PV'],['trans.type','!=','CO']])
            ->join('accounts','accounts.id','=','trans.account_id')
        	->select('trans.*','accounts.name')
        	->get();
        	$from = "All";
            $to = "All";
    	}
    	else {
    		$result = Tran::where([['trans.type','!=','PV'],['trans.type','!=','CO']])
    		->join('accounts','accounts.id','=','trans.account_id')
    		->whereBetween('trans.day',[$from,$to])
    		->select('trans.*','accounts.name')
    		->get();
            $from = date("d/m/Y", strtotime($from));
            $to = date("d/m/Y", strtotime($to));
    	}
    	
    	$data=$uname="";$count=$sum=0;
        foreach ($result as $value) {
        $count++;
        $sum = $sum + $value->amount;
        $data .= '<tr>
                <td>'.$count.'</td>'.'
                <td>'.date("d/m/Y", strtotime($value->day)).'</td>'.'
                <td>'.$value->id.'</td>'.'
                <td>'.$value->name.'</td>'.'
                <td>'.$value->remarks.'</td>'.'
                <td>'.$value->amount.'</td></tr>';
        }
        $uname = Auth::User()->name;
        echo $data.",".$sum.",".$uname.",".$from.",".$to;
    }

    public function getCashoutReport(Request $request)
    {
    	$from = $request->startdate;
    	$to = $request->enddate;

    	if(date('Y', strtotime($from))=='1970' && date('Y', strtotime($to))=='1970'){
    		$result = Tran::where([['trans.type','!=','SV'],['trans.type','!=','CR']])
            ->join('accounts','accounts.id','=','trans.account_id')
        	->select('trans.*','accounts.name')
        	->get();
    	}
    	else {
    		$result = Tran::where([['trans.type','!=','SV'],['trans.type','!=','CR']])
    		->join('accounts','accounts.id','=','trans.account_id')
    		->whereBetween('trans.day',[$from,$to])
    		->select('trans.*','accounts.name')
    		->get();
            $from = date("d/m/Y", strtotime($from));
            $to = date("d/m/Y", strtotime($to));
    	}
    	
    	$data=$uname="";$count=$sum=0;
        foreach ($result as $value) {
        $count++;
        $sum = $sum + $value->amount;
        $data .= '<tr>
                <td>'.$count.'</td>'.'
                <td>'.date("d/m/Y", strtotime($value->day)).'</td>'.'
                <td>'.$value->id.'</td>'.'
                <td>'.$value->name.'</td>'.'
                <td>'.$value->remarks.'</td>'.'
                <td>'.$value->amount.'</td></tr>';
        }
        $uname = Auth::User()->name;
        echo $data.",".$sum.",".$uname.",".$from.",".$to;
    }

    public function getReceivableReport(Request $request)
    {
        $from = $request->startdate;
        $to = $request->enddate;
        $bal=$count=$sum=0;
        $data=$uname="";
        if(date('Y', strtotime($from))=='1970' && date('Y', strtotime($to))=='1970'){

            $account = Account::where('type','Customer')->get();
            foreach ($account as $value) {
                $cr = Ledger::where('account_id',$value->id)->sum('cr');
                $dr = Ledger::where('account_id',$value->id)->sum('dr');
                $bal = $cr-$dr;
                $sum += $bal; 
                $count++;
                $data .= '<tr>
                        <td>'.$count.'</td>'.'
                        <td>'.$value->name.'</td>'.'
                        <td>'.$bal.'</td></tr>';
            }
        }
        else {

            $account = Account::where('type','Customer')->get();
            foreach ($account as $value) {
                $cr = Ledger::where('account_id',$value->id)
                      ->whereBetween('day',[$from,$to])
                      ->sum('cr');
                $dr = Ledger::where('account_id',$value->id)
                      ->whereBetween('day',[$from,$to])
                      ->sum('dr');
                $bal = $cr-$dr;
                $sum += $bal;
                $count++;
                $data .= '<tr>
                        <td>'.$count.'</td>'.'
                        <td>'.$value->name.'</td>'.'
                        <td>'.$bal.'</td></tr>';
            }
            $from = date("d/m/Y", strtotime($from));
            $to = date("d/m/Y", strtotime($to));
        }        
        echo $data.",".$sum.",".$from.",".$to;

    }

    public function getDayendReport(Request $request)
    {
        $from = $request->startdate;
        $to = $request->enddate;
        $sale=$cashin=$cashout=$credit='';
        if(date('Y', strtotime($from))=='1970' && date('Y', strtotime($to))=='1970'){

            $sale = Tran::where('type','SV')->sum('amount'); 
            $cashin = Tran::where('type','CR')->sum('amount');
            $cashout = Tran::where('type','CO')->sum('amount');
            $credit = Counter::sum('remaining');

        }
        else {
            $sale = Tran::where('type','SV')->whereBetween('day',[$from,$to])->sum('amount'); 
            $cashin = Tran::where('type','CR')->whereBetween('day',[$from,$to])->sum('amount');
            $cashout = Tran::where('type','CO')->whereBetween('day',[$from,$to])->sum('amount');
            $credit = Counter::whereBetween('day',[$from,$to])
                    ->sum('remaining');
            $from = date("d/m/Y", strtotime($from));
            $to = date("d/m/Y", strtotime($to));
        }
        $data=$uname="";$count=1;
        $data .= '<tr>
                <td>'.$count.'</td>'.'
                <td>'.$sale.'</td>'.'
                <td>'.$cashin.'</td>'.'
                <td>'.$credit.'</td>'.'
                <td>'.$cashin.'</td>'.'
                <td>'.$cashout.'</td></tr>';
        echo $data.",".$from.",".$to;
    }

    public function getPayableReport(Request $request)
    {
        $from = $request->startdate;
        $to = $request->enddate;
        $bal=$count=$sum=0;
        $data=$uname="";
        if(date('Y', strtotime($from))=='1970' && date('Y', strtotime($to))=='1970'){

            $account = Account::where('type','Vendor')->get();
            foreach ($account as $value) {
                $cr = Ledger::where('account_id',$value->id)->sum('cr');
                $dr = Ledger::where('account_id',$value->id)->sum('dr');
                $bal = abs($cr-$dr);
                $sum += $bal;
                $count++;
                $data .= '<tr>
                        <td>'.$count.'</td>'.'
                        <td>'.$value->name.'</td>'.'
                        <td>'.$bal.'</td></tr>';
            }
        }
        else {

            $account = Account::where('type','Vendor')->get();
            foreach ($account as $value) {
                $cr = Ledger::where('account_id',$value->id)
                      ->whereBetween('day',[$from,$to])
                      ->sum('cr');
                $dr = Ledger::where('account_id',$value->id)
                      ->whereBetween('day',[$from,$to])
                      ->sum('dr');
                $bal = abs($cr-$dr);
                $sum += $bal;
                $count++;
                $data .= '<tr>
                        <td>'.$count.'</td>'.'
                        <td>'.$value->name.'</td>'.'
                        <td>'.$bal.'</td></tr>';
            }
            $from = date("d/m/Y", strtotime($from));
            $to = date("d/m/Y", strtotime($to));
        }        
        echo $data.",".$sum.",".$from.",".$to;
    }

    public function getDayendDetailReport(Request $request)
    {
        $from = $request->startdate;

        if (date('Y', strtotime($from))=='1970') {

            $result = Counter::join('sales','sale_no','=','counters.id')->join('accounts','accounts.id','=','counters.cust_id')->select('counters.*','sales.*','accounts.name')->get();

            $result2 = PCounter::join('purchases','pur_no','=','pcounters.id')->join('accounts','accounts.id','=','pcounters.cust_id')->select('pcounters.*','purchases.*','accounts.name')
                ->get();

            $result3 = Tran::where('trans.type','CR')
            ->join('accounts','accounts.id','=','trans.account_id')
            ->select('trans.*','accounts.name')
            ->orderBy('trans.day', 'desc')->get();

            $result4 = Tran::where('trans.type','CO')
            ->join('accounts','accounts.id','=','trans.account_id')
            ->select('trans.*','accounts.name')
            ->orderBy('trans.day', 'desc')->get();
        }
        else {
            $result = Counter::where('counters.day',$from)
            ->join('sales','sale_no','=','counters.id')
            ->join('accounts','accounts.id','=','counters.cust_id')
            ->select('counters.*','sales.*','accounts.name')->get();

            $result2 = PCounter::where('pcounters.day',$from)
            ->join('purchases','pur_no','=','pcounters.id')->join('accounts','accounts.id','=','pcounters.cust_id')
            ->select('pcounters.*','purchases.*','accounts.name')->get();

            $result3 = Tran::where(
                ['trans.type'=>'CR','trans.day'=>$from])
            ->join('accounts','accounts.id','=','trans.account_id')
            ->select('trans.*','accounts.name')
            ->orderBy('trans.day', 'desc')->get();

            $result4 = Tran::where(
                ['trans.type'=>'CO','trans.day'=>$from])
            ->join('accounts','accounts.id','=','trans.account_id')
            ->select('trans.*','accounts.name')
            ->orderBy('trans.day', 'desc')->get();
        }
        

        $data=$data2=$data3=$data4=$uname="";$count=$count2=$count3=$count4=0;
        foreach ($result as $value) {
            $count++;
        $data .= '<tr>
                <td>'.$count.'</td>'.'
                <td>'.$value->sale_no.'</td>'.'
                <td>'.$value->barcode.'</td>'.'
                <td>'.$value->name.'</td>'.'
                <td>'.$value->ref.'</td>'.'
                <td>'.$value->finalVal.'</td>
                <td>'.$value->received.'</td>'.'
                <td>'.$value->remaining.'</td></tr>';
        }

        foreach ($result2 as $value2) {
            $count2++;
        $data2 .= '<tr>
                <td>'.$count2.'</td>'.'
                <td>'.$value2->pur_no.'</td>'.'
                <td>'.$value2->barcode.'</td>'.'
                <td>'.$value2->name.'</td>'.'
                <td>'.$value2->ref.'</td>'.'
                <td>'.$value2->finalVal.'</td>
                <td>'.$value2->received.'</td>'.'
                <td>'.$value2->remaining.'</td></tr>';
        }

        foreach ($result3 as $value3) {
            $count3++;
        $data3 .= '<tr>
                <td>'.$count3.'</td>'.'
                <td>'.$value3->id.'</td>'.'
                <td>'.$value3->name.'</td>'.'
                <td>'.$value3->remarks.'</td>'.'
                <td>'.$value3->amount.'</td></tr>';

        }

        foreach ($result4 as $value4) {
            $count4++;
        $data4 .= '<tr>
                <td>'.$count4.'</td>'.'
                <td>'.$value4->id.'</td>'.'
                <td>'.$value4->name.'</td>'.'
                <td>'.$value4->remarks.'</td>'.'
                <td>'.$value4->amount.'</td></tr>';

        }
        $uname = Auth::User()->name;
        echo $data.",".$data2.",".$data3.",".$data4.",".$uname;
    }

    public function getStockReport(Request $request)
    {
        $from = $request->startdate;
        $to = $request->enddate;
        $data=$uname="";
        $result = Category::all();
            
        if(date('Y', strtotime($from))=='1970' && date('Y', strtotime($to))=='1970'){

            foreach ($result as $value) {
            $product = Product::where('cat_id',$value->id)->get();
            $data .= '<tr>
                    <td style="background: #F7F7F7;font-weight: bold;">'.$value->name.'
                    </td>
                    </tr>';
            foreach ($product as $value2) {
                $qty = Sale::where('barcode',$value2->barcode)->sum('qty');
                $data .= '<tr>
                    <td>'.$value2->name.'</td>'.'
                    <td>'.$qty.'</td>'.'
                    <td>'.$value2->qty.'</td></tr>';
            }
            }
        }
        else {
            
            foreach ($result as $value) {
            $product = Product::where('cat_id',$value->id)->get();
            $data .= '<tr>
                    <td style="background: #F7F7F7;font-weight: bold;">'.$value->name.'
                    </td>
                    </tr>';
            foreach ($product as $value2) {
                
                $qty = Sale::where('barcode',$value2->barcode)
                        ->whereBetween('day',[$from,$to])
                        ->sum('qty');

                $data .= '<tr>
                    <td>'.$value2->name.'</td>'.'
                    <td>'.$qty.'</td>'.'
                    <td>'.$value2->qty.'</td></tr>';
            }
            }
            $from = date("d/m/Y", strtotime($from));
            $to = date("d/m/Y", strtotime($to));
        }
        
        echo $data.",".$from.",".$to;
    }

    public function getStockTrackReport(Request $request)
    {
        $from = $request->startdate;
        $to = $request->enddate;

        $result = Stock::join('products','products.id','=','stocks.barcode')
            ->join('users','users.id','=','stocks.user_id')
            ->whereBetween('stocks.day',[$from,$to])
            ->select('products.name','users.name as u_name','stocks.*')
            ->get();

        $data=$uname="";$count=1;
        foreach ($result as $value) {
        $count++;
        $data .= '<tr>
                <td>'.date("d/m/Y", strtotime($value->day)).'</td>'.'
                <td>'.$value->u_name.'</td>'.'
                <td>'.$value->name.'</td>'.'
                <td>'.$value->qty.'</td></tr>';
        }
        $uname = Auth::User()->name;
        echo $data.",".$uname.",".$from.",".$to;
    }
    
    public function getpalReport(Request $request)
    {
        $from = $request->startdate;
        $to = $request->enddate;
        $data = '';
        $totalSQty = $totalSFinal = $totalPQty = $totalPFinal = $grossProfit = $tranSumAmnt = $totalTFinal = 0;
        $result = Product::all();
        $result2 = Account::where('type','Expense')->get();
        $data .= '<tr>
                <td style="font-weight:bold;">Sales</td>
                <td></td>
                <td></td>
                </tr>';
        foreach ($result as $value) {
            $saleSumQty = Sale::where('barcode',$value->barcode)
                        ->whereBetween('day',[$from,$to])
                        ->sum('qty');
            $saleSumFinal = Sale::where('barcode',$value->barcode)
                        ->whereBetween('day',[$from,$to])
                        ->sum('final');
            $totalSQty += $saleSumQty;
            $totalSFinal += $saleSumFinal;
            $data .= '<tr>
                <td>'.$value->name.'</td>
                <td>'.$saleSumQty.'</td>
                <td>'.$saleSumFinal.'</td>
                </tr>';
        }
        $data .= '<tr>
                <td style="font-weight:bold;text-align:center">Total Sales</td>
                <td style="font-weight:bold;">'.$totalSQty.'</td>
                <td style="font-weight:bold;">'.$totalSFinal.'</td>
                </tr>';
        $data .= '<tr>
                <td style="font-weight:bold;">Purchases</td>
                <td></td>
                <td></td>
                </tr>';
        foreach ($result as $value) {
            $purSumQty = Purchase::where('barcode',$value->barcode)
                        ->whereBetween('day',[$from,$to])
                        ->sum('qty');
            $purSumFinal = Purchase::where('barcode',$value->barcode)
                        ->whereBetween('day',[$from,$to])
                        ->sum('final');
            $totalPQty += $purSumQty;
            $totalPFinal += $purSumFinal;
            $data .= '<tr>
                <td>'.$value->name.'</td>
                <td>'.$purSumQty.'</td>
                <td>'.$purSumFinal.'</td>
                </tr>';
        }
        $data .= '<tr>
                <td style="font-weight:bold;text-align:center">Total Purchase</td>
                <td style="font-weight:bold;">'.$totalPQty.'</td>
                <td style="font-weight:bold;">'.$totalPFinal.'</td>
                </tr>';
        $grossProfit = $totalSFinal - $totalPFinal;
        if ($grossProfit<0) {
            $grossProfit = '('.number_format(abs($gsProfit)).')';
        }
        $data .= '<tr>
                <td style="font-weight:bold;text-align:center">Gross Profit</td>
                <td></td>
                <td style="font-weight:bold;">'.$grossProfit.'</td>
                </tr>
                </tr>
                <tr>
                <td style="font-weight:bold;">Operating Expenses</td>
                <td></td>
                <td></td>
                </tr>';
        foreach ($result2 as $value2) {
            $tranSumAmnt = Tran::where('account_id',$value2->id)
                        ->whereBetween('day',[$from,$to])
                        ->sum('amount');
            $totalTFinal += $tranSumAmnt;
            $data .= '<tr>
                <td>'.$value2->name.'</td>
                <td></td>
                <td>'.$tranSumAmnt.'</td>
                </tr>';
        }
        $data .= '<tr>
                <td style="font-weight:bold;text-align:center">Total Operating Expenses</td>
                <td></td>
                <td style="font-weight:bold;">'.$totalTFinal.'</td>
                </tr>';
        $opIncome = $grossProfit - $totalTFinal;        
        $data .= '<tr>
                <td style="font-weight:bold;text-align:center;">Operating Income</td>
                <td></td>
                <td style="font-weight:bold;">'.$opIncome.'</td>
                </tr>
                <td style="font-weight:bold;background:yellow">Net Income</td>
                <td></td>
                <td style="font-weight:bold;">'.$opIncome.'</td>
                </tr>';
        echo $data;
    }
}
