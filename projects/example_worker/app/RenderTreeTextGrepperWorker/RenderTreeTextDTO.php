<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 3/8/15
 * Time: 1:51 PM
 */

namespace AlfredNutileInc\RenderTreeTextGrepperWorker;


class RenderTreeTextDTO {


    public $uuid;

    public $urls;

    public $text;

    public $callback;

    public $results;

    public $status;

    public function __construct($uuid, array $urls, array $text, array $callback, $results, $status)
    {
        $this->uuid         = $uuid;
        $this->urls         = $urls;
        $this->text         = $text;
        $this->callback     = $callback;
        $this->results      = $results;
        $this->status       = $status;
    }
}