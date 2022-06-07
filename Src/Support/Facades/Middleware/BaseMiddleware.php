<?php

namespace MvcCore\Jtl\Support\Facades\Middleware;

abstract class BaseMiddleware
{
    private static array $actions = [];

    abstract public function handle();

    final public function register_action($action)
    {
        if (!in_array($action, self::$actions, true)) {
            self::$actions[] = $action;
        }
    }

    final public function get_action($action): string
    {
        return array_values(array_filter(self::$actions, fn ($selectedAction) => $selectedAction === $action))[0];
    }

    final public function list_actions(): array
    {
        return self::$actions;
    }
}
