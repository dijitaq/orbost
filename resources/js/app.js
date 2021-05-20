require('./bootstrap');

jQuery('[data-toggle="off-canvas"]').on('click', function(e)
{
	e.stopPropagation();

  	if($(this).hasClass('is-activated')) {
    		jQuery('#off-canvas').foundation('close');

    		jQuery(this).removeClass('is-activated');

  	} else {
    		jQuery('#off-canvas').foundation('open');

    		jQuery(this).addClass('is-activated');
  	}
});

jQuery('#off-canvas').on('close.zf.offCanvas', function()
{
  	jQuery('[data-toggle="off-canvas"]').removeClass('is-activated');
});