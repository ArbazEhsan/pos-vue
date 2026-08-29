<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Stock;
use App\Models\Company;

class ProductController extends Controller
{
    public function index()
	{
        $user_type = Auth::user()->account_type;
        $result = Product::join('categories','cat_id','=','categories.id')
            ->select('products.*','categories.name as cat_name')
            ->paginate(300);
        return view('product.viewProducts')->with(['product'=>$result]);
	}

    public function exportProducts()
    {
        $result = Product::join('categories','cat_id','=','categories.id')
            ->select('products.*','categories.name as cat_name')
            ->get();
        $result2 = Company::all();
        return view('product.exportProduct')->with(['product'=>$result,'company'=>$result2]);
    }

    public function inventoryCheck()
    {
        return view('product.inventoryCheck');
    }


    public function checkCode($code)
    {
        $result = Product::where('barcode',$code)->count();
        if($result>0){
            echo "Short Code Already Assigned";
        }
        else {
            echo 0;
        }
    }

    public function fillCategory()
    {
        $result='';
        $count = Category::count();
        if ($count>0) {
            $data = Category::where('status',1)->get();
            foreach ($data as $value) {
                $result .= '<option value="'.$value->id.'">'.$value->name.'</option>';
            }
        }
        else {
            $result = '<option value="0">No Category</option>';
        }
        return view('product.addProducts')->with('category', $result);
    }

    

    public function store(Request $request)
    {
    	$post = new Product;
    	$post->name = $request->pname;
    	$post->barcode = $request->barcode;
    	$post->cat_id = $request->cat_id;
    	$post->purchase = $request->pp;
    	$post->whole_sale = $request->ws;
    	$post->retail = $request->rp;
    	$post->min_qty = $request->mq;
    	$post->status = 1;
        $post->user_id = Auth::id();

    	$post->save();
    	return redirect('addProduct')->with('success','Product inserted Successfully');

    }

    
    public function edit($id)
    {
        $cat='';
    	$result = Product::find([$id,0]);
        $data = Category::all();
        foreach ($data as $value) {
            if ($result[0]->cat_id == $value->id) {
                $cat .= '<option value="'.$value->id.'" selected>'.$value->name.'</option>';
            } else {
                $cat .= '<option value="'.$value->id.'">'.$value->name.'</option>';
            }
            
        }
    	return view('product.editProducts')->with(['product'=>$result,'cat'=>$cat]);
    }

    
    public function update(Request $request)
    {
    	$id = $request->id;
    	$post = Product::find($id);
    	$post->name = $request->pname;
    	$post->barcode = $request->barcode;
    	$post->cat_id = $request->cat_id;
    	$post->purchase = $request->pp;
    	$post->whole_sale = $request->ws;
    	$post->retail = $request->rp;
    	$post->min_qty = $request->mq;
    	$post->status = 1;
        $post->user_id = Auth::id();

    	$post->save();
    	return $this->index();
    }

  
    public function delete($id)
    {
    	$result = Product::destroy($id);
    	return $this->index();
    }

    public function status($status,$id)
    {
        $post = Product::find($id);
        if ($status == 1) {
           $post->status = 0; 
        } else {
            $post->status = 1;
        }
        $post->user_id = Auth::id();
        $post->save();
        return $this->index("50");
    }

