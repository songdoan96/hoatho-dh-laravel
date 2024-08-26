@extends('layouts.admin')
@section('content')
    <div class="p-2 flex flex-col">
        <form id="formUpload" method="POST" action="{{ route('admin.uploadStore') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image" id="">
            <button type="submit" value="simple-edit" name="action"
                class="text-white
                        bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium
                        rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                Upload
            </button>
        </form>
        <div class="flex flex-wrap mt-4">
            @foreach ($images as $image)
                <div class="w-1/4 mb-8 flex gap-8">
                    <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->path }}" width="100">
                    <form id="image-active-{{ $image->id }}" action="{{ route('admin.imageChange', $image) }}"
                        method="POST">
                        @csrf
                        <input onchange="document.getElementById('image-active-{{ $image->id }}').submit()"
                            name="image-active" type="checkbox" {{ $image->active ? 'checked' : null }}
                            value="{{ $image->active }}"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                    </form>
                    <form id="image-delete-{{ $image->id }}" action="{{ route('admin.imageDelete', $image) }}"
                        method="POST">
                        @csrf
                        @method('delete')
                        <button
                            onclick="if(confirm('Xóa ảnh')) document.getElementById('image-delete-{{ $image->id }}').submit()"
                            type="submit"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
