<x-admin::layouts.master>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-primary-500">View Unit</h1>
            <p class="text-gray-400">Detailed information about the unit</p>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="bg-dark-50 rounded-xl shadow-sm border border-dark-200 overflow-hidden">
                <div class="p-6 border-b border-dark-200">
                    <div class="flex flex-col md:flex-row md:items-start justify-between">
                        <div class="flex items-start mb-4 md:mb-0">
                            @if($unit->image_url)
                                <img src="{{ $unit->image_url }}" alt="{{ $unit->name }}" class="h-24 w-24 rounded-lg object-cover" onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'h-24 w-24 rounded-lg bg-dark-400 flex items-center justify-center\'><i class=\'fas fa-gamepad text-4xl text-gray-500\'></i></div>';">
                            @else
                                <div class="h-24 w-24 rounded-lg bg-dark-400 flex items-center justify-center">
                                    <i class="fas fa-gamepad text-4xl text-gray-500"></i>
                                </div>
                            @endif
                            <div class="ml-6">
                                <h2 class="text-2xl font-bold text-gray-200">{{ $unit->name }}</h2>
                                <p class="text-gray-400 mt-1">{{ $unit->code }}</p>
                                <div class="mt-2">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($unit->status === 'available') bg-green-600 text-white
                                        @elseif($unit->status === 'rented') bg-yellow-600 text-white
                                        @else bg-red-600 text-white @endif">
                                        {{ ucfirst($unit->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.units.edit', $unit->id) }}" class="inline-flex items-center px-4 py-2 border border-dark-200 rounded-lg text-gray-300 hover:bg-dark-200 transition">
                                <i class="fas fa-edit mr-2"></i> Edit
                            </a>
                            <a href="{{ route('admin.units.index') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition duration-200">
                                <i class="fas fa-arrow-left mr-2"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-dark-400 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider">Description</h3>
                            <p class="mt-1 text-gray-200">{{ $unit->description ?? '-' }}</p>
                        </div>

                        <div class="bg-dark-400 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider">Rank</h3>
                            <p class="mt-1 text-gray-200">{{ $unit->rank }}</p>
                        </div>

                        <div class="bg-dark-400 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider">Level</h3>
                            <p class="mt-1 text-gray-200">{{ $unit->level }}</p>
                        </div>

                        <div class="bg-dark-400 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider">Price per Day</h3>
                            <p class="mt-1 text-gray-200 text-xl font-bold text-primary-500">Rp {{ number_format($unit->price_per_day, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider mb-3">Categories</h3>
                        <div class="flex flex-wrap gap-2">
                            @forelse($unit->categories as $category)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-600 text-white">
                                    {{ $category->name }}
                                </span>
                            @empty
                                <p class="text-gray-400">No categories assigned</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-dark-400 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider">Created At</h3>
                            <p class="mt-1 text-gray-200">{{ $unit->created_at->format('M d, Y H:i') }}</p>
                        </div>

                        <div class="bg-dark-400 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-400 uppercase tracking-wider">Updated At</h3>
                            <p class="mt-1 text-gray-200">{{ $unit->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 border-t border-dark-200 bg-dark-400 flex justify-end">
                    <form action="{{ route('admin.units.destroy', $unit->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition duration-200 flex items-center" 
                            onclick="return confirm('Are you sure you want to delete this unit? This action cannot be undone.')">
                            <i class="fas fa-trash mr-2"></i> Delete Unit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin::layouts.master>