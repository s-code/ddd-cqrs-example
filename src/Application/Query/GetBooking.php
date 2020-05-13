<?php

namespace Booking\Application\Query;

class GetBooking implements QueryInterface
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