<?php

namespace Booking\Infrastructure\Domain;

use Booking\Domain\Booking;
use Booking\Domain\BookingRepositoryInterface;
use Booking\Domain\Event\BookingWasCreated;
use Symfony\Component\Messenger\MessageBusInterface;

class BookingRepository implements BookingRepositoryInterface
{
    /**
     * @var MessageBusInterface
     */
    private $eventBus;

    public function __construct(MessageBusInterface $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function save(Booking $booking): void
    {
        //@todo save to DB

        foreach ($booking->popRecordedEvents() as $event) {
            $this->eventBus->dispatch($event);
        }
    }
}