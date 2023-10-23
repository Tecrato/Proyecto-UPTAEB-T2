<?php
class Lote extends DB
{

	function search($id = null, $id_producto = null, $order = 'id DESC')
	{
		$query = "SELECT * FROM lotes";
		if ($id) {
			$query = $query . " WHERE id=$id";
		}
		if ($id_producto) {
			$query = $query . " WHERE id_producto=$id_producto";
		}
		$query = $query . " ORDER BY $order";

		return $this->conn->query($query);
	}

	function search_with_producto_and_proveedor($id_producto, $id_proveedor)
	{
		$query = "SELECT * FROM lotes WHERE id_producto=$id_producto AND id_proveedor=$id_proveedor";
		return $this->conn->query($query);
	}

	function search_proveedor_from_product($id_producto)
	{
		$query = "SELECT id_proveedor, (SELECT nombre FROM proveedores WHERE lotes.id_proveedor = id) AS proveedor FROM lotes WHERE id_producto = $id_producto GROUP BY id_proveedor";
		return $this->conn->query($query);
	}

	function search_modal_details($id_producto)
	{
		$query = "SELECT imagen,nombre,descripcion,(SELECT nombre FROM categoria WHERE productos.id_categoria = id) AS categoria,(SELECT SUM(restante) FROM lotes WHERE productos.id = id_producto GROUP BY id_producto) AS existencia,precio_venta FROM productos WHERE id = $id_producto";
		return $this->conn->query($query);
	}
	function agregar($id_producto, $id_proveedor, $cantidad, $fecha_c, $fecha_v, $precio_compra)
	{
		$query = "INSERT INTO lotes VALUES(null, $id_producto, $id_proveedor, $cantidad,'$fecha_c', '$fecha_v', $precio_compra, $cantidad)";

		$this->conn->query($query);
	}
	function descontar($id_producto, $cantidad)
	{

		$lotes = $this->search(null, $id_producto, 'fecha_vencimiento ASC');

		for ($i = 0; $cantidad > 0; $i++) {
			$lote = $lotes->fetch_assoc();
			if ($lote['restante'] > $cantidad) {
				$query = "UPDATE lotes SET restante=" . $lote['restante'] - $cantidad . " WHERE id=" . $lote['id'];
				$this->conn->query($query);
				$cantidad = 0;
			} else {
				$query = "UPDATE lotes SET restante=0 WHERE id=" . $lote['id'];
				$this->conn->query($query);
				$cantidad -= $lote['restante'];
			}
		}
	}
	function borrar($id_proveedor = False, $id_producto = False)
	{

		if ($id_proveedor) {
			$query = "DELETE FROM lotes WHERE id_proveedor=$id_proveedor";
		} elseif ($id_producto) {
			$query = "DELETE FROM lotes WHERE id_producto=$id_producto";
		} else {
			throw new Exception("Error, debe pasar el id de un proveedor o de un producto", 1);
		}

		$this->conn->query($query);
	}
}
