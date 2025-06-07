<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class PublicMenuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        if ($search) {
            // Search menu items
            $items = MenuItem::where('is_available', true)
                ->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                })
                ->orderBy('name')
                ->paginate(9)
                ->withQueryString();

            return view('menu.index', compact('items', 'search'));
        }

        // Only categories that have at least one available item
        $categories = Category::whereHas('menuItems', function($q) {
            $q->where('is_available', true);
        })
            ->orderBy('order')
            ->paginate(9)
            ->withQueryString();

        return view('menu.index', compact('categories'));
    }


    public function show(Category $category)
    {
        $items = $category->menuItems()
            ->orderBy('name')
            ->paginate(9);

        return view('menu.show', compact('category', 'items'));
    }
}
