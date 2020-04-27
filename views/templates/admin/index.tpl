<form method="post">
<div class="panel">
	<div class="panel-heading">
		{l s="Settings" mod="ps_multipurpose"}
	</div>
	<div class="panel-body">
		<div class="form-group">
			<label for="ps_multipurpose_title">{l s="Title" mod="ps_multipurpose"}</label>
			<input type="text" name="ps_multipurpose_title" id="ps_multipurpose_title" value="{$ps_multipurpose_title}">
		</div>
	</div>
	<div class="panel-footer">
		<button type="submit" name="ps_multipurpose_setting_save" class="btn btn-sn btn-primary pull-right"><i class="process-icon-save"></i> {l s="Save" mod="ps_multipurpose"}</button>
	</div>
</div>
</form>