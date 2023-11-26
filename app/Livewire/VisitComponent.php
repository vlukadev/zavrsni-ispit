<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Visit;

class VisitComponent extends Component
{
    public $productId; // Assuming you'll pass the product id to this component
    public int $count;

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->recordVisit();
        $this->count = Visit::where('product_id', $this->productId)->count();
    }

    public function render()
    {
        return view('livewire.visit-component');
    }

    private function recordVisit()
    {
        Visit::create([
            'product_id' => $this->productId,
        ]);
    }
}
