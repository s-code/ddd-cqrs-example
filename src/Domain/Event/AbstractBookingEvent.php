<?php

namespace Booking\Domain\Event;

abstract class AbstractBookingEvent implements EventInterface
{
    /**
     * @var string
     */
    private $bookingId;

    public function __construct(string $bookingId)
    {
        $this->bookingId = $bookingId;
    }

    public function getBookingId(): string
    {
        return $this->bookingId;
    }
}