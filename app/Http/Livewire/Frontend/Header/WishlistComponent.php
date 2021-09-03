<?php

namespace App\Http\Livewire\Frontend\Header;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class WishlistComponent extends Component
{
    public $wishlistCount;

    protected $listeners = [
        'update_wishlist' => 'wishlistCount',
        'remove_from_wishlist' => 'removeFromWishlist',
        'move_to_cart' => 'moveToCart'
    ];

    public function mount()
    {
        $this->wishlistCount();
    }

    public function wishlistCount()
    {
        $this->wishlistCount = Cart::instance('wishlist')->count();
    }

    public function moveToCart($rowId)
    {
        $item = Cart::instance('wishlist')->get($rowId);

        $duplicate = Cart::instance('default')->search(function ($cartItem, $rId) use ($rowId) {
            return $rId === $rowId;
        });

        if ($duplicate->isNotEmpty()) {
            $this->removeFromWishlist($rowId);
            $this->alert('warning', 'Product already exist.');
        } else {
            Cart::instance('default')->add($item->id, $item->name, 1, $item->price)
                ->associate(Product::class);
            $this->removeFromWishlist($rowId);
            $this->alert('success', 'Product add in your cart.');
        }
        $this->emit('update_cart');
    }

    public function removeFromWishlist($rowId)
    {
        Cart::instance('wishlist')->remove($rowId);
        $this->emit('update_wishlist');

        if (Cart::instance('wishlist')->count() == 0) {
            return redirect()->route('wishlist.index');
        }
    }

    public function render()
    {
        return view('livewire.frontend.header.wishlist-component');
    }
}