<?php

namespace App\Transformer;

use App\Constant\DatetimeConstant;
use App\Entity\Passenger;
use App\Entity\Ticket;
use App\Traits\DateTimeTrait;

class TicketTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['id', 'passenger', 'totalPrice', 'ticketOwner'];
    const FLIGHT_ATTRIBUTE = ['arrival', 'departure', 'startTime'];

    use DateTimeTrait;

    private PassengerTransformer $passengerTransformer;
    private FlightTransformer $flightTransformer;

    public function __construct(PassengerTransformer $passengerTransformer, FlightTransformer $flightTransformer)
    {
        $this->passengerTransformer = $passengerTransformer;
        $this->flightTransformer = $flightTransformer;
    }

    /**
     * @param array $tickets
     * @param array $param
     * @return array
     */
    public function toArrayList(array $tickets, array $param = []): array
    {
        $ticketList = [];
        foreach ($tickets as $ticket) {
            $ticketList[] = $this->toArray($ticket, $param);
        }

        return $ticketList;
    }

    /**
     * @param Ticket $ticket
     * @param array $param
     * @return array
     */
    public function toArray(Ticket $ticket, array $param = [])
    {
        $ticketArray = $this->transform($ticket, self::BASE_ATTRIBUTE);
        $ticketArray['id'] = $ticket->getId();
        $ticketArray['passenger'] = $this->passengerTransformer->toArray($ticket->getPassenger());
        $ticketArray['seatType'] = $ticket->getSeatType()->getName();
        $ticketArray['total price'] = $ticket->getTotalPrice();
        $ticketArray['payment id'] = $ticket->getPaymentId();
        if($ticket->getStatus()){
            $ticketArray['status'] = $ticket->getStatus();
        }
        if($ticket->getDiscount()){
            $ticketArray['discount'] = $ticket->getDiscount()->getId();
        }
        $ticketArray['createdAt'] = $ticket->getCreatedAt()->format(DatetimeConstant::DATETIME_DEFAULT);
        if ($ticket->getUpdatedAt()) {
            $ticketArray['updatedAt'] = $ticket->getUpdatedAt()->format(DatetimeConstant::DATETIME_DEFAULT);
        }
        if ($ticket->getStatus()) {
            $ticketArray['status'] = $ticket->getStatus();
        }
        $ticketArray['flights'] = $this->getFlights($ticket->getTicketFlights(), $param);

        return $ticketArray;
    }

    /**
     * @param $ticketFlights
     * @return array
     */
    private function getFlights($ticketFlights, array $param = []): array
    {
        $flights = [];
        foreach ($ticketFlights as $ticketFlight) {
            $flight = $ticketFlight->getFlight();
            if($flight->getStartDate() != $param['date']){
                $flights[] = $this->flightTransformer->toArray($ticketFlight->getFlight());
            } elseif ($flight->getStartDate() == $param['date'] && $flight->getStartTime() <= $param['time'] && !$param['effectiveness']){
                $flights[] = $this->flightTransformer->toArray($ticketFlight->getFlight());
            } elseif($flight->getStartDate() == $param['date'] && $flight->getStartTime() > $param['time'] && $param['effectiveness']){
                $flights[] = $this->flightTransformer->toArray($ticketFlight->getFlight());
            }
        }

        return $flights;
    }
}
