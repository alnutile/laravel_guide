<?php
require_once __DIR__ . '/libs/worker_boot.php';

$payload = decryptPayload(getPayload());
fire($payload);

function fire($payload)
{
    try {
        $handle = new \AlfredNutileInc\RenderTreeTextGrepperWorker\RenderTreeGrepperHandler();
        $results = $handle->handle($payload);
        echo print_r($results->getDto()->results);
    }
    catch(\Exception $e)
    {
        echo "Error not caught via callback " . $e->getMessage();
    }


}

