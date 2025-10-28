@extends('layouts.app')

@section('title', 'View Category')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">View Category</h1>
            <div>
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Edit
                </a>
                <a href="{{ route('admin.categories.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to List
                </a>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Name</h3>
                    <p class="text-gray-900">{{ $category->name }}</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Slug</h3>
                    <p class="text-gray-900">{{ $category->slug }}</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Description</h3>
                    <p class="text-gray-900">{{ $category->description ?? '-' }}</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Created At</h3>
                    <p class="text-gray-900">{{ $category->created_at->format('M d, Y H:i') }}</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Updated At</h3>
                    <p class="text-gray-900">{{ $category->updated_at->format('M d, Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection