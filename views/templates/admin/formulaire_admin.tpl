
<div class="row">
	<div class="col-xs-12 col-md-5">
		<div class="panel clearfix">
			<div class="panel-heading">
				<i class="icon-user"></i>
				{$customer_info.customer_name}
				-
				<a href="mailto:test@test.com"><i class="icon-envelope"></i>
					test@test.com
				</a>
			</div>
			<div class="form-horizontal">
				<div class="row">
					<label class="control-label col-lg-5"><strong>Date de naissance</strong></label>
					<div class="col-lg-7">
						<p class="form-control-static">{$customer_info.date_naissance|date_format:"%d/%m/%Y"}</p>
					</div>
				</div>
				<div class="row">
					<label class="control-label col-lg-5"><strong>Poids</strong></label>
					<div class="col-lg-7">
						<p class="form-control-static">{$customer_info.poids}</p>
					</div>
				</div>
				<div class="row">
					<label class="control-label col-lg-5"><strong>Sexe</strong></label>
					<div class="col-lg-7">
						<p class="form-control-static">{$customer_info.sexe}</p>
					</div>
				</div>
				<div class="row">
					<label class="control-label col-lg-5"><strong>Allergie</strong></label>
					<div class="col-lg-7">
						<p class="form-control-static">{if $customer_info.allergie == 1}Oui{else}Non{/if}</p>
					</div>
				</div>
				<div class="row">
					<label class="control-label col-lg-5"><strong>Enceinte</strong></label>
					<div class="col-lg-7">
						<p class="form-control-static">{if $customer_info.enceinte == 1}Oui{else}Non{/if}</p>
					</div>
				</div>
				<div class="row">
					<label class="control-label col-lg-5"><strong>Allaite</strong></label>
					<div class="col-lg-7">
						<p class="form-control-static">{if $customer_info.allaite == 1}Oui{else}Non{/if}</p>
					</div>
				</div>
				<div class="row">
					<label class="control-label col-lg-5"><strong>Médicaments</strong></label>
					<div class="col-lg-7">
						<p class="form-control-static">{$customer_info.medicament_actuel}</p>
					</div>
				</div>
				<div class="row">
					<label class="control-label col-lg-5"><strong>Commentaires</strong></label>
					<div class="col-lg-7">
						<p class="form-control-static">{$customer_info.commentaires}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
