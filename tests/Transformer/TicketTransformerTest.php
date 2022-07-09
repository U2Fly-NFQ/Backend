<?php

namespace App\Tests\Transformer;

use App\Entity\Account;
use App\Entity\Discount;
use App\Entity\Passenger;
use App\Entity\SeatType;
use App\Entity\Ticket;
use App\Transformer\FlightTransformer;
use App\Transformer\PassengerTransformer;
use App\Transformer\TicketFlightTransformer;
use App\Transformer\TicketTransformer;
use DateTime;
use JetBrains\PhpStorm\ArrayShape;
use PHPUnit\Framework\TestCase;

class TicketTransformerTest extends TestCase
{
    /**
     * @dataProvider getTicketDataProvider
     * @return void
     */
    public function testToArray($param): void
    {
        $ticketTransformer = $this->createTicketTransformer();
        $result = $ticketTransformer->toArray($param);
        $this->assertIsArray($result);
    }

    /**
     * @dataProvider getListTicketDataProvider
     * @return void
     */
    public function testToArrayList($param): void
    {
        $ticketTransformer = $this->createTicketTransformer();
        $result = $ticketTransformer->toArrayList($param);
        $this->assertIsArray($result);
    }


    /**
     * @return \App\Entity\Ticket[][][]
     */
    #[ArrayShape(['happy-case-1' => "\App\Entity\Ticket[][]"])]
    public function getListTicketDataProvider()
    {
        $ticket1 = $this->createTicket(1);
        $ticket2 = $this->createTicket(2);
        $listTickets = [$ticket1,$ticket2];

        return [
            'happy-case-1'=> [
                'param'=>$listTickets
            ]
        ];
    }

    /**
     * @return \App\Entity\Ticket[][]
     */
    #[ArrayShape(['happy-case-1' => "\App\Entity\Ticket[]"])]
    public function getTicketDataProvider(): array
    {
        $ticket = $this->createTicket();

        return [
            'happy-case-1'=> [
                'param'=>$ticket
            ]
        ];
    }

    /**
     * @return TicketTransformer
     */
    private function createTicketTransformer(): TicketTransformer
    {
        $passengerTransformer = $this->getMockBuilder(PassengerTransformer::class)->disableOriginalConstructor()->getMock();
        $flightTransformer = $this->getMockBuilder(FlightTransformer::class)->disableOriginalConstructor()->getMock();
        $ticketFlightTransformer = $this->getMockBuilder(TicketFlightTransformer::class)->disableOriginalConstructor()->getMock();
        return new TicketTransformer($passengerTransformer, $flightTransformer, $ticketFlightTransformer);
    }

    /**
     * @param int $id
     * @return Ticket
     */
    private function createTicket(int $id = 1): Ticket
    {

        $passenger = new Passenger();
        $account = $this->getMockBuilder(Account::class)->disableOriginalConstructor()->getMock();
        $account->expects($this->any())->method('getEmail')->willReturn('sang@nfq.asia');
        $passenger->setAccount($account);
        $discount = new Discount();
        $seatType = new SeatType();
        $seatType->setName('business');
        $passenger->setId('1');
        $ticket = new Ticket();
        $ticket->setId($id);
        $ticket->setStatus(0);
        $ticket->setDiscount($discount);
        $ticket->setPassenger($passenger);
        $ticket->setPaymentId('s231');
        $ticket->setSeatType($seatType);
        $ticket->setStatus(1);
        $date = new DateTime();
        $ticket->setUpdatedAt($date);

        return $ticket;
    }
}
