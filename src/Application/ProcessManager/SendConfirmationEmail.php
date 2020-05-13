<?php

namespace Booking\Application\ProcessManager;

use Booking\Domain\Event\BookingWasCreated;
use Booking\Integration\NotificationService\Command\SendEmail;
use Booking\Integration\NotificationService\Domain\Email;
use Symfony\Component\Messenger\MessageBusInterface;

class SendConfirmationEmail
{
    /**
     * @var MessageBusInterface
     */
    private $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(BookingWasCreated $event): void
    {
        $email = $this->buildEmailForBooking($event->getBookingId());

        $this->commandBus->dispatch(new SendEmail($email));
    }

    private function buildEmailForBooking(string $bookingId): Email
    {
        return new Email();
    }
}