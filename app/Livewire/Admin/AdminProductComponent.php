<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductComponent extends Component
{
    use WithPagination;
    public $product_id;

    public function deleteId($id)
    {
        $this->product_id = $id;
    }
    public function deleteProduct()
    {
        Product::find($this->product_id)->unlink('assets/imgs/products/')->delete();

        session()->flash('message', 'Product has been successfully deleted!');
    }

    public function render()
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.admin.admin-product-component', ['products' => $products]);
    }
}
