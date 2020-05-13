<?php

namespace Booking\Integration\NotificationService\Command;

use Booking\Domain\Event\EventInterface;
use Booking\Integration\NotificationService\Domain\Email;

class SendEmail implements EventInterface
{
    /**
     * @var Email
     */
    private $email;

    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }
}