<?php

namespace MvcCore\Jtl\Support\Debug;

use MvcCore\Jtl\Support\Facades\Filesystem\DirectoryComposer;
use Carbon\Carbon;

class Debugger
{
    private object $directory;

    public function __construct()
    {
        $this->directory = new DirectoryComposer();
    }
    public static function die_and_dump($variable): void
    {
        echo '<pre>';
        var_dump($variable);
        echo '<pre>';
        exit;
    }

    public static function print_r($variable): void
    {
        echo '<pre>';
        print_r($variable);
        echo '<pre>';
        exit;
    }

    public function log($text): void
    {
        $today = Carbon::today()->toDateString();
        $filename = "{$this->directory->get_logs()}{$today}.log";
        if (file_exists($filename)) {
            $data = file_get_contents($filename);
            if (!is_array($text)) {
                $data .= "\n $text";
            } else if (is_array($text)) {
                $text = implode("\n", $text);
                $data .= "\n $text";
            }
            file_put_contents($filename, $data);
        } else {
            file_put_contents($filename, $text);
        }
    }

    public function perform_memory_usage(): void
    {
        $this->log($this->convert_memory_usage(memory_get_usage(true)));
    }

    private function convert_memory_usage($size): string
    {
        $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
        return round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
    }
}
