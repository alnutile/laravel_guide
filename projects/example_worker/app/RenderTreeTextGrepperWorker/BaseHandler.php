<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 3/8/15
 * Time: 1:56 PM
 */

namespace AlfredNutileInc\RenderTreeTextGrepperWorker;


class BaseHandler {


    /**
     * @var RenderTreeTextDTO
     */
    protected $dto;

    public function setDto($dto)
    {
        $this->dto = $dto;
        return $this;
    }

    public function getDto()
    {
        return $this->dto;
    }
}