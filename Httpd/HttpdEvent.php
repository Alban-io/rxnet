<?php
namespace Rx\Httpd;


use Rx\Event\Event;

class HttpdEvent extends Event
{
    /**
     * @return HttpdRequest
     */
    public function getRequest() {
        return $this->data['request'];
    }
    /**
     * @return HttpdResponse
     */
    public function getResponse() {
        return $this->data['response'];
    }
}