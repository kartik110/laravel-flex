@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h1>Class</h1>

                        <form action="{{ route('changeclass') }}" method="POST" id="form" class="my-2">
                            @csrf
                            <select class="form-select" aria-label="Select Class" form="form" name="class">
                                <option selected value="1">Select Class</option>
                                <option value="1">1 Class</option>
                                <option value="2">2 Class</option>
                                <option value="3">3 Class</option>
                                <option value="4">4 Class</option>
                                <option value="5">5 Class</option>
                                <option value="6">6 Class</option>
                                <option value="7">7 Class</option>
                                <option value="8">8 Class</option>
                                <option value="9">9 Class</option>
                                <option value="10">10 Class</option>
                                <option value="11">11 Class</option>
                                <option value="12">12 Class</option>
                            </select>
                            <button class="btn btn-primary my-2">Submit</button>
                        </form>
                        <div>
                            <ul>
                                @foreach ($rotatedArray as $element)
                                    <li>{{ $element }} Class</li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
