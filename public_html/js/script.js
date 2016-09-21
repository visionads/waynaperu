$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
/* affix the navbar after scroll below header */
$('#nav').affix({
    offset: {
        top: $('header').height() - $('#nav').height() + 100
    }
});
/* highlight the top nav as scrolling occurs */
$('body').scrollspy({
    target: '#nav'
})
/* smooth scrolling for scroll to top */
$('.scroll-top').click(function() {
    $('body,html').animate({
        scrollTop: 0
    }, 2000);
})
/* smooth scrolling for nav sections */
$('#nav .navbar-nav li>a').click(function() {
    var link = $(this).attr('href');
    var posi = $(link).offset().top;
    $('body,html').animate({
        scrollTop: posi
    }, 2000);
});
$(document).ready(function() {

    $('[data-toggle="tooltip"]').tooltip();
    $('.price-range li').on('click', function() {
        var min_price = $(this).data('minprice');
        var max_price = $(this).data('maxprice');

        if (min_price != '' || min_price == '0') {

            $('.p-r input#min-price').attr('name', 'min-price');
            $('.p-r input#min-price').val(min_price);
        }
        if (max_price != '') {
            $('.p-r input#max-price').attr('name', 'max-price');
            $('.p-r input#max-price').val(max_price);
        }else{
           $('.p-r input#max-price').attr('name', 'max-price');
            $('.p-r input#max-price').val("above");
        }
        $("#filter_form").submit();
    });
    $('.tags li').on('click', function() {
        var tag = $(this).data('tag');
        $('.tags input#tag').attr('name', 'tag');
        $('.tags input#tag').val(tag);
        $("#filter_form").submit();
    });
    $('.categoriess li').on('click', function() {
        var category = $(this).data('catid');
        $('.cats input#category').attr('name', 'category');
        $('.cats input#category').val(category);
        $("#filter_form").submit();
    });
    $('.distt li').on('click', function() {
        var distt = $(this).data('disttid');
        $('.distts input#disttid').attr('name', 'disttid');
        $('.distts input#disttid').val(distt);
        $("#filter_form").submit();
    });
     /*     Modals  */
      $('.launch-modal').on('click', function(e){
        e.preventDefault();
        $( '#' + $(this).data('modal-id') ).modal();
      });
       $('.like-icon').on('click', function(e){
        e.preventDefault();
        $( '#modal-wishlist').modal();
      });
       $('.like span').on('click', function(e){
        e.preventDefault();
        $( '#modal-wishlist').modal();
      });
   
        /*
            Form validation
        */
        $('.registration-form input[type="text"], .registration-form textarea').on('focus', function() {
          $(this).removeClass('input-error');
        });
        
        $('.registration-form').on('submit', function(e) {
          
          $(this).find('input[type="text"], textarea').each(function(){
            if( $(this).val() == "" ) {
              e.preventDefault();
              $(this).addClass('input-error');
            }
            else {
              $(this).removeClass('input-error');
            }
          });
          
        });
});

$(window).scroll(function() {

    if ($('body').height() <= ($(window).height() + $(window).scrollTop())) {

        $('a.tooltip-text').css('visibility', 'hidden');
        //$('.main_footer_section').show();
    } else {

        $('a.tooltip-text').css('visibility', 'visible');
        //$('.main_footer_section').hide();
    }

});



$(function() {
    jQuery("#result").on("click", function(e) {
        var $clicked = $(e.target);
        var $name = $clicked.html();
        var decoded = $("<div/>").html($name).text();
        //console.log($name);
        $('#q').val(decoded);
        $("#search_form").submit();
    });
    jQuery(document).on("click", function(e) {
        var $clicked = $(e.target);
        if (!$clicked.hasClass("search")) {
            jQuery("#result").fadeOut();
        }
    });
    $('#q').click(function() {
        jQuery("#result").fadeIn();
    });
});

// Carousel
$('#myCarousel').carousel({
    interval: 4000
});
// handles the carousel thumbnails
$('[id^=carousel-selector-]').click(function() {
    var id_selector = $(this).attr("id");
    var id = id_selector.substr(id_selector.length - 1);
    id = parseInt(id);
    $('#myCarousel').carousel(id);
    $('[id^=carousel-selector-]').removeClass('selected');
    $(this).addClass('selected');
});
// when the carousel slides, auto update
$('#myCarousel').on('slid', function(e) {
    var id = $('.item.active').data('slide-number');
    id = parseInt(id);
    $('[id^=carousel-selector-]').removeClass('selected');
    $('[id=carousel-selector-' + id + ']').addClass('selected');
});

