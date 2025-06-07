<x-app-layout>
    <div class="bg-gray-50 dark:bg-gray-900 min-h-screen">
        <main class="max-w-7xl mx-auto px-6 py-8 space-y-6">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">🍽️ Menu Items</h1>
                <a href="{{ route('menu-items.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition">
                    + New Item
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 p-4 rounded-lg">
                    <p class="text-sm text-green-800 dark:text-green-200">{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Price</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Available</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                    @forelse($menuItems as $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-white">{{ $item->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-white">{{ $item->category->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-white">${{ number_format($item->price,2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($item->is_available)
                                    <span class="px-2 inline-flex text-xs font-medium rounded-full bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">Yes</span>
                                @else
                                    <span class="px-2 inline-flex text-xs font-medium rounded-full bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200">No</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                <a href="{{ route('menu-items.edit', $item) }}" class="text-yellow-500 hover:text-yellow-700">✏️ Edit</a>
                                <form action="{{ route('menu-items.destroy', $item) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete(this)" class="text-red-600 hover:text-red-800">🗑️ Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                No menu items found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
                    {{ $menuItems->links() }}
                </div>
            </div>
        </main>
    </div>

    <script>
        function confirmDelete(btn) {
            if (confirm('Delete this menu item?')) {
                btn.closest('form').submit();
            }
        }
    </script>
</x-app-layout>
