<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>


<script type="text/javascript">
	function buscarusuario(ci) {
		if (ci.length > 4) {
			url = '<?= base_url(Hasher::make(29)) ?>';
			$.post(url, {
				ci_persona: ci
			}, function(data) {
				datos = JSON.parse(data);
				console.log(datos);
				if (typeof datos.ci != 'undefined') {
					$('#message').empty();
					var cadena = (datos.nombre);
					var fecha = (datos.fecha_nac);
					$('#first_name').val(datos.nombre);
					$('#last_name').val(datos.paterno + ' ' + datos.materno);
					$('#persona_id').val(datos.persona_id);
					$('#identity').val(cadena.split(' ')[0] + '_' + datos.ci);
					$('#company').val('SuYay inscripciones');
					$('#email').val(cadena.split(' ')[0] + '_' + datos.ci + '@upea.bo');
					$('#phone').val(datos.telefono);
					$('#password').val(fecha.replace(/^(\d{4})-(\d{2})-(\d{2})$/g, '$3-$2-$1'));
					$('#password_confirm').val(fecha.replace(/^(\d{4})-(\d{2})-(\d{2})$/g, '$3-$2-$1'));
				} else {
					$('#message').empty();
					$('#message').append('Persona no encontrada.');
				}
			});

		}

	}
</script>


<div class="row">
	<div class="col-lg-12">
		<?php echo form_open(current_url()); ?>
		<div class="row d-flex">
			<div class="col-lg-4">
				<label class="col-form-label">Buscar por Nr. Ci</label>
				<div class="form-group has-success">
					<label for="exampleInput2" class="bmd-label-floating">Nr. Ci</label>
					<input type="text" class="form-control" autocomplete="" id="ci_persona" name="ci_persona" onkeyup="buscarusuario(this.value)">
					<input type="hidden" class="form-control" id="persona_id" name="persona_id" value="">
					<div>
						<p id="message" class="text-danger" style="font-weight: 500;font-size: .8rem;"></p>
					</div>
				</div>
			</div>
		</div>
		<div class="row">

			<div class="col-lg-4">
				<?php echo form_label('{lang_first_name}', 'first_name'); ?>
				<?php echo form_input($first_name); ?>
			</div>
			<div class="col-lg-8">
				<?php echo form_label('{lang_last_name}', 'last_name'); ?>
				<?php echo form_input($last_name); ?>
			</div>

		</div>

		<div class="row">
			<div class="col-lg-12 mt-3">
				<?php
				if ($identity_column !== 'email') {
					echo '<p>';
					echo lang('create_user_identity_label', 'identity');
					echo '<br />';
					echo form_error('identity');
					echo form_input($identity);
					echo '</p>';
				}
				?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					<?php echo form_label('{lang_company_name}', 'company'); ?>
					<?php echo form_input($company); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<?php echo form_label('{lang_email}', 'email'); ?>
				<?php echo form_input($email); ?>
			</div>
			<div class="col-md-6">
				<?php echo form_label('{lang_phone}', 'phone'); ?>
				<?php echo form_input($phone); ?>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-lg-6">
				<?php echo form_label('{lang_password}', 'password'); ?>
				<?php echo form_input($password); ?>
			</div>
			<div class="col-lg-6">
				<?php echo form_label('{lang_password_confirm}', 'password_confirm'); ?>
				<?php echo form_input($password_confirm); ?>
			</div>
		</div>
		<div class="form-group">
			<?php echo form_submit('submit', '{lang_create}', array('class' => 'btn btn-primary')); ?>
			<?php echo anchor(base_url(Hasher::make(21)), '{lang_cancel}', array('class' => 'btn btn-primary')); ?>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>

<div class="row">
	<div class="col-12">
		{message}
	</div>
</div>