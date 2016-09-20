function Shuffle(o) {
	for(var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
	return o;
};

$(document).ready(function() {
	var maxAttempt = 3;
	var rows = 4;
	var cols = 5;
	var images = [
		{ id: 1, src: '01.jpg' },
		{ id: 2, src: '02.jpg' },
		{ id: 3, src: '03.jpg' },
		{ id: 4, src: '04.jpg' },
		{ id: 5, src: '05.jpg' },
		{ id: 6, src: '06.jpg' },
		{ id: 7, src: '07.jpg' },
		{ id: 8, src: '08.jpg' },
		{ id: 9, src: '09.jpg' },
		{ id: 10, src: '10.jpg' },
	];

	// duplicate data
	var tmp = $.merge(images, images);

	// random data
	Shuffle(tmp);

	var $imagelist = $('ul#imagelist');
	var item = 0;
	for( var r = 1; r <= rows; r++ ) {
		for( var c = 1; c <= rows; c++ ) {
			var current = images[item];
			var elt = '<li data-id="'+ current.id +'">';
					elt+= '<img src="/campaigns/emprendeup/memorygame/img/game/'+ current.src +'" alt="'+ current.src +'">';
			    elt+= '</li>';

			$imagelist.append(elt);
			item++;
		}
	}

	var instantGame = {
		attempt: 1,
		first: 0,
		second: 0
	};
	$imagelist.find('li').click(function() {
		var $li = $(this);
		if( !$li.hasClass('selected') ) {
			$li.addClass('selected')
			$li.find('img').show();
			if( instantGame.first === 0 ) {
				instantGame.first = $li.data('id');	
			} else {
				instantGame.second = $li.data('id');	
			}
			if( instantGame.first > 0 && instantGame.second > 0 ) {
				if( instantGame.first === instantGame.second ) {
					instantGame = {
						attempt: 1,
						first: 0,
						second: 0
					};
					$('div#modal-ganaste').modal('show');
				} else {
					if( instantGame.attempt >= maxAttempt ) {
						instantGame = {
							attempt: 1,
							first: 0,
							second: 0
						};
						$('span.total-intentos').html(0);
						$('div#modal-no-ganaste').modal('show');
					} else {
						$('span.total-intentos').html(instantGame.attempt);
						$('div#modal-intentos').modal('show');
					}
					$imagelist.find('li').removeClass('selected');
				}
			}
		}
	});

	$('button#seguir-intentandox').click(function() {
		$('ul#imagelist').find('img').hide();
		instantGame.first = 0;
		instantGame.second = 0;
		instantGame.attempt = instantGame.attempt + 1;
	});

	// NOVEDADES
	$('form[name="mg-no-ganaste"]').validate({
		highlight: function(element, errorClass, validClass) {
		    $(element).parents('div.form-input-validate').removeClass('form-input-valid').addClass('form-input-error');
		},
		unhighlight: function(element, errorClass, validClass) {
		    $(element).parents('div.form-input-validate').removeClass('form-input-error').addClass('form-input-valid');
		},
		rules: {
		    email: { required: true, email: true },
		    terms: { required: true },
		},
		messages: {
		    email: {
		        required: 'Este campo es requerido',
		        email: 'Ingrese un email válido'
		    },
		    terms: {
		        required: 'Este campo es requerido'
		    }
		}
    });

	$('button#no-recibir-novedades').click(function() {
		window.location.reload();
	});

	$('button#recibir-novedades').click(function(e) {
        e.preventDefault();	
        var $form = $('form[name="mg-no-ganaste"]');
        var $btn = $(this);
        if( $form.valid() ) {
        	$btn.button('loading');
        	$form.submit();
        }
	});	

	// GANASTE
	$('form[name="mg-ganaste"]').validate({
		highlight: function(element, errorClass, validClass) {
		    $(element).parents('div.form-input-validate').removeClass('form-input-valid').addClass('form-input-error');
		},
		unhighlight: function(element, errorClass, validClass) {
		    $(element).parents('div.form-input-validate').removeClass('form-input-error').addClass('form-input-valid');
		},
		rules: {
			names: { required: true },
		    email: { required: true, email: true },
		    terms: { required: true },
		},
		messages: {
		    names: {
		        required: 'Este campo es requerido',
		        email: 'Ingres su nombre completo válido'
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
	$('button#no-recibir-descuento').click(function() {
		window.location.reload();
	});

	$('button#recibir-descuento').click(function(e) {
        e.preventDefault();	
        var $form = $('form[name="mg-ganaste"]');
        var $btn = $(this);
        if( $form.valid() ) {
        	$btn.button('loading');
        	$form.submit();
        }
	});	

});
