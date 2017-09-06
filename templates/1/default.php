<!DOCTYPE html>
<html lang="en">
<head>
	<title>Mercurio2</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		* {
			box-sizing: border-box;
		}

		/* Móviles primero: */
		[class*="col-"] {
			width: 100%;
		}

		[class*="col-"] {
			float: left;
		}

		.row::after {
			content: "";
			clear: both;
			display: table;
		}

		html {
			font-family: "Helvetica","Tahoma","Geneva","Arial",sans-serif;
			color: #949494;
		}

		h2,h3{
			color:#012B03;
			margin: 8px;
		}

		.footer {
			background-color: #EEE;
			color: #000;
			text-align: center;
			font-size: 12px;
			padding: 15px;
			margin: 10px auto;
		}
		.anagrama{
			background-image: url('img/anagrama_s.png');
			width:275px;
			height: 139px;
			margin: 0 auto;
		}
		.imagen{
			max-width:100%;
			height:auto;
			border:1px solid red;
		}
		.centro{
			text-align: center;
		}

		@media only screen and (min-width: 600px) {
			/*tablets: */
			.col-m-1 {width: 8.33%;}
			.col-m-2 {width: 16.66%;}
			.col-m-3 {width: 25%;}
			.col-m-4 {width: 33.33%;}
			.col-m-5 {width: 41.66%;}
			.col-m-6 {width: 50%;}
			.col-m-7 {width: 58.33%;}
			.col-m-8 {width: 66.66%;}
			.col-m-9 {width: 75%;}
			.col-m-10 {width: 83.33%;}
			.col-m-11 {width: 91.66%;}
			.col-m-12 {width: 100%;}
		}

		@media only screen and (min-width: 768px) {
			/*desktop: */
			.col-1 {width: 8.33%;}
			.col-2 {width: 16.66%;}
			.col-3 {width: 25%;}
			.col-4 {width: 33.33%;}
			.col-5 {width: 41.66%;}
			.col-6 {width: 50%;}
			.col-7 {width: 58.33%;}
			.col-8 {width: 66.66%;}
			.col-9 {width: 75%;}
			.col-10 {width: 83.33%;}
			.col-11 {width: 91.66%;}
			.col-12 {width: 100%;}
			.anagrama{
				background-image: url('img/anagrama_fcv.png');
				width:454px;
				height: 139px;
			}
			.contenido{
				width: 80%;
				margin: 0 auto;
				border: 1px solid red;
			}
		}
	</style>
</head>
<body>
	<div class="row">
		<div class="col-m-6 col-8">
			<div class="anagrama"></div>
		</div>
		<div class="col-m-6 col-4 centro">
			<h2>{Titulo}</h2>
			<h3>{SubTitulo}</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-12 centro"><img src="img/anagrama_Original.png" class="imagen" alt=""></div>
	</div>
	<div class="row">
		<div class="col-12 col-m-12">
			<div class="contenido">
				{eve_descripcion}
				{eve_objetivos}
				{eve_dirigido}
				{eve_duracion}
				{eve_lugar}
				{eve_fechasHorarios}
				{eve_costo}
				{registro}
				{eve_observaciones}
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem numquam, enim repellendus minima. Aspernatur animi perspiciatis, recusandae dicta maxime nesciunt odio repellendus laboriosam corporis nulla eveniet commodi, voluptates, modi, error!
			</div>
		</div>
	</div>

	<div class="footer">
		<p>Corporación Ecuatoriana Educativa Nueva Acrópolis</p>
		<p>Dirección: Murgeón Oe1-49 y Av. 10 de Agosto</p>
		<p>Teléfono: 02 2523 380 / 02 2233 817</p>
	</div>

</body>
</html>