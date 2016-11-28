<?php     defined('C5_EXECUTE') or die("Access Denied."); ?>
	<div class="row">
		<div class="col-xs-12">
			<div class="form-group">
				<?php     echo $form->label('title', t('Title'));?>
				<?php     echo $form->text('title', $title?$title:t("Restricted Entry"));?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="form-group">
				<?php     echo $form->label('copy', t('Title'));?>
				<?php     echo $form->textarea('copy', $copy?$copy:t("You must be 18 years of age or older to view this page."));?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="form-group">
				<?php      echo $form->label('minAge', t('Minimum Age'));?>
				<div class="input-group">        
					<?php     echo $form->number('minAge', $minAge?$minAge:"18", array('min'=>10, 'max'=>200)); ?>
					<div class="input-group-addon"><?php   echo t('Years')?></div>
				</div>
			</div>
		</div>
	</div>
<div class="row">
	<div class="col-xs-12">
		<div class="form-group">
			<?php    echo $form->label('linkType', t('Redirect Link'))?>
			<select name="linkType" data-select="feature-link-type" class="form-control">
				<option value="0" <?php    echo (empty($extLink) && empty($pageID) ? 'selected="selected"' : '')?>><?php    echo t('None')?></option>
				<option value="1" <?php    echo (empty($extLink) && !empty($pageID) ? 'selected="selected"' : '')?>><?php    echo t('Another Page')?></option>
				<option value="2" <?php    echo (!empty($extLink) ? 'selected="selected"' : '')?>><?php    echo t('External URL')?></option>
			</select>
		</div>
		<div data-select-contents="feature-link-type-internal" style="display: none;" class="form-group">
			<?php    echo $form->label('pageID', t('Choose Page:'))?>
			<?php    echo Core::make('helper/form/page_selector')->selectPage('pageID', $pageID); ?>
		</div>
		<div data-select-contents="feature-link-type-external" style="display: none;" class="form-group">
			<?php    echo $form->label('extLink', t('URL'))?>
			<?php    echo $form->url('extLink', $extLink); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="form-group">
			<?php    echo $form->label('linkType', t('Redirect on Fail Link'))?>
			<select name="failLinkType" data-select="fail-link-type" class="form-control">
				<option value="0" <?php    echo (empty($failextLink) && empty($failpageID) ? 'selected="selected"' : '')?>><?php    echo t('None')?></option>
				<option value="1" <?php    echo (empty($failextLink) && !empty($failpageID) ? 'selected="selected"' : '')?>><?php    echo t('Another Page')?></option>
				<option value="2" <?php    echo (!empty($failextLink) ? 'selected="selected"' : '')?>><?php    echo t('External URL')?></option>
			</select>
		</div>
		<div data-select-contents="fail-link-type-internal" style="display: none;" class="form-group">
			<?php    echo $form->label('failpageID', t('Choose Page:'))?>
			<?php    echo Core::make('helper/form/page_selector')->selectPage('failpageID', $failpageID); ?>
		</div>
		<div data-select-contents="fail-link-type-external" style="display: none;" class="form-group">
			<?php    echo $form->label('failextLink', t('URL'))?>
			<?php    echo $form->url('failextLink', $failextLink); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="form-group">
			<p><input type="checkbox" name="checkAge" value="1" <?php   if ($checkAge == 1) { ?> checked <?php   } ?>  /> <?php   echo t('Show check age link');?></p>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function() {
	$('select[data-select=feature-link-type]').on('change', function() {
	   if ($(this).val() == '0') {
	       $('div[data-select-contents=feature-link-type-internal]').hide();
	       $('div[data-select-contents=feature-link-type-external]').hide();
	   }
	   if ($(this).val() == '1') {
	       $('div[data-select-contents=feature-link-type-internal]').show();
	       $('div[data-select-contents=feature-link-type-external]').hide();
	   }
	   if ($(this).val() == '2') {
	       $('div[data-select-contents=feature-link-type-internal]').hide();
	       $('div[data-select-contents=feature-link-type-external]').show();
	   }
	}).trigger('change');
});
$(function() {
	$('select[data-select=fail-link-type]').on('change', function() {
	   if ($(this).val() == '0') {
	       $('div[data-select-contents=fail-link-type-internal]').hide();
	       $('div[data-select-contents=fail-link-type-external]').hide();
	   }
	   if ($(this).val() == '1') {
	       $('div[data-select-contents=fail-link-type-internal]').show();
	       $('div[data-select-contents=fail-link-type-external]').hide();
	   }
	   if ($(this).val() == '2') {
	       $('div[data-select-contents=fail-link-type-internal]').hide();
	       $('div[data-select-contents=fail-link-type-external]').show();
	   }
	}).trigger('change');
});
</script>