<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow mt-10">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Post</h1>

        @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('posts.update', $post) }}">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label for="title" class="block mb-1 text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                    class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring focus:ring-blue-300"
                    required>
            </div>

            <div class="mb-5">
                <label for="content" class="block mb-1 text-sm font-medium text-gray-700">Content</label>
                <textarea name="content" id="content" rows="5"
                    class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring focus:ring-blue-300"
                    required>{{ old('content', $post->content) }}</textarea>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('posts.index') }}" class="text-sm text-gray-600 hover:underline">← Back to Posts</a>
                <button type="submit"
                    class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition-all duration-200">
                    Update Post
                </button>
            </div>
        </form>
    </div>
</x-app-layout>