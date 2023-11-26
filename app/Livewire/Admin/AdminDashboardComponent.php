<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class AdminDashboardComponent extends Component
{

    public function render()
    {
        // Retrieve data for the statistical chart
        $mostVisitedProducts = Product::orderBy('visits_count', 'desc')
            ->take(5)
            ->get();

        // Pass the variable to the view
        return view('livewire.admin.admin-dashboard-component', [
            'mostVisitedProducts' => $mostVisitedProducts,
        ]);
    }
}
