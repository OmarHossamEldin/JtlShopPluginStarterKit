<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Traits;

use Plugin\JtlShopPluginStarterKit\Src\Validations\ValidateInputs;
use Plugin\JtlShopPluginStarterKit\Src\Helpers\ArrayValidator;
use Plugin\JtlShopPluginStarterKit\Src\Validations\Alerts;
use Plugin\JtlShopPluginStarterKit\Src\Helpers\Response;
use Plugin\JtlShopPluginStarterKit\Src\Support\Debug\Debugger;
use Plugin\JtlShopPluginStarterKit\Src\Support\Http\Header;

trait ValidationTrait
{
    public function validated()
    {
        $arrayValidator = new ArrayValidator($this->all());
        if ($arrayValidator->array_keys_exists('kPlugin', 'jtl_token', 'fetch')) {
            $this->unset('kPlugin', 'jtl_token', 'fetch');
        }
        $data = $this->all();
        $validator     = new ValidateInputs($data);
        if ($validator->passing_inputs_throw_validation_rules($this->rules())) {
            $errors = $validator->get_errors();
            if (count($errors) > 0) {
                if ($this->type === 'form') {
                    Alerts::show('danger', $errors);
                } else {
                    return Response::json($errors, 422);
                }
            } else {
                return $validator->get_validated_inputs();
            }
        };
    }
}
