<?php
namespace Shtechnologyx\Pt3\Controller\pdfs;
class InterpretadorGananciasPerdidas {
    private $frases = [
        'inicio' => [
            'ganancia' => "En {mes}, se obtuvo una ganancia de ",
            'perdida' => "En {mes}, hubo una pérdida de ",
        ],
        'causasPosibles' => [
            'altaGanancia' => "Este buen resultado podría deberse a un aumento en las ventas o a una optimización en costos.",
            'bajaDemanda' => "Esta pérdida puede haber sido causada por una baja demanda o una sobreproducción.",
            'excesoInventario' => "Es posible que esta pérdida se deba a un exceso de inventario o a productos vencidos.",
            'temporadaBaja' => "Esta pérdida puede ser resultado de una temporada baja para el mercado."
        ],
        'valoresAltos' => [
            'mesMayorGanancia' => "El mes con mayor ganancia fue {mes}, con un total de ",
            'mesMayorPerdida' => "El mes con mayor pérdida fue {mes}, alcanzando una pérdida de "
        ],
        'promedio' => [
            'superaPromedio' => "El mes de {mes} superó el promedio de ganancias, con un total de ",
            'bajoPromedio' => "El mes de {mes} estuvo significativamente por debajo del promedio, con una pérdida de "
        ]
    ];

    private $frases2 = [
        'inicio' => [
            'ganancia' => "En la semana {semana}, se obtuvo una ganancia de ",
            'perdida' => "En la semana {semana}, hubo una pérdida de ",
        ],
        'causasPosibles' => [
            'altaGanancia' => "Este buen resultado podría deberse a un aumento en las ventas o a una optimización en costos.",
            'bajaDemanda' => "Esta pérdida puede haber sido causada por una baja demanda o una sobreproducción.",
            'excesoInventario' => "Es posible que esta pérdida se deba a un exceso de inventario o a productos vencidos.",
            'temporadaBaja' => "Esta pérdida puede ser resultado de una temporada baja para el mercado."
        ],
        'valoresAltos' => [
            'semanaMayorGanancia' => "La semana con mayor ganancia fue la {semana}, con un total de ",
            'semanaMayorPerdida' => "La semana con mayor pérdida fue la {semana}, alcanzando una pérdida de "
        ],
        'promedio' => [
            'superaPromedio' => "La semana {semana} superó el promedio de ganancias, con un total de ",
            'bajoPromedio' => "La semana {semana} estuvo significativamente por debajo del promedio, con una pérdida de "
        ]
    ];

    public function interpretarMes($mes, $monto) {
        $interpretacion = "";

        if ($monto >= 0) {
            $interpretacion .= str_replace('{mes}', $mes, $this->frases['inicio']['ganancia']) . "Bs " . number_format($monto, 2) . ". ";
            $interpretacion .= $monto > 1000 ? $this->frases['causasPosibles']['altaGanancia'] : "";
        } else {
            $interpretacion .= str_replace('{mes}', $mes, $this->frases['inicio']['perdida']) . "Bs " . number_format(abs($monto), 2) . ". ";
            if ($monto < -500) {
                $interpretacion .= $this->frases['causasPosibles']['excesoInventario'];
            } else {
                $interpretacion .= $this->frases['causasPosibles']['bajaDemanda'];
            }
        }

        return $interpretacion;
    }

    public function calcularPromedio($meses) {
        $total = array_sum($meses);
        $numMeses = count($meses);
        return $numMeses > 0 ? $total / $numMeses : 0;
    }

    public function interpretarPromedio($meses) {
        $promedio = $this->calcularPromedio($meses);
        $interpretacion = "El promedio de ganancias/pérdidas para este periodo fue de Bs " . number_format($promedio, 2) . ".\n";
        
        // foreach ($meses as $mes => $monto) {
        //     if ($monto > $promedio) {
        //         $interpretacion .= str_replace('{mes}', $mes, $this->frases['promedio']['superaPromedio']) . "$" . number_format($monto, 2) . ".\n";
        //     } elseif ($monto < $promedio) {
        //         $interpretacion .= str_replace('{mes}', $mes, $this->frases['promedio']['bajoPromedio']) . "$" . number_format(abs($monto), 2) . ".\n";
        //     }
        // }

        return $interpretacion;
    }

