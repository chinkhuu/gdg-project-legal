@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6">Хуулийн талаар таны мэдлэгийг сорих тестүүд</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($quizzes as $quiz)
                <a href="{{ route('quiz', $quiz->slug) }}" class="block border rounded-lg overflow-hidden hover:shadow-lg transition">
                    @if($quiz->image)
                        <img src="{{ asset('storage/' . $quiz->image) }}" alt="" class="w-full h-40 object-cover">
                    @endif
                    <div class="p-4">
                        <h2 class="text-xl font-semibold">{{ $quiz->title }}</h2>
                        <p class="text-gray-600 mt-2">{!! Str::limit($quiz->description, 80) !!}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
