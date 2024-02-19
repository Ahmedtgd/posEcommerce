<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */



    public function index()
    {
        $products = DB::table('products')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.*', 'categories.category_name')
        ->paginate(5);

    $categories = Category::all();

    return view('products.index', compact('products', 'categories'));


    }
    public function search(Request $request)
    {
        $search = $request->search;
        $products= Product::where(function ($query) use ($search) {
            $query->where('name', 'like', "%$search%")
                 ->orWhere('description', 'like', "%$search%");
        })->paginate(5);

        return view('products.index', compact('products', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories =Category::all();
        return view('products.create',compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $product = new Product;
        $product->quantity = $request->quantity;

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id= $request->category_id;
///////////////image//////////////////




if ($request->hasFile('file')) {
    $imagePath = $request->file('file')->store('uploads', 'img1');
    $product->file = $imagePath;
}

if ($request->hasFile('fil')) {
    $videoPath = $request->file('fil')->store('uploads', 'video');
    $product->fil = $videoPath;
}

///////////////// end image ///////////////////////


        $product->save();

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.index', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

        $categories = Category::all();
        $product->quantity = $request->quantity;

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        ///////////////image//////////////////

if ($request->hasFile('file')) {
    $imagePath = $request->file('file')->store('uploads', 'img1');
    $product->file = $imagePath;
}

if ($request->hasFile('fil')) {
    $videoPath = $request->file('fil')->store('uploads', 'video');
    $product->fil = $videoPath;
}

///////////////// end image ///////////////////////
        $product->save();

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
    return redirect()->route('products.index');
    }



    public function getProductsByCategory($categoryId)
    {
        $products = Product::where('category_id', $categoryId)->get();
        return response()->json($products);
    }
}
