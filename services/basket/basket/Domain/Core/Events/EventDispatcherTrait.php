<?php

namespace GkBasket\Domain\Core\Events;

trait EventDispatcherTrait
{
    /** @var array|EventInterface[] */
    protected $events = [];

    /**
     * Dispatch event
     *
     * @param EventInterface $event
     */
    public function dispatch(EventInterface $event)
    {
        $this->events[] = $event;
    }

    /**
     * Returns events that needs to be dispatched
     *
     * @return array
     */
    public function getEvents(): array
    {
        return $this->events;
    }
}