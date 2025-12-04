<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Validation\ValidationException;

class CartService
{
    protected $auth;
    protected ?Cart $cart = null;

    public function __construct(AuthFactory $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Obtiene el carrito actual del usuario autenticado.
     */
    public function currentCart(bool $create = true): ?Cart
    {
        if ($this->cart) {
            return $this->cart;
        }

        $user = $this->auth->user();

        if (! $user) {
            return null;
        }

        $this->cart = Cart::firstOrCreate(
            ['user_id' => $user->id],
            ['uuid' => (string) Str::uuid()]
        );

        return $this->cart;
    }

    /**
     * Agrega un producto al carrito.
     */
    public function add(int $productId, int $quantity = 1): CartItem
    {
        $product = Product::findOrFail($productId);

        $cart = $this->currentCart(true);
        if (! $cart) {
            throw new \Exception('Debes estar autenticado para gestionar el carrito.');
        }

        $existingItem = $cart->items()->where('product_id', $product->id)->first();
        $existingQty = $existingItem ? $existingItem->quantity : 0;
        $newQty = $existingQty + $quantity;

        $stock = $product->stock ?? 0;
        if ($newQty > $stock) {
            throw ValidationException::withMessages([
                'quantity' => ["La cantidad solicitada ({$newQty}) excede el stock disponible ({$stock})."]
            ]);
        }

        if ($existingItem) {
            $existingItem->update(['quantity' => $newQty]);
            return $existingItem;
        }

        return $cart->items()->create([
            'product_id' => $product->id,
            'quantity'   => $quantity,
            'price'      => $product->price ?? 0,
        ]);
    }

    /**
     * Elimina un producto del carrito.
     */
    public function remove(int $productId): bool
    {
        $cart = $this->currentCart(false);
        if (! $cart) {
            return false;
        }

        $item = $cart->items()->where('product_id', $productId)->first();
        return $item ? (bool) $item->delete() : false;
    }

    /**
     * Devuelve todos los items del carrito con sus productos.
     */
    public function items()
    {
        $cart = $this->currentCart(false);
        return $cart ? $cart->items()->with('product')->get() : collect();
    }

    /**
     * Calcula el total del carrito.
     */
    public function total(): float
    {
        return $this->items()->reduce(function ($carry, CartItem $item) {
            $price = $item->price ?? ($item->product->price ?? 0);
            return $carry + ($price * $item->quantity);
        }, 0.0);
    }

    /**
     * Vacía el carrito.
     */
    public function clear(): void
    {
        $cart = $this->currentCart(false);
        if ($cart) {
            $cart->items()->delete();
        }
    }
}
