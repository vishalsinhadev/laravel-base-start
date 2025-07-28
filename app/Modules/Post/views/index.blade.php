<x-app-layout>
    <div class="max-w-6xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Posts</h1>
        <a href="{{ route('posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New</a>
        <table class="table-auto w-full mt-4 border">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2">Title</th>
                    <th class="p-2">Content</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr class="border-t">
                    <td class="p-2">{{ $post->title }}</td>
                    <td class="p-2">{{ $post->content }}</td>
                    <td class="p-2">
                        <a href="{{ route('posts.edit', $post) }}" class="text-blue-600">Edit</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-600 ml-2" onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>