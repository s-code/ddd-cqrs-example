<?php

namespace Booking\Cli;

use Booking\Application\Query\GetBooking;
use SCode\AmqpExtraBundle\Stamp\ReplyReceiverStamp;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class SendQueryCommand extends Command
{
    protected static $defaultName = 'app:send-query';

    /**
     * @var MessageBusInterface
     */
    private $queryBus;

    public function __construct(MessageBusInterface $queryBus, string $name = null)
    {
        parent::__construct($name);

        $this->queryBus = $queryBus;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $envelop = $this->queryBus->dispatch(new GetBooking('123'));

        /** @var ReplyReceiverStamp $stamp */
        $stamp = $envelop->last(ReplyReceiverStamp::class);
        $envelop = $stamp->getReceiver()();
        var_dump($envelop->getMessage());

        return 0;
    }
}
