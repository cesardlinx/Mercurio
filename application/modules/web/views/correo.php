<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?= $titulo ?></title>
	<style type="text/css">		
		body {
			font-family: helvetica;
		}

		h3 {
			color: crimson;
		}

		h4 {
			color: teal;
		}

		.contacto {
			margin-top: 10px;
			margin-bottom: 10px;
		}

		.contacto p{
			margin: 0;
		}

		footer {
			font-weight: bold;
		}

	</style>
</head>
<body>
	<h3><?= strtoupper($titulo) ?></h3>
	<p>Estimado/a <?= $nombre ?>:  Muchas gracias por contactarnos, a continuación describimos la información de tu interés.</p>

	<h4>Fechas y horarios a elección:</h4>
	
	<p><?= $horarios ?></p>

	<h4>Valor de la inversión:</h4>

	<p>Costo del Curso: $<?= $costo ?> (Precio incluido 12 % IVA)
	Incluye material, certificado de asistencia y coffee break. </p>
 
	<p>(Pregunte por nuestras opciones de pago)</p>
 
	<p>Aplica el 10% de descuento en su pago de contado mediante depósito o transferencia.</p>
	<ul>
		<li>Cupos limitados: Se tomarán reservas telefónicas, vía mail o personalmente en nuestra Sede Central.</li>
		<li>Se entregan certificados de asistencia</li>
		<li>Más de 29 años trabajando en capacitación y formación</li>
		<li>Miles de personas han pasado por nuestras aulas</li>
		<li>Contamos con parqueadero gratuito</li>		
	</ul>

	<p>Si este curso es de su interés le solicitamos complete la hoja de inscripción adjunta y la reenvíe a este mail. La reserva quedará confirmada una vez se cancele por lo menos el 25% del curso. </p>

	<div class="contacto">
		<p>Cordialmente,</p> 
		<p>Mariana Dueñas</p>
		<p>0958711817</p>
	</div> 

	<footer>Corporación Educativa Ecuatoriana Nueva Acrópolis	Teléfonos: (02) 2523 380 / (02) 2233 817 / 087 060 636 Murgeón Oe 1-49 y Av 10 de Agosto (una cuadra al sur de la Av. Mariana de Jesús)	<a href="http://www.acropolisecuador.org/">http://www.acropolisecuador.org/</a>	<a href="mailto:sedecentral@oinae.org">sedecentral@oinae.org</a></footer>

</body>
</html>