<?php

namespace App\Tests\Service;

use App\Repository\DashboardRepository;

class DashboardServiceTest
{
    public function testGetDashboardData(){
        $dashboardRepository = $this->getMockBuilder(DashboardRepository::class)->disableOriginalConstructor()->getMock();
        $dashboardRepository->expects($this->any())->method('getAnalyzeOfRoute')->willReturn([$account]);
    }
}
