@extends('layouts.default')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Select Plans:</div>

                <div class="card-body">

                    <div class="row">
                        @foreach($plans as $plan)
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header">
                                    ${{ $plan->price }}
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $plan->name }}</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem facere a et dolor ipsum debitis unde autem explicabo sint officiis.</p>

                                    <a href="{{ route('plans.show', $plan->slug) }}" class="btn btn-primary pull-right">Buy Now</a>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection