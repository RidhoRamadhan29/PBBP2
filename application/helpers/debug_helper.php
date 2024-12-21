<?php 
if (!function_exists('dd')) {
    function dd(...$args) {
        echo '<div style="background-color: #f3f4f6; border: 1px solid #d2d6dc; border-radius: 0.375rem; font-family: Menlo, Monaco, Consolas, Liberation Mono, Courier New, monospace; font-size: 14px; line-height: 1.5; color: #000; padding: 10px; margin: 10px;">';
        echo '<pre>';
        foreach ($args as $arg) {
            print_r($arg);
            echo "\n\n";
        }
        echo '</pre>';
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
        echo '<p style="font-size: 12px; color: #666;">Called from: ' . $trace['file'] . ' on line ' . $trace['line'] . '</p>';
        echo '</div>';
        exit;
    }
}
?>