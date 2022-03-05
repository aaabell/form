@extends('layouts.app')

@section('css')

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Form') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if(isset($formTemplate))
                    <form id="" method="" enctype="multipart/form-data">
                        <h3 class="text-center">{{ isset($formTemplate['title']) ? $formTemplate['title'] : ''}} </h3>
                        <p class="text-center font-italic font-weight-light">{{ isset($formTemplate['instruction']) ? $formTemplate['instruction'] : ''}} </p>

                        <div class="row">
                            @foreach($formTemplate['form_inputs'] as $formInput)
                            <div class="col-sm-12 col-md-12 pb-3">
                                <label for="">{{ $formInput['input'] }} <sup style="color: red;">*</sup> :-</label>
                                @if($formInput['input_type'] == 1)
                                <input type="text" name="{{ $formInput['input'] }}"  placeholder="Enter {{ $formInput['input'] }}" class="form-control" >
                                @elseif($formInput['input_type'] == 2)
                                <input type="number" name="{{ $formInput['input'] }}"  placeholder="Enter {{ $formInput['input'] }}" class="form-control" >
                                @elseif($formInput['input_type'] == 3)
                                <select name="{{ $formInput['input'] }}" class="custom-select" aria-label="Default select example">
                                    <option value="">Select an option</option>
                                    @foreach($formInput['form_input_options'] as $option)
                                        <option value="{{ $option['id'] }}"> {{ $option['input'] }}</option>
                                    @endforeach
                                </select>
                                @endif
                            </div>
                            @endforeach
                        </div>

                        <div class="col-sm-12 col-md-12 pb-3 pt-3">
                            <div class="btn-toolbar float-sm-right d-block">
                                <button type="button" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection