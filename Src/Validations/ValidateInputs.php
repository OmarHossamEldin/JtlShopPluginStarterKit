<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Validations;

use Plugin\JtlShopPluginStarterKit\Src\Support\Lang;
use Plugin\JtlShopPluginStarterKit\Src\Helpers\Response;

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
