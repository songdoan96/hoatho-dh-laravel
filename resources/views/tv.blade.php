@extends('layouts.app')
@section('content')
    <div class="grid grid-cols-4 gap-2 h-screen w-screen">
        @foreach ($factories as $factory)
            <a class="bg-blue-900 text-white font-bold text-3xl flex justify-center items-center"
                href="{{ route('kcs.line', $factory->line) }}">
                {{ $factory->line }}
            </a>
        @endforeach
    </div>
@endsection
