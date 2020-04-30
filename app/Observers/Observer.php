<?php

namespace App\Observers;
use App\Events\StockDisponible;

class Observer
{
    public function notificacion( )
    {
            $mensaje = "as";
            event(new StockDisponible( $mensaje));
    }


}
