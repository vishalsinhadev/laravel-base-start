<x-app-layout>
    <div class="max-w-6xl mx-auto my-10 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Product Image -->
            <div class="col-span-1">
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="p-4">
                        <img src="{{ asset('/storage/products/'.$product->image) }}" alt="{{ $product->title }}"
                            class="rounded w-full object-cover">
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="md:col-span-2">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">{{ $product->title }}</h3>
                    <hr class="mb-4" />

                    <p class="text-xl font-bold text-green-700 mb-3">
                        {{ "Rp " . number_format($product->price,2,',','.') }}
                    </p>

                    <div class="prose max-w-none text-gray-700">
                        {!! $product->description !!}
                    </div>

                    <hr class="my-4" />

                    <p class="text-sm text-gray-600">Stock: <span class="font-semibold">{{ $product->stock }}</span></p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>