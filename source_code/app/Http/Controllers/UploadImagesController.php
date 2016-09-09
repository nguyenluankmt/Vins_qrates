<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use File;
class UploadImagesController  extends  Controller{
    public static function motory_image_upload($crop_id, $crop_button_id, $post_id, $type, $name_input = '')
    {
        ob_start();
        if (!$post_id) {
            $post_id = 0;
        }
        if($type == "image1" || $type == "update"){
            $width_resize = 640;
            $height_resize = 320;
        }elseif ($type == 'image'){
            $width_resize = 630;
            $height_resize = 630;
        }else{
            $width_resize = 630;
            $height_resize = 630;
        }

        ?>
        <style>
            #croppicModalObj {
                direction: initial;
            }

            #<?php echo $crop_id; ?>, #croppic_edit {
                                          width: <?php echo $width_resize; ?>px; /* MANDATORY */
                                          height: <?php echo $height_resize; ?>px; /* MANDATORY */
                                          position: relative; /* MANDATORY */
                                          display: none;
                                      }

            <?php if ($type == 'thucan' || $type == 'videos'|| $type == 'thuoc'|| $type == 'image1' ): ?>
            #<?php echo $crop_button_id; ?> {
                border: none !important;
                overflow: hidden;
                position: absolute !important;
                bottom: 5px;
                right: 5px;
                height: 25px !important;
                font-size: 1rem;
                margin-bottom: 0;
                background: #d0021b;
                color: #FFFFFF;
                font-weight: bold;
                text-decoration: none;
                text-align: center;
                border-radius: 2px;
                display: inline-block;
                cursor: pointer;
                font-family: Roboto;
                width: 90px !important;
                line-height: 1.4 !important;
            }

            <?php endif; ?>


        </style>

        <script>
            <?php

            $upload_dir['path'] = 'uploads/calendar';
            ?>
            $(document).ready(function () {
                var ajaxurl = '/upload-image';
                var dealer = 0;
                var orientation = 0;
                var croppicHeaderOptions = {
                    cropData: {
                        //'_token': $('input[name="_token"]').val(),
                        "action": "crop_pic",
                        "post_id": "<?php echo $post_id; ?>",
                        "post_type": "<?php echo $type; ?>",
                        "dealer": dealer,
                        "name_input": "<?php echo $name_input ?>"

                    },
                    rotateFactor: 90,
                    cropUrl: ajaxurl,
                    customUploadButtonId: '<?php echo $crop_button_id; ?>',
                    modal: true,
                    enableMousescroll: true,
                    processInline: true,
                    loaderHtml: '<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
                    onBeforeImgUpload: function () {
                        $(".btn-cancel-upload-img").css("display", "block");
                        <?php if($type != "videos"): ?>$('.show-primary-image').css("display","block");<?php endif; ?>
                    },
                    onAfterImgUpload: function () {
                        var window_width = $(window).width();
                        if (window_width < 768) {
                             var image = new Image();
                             image.src = $(".cropImgWrapper img").attr('src');
                             image.onload = function () {
                                 EXIF.getData(image, function () {
                                     orientation = this.exifdata.Orientation;
                                    if (orientation == 8) {
                                         $('.cropControlRotateLeft').trigger('click');
                                     }
                                     else if (orientation == 6) {
                                         $('.cropControlRotateRight').trigger('click');
                                     }
                                     else if (orientation == 3) {
                                        $('.cropControlRotateLeft').trigger('click');
                                     $('.cropControlRotateLeft').trigger('click');
                                    }
                                 $('.cropControlCrop').trigger('click');
                             });
                             };
                        }
                    },
                    onImgDrag: function () {
                        //                    console.log('onImgDrag')
                    },
                    onImgZoom: function () {
                        //                    console.log('onImgZoom')
                    },
                    onBeforeImgCrop: function () {
                        //                    console.log('onBeforeImgCrop')
                    },
                    onAfterImgCrop: function () {
                        //alert('onAfterImgCrop');
                        $('#dealership-image').removeAttr("style");
                        $('span#error_dealer_image').removeAttr("style");
                        $('#dealership_photos').removeAttr("style");
                        $('span#error_dealership_photos').removeAttr("style");
                        $('.bo-gallery-upload').removeAttr("style");
                        $('span#error_vehicle_photos').removeAttr("style");
                        $('#dealership-photos-error').hide();
                        //                    $('#dealership-photos-check').val("true");
                        $("#dealership-photos").attr("name", "true");
                        $(".btn-cancel-upload-img").css("display", "none");
                    },
                    onError: function (errormessage) {
                        console.log('onError:' + errormessage)
                    }
                };
                new Croppic('<?php echo $crop_id; ?>', croppicHeaderOptions);

                $(document).on('click', '.bo-gallery-block a.edit', function () {

                    var parent_id = $(this).parent().attr('id');

                    var myimage = $(this).next("img").attr("data-original");
                    console.log(myimage);
                    //console.log($('input[name="_token"]').val());
                    console.log(parent_id);

                    var croppicHeaderOption = {
                        cropData: {
                            //'_token': $('input[name="_token"]').val(),
                            "action": "crop_pic",
                            "post_type": "calendar",
                            "dealer": 0,
                            "edit": true,
                            "parent_id": parent_id,
                            "post_id": '<?php $post_id; ?>',
                            "name_input": "<?php echo $name_input ?>"
                        },
                        rotateFactor: 90,
                        cropUrl: ajaxurl,
                        loadPicture: myimage,
                        modal: true,
                        enableMousescroll: true,
                        processInline: true,
                        loaderHtml: '<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
                        onAfterImgCrop: function () {
                            $('#croppicModal').remove();
                        },
                        onError: function (errormessage) {
                            console.log('onError:' + errormessage)
                        }
                    }
                    new Croppic('croppic_edit', croppicHeaderOption);
                });

                $(document).on('click', '.cropControlReset', function () {
                    $('#croppicModal').remove();
                    $(".btn-cancel-upload-img").css("display", "none");
                });
                $(document).on('keyup', function (e) {
                    if (e.keyCode == 27) {
                        $('#croppicModal').remove();
                        $('#croppic-upload').show();
                    }
                });
            });
        </script>
        <?php
        $response = ob_get_contents();
        ob_end_clean();
        echo $response;
    }

    public static function backend_upload_image()
    {
        $name_input = $_POST['name_input'];
        $post_type = $_POST['post_type'];

        $prefix = $post_type;

        $upload_dir['path'] = 'uploads/' . $prefix . '/';
        $edit = false;
        if (isset($_POST['edit'])) {
            $edit = $_POST['edit'];
        }

        $parent_id = '';
        if (isset($_POST['parent_id'])) {
            $parent_id = $_POST['parent_id'];
        }

        if ($post_type == 'thucan' || $post_type == 'videos' || $post_type == 'thuoc'|| $post_type == 'image1' ) {
            $dealer = 1;
        }elseif ($post_type == 'update'){
            $dealer = 2;
        } else {
            $dealer = 0;
        }

        if (!file_exists($upload_dir['path'] . '/large/')) {
            mkdir($upload_dir['path'] . '/large/', 0777, true);
        }
        if (!file_exists($upload_dir['path'] . '/medium/')) {
            mkdir($upload_dir['path'] . '/medium/', 0777, true);
        }
        if (!file_exists($upload_dir['path'] . '/small/')) {
            mkdir($upload_dir['path'] . '/small/', 0777, true);
        }

        $imgUrl = $_POST['imgUrl'];
        $img_src = $imgUrl;
        $imginfo = pathinfo($img_src);

        // original sizes
        $imgInitW = $_POST['imgInitW'];
        $imgInitH = $_POST['imgInitH'];
        // resized sizes
        $imgW = $_POST['imgW'];
        $imgH = $_POST['imgH'];
        // offsets
        $imgY1 = $_POST['imgY1'];
        $imgX1 = $_POST['imgX1'];
        // crop box
        $cropW = $_POST['cropW'];
        $cropH = $_POST['cropH'];
        // rotation angle
        $angle = $_POST['rotation'];

        $jpeg_quality = 100;

        $first_chac_name = $post_type;


        $post_id = $_POST['post_id'];

        if ($edit == true && !preg_match('/^ncg-import/', $imginfo['filename'])) {
            $name = $imginfo['filename'];
        } else {
            $name = $first_chac_name . $post_id . "-" . time();
        }

        $output_filename = $upload_dir['path'] . '/large/' . $name;

        // uncomment line below to save the cropped image in the same location as the original image.
        //$output_filename = dirname($imgUrl). "/croppedImg_".rand();

        $what = getimagesize($imgUrl);

        switch (strtolower($what['mime'])) {
            case 'image/png':
                $img_r = imagecreatefrompng($imgUrl);
                $source_image = imagecreatefrompng($imgUrl);
                $type = '.png';
                break;
            case 'image/jpeg':
                $img_r = imagecreatefromjpeg($imgUrl);
                $source_image = imagecreatefromjpeg($imgUrl);
                error_log("jpg");
                $type = '.jpeg';
                break;
            case 'image/gif':
                $img_r = imagecreatefromgif($imgUrl);
                $source_image = imagecreatefromgif($imgUrl);
                $type = '.gif';
                break;
            default:
                die('image type not supported');
        }


        //Check write Access to Directory

        if (!is_writable(dirname($output_filename))) {
            $response = Array(
                "status" => 'error',
                "message" => 'Can`t write cropped File'
            );
        } else {

            // resize the original image to size of editor
            $resizedImage = imagecreatetruecolor($imgW, $imgH);
            imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
            // rotate the rezized image
            $rotated_image = imagerotate($resizedImage, -$angle, 0);
            // find new width & height of rotated image
            $rotated_width = imagesx($rotated_image);
            $rotated_height = imagesy($rotated_image);
            // diff between rotated & original sizes
            $dx = $rotated_width - $imgW;
            $dy = $rotated_height - $imgH;
            // crop rotated image to fit into original rezized rectangle
            $cropped_rotated_image = imagecreatetruecolor($imgW, $imgH);
            imagecolortransparent($cropped_rotated_image, imagecolorallocate($cropped_rotated_image, 0, 0, 0));
            imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
            // crop image into selected area
            $final_image = imagecreatetruecolor($cropW, $cropH);
            imagecolortransparent($final_image, imagecolorallocate($final_image, 0, 0, 0));
            imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
            // finally output png image
            //imagepng($final_image, $output_filename.$type, $png_quality);
            imagejpeg($final_image, $output_filename . $type, $jpeg_quality);

            //Create thumbnails
            if ($post_type == "image" || $post_type == "thucan"  || $post_type == "thuoc" ) {
                //create 320 thumb
                $r320 = imagecreatetruecolor(320, 320);
                imagecopyresampled($r320, $final_image, 0, 0, 0, 0, 320, 320, 630, 630);
                $name320 = $name . $type;
                $urlExport320 = $upload_dir['path'] . '/medium/' . $name320;

                ImageJPEG($r320, $urlExport320, $jpeg_quality);
                //create 120 x 90 px
                $r120 = imagecreatetruecolor(90, 90);
                imagecopyresampled($r120, $final_image, 0, 0, 0, 0, 90, 90, 630, 630);
                $name120 = $name . $type;
                $urlExport120 = $upload_dir['path'] . '/small/' . $name120;
                ImageJPEG($r120, $urlExport120, $jpeg_quality);
            } elseif ( $post_type == "image1" || $post_type == 'update'){
                $r320 = imagecreatetruecolor(320, 160);
                imagecopyresampled($r320, $final_image, 0, 0, 0, 0, 320, 160, 640, 320);
                $name320 = $name . $type;
                $urlExport320 = $upload_dir['path'] . '/medium/' . $name320;

                ImageJPEG($r320, $urlExport320, $jpeg_quality);
                //create 120 x 90 px
                $r120 = imagecreatetruecolor(120, 60);
                imagecopyresampled($r120, $final_image, 0, 0, 0, 0, 120, 60, 640, 320);
                $name120 = $name . $type;
                $urlExport120 = $upload_dir['path'] . '/small/' . $name120;
                ImageJPEG($r120, $urlExport120, $jpeg_quality);
            }elseif($post_type == "videos"){
                $r320 = imagecreatetruecolor(260, 146);
                imagecopyresampled($r320, $final_image, 0, 0, 0, 0, 260, 146, 630, 630);
                $name320 = $name . $type;
                $urlExport320 = $upload_dir['path'] . '/medium/' . $name320;

                ImageJPEG($r320, $urlExport320, $jpeg_quality);

            }elseif ($post_type == "image") {
                //create 320 thumb
                $r320 = imagecreatetruecolor(320, 320);
                imagecopyresampled($r320, $final_image, 0, 0, 0, 0, 320, 320, 630, 630);
                $name320 = $name . $type;
                $urlExport320 = $upload_dir['path'] . '/medium/' . $name320;
                ImageJPEG($r320, $urlExport320, $jpeg_quality);
                //create 120 x 90 px
                $r120 = imagecreatetruecolor(90, 90);
                imagecopyresampled($r120, $final_image, 0, 0, 0, 0, 90, 90, 630, 630);
                $name120 = $name . $type;
                $urlExport120 = $upload_dir['path'] . '/small/' . $name120;
                ImageJPEG($r120, $urlExport120, $jpeg_quality);
            }
            elseif ($post_type == "image1") {
                //create 320 thumb
                $r320 = imagecreatetruecolor(320, 320);
                imagecopyresampled($r320, $final_image, 0, 0, 0, 0, 320, 320, 630, 630);
                $name320 = $name . $type;
                $urlExport320 = $upload_dir['path'] . '/medium/' . $name320;
                ImageJPEG($r320, $urlExport320, $jpeg_quality);
                //create 120 x 90 px
                $r120 = imagecreatetruecolor(90, 90);
                imagecopyresampled($r120, $final_image, 0, 0, 0, 0, 90, 90, 630, 630);
                $name120 = $name . $type;
                $urlExport120 = $upload_dir['path'] . '/small/' . $name120;
                ImageJPEG($r120, $urlExport120, $jpeg_quality);
            } else {
                //create 320 x 186 px
                $r320 = imagecreatetruecolor(320, 320);
                imagecopyresampled($r320, $final_image, 0, 0, 0, 0, 320, 320, 630, 630);
                $name320 = $name . $type;
                $urlExport320 = $upload_dir['path'] . '/medium/' . $name320;
                ImageJPEG($r320, $urlExport320, 95);
                //create 120 x 70 px
                $r120 = imagecreatetruecolor(90, 90);
                imagecopyresampled($r120, $final_image, 0, 0, 0, 0, 90, 90, 630, 630);
                $name120 = $name . $type;
                $urlExport120 = $upload_dir['path'] . '/small/' . $name120;
                ImageJPEG($r120, $urlExport120, $jpeg_quality);
            }

            // $getfolder = explode("uploads", $upload_dir['path']);
            $getfolder = asset($upload_dir['path'] . 'medium/' . $name . $type);
            $data_original = asset($upload_dir['path'] . 'large/' . $name . $type);
            ob_start();
            if ($dealer == 1):
                ?>

                <a class="delete-img-video" href="javascript: void(0);"><i class="fa fa-times"></i></a>
                <img class="img-responsive" src="<?php echo $getfolder; ?>" alt="">
                <input type="hidden" id="dealership_photos_uploaded_<?php if($post_type=="videos") echo 'videos'; ?>"
                       name="<?php echo ($name_input) ? $name_input : 'photos_uploaded' ?>"
                       value="<?php echo $name . $type; ?>">
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('a.delete-img-video').on('click',function(){


                            $(this).parent().html("");

                        });
                        var prev_img = $(".prev-img").val();
                        if(prev_img != "") $(".remove-image").append('<input type="hidden" name="removeImg[]" value="'+prev_img+'"/>');
                        var current_img = $("#dealership_photos_uploaded_<?php if($post_type=='videos') echo 'videos'?>").val();
                        $(".prev-img").val(current_img);
                        disabledUploadImage(true);
                    });
                </script>
                <?php
            elseif($dealer == 2):
                ?>

                <a class="delete-img-video" href="javascript: void(0);"><i class="fa fa-times"></i></a>
                <img class="img-responsive" src="<?php echo $getfolder; ?>" alt="">
                <input type="hidden" id="dealership_photos_uploaded_<?php if($post_type=="videos") echo 'videos'; ?>"
                       name="<?php echo ($name_input) ? $name_input : 'photos_uploaded' ?>"
                       value="<?php echo $name . $type; ?>">
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('a.delete-img-video').on('click',function(){


                            $(this).parent().html("");

                        });
                        var prev_img = $(".prev-img").val();
                        if(prev_img != "") $(".remove-image").append('<input type="hidden" name="removeImg[]" value="'+prev_img+'"/>');
                        var current_img = $("#dealership_photos_uploaded_<?php if($post_type=='videos') echo 'videos'?>").val();
                        $(".prev-img").val(current_img);
                        disabledUploadImage(true);
                    });
                </script>
                <?php
            else:
                ?>
                <div class="bo-gallery-block bo-table" style="position: relative;" id="<?php echo $name; ?>">
                    <a class="bo-delete-g-photo" href="javascript: void(0);"><i class="fa fa-times"></i></a>
                    <img class="img-thumbnail center-block" src="<?php echo $getfolder; ?>" data-original="<?php echo $data_original; ?>">
                    <input type="hidden" id="dealership_photos_uploaded"
                           name="<?php echo ($name_input) ? $name_input : 'photos_uploaded['.$name . $type.']' ?>"
                           value="<?php echo $name . $type; ?>">
                    <?php if($post_type == "calendar" || $post_type == "product" ):?>
                        <div class="box-select-primary" data-primary="<?php echo $name . $type; ?>">
                            <span class="fa fa-circle-o btn-img-primary"></span> Ảnh chính
                            <input type="hidden" class="pos-key" name="<?php echo ($name_input) ? $name_input : 'photos_uploaded['.$name . $type.'][key]' ?>" value="<?php echo $name; ?>">
                            <input type="hidden" class="pos-x" name="<?php echo ($name_input) ? $name_input : 'photos_uploaded['.$name . $type.'][x]' ?>" value="-1">
                            <input type="hidden" class="pos-y" name="<?php echo ($name_input) ? $name_input : 'photos_uploaded['.$name . $type.'][y]' ?>" value="-1">
                            <input type="hidden" class="pos-primary" name="<?php echo ($name_input) ? $name_input : 'photos_uploaded['.$name . $type.'][primary]' ?>" value="0">
                        </div>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                $('.show-primary-image').append('<a class="item-map <?php echo $name; ?>" data-id="<?php echo $name; ?>"></a>');
                                disabledVideoControl(true); //disabled inputs for video url-info-image
                            });
                        </script>
                    <?php endif; ?>
                </div>
                <?php
            endif;
            $url = ob_get_contents();
            ob_end_clean();
            if($dealer == 2){
                $dealer =1;
            }
            $response = array(
                "status" => 'success',
                "url" => $url,
                "dealer" => $dealer,
                "edit" => $edit,
                "parent_id" => $parent_id
            );
        }
        print json_encode($response);
        exit;
    }
} 