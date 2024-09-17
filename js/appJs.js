// JavaScript Document
$(function(){
	// Initialize tabs
	$('[data-toggle="tabs"] a, .enable-tabs a').click(function(e){ e.preventDefault(); $(this).tab('show'); });

	// Initialize Tooltips
	$('[data-toggle="tooltip"], .enable-tooltip').tooltip({container: 'body', animation: false});

	// Initialize Popovers
	$('[data-toggle="popover"], .enable-popover').popover({container: 'body', animation: true});

	// Initialize single image lightbox
	$('[data-toggle="lightbox-image"]').magnificPopup({type: 'image', image: {titleSrc: 'title'}});
	
	// Initialize image gallery lightbox
	$('[data-toggle="lightbox-gallery"]').each(function(){
		$(this).magnificPopup({
			delegate: 'a.gallery-link',
			type: 'image',
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				arrowMarkup: '<button type="button" class="mfp-arrow mfp-arrow-%dir%" title="%title%"></button>',
				tPrev: 'Previous',
				tNext: 'Next',
				tCounter: '<span class="mfp-counter">%curr% / %total%</span>'
			},
			image: {titleSrc: 'title'}
		});
	});
	
	// Initialize Chosen
	$('.select-chosen').chosen({width: "100%"});

	// Initialize Select2
	$('.select-select2').select2();

	// Initialize Bootstrap Colorpicker
	$('.input-colorpicker').colorpicker({format: 'hex'});
	$('.input-colorpicker-rgba').colorpicker({format: 'rgba'});

	// Initialize Slider for Bootstrap
	$('.input-slider').slider();

	// Initialize Tags Input
	$('.input-tags').tagsInput({ width: 'auto', height: 'auto'});

	// Initialize Datepicker
	$('.input-datepicker, .input-daterange').datepicker({weekStart: 1});
	$('.input-datepicker-close').datepicker({weekStart: 1}).on('changeDate', function(e){ $(this).datepicker('hide'); });

	// Initialize Timepicker
	$('.input-timepicker').timepicker({minuteStep: 1,showSeconds: true,showMeridian: true});
	$('.input-timepicker24').timepicker({minuteStep: 1,showSeconds: true,showMeridian: false});

});