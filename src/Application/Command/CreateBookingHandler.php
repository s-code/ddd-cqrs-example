<?php

namespace Booking\Application\Command;

use Booking\Domain\Booking;
use Booking\Domain\BookingRepositoryInterface;

class CreateBookingHandler
{
    /**
     * @var BookingRepositoryInterface
     */
    private $repository;

    public function __construct(BookingRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateBooking $command): void
    {
        throw new \InvalidArgumentException();
        $booking = new Booking($command->getBookingId());

        $this->repository->save($booking);
    }
}