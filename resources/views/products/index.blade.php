<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="w-full py-6">
            <div class="bg-white shadow rounded-lg p-6">
                <a href="{{ route('products.create') }}" class="inline-block mb-4 px-4 py-2 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700 transition">
                    ADD PRODUCT
                </a>

                @if ($products->isEmpty())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    Data Products belum ada.
                </div>
                @else
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                        <thead class="bg-gray-100 text-gray-700 text-left text-sm uppercase font-semibold">
                            <tr>
                                <th class="p-3">IMAGE</th>
                                <th class="p-3">TITLE</th>
                                <th class="p-3">PRICE</th>
                                <th class="p-3">STOCK</th>
                                <th class="p-3 w-1/5">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-200">
                            @foreach ($products as $product)
                            <tr>
                                <td class="p-3 text-center">
                                    <img src="{{ asset('/storage/products/'.$product->image) }}" class="rounded w-[150px] mx-auto">
                                </td>
                                <td class="p-3">{{ $product->title }}</td>
                                <td class="p-3">{{ "Rp " . number_format($product->price,2,',','.') }}</td>
                                <td class="p-3">{{ $product->stock }}</td>
                                <td class="p-3 text-center space-x-2">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-flex space-x-1">
                                        <a href="{{ route('products.show', $product->id) }}" class="px-2 py-1 bg-gray-800 text-white text-xs rounded hover:bg-gray-900">SHOW</a>
                                        <a href="{{ route('products.edit', $product->id) }}" class="px-2 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $products->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>