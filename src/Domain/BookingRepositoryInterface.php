<?php

namespace Booking\Domain;

interface BookingRepositoryInterface
{
    public function save(Booking $booking): void;
}