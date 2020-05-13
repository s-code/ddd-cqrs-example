<?php

namespace Booking\Domain;

use Booking\Domain\Event\AbstractBookingEvent;
use Booking\Domain\Event\BookingWasCreated;

class Booking
{
    /**
     * @var string
     */
    private $bookingId;

    /**
     * @var AbstractBookingEvent[]
     */
    private $events;

    public function __construct(string $bookingId)
    {
        $this->events[] = new BookingWasCreated($bookingId);

        //@todo replace by internal listeners
        $this->bookingId = $this->events[0]->getBookingId();
    }

    public function getBookingId(): string
    {
        return $this->bookingId;
    }

    public function popRecordedEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }
}