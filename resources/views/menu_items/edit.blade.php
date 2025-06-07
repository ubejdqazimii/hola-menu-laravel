{{-- resources/views/menu_items/edit.blade.php --}}
<x-app-layout>
    <div class="flex justify-center items-center min-h-[calc(100vh-100px)] px-4 py-10 bg-gray-50 dark:bg-gray-900">
        <div class="w-full max-w-3xl bg-white dark:bg-gray-800 shadow-xl rounded-xl p-8 space-y-6">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white text-center">✏️ Edit Menu Item</h1>

            <form
                action="{{ route('menu-items.update', $menuItem) }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-6"
            >
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 dark:bg-red-900 border-l-4 border-red-500 text-red-700 dark:text-red-300 rounded">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-lg font-medium text-gray-700 dark:text-gray-200 mb-2">
                        Category
                    </label>
                    <select
                        id="category_id"
                        name="category_id"
                        required
                        class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-800 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        @foreach($categories as $cat)
                            <option
                                value="{{ $cat->id }}"
                                {{ old('category_id', $menuItem->category_id) == $cat->id ? 'selected' : '' }}
                            >
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Name -->
                <div>
                    <label for="name" class="block text-lg font-medium text-gray-700 dark:text-gray-200 mb-2">
                        Name
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        required
                        value="{{ old('name', $menuItem->name) }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-lg font-medium text-gray-700 dark:text-gray-200 mb-2">
                        Description
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        rows="3"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >{{ old('description', $menuItem->description) }}</textarea>
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-lg font-medium text-gray-700 dark:text-gray-200 mb-2">
                        Price
                    </label>
                    <input
                        type="number"
                        step="0.01"
                        id="price"
                        name="price"
                        required
                        value="{{ old('price', $menuItem->price) }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <!-- Image -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                        Image (optional)
                    </label>
                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/*"
                        class="block w-full text-sm text-gray-900 dark:text-gray-100 file:mr-4 file:py-2 file:px-4 file:rounded-lg
                   file:border-0 file:text-sm file:font-semibold file:bg-blue-50 dark:file:bg-blue-900
                   file:text-blue-700 dark:file:text-blue-300 hover:file:bg-blue-100 dark:hover:file:bg-blue-800"
                    >
                    @error('image')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Availability -->
                <div class="flex items-center space-x-3">
                    <input type="hidden" name="is_available" value="0">
                    <input
                        type="checkbox"
                        id="is_available"
                        name="is_available"
                        value="1"
                        {{ old('is_available', $menuItem->is_available) ? 'checked' : '' }}
                        class="h-5 w-5 text-green-600 rounded focus:ring-green-500 border-gray-300 dark:border-gray-600"
                    />
                    <label for="is_available" class="text-gray-700 dark:text-gray-200">Available</label>
                </div>

                <!-- Actions -->
                <div class="flex justify-center space-x-4 pt-4">
                    <button
                        type="submit"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition"
                    >
                        Update Item
                    </button>
                    <a
                        href="{{ route('menu-items.index') }}"
                        class="px-6 py-3 bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-lg transition"
                    >
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
