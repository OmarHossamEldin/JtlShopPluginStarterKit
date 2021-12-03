<?php

namespace Plugin\JtlShopStarterKite\Src\Validations;

use Plugin\JtlShopStarterKite\Src\Support\Lang;
use Plugin\JtlShopStarterKite\Src\Helpers\Response;

class ValidateInputs extends FilterInputs
{

    public function passingInputsThrowValidationRules($rules)
    {
        $inputs = $this->filtered();
        array_walk($inputs, function (&$input, $key) use ($rules) {
            if (array_key_exists($key, $rules) !== false) {
                switch ($rules[$key]) {
                    case 'required':
                        if ($input) {
                            $input = $input;
                        } else {
                            Alerts::show('warning', ValidationMessage::get('required'), $key);
                        }
                        break;
                    case 'nullable':
                        $input = !!$input ? $input : '';
                        break;
                    default:
                        $input = 'not supported validation rule';
                        break;
                }
            }
        });
        if ($inputs['jtl_token'] && $inputs['kPluginAdminMenu']) {
            unset($inputs['jtl_token'], $inputs['kPluginAdminMenu']);
        }
        return $inputs;
    }

    public function passingAjaxRequestThrowValidationRules($rules)
    {
        $inputs = $this->filtered();
        array_walk($inputs, function (&$input, $key) use ($rules) {
            if (array_key_exists($key, $rules) !== false) {
                switch ($rules[$key]) {
                    case 'required':
                        if ($input) {
                            $input = $input;
                        } else {
                            echo Response::json([
                                $key => Lang::get('validations', 'required')
                            ], 422);
                            exit();
                        }
                        break;
                    case 'nullable':
                        $input = !!$input ? $input : '';
                        break;
                    default:
                        $input = 'not supported validation rule';
                        break;
                }
            }
        });
        return $inputs;
    }
}
