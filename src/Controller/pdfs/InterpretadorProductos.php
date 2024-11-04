<?php
namespace Shtechnologyx\Pt3\Controller\pdfs;
class InterpretadorProductos
{
    private $frases = [
        'inicio' => "El producto {nombre} ha registrado una venta de {cantidad} unidades.",
        'masVendido' => "El producto más vendido del periodo es {nombre}, logrando un destacado total de {cantidad} unidades vendidas.",
        'menosVendido' => "El producto menos vendido es {nombre}, con solo {cantidad} unidades, lo cual indica una baja demanda en comparación con otros productos.",
        'promedio' => [
            'superaPromedio' => "El producto {nombre} ha superado el promedio de ventas, con un desempeño notable que refleja un interés alto por parte de los consumidores.",
            'bajoPromedio' => "El producto {nombre} ha estado por debajo del promedio de ventas, lo cual podría sugerir una oportunidad para mejorar su promoción o reconsiderar su oferta.",
            'cercaPromedio' => "El producto {nombre} ha tenido un desempeño cercano al promedio, manteniéndose en un nivel de ventas estable en comparación con otros productos.",
        ],
        'totalVentas' => "En total, se vendieron {totalVentas} unidades de todos los productos.",
        'observaciones' => [
            'excelenteRendimiento' => "El producto {nombre} ha demostrado un rendimiento sobresaliente, liderando en ventas con una diferencia significativa respecto a otros.",
            'posibleMejora' => "El producto {nombre} podría beneficiarse de una revisión estratégica, considerando que sus ventas han sido considerablemente menores."
        ]
    ];

    public function interpretarProducto($producto)
    {
        $nombre = $producto['nombre'];
        $cantidad = $producto['cantidad'];

        $interpretacion = str_replace(['{nombre}', '{cantidad}'], [$nombre, $cantidad], $this->frases['inicio']);

        return $interpretacion;
    }

    public function interpretarProductos($productos)
    {
        $interpretacion = "";
        $productoMasVendido = null;
        $productoMenosVendido = null;
        $mayorVenta = PHP_INT_MIN;
        $menorVenta = PHP_INT_MAX;
        $totalVentas = 0;

        foreach ($productos as $producto) {
            $nombre = $producto['nombre'];
            $cantidad = $producto['cantidad'];
            $totalVentas += $cantidad;

            if ($cantidad > $mayorVenta) {
                $mayorVenta = $cantidad;
                $productoMasVendido = $nombre;
            }
            if ($cantidad < $menorVenta) {
                $menorVenta = $cantidad;
                $productoMenosVendido = $nombre;
            }
        }

        $interpretacion .= str_replace('{totalVentas}', $totalVentas, $this->frases['totalVentas']) . "\n\n";

        if ($productoMasVendido) {
            $interpretacion .= str_replace(
                ['{nombre}', '{cantidad}'],
                [$productoMasVendido, $mayorVenta],
                $this->frases['masVendido']
            ) . "\n";
            $interpretacion .= str_replace(
                '{nombre}',
                $productoMasVendido,
                $this->frases['observaciones']['excelenteRendimiento']
            ) . "\n\n";
        }

        if ($productoMenosVendido) {
            $interpretacion .= str_replace(
                ['{nombre}', '{cantidad}'],
                [$productoMenosVendido, $menorVenta],
                $this->frases['menosVendido']
            ) . "\n";
            $interpretacion .= str_replace(
                '{nombre}',
                $productoMenosVendido,
                $this->frases['observaciones']['posibleMejora']
            ) . "\n\n";
        }

        return $interpretacion;
    }

    public function interpretarPromedio($productos)
    {
        $total = array_sum(array_column($productos, 'cantidad'));
        $numProductos = count($productos);
        $promedio = $numProductos > 0 ? $total / $numProductos : 0;

        $interpretacion = "El promedio de ventas fue de " . number_format($promedio, 2) . " unidades.\n\n";

        foreach ($productos as $producto) {
            $nombre = $producto['nombre'];
            $cantidad = $producto['cantidad'];

            if ($cantidad > $promedio) {
                $interpretacion .= str_replace(
                    '{nombre}',
                    $nombre,
                    $this->frases['promedio']['superaPromedio']
                ) . "\n\n";
            } elseif ($cantidad < $promedio) {
                $interpretacion .= str_replace(
                    '{nombre}',
                    $nombre,
                    $this->frases['promedio']['bajoPromedio']
                ) . "\n\n";
            } else {
                $interpretacion .= str_replace(
                    '{nombre}',
                    $nombre,
                    $this->frases['promedio']['cercaPromedio']
                ) . "\n\n";
            }
        }

        return $interpretacion;
    }
}
