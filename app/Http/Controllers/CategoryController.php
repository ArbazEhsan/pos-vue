<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index($num)
	{
		$result = Category::paginate($num);
		return view('category.category')->with('category', $result);
	}

	public function store(Request $request)
    {
    	$post = new Category;
    	$post->name = $request->cat_name;
    	$post->status = 1;
        $post->user_id = Auth::id();

    	$post->save();
    	return redirect('category');

    }
    public function edit($id)
    {
    	$result = Category::find([$id,0]);
    	return view('category.editCategory')->with('category',$result);
    }
    public function update(Request $request)
    {
    	$id = $request->id;
    	$post = Category::find($id);
    	$post->name = $request->cat_name;
    	$post->status = 1;
        $post->user_id = Auth::id();

    	$post->save();
    	return redirect('category/10')->with('success','Category updated Successfully');
    }
    public function delete($id)
    {
    	$result = Category::destroy($id);
    	return redirect('category/10');
    }
    public function status($status,$id)
    {
        $post = Category::find($id);
        $uid = Auth::id();

        if ($status == 1) {
           $post->status = 0;
           Product::where('cat_id',$id)->update(['status'=>0,'user_id'=>$uid]);
        } else {
            $post->status = 1;
            Product::where('cat_id',$id)->update(['status'=>1,'user_id'=>$uid]);
        }
        $post->user_id = $uid;
        $post->save();
        return redirect('category/10');
    }
}