    /* Stock opening start */
    public function viewStock()
    {
        return view('product.viewStockOpening');
    }
    public function searchStock(Request $request)
    {
        $barcode = $request->barcode;
        $name = $request->pname;
        if (empty($barcode) && empty($name)) {
            $result = Product::all();
            $data = "";
            $count = 0;
            foreach ($result as $value) {
                $count++;
                $data .= '<tr>
                    <td>'.$count.'</td>'.'
                    <td>'.$value->barcode.'</td>'.'
                    <td>'.$value->name.'</td>'.'
                    <td><input type="number" name="qty[]" class="form-control col-md-6" placeholder="Enter Qty" value="'.$value->qty.'" autocomplete="false" autofocus="true"><input type="hidden" name="id[]" class="form-control col-md-6" value="'.$value->id.'"></td>'.'
                </tr>';

            }

        } else {
            $result = Product::where([
                ['barcode',$barcode],
                ['name',$name]
            ])
            ->orWhere('barcode',$barcode)
            ->orWhere('name',$name)->get();
            $data = "";
            $count = 0;
            foreach ($result as $value) {
                $count++;
                $data .= '<tr>
                    <td>'.$count.'</td>'.'
                    <td>'.$value->barcode.'</td>'.'
                    <td>'.$value->name.'</td>'.'
                    <td><input type="number" name="qty[]" class="form-control col-md-6" placeholder="Enter Qty" value="'.$value->qty.'" autocomplete="false" autofocus="true"><input type="hidden" name="id[]" class="form-control col-md-6" value="'.$value->id.'"></td>'.'
                </tr>';

            }
        }
        echo $data;
    }
    public function updateStock(Request $request)
    {
        $id = $request->id;
        $qty = $request->qty;
        $uid = Auth::id();

        for ($i=0; $i<count($id) ; $i++) {
            if (!empty($qty[$i])) {
                $result = Product::whereId($id[$i])->update(['qty'=>$qty[$i],'user_id'=>$uid]);
             }  
        }
        return "Stock Updated Successfully";
    }
    /* Stock opening end */

    /* Bulk price start */
    public function viewBulk()
    {
        $data="";
        $result = Product::where('status',1)->get();
        return view('product.viewBulkPrice')->with('product',$result);
    }
    public function searchBulk(Request $request)
    {
        $barcode = $request->plist;
        if (empty($barcode) && empty($name)) {
            $result = Product::where('status',1)->get();
        } else {
            $result = Product::where([
                ['id',$barcode],
                ['status',1],
            ])->get();
            
        }
        $data = "";
        $count = 0;
        foreach ($result as $value) {
            $count++;
            $data .= '<tr>
                <td>'.$count.'</td>'.'
                <td>'.$value->barcode.'</td>'.'
                <td>'.$value->name.'</td>'.'
                <td><input type="number" name="purchase[]" class="form-control col-md-10" placeholder="Enter Purchase Price" value="'.$value->purchase.'" autocomplete="false" autofocus="true" ></td>'.'
                <td><input type="number" name="whole_sale[]" class="form-control col-md-10" placeholder="Enter Whole Sale" value="'.$value->whole_sale.'" autocomplete="false" autofocus="true" ></td>'.'
                <td><input type="number" name="retail[]" class="form-control col-md-10" placeholder="Enter Retail Price" value="'.$value->retail.'" autocomplete="false" autofocus="true" ><input type="hidden" name="id[]" class="form-control col-md-6" value="'.$value->id.'"></td>'.'
            </tr>';

        }
        echo $data;
    }

    public function searchBulkByFilter($filter)
    {
        $id = $filter;
        if ($id == 'product') {
           $result = Product::where([
                ['cat_id','!=',8],
                ['status','=',1]
            ])->get(); 
        }
        elseif($id == 'stock') {
           $result = Product::where(['cat_id'=>8,'status'=>1])->get();
        }
        $data = "";
        $count = 0;
        foreach ($result as $value) {
            $count++;
            $data .= '<tr>
                <td>'.$count.'</td>'.'
                <td>'.$value->barcode.'</td>'.'
                <td>'.$value->name.'</td>'.'
                <td><input type="number" name="purchase[]" class="form-control col-md-10" placeholder="Enter Purchase Price" value="'.$value->purchase.'" autocomplete="false" autofocus="true" ></td>'.'
                <td><input type="number" name="whole_sale[]" class="form-control col-md-10" placeholder="Enter Whole Sale" value="'.$value->whole_sale.'" autocomplete="false" autofocus="true" ></td>'.'
                <td><input type="number" name="retail[]" class="form-control col-md-10" placeholder="Enter Retail Price" value="'.$value->retail.'" autocomplete="false" autofocus="true" ><input type="hidden" name="id[]" class="form-control col-md-6" value="'.$value->id.'"></td>'.'
            </tr>';

        }
        echo $data;
    }
    public function updateBulk(Request $request)
    {
        $id = $request->id;
        $purchase = $request->purchase;
        $whole_sale = $request->whole_sale;
        $retail = $request->retail;
        $uid = Auth::id();

        for ($i=0; $i<count($id) ; $i++) { 
            if (!empty($purchase[$i]) || !empty($whole_sale[$i]) || !empty($retail[$i])) {
                $result = Product::whereId($id[$i])->update(['purchase'=>$purchase[$i],'whole_sale'=>$whole_sale[$i],'retail'=>$retail[$i],'user_id'=>$uid]);
            }
        }
        return "Price Updated Successfully";
    }
    /* Bulk price end */

