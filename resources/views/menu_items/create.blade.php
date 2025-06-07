<x-app-layout>
    <div class="flex justify-center items-center min-h-[calc(100vh-100px)] px-4 py-10 bg-gray-50 dark:bg-gray-900">
        <div class="w-full max-w-3xl bg-white dark:bg-gray-800 shadow-xl rounded-xl p-8 space-y-6">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white text-center">➕ Add Menu Item</h1>

            <form action="{{ route('menu-items.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 dark:bg-red-900 border-l-4 border-red-500 text-red-700 dark:text-red-300 rounded">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div>
                    <label for="category_id" class="block text-lg font-medium text-gray-700 dark:text-gray-200 mb-2">Category</label>
                    <select name="category_id" id="category_id" required
                            class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-800 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Select category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="name" class="block text-lg font-medium text-gray-700 dark:text-gray-200 mb-2">Name</label>
                    <input type="text" name="name" id="name" required
                           value="{{ old('name') }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Item name">
                </div>

                <div>
                    <label for="description" class="block text-lg font-medium text-gray-700 dark:text-gray-200 mb-2">Description</label>
                    <textarea name="description" id="description" rows="3"
                              class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Optional description">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label for="price" class="block text-lg font-medium text-gray-700 dark:text-gray-200 mb-2">Price ($)</label>
                    <input type="number" name="price" id="price" step="0.01" required
                           value="{{ old('price') }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="0.00">
                </div>

                <div>
                    <label for="image">Image (optional)</label>
                    <input
                        type="file"
                        name="image"
                        id="image"
                        accept="image/*"
                    >
                    @error('image')
                    <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center space-x-3">
                    <input type="hidden" name="is_available" value="0">

                    <input
                        type="checkbox"
                        id="is_available"
                        name="is_available"
                        value="1"
                        {{ old('is_available', ($menuItem->is_available ?? true)) ? 'checked' : '' }}
                        class="h-5 w-5 text-green-600 rounded focus:ring-green-500 border-gray-300 dark:border-gray-600"
                    />

                    <label for="is_available" class="text-gray-700 dark:text-gray-200">
                        Available
                    </label>
                </div>

                <div class="flex justify-center space-x-4 pt-4">
                    <button type="submit"
                            class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition">Create Item</button>
                    <a href="{{ route('menu-items.index') }}"
                       class="px-6 py-3 bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-lg transition">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
