$(document).ready(function () {

    $('input.tableflat').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });

    $('.deleteUser, .deleteChuong, .deleteNews, .deleteChi, .deleteDiem, .deleteTile,.deleteLich,.deleteUpdate').click(function(){
    	var url = $(this).attr('url');
    	var id = $(this).attr('data-id');
		var data = {
            id: id
        };

        $.post(url, data, function (response) {
        	if (response) {
        		location.reload();
        	}
        })
    });
    $('.deleteGiong, .deleteChuong').click(function(){
        var url = $(this).attr('url');
        var id = $(this).attr('data-id');
        var data = {
            id: id
        };

        $.post(url, data, function (response) {
            if (response != 1){
                alert(response);
            }else{
                location.reload();
            }
        })
    });

    $('*').delegate("a.bo-delete-g-photo",'click',function(){
        var img_remove = $(this).parent().find('.box-select-primary').attr('data-primary');
        $('.image-remove').append('<input type="hidden" value="'+img_remove+'" name="list_image_remove[]"/>');
        var item_map_remove = $(this).parent().attr("id");
        $('.show-primary-image .'+item_map_remove).remove();
        $(this).parent().remove();
        if($(this).parent().find('.box-select-primary').hasClass('box-select-primary-selected') == true){
            resetBackgroundThumbnail();
            resetCoordinatesPrimary();
            resetItemOnMap();
            $(".box-show-primary-image").html('');
        }
        var number_img = $('.bo-gallery-block').length;
        if(number_img == 0){
            disabledVideoControl(false);
            $(".show-primary-image").css('display','none');
        }
    });

    $("#addEditCalendar").click(function(event){
        var target = $(event.target);
        if(!target.is('#cross')){
            noSelectItemMap();
        }
    });

    $('.btn-cancel-upload-img').click(function(){
        $(this).css("display","none");
        $('.cropControlReset').trigger('click');
    });
});

function resetCoordinatesPrimary(){
    $('.pos-x').each(function(){
        $(this).val(-1);
    });
    $('.pos-y').each(function(){
        $(this).val(-1);
    });
    $('.pos-primary').each(function(){
        $(this).val(0);
    });
}

function resetBackgroundThumbnail(){
    $('.bo-gallery-block .center-block').each(function(){
        $(this).css('background-color','#FFF');
    });
}

function resetItemOnMap(){
    $('.show-primary-image .item-map').each(function(){
        $(this).removeClass('item-map-selected').css('display','none');
    });
}

function noSelectItemMap(){
    $('.item-map-selected').removeClass('item-map-selected');
    $('.bo-gallery-block-selected').removeClass('bo-gallery-block-selected');
    $('.img-thumbnail').each(function(){
        $(this).css('background-color','#FFF');
    });
}

function disabledUploadImage(bool){
    if(bool==true){
        $("#croppic-upload").addClass('croppic-upload-remove');
    }else{
        $("#croppic-upload").removeClass('croppic-upload-remove');
    }
}

function disabledVideoControl(bool){
    if(bool==true){
        $('#croppic-upload_videos, #video_url, #video_desc').attr('disabled','disabled');
    }else{
        $('#croppic-upload_videos, #video_url, #video_desc').removeAttr('disabled');
    }
}

$('.orderStatus').change(function() {
    var id = $(this).attr('data-id');
    var status = $(this).val();
    var url = '/backend/ajax/update-order-status';
    var data = {
        id: id,
        status: status
    }

    $.post(url, data, function (response) {
        if (response) {
            location.reload();
        }
    })
})