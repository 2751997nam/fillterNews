@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('news.create') }}" role="button" class="btn btn-success">Add News</a>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            @foreach ($newses as $news)
                <div class="card">
                    <div class="card-body">
                        <div style="width: 100px; height: 100px; display: inline-block">
                            <a href="{{ route('news.show', ['id' => $news->id]) }}"><img style="width: 100%; height: 100%" src="{{ $news->thumbnail }}" alt=""></a>
                        </div>
                        <div class="d-inline-block">
                            <a href="{{ route('news.show', ['id' => $news->id]) }}"><p>{{ $news->title }}</p></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection