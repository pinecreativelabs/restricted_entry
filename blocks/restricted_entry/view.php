<?php     defined('C5_EXECUTE') or die("Access Denied.");
$linkURL = $controller->getLinkURL();
$failLinkURL = $controller->getFailLinkURL(); 
$c = Page::getCurrentPage();
if (is_object($c) && $c->isEditMode()) { 
//disable in edit mode
	echo '<style>.re_edit_disable{width:100%;min-height:20px;background:#999999;padding:10px;text-align:center;color:#fff}
	.re_disable.error{color:#cf0000} a:focus{outline:none!important;} </style>';?>
	<div class="re_edit_disable"><h4><?php   echo t('Restricted Entry is disabled in edit mode.')?></h4></div>
<?php   } else {
	if($checkAge == 1){ ?>
		<a id="re-<?php   echo $bID ?>" href="<?php   echo URL::page($c); ?>"><?php   echo t('Check My Age') ?></a>
	<?php   } ?>
<script type="text/javascript">
$(document).ready(function(){ 
	if(CCM_EDIT_MODE){
		return;
	}
	<?php   if($checkAge == 1){ ?>
	var minAge = $('select').val();
    $('select').on('change', function(){
    minAge = $(this).val(); 
    });
    $('#re-<?php   echo $bID ?>').on('click', function(){
        sessionStorage.clear();
        $.ageCheck({minAge: minAge});
    });
	<?php   } ?>
    $.ageCheck({
		"minAge": <?php   echo $minAge ?>,
		"title" : "<?php   echo $title ?>",
		"copy": "<?php   echo $copy ?>",
		"redirectTo": "<?php    echo $linkURL;?>",
		"redirectOnFail": "<?php   echo $failLinkURL ?>"
	});        
});  
</script>
<?php   } ?>