$(document).ready(function() {
        // Cart Page
            jQuery('select.cart-selector').on('change', function() {
              console.log('entered');
              var new_qty       = this.value;
              var ex_qty        = $(this).parent().data('exqty');
              var totat_qty     = $(this).parent().data('totalqty');
              var product_type  = $(this).parent().data('product');
              var product_id    = $(this).parent().data('pid');
              var location_id   = $(this).parent().data('locid');
              updateQty(new_qty,ex_qty,totat_qty,product_type, product_id, location_id);
            });
     // Form Code
          jQuery('.btn-edit.btn-pdf').click(function(){
            jQuery(this).parent().next('p').children('input').removeClass('diasbled-field').removeAttr('disabled');
          });

          jQuery('.btn-edit.btn-mail,.btn-edit.btn-gift').click(function(){
            jQuery(this).parent().next('div').children('textarea').addClass('enabled').removeAttr('disabled');
          });

    // Accordion Page

    $(".accordion-toggle").click(function() {
        $(this).toggleClass("vp_collapse");
    });
    // Experience page location 
    $("select#basic").change(function() {
       var end = this.value;
        getLocData(end);
    });
    $('select#pdf-price, select#mail-price, select#gift-price').change(function() {
        if ($('select#basic').val() == '') {
            console.log('killbill');
        } else {
            var price1 = parseFloat($('#pdf-price').siblings('em').children('span').html()).toFixed(2);
            var price2 = parseFloat($('#mail-price').siblings('em').children('span').html()).toFixed(2);
            var price3 = parseFloat($('#gift-price').siblings('em').children('span').html()).toFixed(2);
            var pdf_count = $('#pdf-price').val();
            var mail_count = $('#mail-price').val();
            var gift_count = $('#gift-price').val();
            var total_count = parseInt(pdf_count) + parseInt(mail_count) + parseInt(gift_count);
            var total_price = (pdf_count * price1) + (mail_count * price2) + (gift_count * price3);
            $("form#product-add input#total_qty").val(total_count);
            $("form#product-add input#total_price").val(parseFloat(total_price).toFixed(2));
            $('h2.pricet').html('<span>Precio: S/.</span>' + parseFloat(total_price).toFixed(2));
            // console.log(pdf);
        }
    });
    $('a.back').click(function() {
        parent.history.back();
        return false;
    });
    $('form#product-add button.checkout-btn').on('click', function() {
        $("form#product-add input#type").val("checkout");
        $("form#product-add").submit();
    });
    $('form#product-add button.cart-btn').on('click', function() {
        $("form#product-add input#type").val("cart");
        $("form#product-add").submit();
    });
    jQuery(window).scroll(function(){ 
        if(jQuery(window).scrollTop() > 1 ){
          jQuery('.mobile-menu').addClass('second-sticky');
        }else{
          jQuery('.mobile-menu').removeClass('second-sticky');
        }
      });
});
/*
 jQuery(function() {
            var datepicker = jQuery('input.datepicker');
            if (datepicker.length > 0) {
              jQuery('.checkout_wrapper input.datepicker').datepicker({
                format: "dd/mm/yyyy",
                startDate: new Date()
              });
              jQuery('#home input.datepicker').datepicker({
                format: "dd/mm/yyyy",
                endDate: new Date()
              });
            }
});

// Add Email Field PDF Section (Checkout Page)
var ct = 1;

jQuery('.chk_button_sec .btn-send.btn-pdf').click(function(){
    total       = jQuery(this).data('total');
    count       = jQuery(this).data('count');
    console.log(total +'-'+count);
    count++;
    if(count <= total) {
        console.log('we can add block');
        jQuery(this).attr('data-count', count);
        console.log(jQuery(this).data('count'));
    } else {
        console.log('we cannot add block');
    }

    ct++;
    var con     =   jQuery(this).parents('.checkout_wrapper').attr('id', ct);
    var pid     =   jQuery(this).data('pid');
    var html    =   '<p>Correo a: <input name="email['+pid+'][]" type="text" value=""/></p>';
        html    +=  '<div class="checkout_form"><div class="field_row"><input class="datepicker" name="date['+pid+'][]" type="text" class="field1" placeholder="Fecha" /></div><div class="field_row"><input type="text" name="from['+pid+'][]" class="field12" placeholder="Para" /><input type="text" name="to['+pid+'][]" class="field12" placeholder="Por" /></div><div class="field_row"><textarea name="msg['+pid+'][]" placeholder="Mensaje personal"></textarea></div></div>';
    jQuery(this).parent().siblings(".append").append(html);

    var datepicker = jQuery('input.datepicker');
      jQuery('.checkout_wrapper#'+ct+' input.datepicker').datepicker({
        format: "dd/mm/yyyy",
        startDate: new Date()
      });
});
// Add Email Field MAIL Section(Checkout Page)
jQuery('.chk_button_sec .btn-send.btn-mail').click(function(){
    ct++;
    var con     =   jQuery(this).parents('.checkout_wrapper').attr('id', ct);
    var pid     =   jQuery(this).data('pid');
    var html    =   '<div class="form_listing"<<textarea rows="5" cols="30" name="giftAddress['+pid+'][]" class="disabled-field enabled"></textarea><div class="del_wrapper"><label>Tipo de Delivery:</label><div class="del_row1"><input type="radio" value="express" name="mailshipping['+pid+'][]" checked/><p><em>Express</em> <span>(X S/. )</span></p></div><div class="del_row1"><input type="radio" value="priority" name="mailshipping['+pid+'][]" /><p><em>Priority</em>  <span>(X S/. )</span></p></div></div></div>';

        html    +=  '<div class="checkout_form"><div class="field_row"><input class="datepicker" name="date['+pid+'][]" type="text" class="field1" placeholder="Fecha" /></div><div class="field_row"><input type="text" name="from['+pid+'][]" class="field12" placeholder="Para" /><input type="text" name="to['+pid+'][]" class="field12" placeholder="Por" /></div><div class="field_row"><textarea name="msg['+pid+'][]" placeholder="Mensaje personal"></textarea></div></div>';
    jQuery(this).parent().siblings(".append").append(html);

    var datepicker = jQuery('input.datepicker');
      jQuery('.checkout_wrapper#'+ct+' input.datepicker').datepicker({
        format: "dd/mm/yyyy",
        startDate: new Date()
      });
});
*/
$(document).ready(function(e) { 
    $(window).scroll(function(){ 
        if($(window).scrollTop() > 1 ){
            $('.mobile-menu').addClass('second-sticky');
        }else{
            $('.mobile-menu').removeClass('second-sticky');
        }
        
        
        if($(window).scrollTop() > 5 ){
            $('#top_head').addClass('desktop-sticky');
        }else{
            $('#top_head').removeClass('desktop-sticky');
        }
        
        
    });
    $("body").click(function(){
        $(".tooltip.in").hide();
    });

});

