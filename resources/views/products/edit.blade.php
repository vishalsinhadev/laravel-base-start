<x-app-layout>
    <div class="max-w-4xl mx-auto my-10 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- IMAGE -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">IMAGE</label>
                    <input type="file" name="image"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('image') border-red-500 @enderror">

                    @error('image')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- TITLE -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">TITLE</label>
                    <input type="text" name="title" value="{{ old('title', $product->title) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none @error('title') border-red-500 @enderror"
                        placeholder="Product Title">

                    @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- DESCRIPTION -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">DESCRIPTION</label>
                    <textarea name="description" rows="5"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none @error('description') border-red-500 @enderror"
                        placeholder="Product Description">{{ old('description', $product->description) }}</textarea>

                    @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- PRICE & STOCK -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">PRICE</label>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none @error('price') border-red-500 @enderror"
                            placeholder="Product Price">

                        @error('price')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">STOCK</label>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none @error('stock') border-red-500 @enderror"
                            placeholder="Product Stock">

                        @error('stock')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- ACTION BUTTONS -->
                <div class="flex gap-4 mt-6">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-700 transition focus:ring-2 focus:ring-blue-500">
                        UPDATE
                    </button>
                    <button type="reset"
                        class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white text-sm font-semibold rounded-md hover:bg-yellow-600 transition focus:ring-2 focus:ring-yellow-400">
                        RESET
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- CKEditor for Description -->
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
</x-app-layout>