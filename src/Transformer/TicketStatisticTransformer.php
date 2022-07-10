<?php

namespace App\Transformer;

use App\Constant\DatetimeConstant;
use App\Entity\Airline;
use App\Entity\TicketsStatistic;
use App\Traits\DateTimeTrait;
use PHP_CodeSniffer\Tests\Core\Tokenizer\DoubleArrowTest;

class TicketStatisticTransformer extends AbstractTransformer
{
    const BASE_ATTRIBUTE = ['success', 'cancel', 'date'];
    use DateTimeTrait;

    /**
     * @param TicketsStatistic $object
     * @return array
     */
    public function toArrayList(array $ticketsStatistics): array
    {
        $data = [];
        foreach ($ticketsStatistics as $ticketsStatistic) {
            $data[] = $this->toArray($ticketsStatistic);
        }

        return $data;
    }

    public function toArray(TicketsStatistic $ticketsStatistic): array
    {
        $result = $this->transform($ticketsStatistic, self::BASE_ATTRIBUTE);
        $result['date'] = $this->dateTimeToDate($ticketsStatistic->getDate());
        return $result;
    }
}