$(document).ready(function() {
    if( $.cookie('modalnewsletter') === undefined ) {
        $('form[name="newsletter"]').validate({
            highlight: function(element, errorClass, validClass) {
                $(element).parents('div.form-input-validate').removeClass('form-input-valid').addClass('form-input-error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('div.form-input-validate').removeClass('form-input-error').addClass('form-input-valid');
            },
            rules: {
                names: { required: true, minlength: 2 },
                email: { required: true, email: true },
                terms: { required: true },
            },
            messages: {
                names: {
                    required: 'Este campo es requerido',
                    minlength: 'Ingrese como mínimo 2 caracteres'
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

        $('button#gonewsletter').click(function (e) {
            e.preventDefault();

            var $form = $('form[name="newsletter"]');
            var $btn = $('button#gonewsletter');
            if( $form.valid() ) {
                $.ajax({
                    url: $form.attr('action'),
                    type: 'post',
                    dataType: 'json',
                    data: $form.serialize(),
                    beforeSend: function() {
                        $btn.button('loading');
                    },
                    success: function(response) {
                        if( response.status === 'failed' ) {
                            return alert(response.message);
                        }
                        $('#modal-newsletter').modal('hide');
                        $('#modal-newsletter-success').modal('show');
                    }
                }).always(function() {
                    $btn.button('reset');
                });
            }
        });

        $('#modal-newsletter').modal('show');
        $.cookie('modalnewsletter', true);        
    }
});

