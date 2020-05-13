<?php

namespace Booking\Application\Command;

class CreateBooking implements CommandInterface
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