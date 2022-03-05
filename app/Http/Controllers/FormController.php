<?php

namespace App\Http\Controllers;

use App\Models\FormInputOptions;
use App\Models\FormInputs;
use App\Models\FormTemplate;
use Validator;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function __construct()
    {
        # code...
    }

    /**
     * List form data to user
     * 
     * @param request $request
     * 
     * @reutrn view
     * 
     */
    public function listFrom(Request $request)
    {
        try {
            $formTemplates = FormTemplate::all();

            return view('forms.list', [
                'forms' => $formTemplates,
            ]);
        } catch (\Exception $ex) {
            // echo $ex->getMessage();

            abort(500);
        }
    }


    /**
     * Add update form template data
     * 
     * @param request $request
     * 
     * @reutrn view
     * 
     */
    public function addUpdateForm(Request $request)
    {
        try {
            if ($request->getMethod() == "POST") {
                $aRules = [
                    'form_template_id' => 'nullable|exists:form_templates,id',
                    'title' => 'required',
                    'instruction' => 'required',
                ];

                $v = Validator::make($request->all(), $aRules);

                if ($v->fails()) {
                    $errorString = implode(",", $v->messages()->all());

                    return response()->json([
                        'status'    => false,
                        'message'   => $errorString,
                    ], 400);
                }

                $aRequest = $request->all();
                $action = 'created';

                if (isset($aRequest['form_template_id'])) {
                   $id = $aRequest['form_template_id'];
                   $formTemplate =  FormTemplate::find($id);
                   $formTemplate->title = $aRequest['title'];
                   $formTemplate->instruction = $aRequest['instruction'];
                   $formTemplate->updated_at = date('Y-m-d H:i:s');
                   $formTemplate->save();

                   $action = 'updated';
                } else {
                    $id = FormTemplate::insertGetId(array(
                        'title' => $aRequest['title'],
                        'instruction' => $aRequest['instruction'],
                        'created_at' => date('Y-m-d H:i:s'),
                    ));
                }
                
                return response()->json([
                    'status'    => true,
                    'message'   => 'Successfully '.$action.' form template',
                    'url'       => url("/edit-form/{$id}")
                ], 200);
            } 

            return view('forms.add-edit', [
                'editForm'     => false,
                'formTemplate' => [],
            ]);
        } catch (\Exception $ex) {
            // echo $ex->getMessage();

            abort(500);
        }
    }


    /**
     * Edit form data
     * 
     * @param request $request
     * 
     * @reutrn view
     * 
     */
    public function editForm(Request $request, $id)
    {
        try {
            if ($request->getMethod() == "POST") {
                $aRequest = $request->all();

                if (isset($aRequest['form_input_id'])) {
                    $formInput = FormInputs::find($aRequest['form_input_id']);
                } else {
                    $formInput = new FormInputs();
                }

                $formInput->input = $aRequest['inputLabel'];
                $formInput->input_type = $aRequest['inputType'];
                $formInput->form_template_id = $aRequest['form_template_id'];
                $formInput->updated_at = date('Y-m-d H:i:s');
                $formInput->save();

                if ($aRequest['inputType'] == 3) {
                    FormInputOptions::where('form_input_id',$formInput->id)->delete();

                    foreach ($aRequest['options'] as $key => $option) {
                        if (isset($option)) {
                            $inputOption = new FormInputOptions();
                            $inputOption->form_input_id = $formInput->id;
                            $inputOption->input = $option;
                            $inputOption->created_at = date('Y-m-d H:i:s');
                            $inputOption->updated_at = date('Y-m-d H:i:s');
                            $inputOption->save();
                        }
                    }
                }

                return redirect(url("/edit-form/{$aRequest['form_template_id']}"));
            }
            $formTemplate = FormTemplate::find($id);
            $formTemplate->form_inputs = $formTemplate->formInputs;
            foreach ($formTemplate->form_inputs as $key => $formTemplateInput) {
                $formTemplate->form_inputs[$key]->form_input_options  = $formTemplateInput->formInputOptions;
            }

            $response = isset($formTemplate) ? $formTemplate->toArray() : [];

            return view('forms.add-edit', [
                'editForm'     => true,
                'formTemplate' => $response,
            ]);
        } catch (\Exception $ex) {
            // echo $ex->getMessage();

            abort(500);
        }
    }


    /**
     * Delete form inputs
     * 
     * @param request $request
     * 
     * @reutrn view
     * 
     */
    public function deleteFormInput(Request $request)
    {
        try {
            if ($request->getMethod() == "POST") {
                $aRules = [
                    'form_input_id' => 'required|exists:form_inputs,id',
                ];

                $v = Validator::make($request->all(), $aRules);

                if ($v->fails()) {
                    $errorString = implode(",", $v->messages()->all());

                    return response()->json([
                        'status'    => false,
                        'message'   => $errorString,
                    ], 400);
                }

                $aRequest = $request->all();

                FormInputs::find($aRequest['form_input_id'])->delete();
                
                return response()->json([
                    'status'    => true,
                    'message'   => 'Successfully deleted input',
                ], 200);
            }
        } catch (\Exception $ex) {
            // echo $ex->getMessage();

            abort(500);
        }
    }

    /**
     * View form 
     * 
     * @param request $request
     * 
     * @return view
     */
    public function viewForm(Request $request, $id)
    {
        try {
            $formTemplate = FormTemplate::find($id);
            $formTemplate->form_inputs = $formTemplate->formInputs;
            foreach ($formTemplate->form_inputs as $key => $formTemplateInput) {
                $formTemplate->form_inputs[$key]->form_input_options  = $formTemplateInput->formInputOptions;
            }

            $response = isset($formTemplate) ? $formTemplate->toArray() : [];

            return view('forms.view', [
                'formTemplate' => $response,
            ]);
        } catch (\Exception $ex) {
            // echo $ex->getMessage();

            abort(500);
        }
    }
}
