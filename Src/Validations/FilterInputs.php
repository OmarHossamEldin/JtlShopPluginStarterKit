<?php

namespace Plugin\JtlShopStarterKite\Src\Validations;

class FilterInputs
{
  private $inputs;

  public function __construct($inputs)
  {
    $this->inputs = array_map(function ($input) {
      if (is_array($input)) {
        $input = array_map(fn ($element) => $this->filterLayer($element), $input);
      } else {
        $input = $this->filterLayer($input);
      }
      return $input;
    }, $inputs);
  }

  public function filterLayer($input)
  {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
  }
  public function filtered()
  {
    return $this->inputs;
  }
}
