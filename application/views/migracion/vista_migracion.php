<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>


<div class="col-md-12">
	<div class="card text-center">
		<div class="card-block">
			<h2 class="card-title">{titulo}</h2>

			<div class="element-box">
				<div class="table-responsive">

					<!-- FORMULARIO PARA SOICITAR LA CARGA DEL EXCEL -->
					Selecciona el archivo a importar:
					<form name="importa" method="post" action="<?= site_url(Hasher::make(10)) ?>" enctype="multipart/form-data">
						<input type="file" name="excel" />
						<input type='submit' name='enviar' value="Importar" />
						<input type="hidden" value="upload" name="action" />
					</form>

				</div>
			</div>


		</div>
	</div>

</div>