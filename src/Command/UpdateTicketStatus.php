<?php

namespace App\Command;

use App\Repository\TicketRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:update-ticket-status',
    description: 'Update ticket status.',
    hidden: false,
    aliases: ['app:update-ticket-status']
)]
class UpdateTicketStatus extends Command
{
    private TicketRepository $ticketRepository;

    public function __construct(TicketRepository $ticketRepository, string $name = null)
    {
        parent::__construct($name);
        $this->ticketRepository = $ticketRepository;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->ticketRepository->updateTicketStatus();
        return Command::SUCCESS;
    }
}
