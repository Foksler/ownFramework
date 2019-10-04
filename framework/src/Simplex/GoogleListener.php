<?php

namespace App\Simplex;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
//use App\Simplex\ResponseEvent;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class GoogleListener implements EventSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return ['kernel.response' => 'onResponse'];
    }

    /**
     * @param ResponseEvent $event
     */
    public function onResponse(ResponseEvent $event)
    {
//        $response = $event->getControllerResult();
        $response = $event->getResponse();

        if ($response->isRedirection()
            || ($response->headers->has('Content-Type') && false === strpos($response->headers->get('Content-Type'), 'html'))
            || 'html' !== $event->getRequest()->getRequestFormat()
        ) {
            return;
        }

        $response->setContent($response->getContent() . '</br>GA CODE');
    }
}
