<?php

namespace App\Request;

class ListFlightRequest extends BaseRequest
{
    private string|null $arrival = null;
    private string|null $departure = null;
    private string|null $startTime = null;
    private string|null $startDate = null;
    private string|null $airplaneId = null;
    private string|null $airline = null;
    private string $seatType = 'Economy';
    private string|null $order = null;
    private float|null $minPrice = null;
    private float|null $maxPrice = null;
    private int $seatNumber = 1;
    private int $page = 1;
    private int $offset = 15;

    private string|null $arrivalRoundTrip = null;
    private string|null $departureRoundTrip = null;
    private string|null $startTimeRoundTrip = null;
    private string|null $startDateRoundTrip = null;
    private string|null $airplaneIdRoundTrip = null;
    private string|null $airlineRoundTrip = null;
    private string $seatTypeRoundTrip = 'Economy';
    private string|null $orderRoundTrip = null;
    private float|null $minPriceRoundTrip = null;
    private float|null $maxPriceRoundTrip = null;
    private int $seatNumberRoundTrip = 1;
    private int $pageRoundTrip = 1;
    private int $offsetRoundTrip = 15;

    /**
     * @return string|null
     */
    public function getArrival(): ?string
    {
        return $this->arrival;
    }

    /**
     * @param string|null $arrival
     */
    public function setArrival(?string $arrival): void
    {
        $this->arrival = $arrival;
    }

    /**
     * @return string|null
     */
    public function getDeparture(): ?string
    {
        return $this->departure;
    }

    /**
     * @param string|null $departure
     */
    public function setDeparture(?string $departure): void
    {
        $this->departure = $departure;
    }

    /**
     * @return string|null
     */
    public function getStartTime(): ?string
    {
        return $this->startTime;
    }

    /**
     * @param string|null $startTime
     */
    public function setStartTime(?string $startTime): void
    {
        $this->startTime = $startTime;
    }

