<?php

namespace Plugin\JtlShopStarterKite\Src\Requests;

use Plugin\JtlShopStarterKite\Src\Validations\ValidateInputs;

class PostStoreRequest
{
    public function rules()
    {
        return [
            'title' => 'required',
            'body' => 'required'
        ];
    }

    public function validate(Array $data)
    {
        $validator     = new ValidateInputs($data);
        $validatedData = $validator->passingInputsThrowValidationRules($this->rules());
        return $validatedData;
    }
}
