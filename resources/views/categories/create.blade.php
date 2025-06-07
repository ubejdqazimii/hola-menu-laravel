<x-app-layout>
    <div class="flex justify-center items-center min-h-[calc(100vh-100px)] px-4 py-10 bg-gray-100 dark:bg-gray-900">
        <div class="w-full max-w-2xl bg-white dark:bg-gray-800 shadow-xl rounded-xl p-8 space-y-6">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white text-center">📝 Create a New Category</h1>

            <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Category Name -->
                <div>
                    <label for="name" class="block text-lg font-medium text-gray-700 dark:text-gray-200 mb-2">
                        Category Name
                    </label>
                    <input type="text" name="name" id="name"
                           class="w-full px-5 py-3 text-base rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="e.g. Drinks, Desserts" required>
                </div>

                <!-- Display Order -->
                <div>
                    <label for="order" class="block text-lg font-medium text-gray-700 dark:text-gray-200 mb-2">
                        Display Order <span class="text-sm text-gray-400">(optional)</span>
                    </label>
                    <input type="number" name="order" id="order"
                           class="w-full px-5 py-3 text-base rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="e.g. 1, 2, 3">
                </div>

                <!-- Actions -->
                <div class="flex justify-center gap-4">
                    <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white text-base font-semibold rounded-md transition">
                        ✅ Create Category
                    </button>

                    <a href="{{ route('categories.index') }}"
                       class="inline-flex items-center px-6 py-3 bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-800 dark:text-white text-base font-semibold rounded-md transition">
                        ❌ Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