    /**
     * @return string|null
     */
    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    /**
     * @param string|null $startDate
     */
    public function setStartDate(?string $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return string|null
     */
    public function getAirplaneId(): ?string
    {
        return $this->airplaneId;
    }

    /**
     * @param string|null $airplaneId
     */
    public function setAirplaneId(?string $airplaneId): void
    {
        $this->airplaneId = $airplaneId;
    }

    /**
     * @return string|null
     */
    public function getAirline(): ?string
    {
        return $this->airline;
    }

    /**
     * @param string|null $airline
     */
    public function setAirline(?string $airline): void
    {
        $this->airline = $airline;
    }

    /**
     * @return string
     */
    public function getSeatType(): string
    {
        return $this->seatType;
    }

    /**
     * @param string $seatType
     */
    public function setSeatType(string $seatType): void
    {
        $this->seatType = $seatType;
    }

    /**
     * @return string|null
     */
    public function getOrder(): ?string
    {
        return $this->order;
    }

    /**
     * @param string|null $order
     */
    public function setOrder(?string $order): void
    {
        $this->order = $order;
    }

    /**
     * @return float|null
     */
    public function getMinPrice(): ?float
    {
        return $this->minPrice;
    }

    /**
     * @param float|null $minPrice
     */
    public function setMinPrice(?float $minPrice): void
    {
        $this->minPrice = $minPrice;
    }

    /**
     * @return float|null
     */
    public function getMaxPrice(): ?float
    {
        return $this->maxPrice;
    }

    /**
     * @param float|null $maxPrice
     */
    public function setMaxPrice(?float $maxPrice): void
    {
        $this->maxPrice = $maxPrice;
    }

    /**
     * @return int
     */
    public function getSeatNumber(): int
    {
        return $this->seatNumber;
    }

    /**
     * @param int $seatNumber
     */
    public function setSeatNumber(int $seatNumber): void
    {
        $this->seatNumber = $seatNumber;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     */
    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    /**
     * @return string|null
     */
    public function getArrivalRoundTrip(): ?string
    {
        return $this->arrivalRoundTrip;
    }

    /**
     * @param string|null $arrivalRoundTrip
     */
    public function setArrivalRoundTrip(?string $arrivalRoundTrip): void
    {
        $this->arrivalRoundTrip = $arrivalRoundTrip;
    }

    /**
     * @return string|null
     */
    public function getDepartureRoundTrip(): ?string
    {
        return $this->departureRoundTrip;
    }

    /**
     * @param string|null $departureRoundTrip
     */
    public function setDepartureRoundTrip(?string $departureRoundTrip): void
    {
        $this->departureRoundTrip = $departureRoundTrip;
    }

    /**
     * @return string|null
     */
    public function getStartTimeRoundTrip(): ?string
    {
        return $this->startTimeRoundTrip;
    }

    /**
     * @param string|null $startTimeRoundTrip
     */
    public function setStartTimeRoundTrip(?string $startTimeRoundTrip): void
    {
        $this->startTimeRoundTrip = $startTimeRoundTrip;
    }

    /**
     * @return string|null
     */
    public function getStartDateRoundTrip(): ?string
    {
        return $this->startDateRoundTrip;
    }

    /**
     * @param string|null $startDateRoundTrip
     */
    public function setStartDateRoundTrip(?string $startDateRoundTrip): void
    {
        $this->startDateRoundTrip = $startDateRoundTrip;
    }

    /**
     * @return string|null
     */
    public function getAirplaneIdRoundTrip(): ?string
    {
        return $this->airplaneIdRoundTrip;
    }

    /**
     * @param string|null $airplaneIdRoundTrip
     */
    public function setAirplaneIdRoundTrip(?string $airplaneIdRoundTrip): void
    {
        $this->airplaneIdRoundTrip = $airplaneIdRoundTrip;
    }

    /**
     * @return string|null
     */
    public function getAirlineRoundTrip(): ?string
    {
        return $this->airlineRoundTrip;
    }

    /**
     * @param string|null $airlineRoundTrip
     */
    public function setAirlineRoundTrip(?string $airlineRoundTrip): void
    {
        $this->airlineRoundTrip = $airlineRoundTrip;
    }

    /**
     * @return string
     */
    public function getSeatTypeRoundTrip(): string
    {
        return $this->seatTypeRoundTrip;
    }

    /**
     * @param string $seatTypeRoundTrip
     */
    public function setSeatTypeRoundTrip(string $seatTypeRoundTrip): void
    {
        $this->seatTypeRoundTrip = $seatTypeRoundTrip;
    }

    /**
     * @return string|null
     */
    public function getOrderRoundTrip(): ?string
    {
        return $this->orderRoundTrip;
    }

    /**
     * @param string|null $orderRoundTrip
     */
    public function setOrderRoundTrip(?string $orderRoundTrip): void
    {
        $this->orderRoundTrip = $orderRoundTrip;
    }

    /**
     * @return float|null
     */
    public function getMinPriceRoundTrip(): ?float
    {
        return $this->minPriceRoundTrip;
    }

    /**
     * @param float|null $minPriceRoundTrip
     */
    public function setMinPriceRoundTrip(?float $minPriceRoundTrip): void
    {
        $this->minPriceRoundTrip = $minPriceRoundTrip;
    }

    /**
     * @return float|null
     */
    public function getMaxPriceRoundTrip(): ?float
    {
        return $this->maxPriceRoundTrip;
    }

    /**
     * @param float|null $maxPriceRoundTrip
     */
    public function setMaxPriceRoundTrip(?float $maxPriceRoundTrip): void
    {
        $this->maxPriceRoundTrip = $maxPriceRoundTrip;
    }

    /**
     * @return int
     */
    public function getSeatNumberRoundTrip(): int
    {
        return $this->seatNumberRoundTrip;
    }

    /**
     * @param int $seatNumberRoundTrip
     */
    public function setSeatNumberRoundTrip(int $seatNumberRoundTrip): void
    {
        $this->seatNumberRoundTrip = $seatNumberRoundTrip;
    }

    /**
     * @return int
     */
    public function getPageRoundTrip(): int
    {
        return $this->pageRoundTrip;
    }

    /**
     * @param int $pageRoundTrip
     */
    public function setPageRoundTrip(int $pageRoundTrip): void
    {
        $this->pageRoundTrip = $pageRoundTrip;
    }

    /**
     * @return int
     */
    public function getOffsetRoundTrip(): int
    {
        return $this->offsetRoundTrip;
    }

    /**
     * @param int $offsetRoundTrip
     */
    public function setOffsetRoundTrip(int $offsetRoundTrip): void
    {
        $this->offsetRoundTrip = $offsetRoundTrip;
    }


    public function splitOneWayAndRoundTrip(array $listFlightRequest)
    {
        $listFlightRequest['criteria']['oneway']['arrival'] = $this->getArrival();
        $listFlightRequest['criteria']['oneway']['departure'] = $this->getDeparture();
        $listFlightRequest['criteria']['oneway']['startTime'] = $this->getStartTime();
        $listFlightRequest['criteria']['oneway']['startDate'] = $this->getStartDate();
        $listFlightRequest['criteria']['oneway']['airline'] = $this->getAirline();
        $listFlightRequest['criteria']['oneway']['seatType'] = $this->getSeatType();
        $listFlightRequest['criteria']['oneway']['order'] = $this->getOrder();
        $listFlightRequest['criteria']['oneway']['minPrice'] = $this->getMinPrice();
        $listFlightRequest['criteria']['oneway']['maxPrice'] = $this->getMaxPrice();
        $listFlightRequest['criteria']['oneway']['seatNumber'] = $this->getSeatNumber();
        $listFlightRequest['criteria']['oneway']['page'] = $this->getPage();
        $listFlightRequest['criteria']['oneway']['offset'] = $this->getOffset();
        $listFlightRequest['criteria']['oneway']['offset'] = $this->getOffset();
        $listFlightRequest['criteria']['oneway']['pagination'] = [
            'page'=>$this->getPage(),
            'offset'=>$this->getOffset()
        ];


        $listFlightRequest['criteria']['roundtrip']['arrival'] = $this->getArrivalRoundTrip();
        $listFlightRequest['criteria']['roundtrip']['departure'] = $this->getDepartureRoundTrip();
        $listFlightRequest['criteria']['roundtrip']['startTime'] = $this->getStartTimeRoundTrip();
        $listFlightRequest['criteria']['roundtrip']['startDate'] = $this->getStartDateRoundTrip();
        $listFlightRequest['criteria']['roundtrip']['airline'] = $this->getAirlineRoundTrip();
        $listFlightRequest['criteria']['roundtrip']['seatType'] = $this->getSeatTypeRoundTrip();
        $listFlightRequest['criteria']['roundtrip']['order'] = $this->getOrderRoundTrip();
        $listFlightRequest['criteria']['roundtrip']['minPrice'] = $this->getMinPriceRoundTrip();
        $listFlightRequest['criteria']['roundtrip']['maxPrice'] = $this->getMaxPriceRoundTrip();
        $listFlightRequest['criteria']['roundtrip']['seatNumber'] = $this->getSeatNumberRoundTrip();
        $listFlightRequest['criteria']['roundtrip']['page'] = $this->getPageRoundTrip();
        $listFlightRequest['criteria']['roundtrip']['offset'] = $this->getOffsetRoundTrip();
        $listFlightRequest['criteria']['roundtrip']['pagination'] = [
            'page'=>$this->getPage(),
            'offset'=>$this->getOffset()
        ];

        $removeListFlightRequest = $listFlightRequest;
        $toRemove = ['oneway', 'roundtrip'];
        foreach ($toRemove as $key) {
            unset($removeListFlightRequest['criteria'][$key]);
        }
        foreach ($removeListFlightRequest['criteria'] as $key => $value) {
            unset($listFlightRequest['criteria'][$key]);
        }

        return $listFlightRequest;
    }
}
