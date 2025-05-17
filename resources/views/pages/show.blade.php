@extends('layouts.app')

@section('content')
  <div class="max-w-4xl mx-auto py-8 px-6">
    <h1 class="text-3xl font-bold mb-4">{{ $page->title }}</h1>
    <div class="prose max-w-full">
      {!! $page->content !!}
    </div>
  </div>
@endsection
