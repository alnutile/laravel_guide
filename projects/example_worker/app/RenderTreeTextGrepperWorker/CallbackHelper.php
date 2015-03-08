<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 3/8/15
 * Time: 4:17 PM
 */

namespace AlfredNutileInc\RenderTreeTextGrepperWorker;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Facades\Log;

trait CallbackHelper {

    protected function setCallBackParams($callback_params = false)
    {
        if($callback_params == false)
            $callback_params = $this->getDto()->callback['params'];
        $this->callback_params = $callback_params;
    }

    protected function setCallBackStatus($status)
    {
        $this->callback_status = $status;
    }

    protected function getCallBackStatus()
    {
        return $this->callback_status;
    }

    protected function setCallBackUuid($uuid = false)
    {
        if($uuid == false)
            $uuid = $this->getDto()->uuid;
        $this->callback_uuid = $uuid;
    }

    protected function setCallBackResults($results = null)
    {
        if($results == null)
            $results = $this->getDto()->results;
        $this->callback_results = $results;
    }

    protected function getCallBackResults()
    {
        return $this->callback_results;
    }

    protected function makeCallbackRequest()
    {
        try
        {
            //@TODO encrypt
            $post = json_encode([
                'results' => $this->getCallBackResults(),
                'params'  => $this->getCallBackParams(),
                'status'  => $this->getCallBackStatus()
            ]);
            $this->callback_response = $this->getCallbackClient()->post($this->getCallbackUrl(), ['body' => $post, 'verify' => false]);
            $this->getDto()->results[] = "Response OK";
        } catch(BadResponseException $e)
        {
            $response = $e->getResponse();
            Log::debug(sprintf("Error from provider %s", $e->getResponse()->getStatusCode()));

            if($response === null)
            {
                Log::debug(sprintf("Empty response from callback %s", $this->getCallbackUrl()));
            }

            $this->getDto()->results[] = $response;
        }
    }

    /**
     * @return mixed Client
     */
    protected function getCallbackClient()
    {
        if($this->callback_client == null)
            $this->setCallbackClient();

        return $this->callback_client;
    }

    protected function setCallbackClient($client = null)
    {
        if($client == null)
        {
            $client = new Client();
        }

        $this->callback_client = $client;
        return $this;
    }

    protected function getCallBackParams()
    {
        if($this->callback_params == false)
            $this->setCallBackParams();

        return $this->callback_params;
    }

    protected function getCallbackUrl()
    {
        try
        {
            if($this->callback_url == false)
                $this->setCallBackUrl();
            return $this->callback_url;
        } catch(\Exception $e)
        {
            throw new \Exception(sprintf("URL not in callback message %s", $e->getMessage()));
        }
    }

    protected function setCallBackUrl($callback_url = false)
    {
        if($callback_url == false)
            $callback_url = $this->getDto()->callback['caller'];
        $this->callback_url = $callback_url;
    }

}