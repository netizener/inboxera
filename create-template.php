<?php include('includes/header.php');?>
<?php include('includes/login/auth.php');?>
<?php include('includes/templates/main.php');?>
<?php 
	//IDs
	$aid = isset($_GET['i']) && is_numeric($_GET['i']) ? get_app_info('app') : exit;
	
	if(get_app_info('is_sub_user')) 
	{
		if(get_app_info('app')!=get_app_info('restricted_to_app'))
		{
			echo '<script type="text/javascript">window.location="'.addslashes(get_app_info('path')).'/templates?i='.get_app_info('restricted_to_app').'"</script>';
			exit;
		}
	}
?>

<script src="<?php echo get_app_info('path');?>/js/ckeditor/ckeditor.js?8"></script>
<?php $dark_mode = get_app_info('dark_mode');?>
<?php include('js/create/editor.php');?>

<!-- Validation -->
<script type="text/javascript" src="<?php echo get_app_info('path');?>/js/validate.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#edit-form").validate({
			rules: {
				template_name: {
					required: true	
				},
				html: {
					required: true
				}
			},
			messages: {
				template_name: "<?php echo addslashes(_('The name of this template is required'));?>",
				html: "<?php echo addslashes(_('Your HTML code is required'));?>"
			}
		});
		$("#template_name").focus();
	});
</script>

<div class="row-fluid">
    <div class="span2">
        <?php include('includes/sidebar.php');?>
    </div> 
    
    <div class="span10">
	    <div class="row-fluid">
		    <div class="span10">
			    <div>
			    	<p class="lead">
		    	<?php if(get_app_info('is_sub_user')):?>
			    	<?php echo get_app_data('app_name');?>
		    	<?php else:?>
			    	<a href="<?php echo get_app_info('path'); ?>/edit-brand?i=<?php echo get_app_info('app');?>" data-placement="right" title="<?php echo _('Edit brand settings');?>"><?php echo get_app_data('app_name');?> <span class="icon icon-pencil top-brand-pencil"></span></a>
		    	<?php endif;?>
		    </p>
		    	</div>
		    	<h2><?php echo _('Create template');?></h2><br/>
		    </div>
	    </div>
	    
	    <div class="row-fluid">
		    		    
	    	<form action="<?php echo get_app_info('path')?>/includes/templates/save-template.php?i=<?php echo get_app_info('app')?>" method="POST" accept-charset="utf-8" class="form-vertical" id="edit-form">
		    	
		    	<div class="span3" style="width:100%;">
			        <label class="control-label" for="template_name"><?php echo _('Template name');?></label>
			    	<div class="control-group">
				    	<div class="controls">
			              <input type="text" class="input-xlarge" id="template_name" name="template_name" placeholder="<?php echo _('Name of this template');?>">
			            </div>
			        </div>
			        
			        <label class="control-label" for="plain"><?php echo _('Plain text version');?></label>
		            <div class="control-group">
				    	<div class="controls">
			              <textarea class="input-xlarge" id="plain" name="plain" rows="10" placeholder="<?php echo _('Plain text version of this template');?>"></textarea>
			            </div>
			        </div>
			        <script src="https://editor.unlayer.com/embed.js"></script>

			        <div id="editor">
			    
		    	</div>
		   
			        <button type="submit" class="btn btn-inverse" id="save-button"><i class="icon-ok icon-white"></i> <?php echo _('Save template');?></button>
			    </div>
		    				    
			    
		    </form>
		    
	    </div>
	</div>
</div>
<script>
  unlayer.createEditor({
    id: 'editor',
    projectId: 8942,
    displayMode: 'email'
  })

unlayer.addEventListener('design:updated', function(updates) {
  // Design is updated by the user
  
  unlayer.exportHtml(function(data) {
    var json = data.design; // design json
    var html = data.html; // design html

    // Save the json, or html here
  })
})
</script>
<?php include('includes/footer.php');?>
