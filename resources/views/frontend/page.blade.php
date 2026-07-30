@extends('layouts.store')

@section('content')
<section class="py-5 mt-5 bg-light min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="bg-white p-4 p-md-5 rounded shadow-sm border">
                    <h1 class="fw-bold mb-4">{{ $page->title }}</h1>
                    
                    <div class="page-content text-muted lh-lg">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
