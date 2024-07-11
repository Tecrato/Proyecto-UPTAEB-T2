CREATE VIEW
    `ingresos_mensuales` AS
SELECT
    coalesce(
        round(
            sum(
                case
                    when month (rv.fecha) = 1 then `p`.`monto`
                    else 0
                end
            ),
            2
        ),
        0
    ) AS `Enero`,
    coalesce(
        round(
            sum(
                case
                    when month (rv.fecha) = 2 then `p`.`monto`
                    else 0
                end
            ),
            2
        ),
        0
    ) AS `Febrero`,
    coalesce(
        round(
            sum(
                case
                    when month (rv.fecha) = 3 then `p`.`monto`
                    else 0
                end
            ),
            2
        ),
        0
    ) AS `Marzo`,
    coalesce(
        round(
            sum(
                case
                    when month (rv.fecha) = 4 then `p`.`monto`
                    else 0
                end
            ),
            2
        ),
        0
    ) AS `Abril`,
    coalesce(
        round(
            sum(
                case
                    when month (rv.fecha) = 5 then `p`.`monto`
                    else 0
                end
            ),
            2
        ),
        0
    ) AS `Mayo`,
    coalesce(
        round(
            sum(
                case
                    when month (rv.fecha) = 6 then `p`.`monto`
                    else 0
                end
            ),
            2
        ),
        0
    ) AS `Junio`,
    coalesce(
        round(
            sum(
                case
                    when month (rv.fecha) = 7 then `p`.`monto`
                    else 0
                end
            ),
            2
        ),
        0
    ) AS `Julio`,
    coalesce(
        round(
            sum(
                case
                    when month (rv.fecha) = 8 then `p`.`monto`
                    else 0
                end
            ),
            2
        ),
        0
    ) AS `Agosto`,
    coalesce(
        round(
            sum(
                case
                    when month (rv.fecha) = 9 then `p`.`monto`
                    else 0
                end
            ),
            2
        ),
        0
    ) AS `Septiembre`,
    coalesce(
        round(
            sum(
                case
                    when month (rv.fecha) = 10 then `p`.`monto`
                    else 0
                end
            ),
            2
        ),
        0
    ) AS `Octubre`,
    coalesce(
        round(
            sum(
                case
                    when month (rv.fecha) = 11 then `p`.`monto`
                    else 0
                end
            ),
            2
        ),
        0
    ) AS `Noviembre`,
    coalesce(
        round(
            sum(
                case
                    when month (rv.fecha) = 12 then `p`.`monto`
                    else 0
                end
            ),
            2
        ),
        0
    ) AS `Diciembre`
FROM
    `pagos` AS `p`
    INNER JOIN registro_ventas rv ON p.id_venta = rv.id
WHERE
    year (rv.fecha) = year (current_timestamp());