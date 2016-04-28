<?php
namespace Rx\Observer;


use Rx\Event\ErrorEvent;
use Rx\Httpd\HttpdResponse;
use Rx\ObserverInterface;
use Rx\Event\Event;

/**
 * Class PipeHttpResponse
 * @package Rx\Observer
 */
class PipeHttpResponseObserver implements ObserverInterface
{
    /**
     * @var HttpdResponse
     */
    protected $response;

    /**
     * PipeHttpResponse constructor.
     * @param HttpdResponse $response
     */
    public function __construct($response)
    {
        $this->response = $response;
    }

    /**
     * @param Event $event
     */
    public function onNext($event)
    {
        if($event instanceof ErrorEvent ){
            $this->response->sendError($event->getMessage(), $event->getCode());
            return;
        }

        $this->response->json($event);
    }
    /**
     * @param \Exception $e
     */
    public function onError(\Exception $e)
    {
        $this->response->sendError($e->getMessage(), $e->getCode() ? : 500);
    }

    /**
     *
     */
    public function onCompleted()
    {

    }
}