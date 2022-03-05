@extends('layouts.form-app')

@section('css')
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Add New Form') }}</div>

                <div class="card-body">
                    <div class="alert alert-message d-none"></div>

                    <h3 class="pb-3 pt-3">Form Details</h3>
                    <form id="js-form-template" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="form_template_id" value="{{ isset($formTemplate['id']) ? $formTemplate['id'] : '' }}">
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <label for="js-title">Form Title <sup style="color: red;">*</sup> :-</label>
                                <input type="text" name="title" id="js-title" placeholder="Enter Form Title" class="form-control" value="{{ isset($formTemplate['title']) ? $formTemplate['title'] : '' }}" required="true">
                            </div>


                            <div class="col-sm-6 col-md-6">
                                <label for="js-instruction">Form Instructions<sup style="color: red;">*</sup> :-</label>
                                <input type="instruction" name="instruction" id="js-instruction" placeholder="Enter Form Instructions" class="form-control" value="{{ isset($formTemplate['instruction']) ? $formTemplate['instruction'] : '' }}" required="true">
                            </div>

                            <div class="clearfix"></div>

                            <div class="col-sm-12 col-md-12 pb-3 pt-3">
                                <div class="btn-toolbar float-sm-right d-block">
                                    <button type="submit" class="btn btn-success" id="js-submit-form-template">Save Form Template</button>
                                    @if(isset($editForm) && $editForm)
                                    <button type="button" id="js-add-form-input" class="btn btn-primary">Add Form Input</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>

                    @if(isset($editForm) && $editForm)
                    <h3 class="pb-3 pt-3">Form Input Fields</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Input Name</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        @if(isset($formTemplate['form_inputs']) && count($formTemplate['form_inputs']) > 0)
                            @foreach($formTemplate['form_inputs'] as $formInput)
                            <tr>
                                <td>{{ $formInput['id'] }}</td>
                                <td>{{ $formInput['input'] }}</td>
                                <td>{{ $formInput['created_at'] }}</td>
                                <td>{{ $formInput['updated_at'] }}</td>
                                <td>
                                    <a href="javascript:void(0);" data-id="{{ $formInput['id'] }}" class="js-edit-form-input" style="color:black"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:void(0);" data-id="{{ $formInput['id'] }}" class="pl-4 js-delete-form-input" style="color:black"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tbody>
                                <tr>
                                    <td colspan="11" class="no-results text-center">No records found!</td>
                                </tr>
                            </tbody>
                        @endif
                    </table>
                    @endif

                    @if((isset($formTemplate['id'])))
                    <div class="js-form-inputs-wrap d-none">
                        <h3 class="pb-3 pt-3">Add / Edit Form Input</h3>
                        <form action="{{route('form.edit', [$formTemplate['id']])}}" id="js-form-inputs" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="form_input_id" value="">
                            <input type="hidden" name="form_template_id" value="{{ isset($formTemplate['id']) ? $formTemplate['id'] : '' }}">
                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <label for="js-inputLabel">Input Label <sup style="color: red;">*</sup> :-</label>
                                    <input type="text" name="inputLabel" id="js-inputLabel" placeholder="Enter Input Label" class="form-control">
                                </div>

                                <div class="col-sm-6 col-md-6">
                                    <label for="js-inputType">Input Type <sup style="color: red;">*</sup> :-</label>
                                    <select class="custom-select" aria-label="Default select example" name="inputType" id="js-inputType">
                                        <option value="1">Text</option>
                                        <option value="2">Number</option>
                                        <option value="3">Select</option>
                                    </select>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 select-options-wrap pb-3 pt-3 d-none">
                                    <label class="choices-label">Options:</label>
                                    
                                    <div class="select-options-fields-wrap">
                                        <div class="input-group w-auto pb-3 single-select-options-list">
                                            <div class="btn-group-toggle col-lg-8 col-md-8 col-sm-8" data-toggle="buttons">
                                                <input type="text" name="options[]" class="form-control" placeholder="Enter text">
                                            </div>
                                            <div class="input-group-prepend">
                                                <a href="javascript:void(0)" class="delete_option">Delete</a>
                                            </div>
                                        </div>

                                        <div class="input-group w-auto pb-3 single-select-options-list">
                                            <div class="btn-group-toggle col-lg-8 col-md-8 col-sm-8" data-toggle="buttons">
                                                <input type="text" name="options[]" class="form-control" placeholder="Enter text">
                                            </div>
                                            <div class="input-group-prepend">
                                                <a href="javascript:void(0)" class="delete_option">Delete</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 pt-3">
                                        <a href="javascript:void(0)" class="add-new-select-option">Add new options</a>
                                    </div>

                                </div>

                                <div class="col-sm-12 col-md-12 pb-3 pt-3">
                                    <div class="btn-toolbar float-sm-right ">
                                        <button type="submit" class="btn btn-success" id="js-save-form-input">Save Form Input</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    var formTemplate = {!! json_encode($formTemplate) !!};
    var cloneCount = $('.single-select-options-list').length;

    function showAlert(message, type) {
        $('.alert-message').html(message);
        $('.alert-message').removeClass('alert-danger');
        $('.alert-message').removeClass('alert-success');
        if (type == 'error') $('.alert-message').addClass('alert-danger');
        if (type == 'success') $('.alert-message').addClass('alert-success');
        $('.alert-message').removeClass('d-none');
    }

    function cloneSingleSelectOption() {
        var cloned = $('.single-select-options-list:first').clone(true, true).get(0);
        cloneCount++;

        $(cloned).find("input:text").val("");

        $(cloned).insertAfter('.single-select-options-list:last');
    }

    $(document).on('click',"#js-add-form-input",function(e){ 
        $(".js-form-inputs-wrap").toggleClass('d-none');
    });
    
    $(document).on('change',"#js-inputType",function(e){ 
        if ($(this).val() == 3) {
            $(".select-options-wrap").removeClass('d-none');
        } else {
            $(".select-options-wrap").addClass('d-none');
        }
    });

    $(document).on('click','.add-new-select-option',function () {
        cloneSingleSelectOption();
    });

    $(document).on('click','.delete_option',function () {
        if ($('.single-select-options-list').length == 1)  return;
        $(this).parents('.single-select-options-list:first').remove();
    });

    $(document).on('click','.js-edit-form-input',function (e) {
        e.preventDefault();

        var form_input_id = $(this).attr('data-id');
        var formInputDatas = formTemplate.form_inputs;
        const formInputData = formInputDatas.filter((formInputData) => formInputData.id == form_input_id);
        if (formInputData.length > 0) {
            console.log(formInputData);
            $('input[name="form_input_id"]').val(formInputData[0].id);
            $('#js-inputLabel').val(formInputData[0].input);
            $('#js-inputType option[value="'+ String(formInputData[0].input_type) +'"]').attr("selected", "selected");
            if( formInputData[0].input_type == 3) {
                $(".select-options-wrap").removeClass('d-none');
            } else  {
                $(".select-options-wrap").addClass('d-none');
            }
            var options = formInputData[0].form_input_options;
            for (var i = 0; i < options.length; i++){
                var option = options[i];
                console.log(option);
                if (i > 1) cloneSingleSelectOption();
                $(".single-select-options-list").eq(i).find("input:text").val(option.input);
            }
            $(".js-form-inputs-wrap").removeClass('d-none');
        }

    });
    

    $(document).on('click',"#js-submit-form-template",function(e){  
        e.preventDefault();
        var _token = $('input[name="_token"]').val();
        var formTitle = $('input[name="title"]').val();
        var formInstruction = $('input[name="instruction"]').val();
        var formTemplateId = $('input[name="form_template_id"]').val();

        $.ajax({
            url : '{{ route("form.add") }}',
            type: 'POST',
            data: {
                _token : _token,
                form_template_id : formTemplateId,
                title : formTitle,
                instruction : formInstruction,
            },
            success: function (response) {
                if (response.status) {
                    showAlert(response.message, 'success');
                    window.location.href = response.url;
                }
            },
            complete: function () {

            },
            error: function (response) {
                if(response.responseJSON.message != "undefined" && response.responseJSON.message != null){
                    showAlert(response.responseJSON.message, 'error');
                }
            }
        });
    });

    $(document).on('click',".js-delete-form-input",function(e){  
        e.preventDefault();
        var that = $(this);
        var _token = $('input[name="_token"]').val();
        var form_input_id = $(this).attr('data-id');

        $.ajax({
            url : '{{ route("form.delete") }}',
            type: 'POST',
            data: {
                _token : _token,
                form_input_id : form_input_id,
            },
            success: function (response) {
                if (response.status) {
                    showAlert(response.message, 'success');
                    that.parents('tr:first').remove();
                }
            },
            complete: function () {

            },
            error: function (response) {
                if(response.responseJSON.message != "undefined" && response.responseJSON.message != null){
                    showAlert(response.responseJSON.message, 'error');
                }
            }
        });
    });
</script>
@endsection