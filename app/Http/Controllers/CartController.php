<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Services\CheckoutService;
use App\Http\Requests\AddToCartRequest;




class CartController extends Controller
{
    public function add(AddToCartRequest $request)
    {
        // $user = auth()->user(); // for now assume logged in

        $user = \App\Models\User::first();

        $product = Product::findOrFail($request->product_id);

        // check stock
        if ($request->quantity > $product->stock) {
            return response()->json(['error' => 'Not enough stock']);
        }

        // get or create cart
        $cart = Cart::firstOrCreate([
            'user_id' => $user->id
        ]);

        // check if product already in cart
        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            $item->quantity += $request->quantity;
            $item->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect('/')->with('success', 'Product added to cart');
    }

    public function view()
    {
        // $user = auth()->user(); // for now assume logged in

        $user = \App\Models\User::first();

        $cart = $user->cart()->with('items.product.vendor')->first();

        if (!$cart) {
            return response()->json(['message' => 'Cart is empty']);
        }

        // group by vendor
        $grouped = $cart->items->groupBy(function ($item) {
            return $item->product->vendor->name;
        });

        return response()->json($grouped);
    }

    public function checkout(CheckoutService $checkoutService)
    {
        $user = \App\Models\User::first();

        $cart = $user->cart()->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect('/cart-ui')->with('error', 'Cart is empty');
        }

        $checkoutService->process($cart, $user);

        return redirect('/cart-ui')->with('success', 'Checkout successful');
    }

    public function orders()
    {
        $orders = \App\Models\Order::with(['items.product', 'vendor', 'user'])->get();

        return response()->json($orders);
    }

    public function home()
    {
        $products = \App\Models\Product::with('vendor')->get();

        return view('home', compact('products'));
    }

    public function cartUI()
    {
        $user = \App\Models\User::first();

        $cart = $user->cart()->with('items.product.vendor')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return view('cart', ['grouped' => []]);
        }

        $grouped = $cart->items->groupBy(function ($item) {
            return $item->product->vendor->name;
        });

        return view('cart', compact('grouped'));
    }

    public function adminUI(Request $request)
    {
        $query = \App\Models\Order::with(['items.product', 'vendor', 'user']);

        if ($request->vendor_id) {
            $query->where('vendor_id', $request->vendor_id);
        }

        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $orders = $query->get();

        return view('admin-orders', compact('orders'));
    }

    public function vendors()
    {
        $vendors = \App\Models\Vendor::all();
        return view('vendors', compact('vendors'));
    }

    public function addVendor(Request $request)
    {
        \App\Models\Vendor::create([
            'name' => $request->name
        ]);

        return redirect('/admin/vendors');
    }

    public function deleteVendor($id)
    {
        \App\Models\Vendor::find($id)->delete();
        return redirect('/admin/vendors');
    }

    public function products()
    {
        $products = \App\Models\Product::with('vendor')->get();
        $vendors = \App\Models\Vendor::all();

        return view('products', compact('products', 'vendors'));
    }

    public function addProduct(Request $request)
    {
        \App\Models\Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'vendor_id' => $request->vendor_id
        ]);

        return redirect('/admin/products');
    }

    public function deleteProduct($id)
    {
        \App\Models\Product::find($id)->delete();
        return redirect('/admin/products');
    }
    
}
