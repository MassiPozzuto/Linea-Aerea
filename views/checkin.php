<?php
function generarCodigoAleatorio()
{
	$letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Caracteres de letras
	$numeros = '0123456789'; // Caracteres de números

	$codigo = '';

	// Genera 2 letras aleatorias
	for ($i = 0; $i < 2; $i++) {
		$codigo .= $letras[rand(0, strlen($letras) - 1)];
	}

	// Genera 2 números aleatorios
	for ($i = 0; $i < 2; $i++) {
		$codigo .= $numeros[rand(0, strlen($numeros) - 1)];
	}

	// Genera 2 letras aleatorias
	for ($i = 0; $i < 2; $i++) {
		$codigo .= $letras[rand(0, strlen($letras) - 1)];
	}

	// Mezcla los caracteres aleatoriamente
	$codigo = str_shuffle($codigo);

	return $codigo;
}
$codigoAleatorio = generarCodigoAleatorio();

// Realiza la consulta SQL para obtener los datos del vuelo
$vueloId = $_POST['vueloid']; // Reemplaza 75 con el ID del vuelo que deseas mostrar
$dni = $_POST['dni'];
$sqlVuelo = "SELECT v.*, p.*, u.* ,a_origen.nombre AS nombre_origen, a_destino.nombre AS nombre_destino
FROM vuelos v
INNER JOIN aeropuertos a_origen ON v.id_aero_origen = a_origen.id
INNER JOIN aeropuertos a_destino ON v.id_aero_destino = a_destino.id
INNER JOIN pasajes p ON v.id = p.id_vuelo
INNER JOIN usuarios u ON p.id_usuario = u.id
WHERE v.id = ? AND u.dni = ?";

$params = array($vueloId, $dni);

$options = array("Scrollable" => SQLSRV_CURSOR_STATIC);

try {
	$stmtVuelo = sqlsrv_query($conn, $sqlVuelo, $params, $options);

	// Verifica si se encontró el registro
	if ($stmtVuelo && sqlsrv_has_rows($stmtVuelo)) {
		$rowVuelo = sqlsrv_fetch_array($stmtVuelo, SQLSRV_FETCH_ASSOC);
		$aeropuertoOrigen = $rowVuelo['nombre_origen'];
		$aeropuertoDestino = $rowVuelo['nombre_destino'];
		$fechaSalida = $rowVuelo['fecha_partida'];
		$fechaLlegada = $rowVuelo['fecha_arribo']; // Agrega la columna de fecha de llegada
		$clase = $rowVuelo['clase'];
		$nombre = $rowVuelo['nombre'];
		$apellido = $rowVuelo['apellido'];
		$id = $rowVuelo['id_vuelo'];
		$origen = $rowVuelo['id_aero_origen'];
		$destino = $rowVuelo['id_aero_destino'];
		// Resto del código...
	} else {

		echo "<script>
		alert('Check-in no encontrado');
		window.location.replace(
			'http://localhost/Linea-Aerea/controllers/home.php?activeTab=checkin',
		  );
		</script>";

		
	}
} catch (Exception $e) {
	die("Error en la consulta de vuelo: " . $e->getMessage());
}

// Realiza la consulta SQL para obtener los datos del aeropuerto de destino
$aeropuertoDestinoId = $destino; // Reemplaza 2 con el ID del aeropuerto de destino que deseas mostrar
$sqlAeropuertoDestino = "SELECT * FROM Aeropuertos WHERE id = ?";
$aeropuertoPartidaId = $origen; // Reemplaza 2 con el ID del aeropuerto de destino que deseas mostrar
$sqlAeropuertoPartida = "SELECT * FROM Aeropuertos WHERE id = ?";
$params = array($aeropuertoDestinoId);
$params1 = array($aeropuertoPartidaId);
$options = array("Scrollable" => SQLSRV_CURSOR_STATIC);

