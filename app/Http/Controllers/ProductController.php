<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = [
            [
                'id' => 1,
                'name' => 'Kopi 1',
                'image' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'id' => 2,
                'name' => 'Kopi 2',
                'image' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'id' => 3,
                'name' => 'Kopi 3',
                'image' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'id' => 4,
                'name' => 'Kopi 4',
                'image' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'id' => 5,
                'name' => 'Kopi 5',
                'image' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'id' => 6,
                'name' => 'Kopi 6',
                'image' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'id' => 7,
                'name' => 'Kopi 7',
                'image' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'id' => 8,
                'name' => 'Kopi 8',
                'image' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=800&q=80',
            ],
        ];

        return view('landing', compact('products'));
    }
}