    public function interpretarAnual($meses) {
        $interpretacion = "";
        $mesMayorGanancia = '';
        $mayorGanancia = PHP_INT_MIN;
        $mesMayorPerdida = '';
        $mayorPerdida = PHP_INT_MAX;

        // Identificar el mes con mayor ganancia y mayor pérdida
        foreach ($meses as $mes => $monto) {
            if ($monto > $mayorGanancia) {
                $mayorGanancia = $monto;
                $mesMayorGanancia = $mes;
            }
            if ($monto < $mayorPerdida) {
                $mayorPerdida = $monto;
                $mesMayorPerdida = $mes;
            }

        }

        // Interpretación del mes con mayor ganancia
        if ($mayorGanancia > 0) {
            $interpretacion .= str_replace('{mes}', $mesMayorGanancia, $this->frases['valoresAltos']['mesMayorGanancia']) . "Bs " . number_format($mayorGanancia, 2) . ".\n";
        }

        // Interpretación del mes con mayor pérdida
        if ($mayorPerdida < 0) {
            $interpretacion .= str_replace('{mes}', $mesMayorPerdida, $this->frases['valoresAltos']['mesMayorPerdida']) . "Bs " . number_format(abs($mayorPerdida), 2);
        }

        // Agregar interpretación del promedio
        $interpretacion .= "\n" . $this->interpretarPromedio($meses);

        return $interpretacion;
    }



    public function interpretarSemana($semana, $monto) {
        $interpretacion = "";
    
        if ($monto >= 0) {
            $interpretacion .= str_replace('{semana}', $semana, $this->frases2['inicio']['ganancia']) . "Bs " . number_format($monto, 2) . ". ";
            $interpretacion .= $monto > 1000 ? $this->frases2['causasPosibles']['altaGanancia'] : "";
        } else {
            $interpretacion .= str_replace('{semana}', $semana, $this->frases2['inicio']['perdida']) . "Bs " . number_format(abs($monto), 2) . ". ";
            if ($monto < -500) {
                $interpretacion .= $this->frases2['causasPosibles']['excesoInventario'];
            } else {
                $interpretacion .= $this->frases2['causasPosibles']['bajaDemanda'];
            }
        }
    
        return $interpretacion;
    }
    
    public function interpretarSemanalmente($semanas) {
        $interpretacion = "";
        $semanaMayorGanancia = '';
        $mayorGanancia = PHP_INT_MIN;
        $semanaMayorPerdida = '';
        $mayorPerdida = PHP_INT_MAX;
    
        // Identificar la semana con mayor ganancia y mayor pérdida
        foreach ($semanas as $semana => $monto) {
            if ($monto > $mayorGanancia) {
                $mayorGanancia = $monto;
                $semanaMayorGanancia = $semana;
            }
            if ($monto < $mayorPerdida) {
                $mayorPerdida = $monto;
                $semanaMayorPerdida = $semana;
            }
        }
    
        // Interpretación de la semana con mayor ganancia
        if ($mayorGanancia > 0) {
            $interpretacion .= str_replace('{semana}', $semanaMayorGanancia, $this->frases2['valoresAltos']['semanaMayorGanancia']) . "Bs " . number_format($mayorGanancia, 2) . ".\n";
        }
    
        // Interpretación de la semana con mayor pérdida
        if ($mayorPerdida < 0) {
            $interpretacion .= str_replace('{semana}', $semanaMayorPerdida, $this->frases2['valoresAltos']['semanaMayorPerdida']) . "Bs " . number_format(abs($mayorPerdida), 2);
        }
    
        // Agregar interpretación del promedio
        $interpretacion .= "\n" . $this->interpretarPromedio($semanas);
    
        return $interpretacion;
    }
    
    public function interpretarPromedioSemana($semanas) {
        $promedio = $this->calcularPromedio($semanas);
        $interpretacion = "El promedio de ganancias/pérdidas para este periodo fue de Bs " . number_format($promedio, 2) . ".\n";
        
        foreach ($semanas as $semana => $monto) {
            if ($monto > $promedio) {
                $interpretacion .= str_replace('{semana}', $semana, $this->frases2['promedio']['superaPromedio']) . "Bs " . number_format($monto, 2) . ".\n";
            } elseif ($monto < $promedio) {
                $interpretacion .= str_replace('{semana}', $semana, $this->frases2['promedio']['bajoPromedio']) . "Bs " . number_format(abs($monto), 2) . ".\n";
            }
        }
    
        return $interpretacion;
    }
    
}