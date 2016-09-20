function common_delete(primary_id,url){

    if(!primary_id){
        alert('No Activity ID found');
        return false;
    }
    var confirmme = confirm('Are you sure you want to delete this record');

    if(confirmme){
        var request_url = url;
        console.log(request_url);
        jQuery.ajax({

            'url'       : request_url,
            'action'    : 'POST',
            'data'      : {primery_id:primary_id},
            'success'   : function(result){

                location.reload();
            },
            'error'     : function(){
                console.log('Some error occurred');
            }
        });
    }
}


function f_delete(primary_id,url){
    if(!primary_id){
        alert('No Activity ID found');
        return false;
    }
    var confirmme = confirm('Are you sure you want to delete this record');

    if(confirmme){
        var request_url = url;
        console.log('hi');
        console.log(request_url);
        jQuery.ajax({

            'url'       : request_url,
            'action'    : 'POST',
            'data'      : {primery_id:primary_id},
            'success'   : function(result){

                location.reload();
            },
            'error'     : function(){
                console.log('Some error occurred');
            }
        });
    }
}



$(function() {
   
    // Clear event
    $('.cat-image .image-preview-clear').click(function(){
        //$('.image-preview').attr("data-content","").popover('hide');
        $('.cat-image .image-preview-filename').val("");
        $('.cat-image .image-preview-clear').hide();
        $('.cat-image .image-preview-input input:file').val("");
        $(".cat-image .image-preview-input-title").text("Browse"); 
    }); 
    // Create the preview image
    $(".cat-image .image-preview-input input:file").change(function (){     
             
        var file = this.files;
        var filename = file[0].name;
        for (var i = 1; i < file.length; i++) {
            filename = filename + ', ' + file[i].name;
        };
        $(".cat-image .image-preview-input-title").text("Change");
            $(".cat-image .image-preview-clear").show();
            $(".cat-image .image-preview-filename").val(filename); 
        
    });  


    // Clear event
    $('.cat-icon .image-preview-clear').click(function(){
        //$('.image-preview').attr("data-content","").popover('hide');
        $('.cat-icon .image-preview-filename').val("");
        $('.cat-icon .image-preview-clear').hide();
        $('.cat-icon .image-preview-input input:file').val("");
        $(".cat-icon .image-preview-input-title").text("Browse"); 
    }); 
    // Create the preview image
    $(".cat-icon .image-preview-input input:file").change(function (){     
             
        var file = this.files;
        var filename = file[0].name;
        for (var i = 1; i < file.length; i++) {
            filename = filename + ', ' + file[i].name;
        };
        $(".cat-icon .image-preview-input-title").text("Change");
            $(".cat-icon .image-preview-clear").show();
            $(".cat-icon .image-preview-filename").val(filename); 
        
    });  


    // Clear event
    $('.pro-icon .image-preview-clear').click(function(){
        //$('.image-preview').attr("data-content","").popover('hide');
        $('.pro-icon .image-preview-filename').val("");
        $('.pro-icon .image-preview-clear').hide();
        $('.pro-icon .image-preview-input input:file').val("");
        $(".pro-icon .image-preview-input-title").text("Browse"); 
    }); 
    // Create the preview image
    $(".pro-icon .image-preview-input input:file").change(function (){     
             
        var file = this.files;
        var filename = file[0].name;
        for (var i = 1; i < file.length; i++) {
            filename = filename + ', ' + file[i].name;
        };
        $(".pro-icon .image-preview-input-title").text("Change");
            $(".pro-icon .image-preview-clear").show();
            $(".pro-icon .image-preview-filename").val(filename); 
        
    });  
});

$(document).ready(function(){
    //FANCYBOX
    //https://github.com/fancyapps/fancyBox
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});
   
$(function () {
    $(document).on("click",".img-radio",function(e) {
        $('.img-radio').not(this).css('opacity','0.5')
            .siblings('input').prop('checked',false);
        $(this).css('opacity','1')
            .siblings('input').prop('checked',true);
    });
});