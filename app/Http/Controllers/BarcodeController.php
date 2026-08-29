<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Permission;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Auth;

class BarcodeController extends Controller
{
    public function viewBarcode()
    {
    	$result='';
        $count = Product::count();
        if ($count>0) {
            $data = Product::where([['status',1],['cat_id','!=',8]])->get();
            foreach ($data as $value) {
                $result .= '<option value="'.$value->barcode.'">'.$value->name.'</option>';
            }
        }
        else {
            $result = '<option value="0">No Product</option>';
        }
        return view('barcode.barcode')->with('result', $result);
    }

    public function createBarcode(Request $request)
    {
        $name = $request->pname;
        $n = $request->nprint;
        $dns = new DNS1D();
        $dns->setStorPath(__DIR__.'/cache/');
       	$barcode = $dns->getBarcodeSVG($name, 'C128',1,43,'black',true);
       	return view('barcode.printBarcode')->with(['result'=>$barcode,'n'=>$n]);
            
    }
}
