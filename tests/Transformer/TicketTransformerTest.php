<?php

namespace App\Tests\Transformer;

use App\Entity\Flight;
use App\Entity\Passenger;
use App\Entity\Ticket;
use App\Transformer\FlightTransformer;
use App\Transformer\PassengerTransformer;
use App\Transformer\TicketTransformer;
use PHPUnit\Framework\TestCase;

class TicketTransformerTest extends TestCase
{
    /**
     * @dataProvider getFlightDataProvider
     * @return void
     */
    public function testGetFlight($param, $expected)
    {
        $ticketTransformer = $this->createTicketTransformer();
        $result = $ticketTransformer->toArray($param);
        $this->assertEquals($expected, $result);
    }

    public function getFlightDataProvider()
    {
        $passsenger = new Passenger();


        $ticket = new Ticket();
        $ticket->setId(1);
        $ticket->setStatus('0');
        $ticket->setDiscount(12);
        $ticket->setPassenger($passsenger);

        return [
            'happy-case-1'=> [
                'param'=>$ticket,
                'expected'=>[
                    'status'=>0,
                    'discount'=>12
                ]
            ]
        ];
    }

    private function createTicketTransformer()
    {
        $passengerTransformer = $this->getMockBuilder(PassengerTransformer::class)->disableOriginalConstructor()->getMock();
        $flightTransformer = $this->getMockBuilder(FlightTransformer::class)->disableOriginalConstructor()->getMock();
        $passenger = $this->getMockBuilder(Passenger::class)->disableOriginalConstructor()->getMock();
        $ticket = $this->getMockBuilder(Ticket::class)->disableOriginalConstructor()->getMock();

        return new TicketTransformer($passengerTransformer, $flightTransformer);
    }
}
