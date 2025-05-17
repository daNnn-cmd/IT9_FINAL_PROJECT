<?php

namespace App\Repositories\Interface;

interface ReservationRepositoryInterface
{
    public function getUnoccupiedRoom($request);

    public function countUnoccupiedRoom($request);
}
