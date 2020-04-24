<?php

namespace App\Observers;
use App\Events\StockDisponible;
use App\conferencia;

class Observer
{

    public function notificacion(conferencia $conferencia)
    {
        $mensaje="soy el mensaje ok bebe";
        event(new StockDisponible( $mensaje));

    }


}
