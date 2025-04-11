<x-layout>
    <div class="max-w-2xl mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-4">Todo List</h2>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Todo List --}}
        <div class="bg-white shadow-md rounded-lg p-4">
            <ul>
                @forelse ($datas as $todo)
                    <li class="flex justify-between items-center border-b py-2">
                        <div>
                            <span class="{{ $todo->completed ? 'line-through text-yellow-600 font-semibold' : 'text-black' }}">
                                {{ $todo->name }}
                            </span>
                            <span class="text-sm text-gray-400 ml-2">
                                ({{ $todo->dead_line ? \Carbon\Carbon::parse($todo->dead_line)->format('M d, Y') : 'No Deadline' }})
                            </span>
                        </div>
                        <div class="flex space-x-2">
                            @auth
                                {{-- Complete / Undo --}}
                                <form action="{{ route('todo.update', $todo->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="completed" value="{{ $todo->completed ? 0 : 1 }}">
                                    <button type="submit"
                                        class="px-2 py-1 text-sm rounded-md
                                        {{ $todo->completed ? 'bg-yellow-500 text-white' : 'bg-green-500 text-white' }}">
                                        {{ $todo->completed ? 'Undo' : 'Complete' }}
                                    </button>
                                </form>

                                {{-- Delete --}}
                                <form action="{{ route('todo.destroy', $todo->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 text-sm bg-red-500 text-white rounded-md">
                                        Delete
                                    </button>
                                </form>
                            @endauth

                            @guest
                                {{-- Redirect to login if not authenticated --}}
                                <a href="{{ route('login') }}"
                                    class="px-2 py-1 text-sm bg-green-500 text-white rounded-md hover:bg-green-600">
                                    Complete
                                </a>
                                <a href="{{ route('login') }}"
                                    class="px-2 py-1 text-sm bg-red-500 text-white rounded-md hover:bg-red-600">
                                    Delete
                                </a>
                            @endguest
                        </div>
                    </li>
                @empty
                    <li class="text-gray-500 text-center py-4">No todos available.</li>
                @endforelse
            </ul>
        </div>

        {{-- Add Todo Form --}}
        <div class="bg-gray-100 p-4 rounded-lg mt-4">
            <h3 class="text-lg font-semibold mb-2">Add New todo</h3>

            @auth
                <form action="{{ route('todo.store') }}" method="POST" class="space-y-2">
                    @csrf
                    <input type="text" name="name" placeholder="Enter todo name"
                        class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300 outline-none">

                    <input type="date" name="dead_line"
                        class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300 outline-none">

                    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        Add todo
                    </button>
                </form>
            @endauth

            @guest
            <form onsubmit="window.location.href='{{ route('login') }}'; return false;" class="space-y-2">
                <input type="text" placeholder="Enter todo name"
                    class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300 outline-none">
        
                <input type="date"
                    class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300 outline-none">
        
                <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    Add todo
                </button>
            </form>
        @endguest
        </div>
    </div>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
</x-layout>
