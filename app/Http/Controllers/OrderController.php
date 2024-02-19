<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function search(Request $request)
{
    $search = $request->search;
    $orders = Order::where(function ($query) use ($search) {
        $query->where('vehicle', 'like', "%$search%")
            ->orWhere('deliveryStatus', 'like', "%$search%");
    })->paginate(5);

    return view('orders.index', compact('orders', 'search'));
}


    public function index()
    {

        $orders = Order::join('users', 'orders.user_id', '=', 'users.id')
        ->select('orders.*', 'users.name')
        ->get();


        $orders = Order::with('products')->get();
        $orders = Order::with(['products', 'user'])->paginate(5);
/*
       $user = auth()->user();
        $user_name = auth()->user()->name;
        $orders = auth()->user()->name;
*/
        $products =Product::all();
        $users =User::all();

return view('orders.index', compact('orders','products'));
    }

    public function create()
{
    $categories = Category::all();
    $products = Product::with('categories')->get();
    $products2 = Product::all();

    return view('orders.create', compact('products', 'products2', 'categories'));
}


    public function store(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_quantities' => 'required|array',
            'product_quantities.*' => 'numeric|min:1',
        ]);

        $userId = auth()->user()->id;

        $order = new Order([
            'deliveryStatus' => $request->deliveryStatus,
            'vehicle' => $request->vehicle,
            'customer_id' => $request->customer_id,
            'user_id' => $userId,
        ]);

        ///////////////image//////////////////




if ($request->hasFile('file')) {
    $imagePath = $request->file('file')->store('uploads', 'img1');
    $order->file = $imagePath;
}

if ($request->hasFile('fil')) {
    $videoPath = $request->file('fil')->store('uploads', 'video');
    $order->fil = $videoPath;
}

///////////////// end image ///////////////////////

        $order->save();

        $productIds = $request->input('product_ids');
        $productQuantities = $request->input('product_quantities');

        foreach ($productIds as $index => $productId) {
            $product = Product::find($productId);
            $quantity = $productQuantities[$index];


            $order->products()->attach($product, ['quantity' => $quantity]);


            $product->quantity -= $quantity;
            $product->save();

        }


        return redirect()->route('orders.index');
    }

    public function show(Order $order)
    {
       return view('orders.index', compact('order'));
    }


    public function edit(Order $order)
{
    $products = Product::all();
    return view('orders.edit', compact('order', 'products'));
}


    public function update(Request $request, Order $order)
    {
        $request->validate([

        ]);

        $order->deliveryStatus = $request->deliveryStatus;
        $order->vehicle = $request->vehicle;
        $order->customer_id = $request->customer_id;
        $order->user_id = $request->user_id;

        $productIds = $request->input('product_ids');
        $productQuantities = $request->input('product_quantities');

        $order->products()->detach();

        foreach ($productIds as $index => $productId) {
            $product = Product::find($productId);
            $quantity = $productQuantities[$index];

            if ($product && $quantity > 0) {
                if ($product->quantity >= $quantity) {
                    $order->products()->attach($product, ['quantity' => $quantity]);
                    $product->quantity -= $quantity;
                    $product->save();
                } else {

                }
            }
        }

              ///////////////image//////////////////




if ($request->hasFile('file')) {
    $imagePath = $request->file('file')->store('uploads', 'img1');
    $order->file = $imagePath;
}

if ($request->hasFile('fil')) {
    $videoPath = $request->file('fil')->store('uploads', 'video');
    $order->fil = $videoPath;
}

///////////////// end image ///////////////////////

        $order->save();

        return redirect()->route('orders.index');
    }


    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index');
    }



}
