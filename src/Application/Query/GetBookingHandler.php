<?php

namespace Booking\Application\Query;

class GetBookingHandler
{
    public function __invoke(GetBooking $query): array
    {
        //@todo implement fetching data from read model

        return [
            'bookingId' => $query->getBookingId()
        ];
    }
}