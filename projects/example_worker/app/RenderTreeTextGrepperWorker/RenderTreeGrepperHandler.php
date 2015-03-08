<?php

namespace AlfredNutileInc\RenderTreeTextGrepperWorker;



use Illuminate\Support\Facades\Event;

class RenderTreeGrepperHandler extends BaseHandler implements HandlerInterface  {


    public function handle($dto)
    {
        $this->setDto($dto);

        //Do the work
        Event::fire('grep.success', [$this->getDto()]);
        return $this;
    }
}