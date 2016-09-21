$(document).ready(function() {

	$('#video').YTPlayer({
	    fitToBackground: true,
	    videoId: 'x0e4unc8VmU'
	});

	$('form[name="waynaup"]').validate({
		highlight: function(element, errorClass, validClass) {
		    $(element).parents('div.form-input-validate').removeClass('form-input-valid').addClass('form-input-error');
		},
		unhighlight: function(element, errorClass, validClass) {
		    $(element).parents('div.form-input-validate').removeClass('form-input-error').addClass('form-input-valid');
		},
		rules: {
		    names: { required: true, minlength: 2 },
		    surname_father: { required: true, minlength: 2 },
		    phone: { required: true, minlength: 7 },
		    email: { required: true, email: true },
		    terms: { required: true },
		},
		messages: {
		    names: {
		        required: 'Este campo es requerido',
		        minlength: 'Ingrese como mínimo 2 caracteres'
		    },
		    surname_father: {
		        required: 'Este campo es requerido',
		        minlength: 'Ingrese como mí­nimo 2 caracteres'
		    },
		    email: {
		        required: 'Este campo es requerido',
		        email: 'Ingrese un email válido'
		    },
		    terms: {
		        required: 'Este campo es requerido'
		    }
		}
    });

    $('button#lestgo').click(function (e) {
        e.preventDefault();	
        var $form = $('form[name="waynaup"]');
        var $btn = $(this);
        if( $form.valid() ) {
        	$btn.button('loading');
        	$form.submit();
        }
    });
	
});
