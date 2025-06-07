<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the menu items.
     */
    public function index()
    {
        $menuItems = MenuItem::with('category')
            ->orderBy('name')
            ->paginate(10);

        return view('menu_items.index', compact('menuItems'));
    }

    // app/Models/MenuItem.php



    /**
     * Show the form for creating a new menu item.
     */
    public function create()
    {
        $categories = Category::orderBy('order')->get();
        return view('menu_items.create', compact('categories'));
    }

    /**
     * Store a newly created menu item in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'name'         => 'required|string|max:255',
            'description'  => 'nullable|string',
            'price'        => 'required|numeric|min:0',
            'is_available' => 'sometimes|boolean',
            'image'        => 'nullable|image|max:5120', // allow up to 5 MB
        ]);

        if ($request->hasFile('image')) {
            // store() will generate a unique filename with correct extension
            $data['image'] = $request->file('image')
                ->store('menu_images', 'public');
        }

        MenuItem::create($data);

        return redirect()->route('menu-items.index')
            ->with('success', 'Menu item created successfully.');
    }

    /**
     * Show the form for editing the specified menu item.
     */
    public function edit(MenuItem $menuItem)
    {
        $categories = Category::orderBy('order')->get();
        return view('menu_items.edit', compact('menuItem', 'categories'));
    }

    /**
     * Update the specified menu item in storage.
     */
    public function update(Request $request, MenuItem $menuItem)
    {
        $data = $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'name'         => 'required|string|max:255',
            'description'  => 'nullable|string',
            'price'        => 'required|numeric|min:0',
            'is_available' => 'sometimes|boolean',
            'image'        => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('image')) {
            // delete old image if it exists
            if ($menuItem->image) {
                Storage::disk('public')->delete($menuItem->image);
            }
            // store new upload
            $data['image'] = $request->file('image')
                ->store('menu_images', 'public');
        }

        $menuItem->update($data);

        return redirect()->route('menu-items.index')
            ->with('success', 'Menu item updated successfully.');
    }

    /**
     * Remove the specified menu item from storage.
     */
    public function destroy(MenuItem $menuItem)
    {
        if ($menuItem->image) {
            Storage::disk('public')->delete($menuItem->image);
        }
        $menuItem->delete();

        return redirect()->route('menu-items.index')
            ->with('success', 'Menu item deleted successfully.');
    }
}
