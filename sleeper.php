<?php

header('Content-Type: text/plain; charset=UTF-8');

class sleeper {

    protected static $sleep = 500000;

    public static function on () {
        while (@ob_get_level()) {
            ob_end_clean();
        }
        ob_start();
       // return self::line();
    }

    public static function line ( $params = null ) {
        echo json_encode($params);
        echo str_pad (null,4096 ) . "\r\n";
        return self::flush();
    }

    protected static  function flush() {
        return flush() | ob_flush() | usleep(self::$sleep);
    }

    public static function end() {
        return ob_end_flush();
    }

}

$tasks = [
    'Downloading google.com ...',
    'Downloading yahoo.com ...',
    'Downloading wikipedia.org ...',
    'Downloading amazon.com ...',
    'Downloading github.com ...',
    'Downloading other sites',
    'Internet download complete',
];

$response = [];

sleeper::on();

foreach ( $tasks as $key => $task ) {
    /*
     * Here goes the worker that you need
     */
    $response[] = [ 'line' => $key, 'task' => $task ];
    /*
     * Push the response
     */
    sleeper::line($response);

}

sleeper::end();
