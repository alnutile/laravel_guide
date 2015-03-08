<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 3/8/15
 * Time: 1:59 PM
 */

namespace AlfredNutileInc\RenderTreeTextGrepperWorker;


use Illuminate\Support\ServiceProvider;

class GrepCallbackListener extends ServiceProvider {

    use CallbackHelper;

    /**
     * @var RenderTreeTextDTO
     */
    protected $dto;

    protected $callback_url;
    protected $callback_status;
    protected $callback_params;
    protected $callback_results;
    protected $callback_uuid;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $callback_client;

    /**
     * @var \Guzzle\Response
     */
    public $callback_response;



    public function register()
    {
        // TODO: Implement register() method.
    }

    public function boot()
    {

        $this->app['events']->listen('grep.success', function($dto)
        {
            $this->setDto($dto);
            $this->callback();
        });

        $this->app['events']->listen('grep.error', function($message, $dto)
        {
            $this->setDto($dto);
            $this->callbackError($message);
        });
    }

    protected function setDto($dto)
    {
        $this->dto = $dto;
    }

    protected function callback()
    {
        //Handle the callback
        if(!empty($this->getDto()->callback))
        {
            $this->setCallBackParams();
            $this->setCallBackStatus(200);
            $this->setCallBackUuid();
            $this->getDto()->results[] = "Listener is listening though of course there is more to do than this";
            $this->setCallBackResults();
            $this->makeCallbackRequest();
        }
    }

    protected function callbackError()
    {
        //Handle the callback error
    }

    /**
     * @return RenderTreeTextDTO
     */
    protected function getDto()
    {
        return $this->dto;
    }
}