@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>
        @includeIf("footer.contents.$slug")
    </div>
@endsection