try {
	$stmtAeropuertoDestino = sqlsrv_query($conn, $sqlAeropuertoDestino, $params, $options);
	$stmtAeropuertoPartida = sqlsrv_query($conn, $sqlAeropuertoPartida, $params1, $options);
	// Verifica si se encontró el registro
	if ($stmtAeropuertoDestino && sqlsrv_has_rows($stmtAeropuertoDestino)) {
		$rowAeropuertoDestino = sqlsrv_fetch_array($stmtAeropuertoDestino, SQLSRV_FETCH_ASSOC);
		$nombreAeropuertoDestino = $rowAeropuertoDestino['CUA'];
	} else {
		echo "No se encontraron registros del aeropuerto de destino.";
	}
	if ($stmtAeropuertoPartida && sqlsrv_has_rows($stmtAeropuertoPartida)) {
		$rowAeropuertoPartida = sqlsrv_fetch_array($stmtAeropuertoPartida, SQLSRV_FETCH_ASSOC);
		$nombreAeropuertoPartida = $rowAeropuertoPartida['CUA'];
	} else {
		echo "No se encontraron registros del aeropuerto de destino.";
	}
} catch (Exception $e) {
	die("Error en la consulta del aeropuerto de destino: " . $e->getMessage());
}
?>
<div class="wrap" data-pos="0">
	<div class="headbar">
		<i class="zmdi zmdi-arrow-left btnBack"></i> <span>Check in</span>
	</div>
	<div class="header">
		<div class="bg"></div>
		<div class="filter"></div>
		<div class="title">
			<div class="fromPlace">
			<?php echo $nombreAeropuertoPartida ?>
			</div>
			<span class="separator"><i class="zmdi zmdi-airplane"></i></span>
			<div class="toPlace">
			<?php echo $nombreAeropuertoDestino ?>
			</div>
		</div>
		<div class="map"></div>
	</div>

	<div class="content">
		<section>
			<div class="form">
				<div class="control select">
					<div class="control-head">
						<i class="zmdi zmdi-flight-takeoff"></i>
						<span class="close"><i class="zmdi zmdi-close"></i></span>
						<div>
							<h6>Desde</h6>
							<span class="airport-name" data-role="from" style="font-size:14px;"><?php echo utf8_encode($aeropuertoOrigen) ?></span>
						</div>
					</div>
					<div class="control-body">
						<ul class="select-index"></ul>
						<div class="nano">
							<div class="nano-content">
								<ul class="select-data"></ul>
							</div>
						</div>
					</div>
				</div>
				<div class="control select">
					<div class="control-head">
						<i class="zmdi zmdi-flight-land"></i>
						<span class="close"><i class="zmdi zmdi-close"></i></span>
						<div>
							<h6>A aeropuerto</h6>
							<span class="airport-name" data-role="to" style="font-size:14px;"><?php echo utf8_encode($aeropuertoDestino) ?></span>
						</div>
					</div>
					<div class="control-body">
						<ul class="select-index"></ul>
						<div class="nano">
							<div class="nano-content">
								<ul class="select-data"></ul>
							</div>
						</div>
					</div>
				</div>
				<div class="control dateinput" style="height: 155px;">
					<div class="control-head">
						<i class="zmdi zmdi-calendar"></i>
						<span class="close"><i class="zmdi zmdi-close"></i></span>
						<div class="control-item">
							<h6>Fecha de salida</h6>
							<span><?php echo date_format($fechaSalida, "d/m/Y H:i:s") ?></span>
						</div>
						<div class="control-item">
							<h6>Fecha de llegada</h6>
							<span><?php echo date_format($fechaLlegada, "d/m/Y H:i:s") ?></span> <!--Quitar si no se selecciona-->
						</div>
					</div>
					<div class="control-body">
						<div class="info-message">
							<i class="zmdi zmdi-info"></i>
							<!-- <span>Select the depar date then the return date if you need a round trip ticket</span> -->

						</div>

					</div>
				</div>

				<div class="control radio">
					<i class="zmdi zmdi-airline-seat-recline-extra"></i>
					<div class="control-item">
						<h6 style="margin-bottom: 8px">Clase</h6>
						<label>
							<input type="radio" name="seat" value="Economy" checked="checked">
							<span><?php echo utf8_encode($clase) ?></span>
						</label>
					</div>
				</div>
				<div class="control control2">
					Nombre: <h6> <?php echo utf8_encode($nombre . " " . $apellido) ?></h6>
				</div>
				<div class="control control2">

					Codigo:<h2 class="embarco" style="font-size:30px; margin-top:12px;"><?php echo "L" . ($id * 3) . "R"  ?></h2>
				</div>
				<div class="control control2">
					Puerta de embarco: <h2 class="embarco"><?php echo "A" . rand(1, 10) ?></h2>
				</div>
			</div>
			<div class="list">
				<div class="nano">
					<div class="nano-content">

					</div>
				</div>
			</div>

			<div class="ticket">
				<section>

				</section>
				<button class="btnBook">BOOK FLIGHT</button>
				<!-- <button class="btnHome">BACK TO HOME</button> -->
				<div class="loader">Loading...</div>
			</div>

		</section>
	</div>

</div>