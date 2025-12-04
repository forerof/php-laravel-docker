<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->middleware('auth');
        $this->cartService = $cartService;
    }

    public function index()
    {
        $items = $this->cartService->items();
        $total = $this->cartService->total();

        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'sometimes|integer|min:1'
        ]);

        $quantity = $data['quantity'] ?? 1;

        try {
            $item = $this->cartService->add($data['product_id'], $quantity);
            return redirect()->back()->with('success', 'Producto añadido al carrito.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function remove(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $this->cartService->remove($data['product_id']);

        return redirect()->back()->with('success', 'Producto removido del carrito.');
    }

    public function clear()
    {
        $this->cartService->clear();
        return redirect()->back()->with('success', 'Carrito vaciado.');
    }
}