    /* Re-order start */
    public function viewReorder()
    {
        $result = Product::whereRaw('qty < min_qty')->paginate(5);
        return view('product.viewReorder')->with('product', $result);
    }
    /* Re-order end */

    /* Countsheet start */
    public function countsheet()
    {
        $data="";
        $result = Product::where('status',1)->get();
        return view('product.countsheet')->with('product',$result);
    }
    public function searchProduct($value)
    {
        $result = Product::where('name','LIKE','%'.$value.'%')->get();
        $data = "";
        foreach ($result as $value) {
            $data .= '<option value='.$value->id.'>'.$value->name.'</option>';
        }
        echo $data;
    }
    public function searchProductFor(Request $request)
    {
        $id = $request->plist;
        if (empty($id)) {
           $result = Product::where('status',1)->get(); 
        }
        else {
           $result = Product::where(['id'=>$id,'status'=>1])->get();
        }
        $data = "";
        $count = 0;
        foreach ($result as $value) {
            $count++;
            $data .= '<tr>
                <td>'.$count.'</td>'.'
                <td>'.$value->barcode.'</td>'.'
                <td>'.$value->name.'</td>'.'
                <td>'.$value->purchase.'</td>'.'
                <td><input type="number" name="qty[]" class="form-control col-md-10" placeholder="Enter Quantity" value="'.$value->qty.'" autocomplete="false" autofocus="true" step="0.01" style="font-weight:bold;font-size:15px;"><input type="hidden" name="id[]" class="form-control col-md-6" value="'.$value->id.'"></td>'.'
            </tr>';
        }
        echo $data;
    }

    public function searchProductByFilter($filter)
    {
        $id = $filter;
        if ($id == 'product') {
           $result = Product::where([
                ['cat_id','!=',8],
                ['status','=',1]
            ])->get(); 
        }
        elseif($id == 'stock') {
           $result = Product::where(['cat_id'=>8,'status'=>1])->get();
        }
        $data = "";
        $count = 0;
        foreach ($result as $value) {
            $count++;
            $data .= '<tr>
                <td>'.$count.'</td>'.'
                <td>'.$value->barcode.'</td>'.'
                <td>'.$value->name.'</td>'.'
                <td>'.$value->purchase.'</td>'.'
                <td><input type="number" name="qty[]" class="form-control col-md-10" placeholder="Enter Quantity" value="'.$value->qty.'" autocomplete="false" autofocus="true" step="0.01" style="font-weight:bold;font-size:15px;"><input type="hidden" name="id[]" class="form-control col-md-6" value="'.$value->id.'"></td>'.'
            </tr>';
        }
        echo $data;
    }
    public function updateProductQty(Request $request)
    {
        $id = $request->id;
        $qty = $request->qty;
        $uid = Auth::id();
        $day = date('y-m-d');
        for ($i=0; $i<count($id); $i++) { 
            if (!empty($qty[$i])) {
                Product::where('id',$id[$i])->update(['qty'=>$qty[$i],'user_id'=>$uid]);
                Stock::insert(['day'=>$day,'barcode'=>$id[$i],'qty'=>$qty[$i],'user_id'=>$uid]);
            }
        }
        return "Qty Updated Successfully";
    }
    /* Countsheet end */

    /* Stock Form start */
    public function viewStockForm()
    {
        $result = Product::join('categories','cat_id','=','categories.id')
            ->select('products.*','categories.name as cat_name')
            ->paginate(10);
        return view('product.viewStockForm')->with('product', $result);
    }
    /* Stock Form end */
}
