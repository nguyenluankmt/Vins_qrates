<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Commonpage;
use App\Maternitycheckup;
use App\Checklist;
use App\Babyregistry;
use App\ChuongTrai,App\Update,App\Lichthuan,App\Thucan,App\Thuoc, DB;



class FunctionController extends Controller
{
    public static function appendToPaginate($unsets = array())
    {
        $params = $_GET;

        $appends = array();
        if ($unsets) {
            foreach ($unsets as $item) {
                unset($params[$item]);
            }
        }

        if ($params) {
            foreach ($params as $key => $val) {
                if ($val != '') {
                    $appends[$key] = $val;
                }

            }
        }

        return $appends;
    }

    public static function notify(){
        $notify = array();
            if (Auth::User()->role == 1 || Auth::User()->role == 5) {
                $getdulieu = Update::select('*')->get();
            }else{
                $id_nv = Auth::User()->id;
                $getdulieu = Update::select('update.thucan_thucte','update.so_luong','do_tuoi','update.id_chuong')->join('chuong', 'chuong.id', '=', 'update.id_chuong')->join('users', 'users.id', '=', 'chuong.user_id')->where('users.id',$id_nv)->get();
            }

            // dd($getdulieu);
            foreach ($getdulieu as $keyn => $valuen) {
                $dulieu = json_decode($valuen['thucan_thucte'] , true);
                $soluong_nuoi = json_decode($valuen['so_luong'],true);

                foreach ($dulieu as $key1n => $value1n) {

                    foreach ($value1n as $ngay => $dulieu_thucte) {
                        $homnay=date('Y-m-d');
                        $date_nuoi = DB::table('chuong')->where('id', $valuen->id_chuong)->select('thoigian_nuoi','ten_chuong')->first();
                        if ($date_nuoi != "") {
                             $ten_chuong = $date_nuoi->ten_chuong;
                             $ngay_batdau = strtotime($date_nuoi->thoigian_nuoi);
                            $so_ngay_nuoi = $valuen->do_tuoi;
                            $homnay = strtotime($homnay);
                            $today = intval(ceil($homnay - $ngay_batdau) / 86400) +1;
                            $tomorow = $today - 1;
                        
                       
                        

                        if ( $today <= $so_ngay_nuoi && $tomorow >= 0) {
                            if ($ngay == $today) {
                                if (isset($dulieu_thucte)) {
                                    $dulieu_homnay = $dulieu_thucte;
                                    $dulieu_homnay['ngay'] = $ngay;

                                }
                            }

                            if ($ngay == $tomorow) {
                                if (isset($dulieu_thucte)) {
                                    $dulieu_homqua = $dulieu_thucte;
                                    $dulieu_homqua['ngay'] = $ngay;
                                }
                            }
                        }
                    }
                        
                    }
                    #Dữ liệu thức ăn 
                    
                    if (isset($dulieu_homqua) && isset($dulieu_homnay)) {
                        $thucan_homqua = array();
                        $soluong = $soluong_nuoi[$dulieu_homqua['ngay']];
                        foreach ($dulieu_homqua[0] as $keydl => $valuedl) {
                            if (isset($valuedl)) {
                                $getTen = Thucan::where('id',$valuedl[0])->select('*')->first();
                                $ten_thucan = $getTen->ten_thucan;
                                $klt = $getTen['khoi_luong_tinh'];
                                $bao = $valuedl[1]*$soluong[0]/(1000*$klt);
                                $bao = round($bao,3);

                                $thucan_homqua[] = $ten_thucan.' : '.($valuedl[1]*$soluong[0]/1000)."(kg) - ".$bao." (bao)" ;
                            }
                            
                        }

                         $thucan_homnay = array();
                    foreach ($dulieu_homnay[0] as $keydl1 => $valuedl1) {
                        if (isset($valuedl1)) {
                            $getTen = Thucan::where('id',$valuedl1[0])->select('*')->first();
                            $ten_thucan = $getTen->ten_thucan;
                            $klt = $getTen['khoi_luong_tinh'];
                            $bao = $valuedl[1]*$soluong[0]/(1000*$klt);
                            $bao = round($bao,3);

                            $thucan_homnay[] = $ten_thucan.' : '.($valuedl1[1]*$soluong[0]/1000)."(kg) - ".$bao." (bao)" ;
                        }
                        
                    }

                    #Tính dữ liệu báo cáo thuốc
                    $thuoc_homqua = array();
                    foreach ($dulieu_homqua[1] as $keydl2 => $valuedl2) {
                        if (isset($valuedl2) && $valuedl2[0] != 0) {
                            $getThuoc = Thuoc::where('id',$valuedl2[0])->select('*')->first();
                            $ten_thuoc = $getThuoc["ten_thuoc"];

                            if ($getThuoc['quy_cach_dong_goi'] == 1) {
                                $quycach = "gói";
                                $qc = "g";
                            }elseif($getThuoc['quy_cach_dong_goi'] == 2){
                                $quycach = "bao";
                                $qc = "g";
                            }elseif($getThuoc['quy_cach_dong_goi'] == 3){
                                $quycach = "chai";
                                $qc = "ml";
                            }else{
                                $quycach = "lọ";
                                $qc = "ml";
                            }
                            if ($getThuoc['don_vi'] && $getThuoc['don_vi'] != 0) {
                                $thuoc_su_dung = round(($valuedl2[1]*$soluong[0])/$getThuoc['don_vi'],2).'('.$quycach.')';

                                $thuoc_homqua[] = $ten_thuoc.' : '.$thuoc_su_dung.' - '.$valuedl2[1].$qc.' / 1con';
                            }
                           
                        }
                        
                    }
                    $thuoc_homnay = array();

                    foreach ($dulieu_homnay[1] as $keydl3 => $valuedl3) {
                        if (isset($valuedl3) && $valuedl3[0] != 0) {
                            $getThuoc = Thuoc::where('id',$valuedl3[0])->select('*')->first();
                            $ten_thuoc = $getThuoc["ten_thuoc"];

                            if ($getThuoc['quy_cach_dong_goi'] == 1) {
                                $quycach = "gói";
                                $qc = "g";
                            }elseif($getThuoc['quy_cach_dong_goi'] == 2){
                                $quycach = "hộp";
                                $qc = "g";
                            }elseif($getThuoc['quy_cach_dong_goi'] == 3){
                                $quycach = "chai";
                                $qc = "ml";
                            }else{
                                $quycach = "lọ";
                                $qc = "ml";
                            }
                            if($getThuoc['don_vi'] && $getThuoc['don_vi'] != 0){
                                 $thuoc_su_dung = round(($valuedl3[1]*$soluong[0])/$getThuoc['don_vi'],2).'('.$quycach.')';

                            $thuoc_homnay[] = $ten_thuoc.' : '.$thuoc_su_dung.' - '.$valuedl3[1].$qc.' / 1con';

                            }

                           
                        }

                        
                    }
                    #End dữ liệu thuốc
                    $notify_thucan = array_diff_assoc($thucan_homnay, $thucan_homqua);
                    $notify_thuoc = array_diff_assoc($thuoc_homnay, $thuoc_homqua);

                    if ($notify_thucan != null) {
                        $notify[$ten_chuong]['thucan'] =  $notify_thucan;
                    }

                    if ($notify_thuoc != null) {
                        $notify[$ten_chuong]['thuoc'] =  $notify_thuoc;
                    } 
                    
                   
                    }
                              
                }   

            }
            
            $data['notify'] = $notify;
            ob_start()
            ?>

            <li role="presentation" id="notifytion" class="dropdown presentation">
                  <a href="javascript:;" class="dropdown-toggle info-number true" data-toggle="dropdown" title="Thông báo cho hôm nay">
                    <i class="fa fa-envelope-o noti"></i>
                    <span class="badge bg-green"> <?php echo count($data['notify']); ?> </span>
                  </a>
                  <style type="text/css">
                      #menu1{
                        max-height: 400px;
                        overflow: auto;
                      }
                      .noti{
                       font-size:20px; 
                      }
                      @media(max-width: 767px){
                         .noti{
                            font-size:20px; 
                            float: right;
                            margin-bottom: 10%;
                           
                            }
                            .top_nav li a i {
                                font-size: 20px;
                            }
                        }
                  </style>
                  <?php if(count($data['notify']) > 0): ?>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                  <?php foreach($data['notify'] as $key => $value): ?>
                    <li style="background:#ccc;">
                      <a>
                        <span>
                          <h5 style="font-weight:bold;"> <?php echo $key; ?> </h5>
                        </span>
                        <span class="message" style="font-size:13px;">
                            
                              <?php if(isset($value["thucan"])): ?>
                                <p style="font-weight:bold;">+ Lượng thức ăn : </p>
                                <p style="padding-left:15px;line-height:20px;">
                                <?php foreach($value['thucan'] as $key1 => $value1): ?>
                                   - <?php echo $value1; ?><br/>
                                <?php endforeach ?>
                                </p>
                              <?php endif ?>
                            
                            
                               <?php if(isset($value["thuoc"]) && $value["thuoc"] != ""): ?>
                                <p style="font-weight:bold;">+ Lượng thuốc :  </p>
                                <p style="padding-left:15px;line-height:20px;">
                                <?php foreach($value['thuoc'] as $key2 => $value2): ?>
                                    - <?php echo $value2; ?> <br/>
                                <?php endforeach; ?>
                                </p>
                               <?php endif; ?>
                        </span>
                      </a>
                    </li>
                <?php endforeach; ?>
                  </ul>
                <?php endif ?>
                </li>
                
            <?php
            return ob_get_clean();


    }

    public static function displaySearchCounter($current_page = '', $item_per_page = '', $total_page = '')
    {
        if ($current_page > 1) {
            $start = ($current_page - 1) * $item_per_page + 1;
            if ($item_per_page * $current_page > $total_page) {
                $end = $total_page;
            } else {
                $end = $item_per_page * $current_page;
            }
        } else {
            if ($item_per_page * $current_page > $total_page) {
                $end = $total_page;
            } else {
                $end = $item_per_page * $current_page;
            }
            if ($total_page) {
                $start = 1;
            } else {
                $start = 0;
            }

        }
        return $start . ' - ' . $end;
    }

    public static function add_param_url($param = array())
    {
        $url = \Request::fullUrl();
        if (isset($_GET[$param[0]]) && $_GET[$param[0]] == $param[1]) {
            return $url;
        } else {
            if ($_GET) {
                if (isset($_GET[$param[0]])) {
                    $str = $param[0] . '=' . $_GET[$param[0]];
                    $convert = $param[0] . '=' . $param[1];
                    $url = str_replace($str, $convert, $url);
                } else {
                    $url .= '&' . $param[0] . '=' . $param[1];
                }
            } else {

                $url .= '/?' . $param[0] . '=' . $param[1];
            }
        }
        return $url;
    }

    public static function random($chars = 8)
    {
        $letters = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        return substr(str_shuffle($letters), 0, $chars);
    }

    public static function getImageLink($name, $type, $size)
    {
        if ($name) {
            return URL('/') . '/uploads/' . $type . '/' . $size . '/' . $name;
        } else {
            return null;
        }
    }

    public static function checkData($check)
    {
        if (isset($check) && $check) {
            return $check;
        } else {
            return null;
        }
    }


    public static function limit_content_length($content, $length)
    {
        $excerpt = preg_replace('/(<p>)|(<\/p>)|(\*)/', '', $content);
        //$excerpt = strip_shortcodes($excerpt);
        $excerpt = strip_tags($excerpt);
        $excerpt = substr($excerpt, 0, $length);
        if (strlen($content) > $length) {
            $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
            $excerpt = str_limit($excerpt, $length, " ... ");
            $excerpt = $excerpt . '...';
        }
        return $excerpt;
    }

    public static function getWeekDay($id, $lang = 'vi')
    {
        if ($lang == 'vi') {
            $cat_name = Category::select('cat_name_vi')->where('id', $id)->get()->toArray();
            if ($cat_name) {
                return $cat_name[0]['cat_name_vi'];
            } else {
                return '--';
            }
        } else {
            $cat_name = Category::select('cat_name_en')->where('id', $id)->get()->toArray();
            if ($cat_name) {
                return $cat_name[0]['cat_name_en'];
            } else {
                return '--';
            }
        }
    }

    public static function getJS()
    {
        ob_start();
        ?>

        <script>
            $(document).ready(function () {
                $("select.uitip").change(function () {
                    var slecttitle = $(this).find("option:selected").attr("title");
                    var slecttitle1 = $(this).attr("title");
                    slecttitle1 = slecttitle;
                    $(this).attr("title", slecttitle);
                    document.getElementById("thucan").title = slecttitle1;
                    for (var i = 1; i <= 100; i++) {
                        document.getElementById("thucan_id" + i).title = slecttitle1;
                    }
                });
                $("select.uitit").on("change", function () {
                    var itle1 = $(this).find("option:selected").attr("title");
                    var itle = $(this).attr("title");
                    itle = itle1;
                    $(this).attr("title", itle);

                });

                var i = 1;

                $(".them").on('click', function () {
                    i++;
                    var parent = $(this).closest('td');
                    var thucan = parent.find('select').val();
                    var count = $('.xyz').attr('count');
                    alert(parent);
                    var id_ga = $(this).attr('id_ga');
                    var ngay = $(this).attr('ngay');
                    var clas = id_ga + "_" + ngay + "_" + i;
                    var clas1 = id_ga + "-" + ngay;
                    var a = $('.' + id_ga + '_' + ngay).length;

                    if (thucan == 0) {
                        alert("Bạn chưa chọn thức ăn chính !");
                    } else {
                        var testid = $(this).attr('ida');
                        var txt = $('.' + clas1).html();
                        var test = "<div class='" + clas + " " + id_ga + "_" + ngay + "'>";
                        test += "<select class='khungvien3 " + a + "_" + id_ga + "_" + ngay + " thucan_" + id_ga + "_" + ngay + "' title='' name='data_" + id_ga + "_" + ngay + "[thucan_id][]' id='thucan_id'>";

                        test += txt;

                        test += "</select>";

                        
                        test += "<a  href='javascript:void(0)' class='nut2 btn btn-default xoa" + i + "' >-</a>";
                        

                        test += "<script>";


                        test += " $('.xoa" + i + "').on('click',function () {";
                        test += " $('." + clas + "').remove(); ";
                        test += "});";

                        test += "$('." + a + "_" + id_ga + "_" + ngay + "').on('change', function() {";
                        test += "var j = 0 ;";
                        test += "var b = $(this).val();";
                        test += " $('.thucan_" + id_ga + "_" + ngay + "').each(function() { ";
                        test += " if(b == $(this).val() ) {"
                        test += "j++;";
                        test += "}";
                        test += "});";

                        test += "if(j > 1){";
                        test += "alert('Thức ăn này đã tồn tại');";
                        test += "$(this).children('option:selected').removeAttr('selected') ;";
                        test += "}";

                        test += "});";

                        test += "<\/script>";
                        test += "</div>";

                        var test1 = "<div class='" + clas + "'> <input name='data_" + id_ga + "_" + ngay + "[dinh_luong][]' class='khungvien1' type='text'> </div>";

                        // if (a <= (count - 2)) {
                        //     $("#testselect_" + testid).append(test);
                        //     $("#testdl" + testid).append(test1);
                        // } else {
                        //     alert('Thức ăn trong kho chỉ có ' + count + ' loại!');
                        // }


                    }
                });


                var i = 1;
                $(".themcon").click(function () {
                    i++;
                    var parent = $(this).closest('td');
                    var count = $('.selec').attr('dem');

                    var thucan = parent.find('select').val();
                    if (thucan == '') {
                        alert(" Bạn chưa chọn thuốc !");
                    } else {
                        var testid = $(this).attr('idacon');
                        // var test = $('#default').html();
                        var id_ga = $(this).attr('id_gacon');
                        var ngay = $(this).attr('ngaycon');
                        var clas = id_ga + "_" + ngay + "_" + ngay + "_" + i;
                        var clas1 = id_ga + "-" + ngay + "-" + ngay;
                        var txt = $('.' + clas1).html();

                        var a = $('.' + id_ga + '_' + ngay + '_' + ngay).length;
            
                        var test = "<div tt='" + clas + "' class='" + clas + " " + id_ga + "_" + ngay + "_" + ngay + "'>";
                        test += "<select  class='khungvien3 uitit selectt "+ a + "_" + id_ga + "_" + ngay + "_" + ngay + " thuoc_" + id_ga + "_" + ngay + "_" + ngay + "' title=''idga='" + id_ga + "'idcon='" + ngay + "' name='data_" + id_ga + "_" + ngay + "[thuoc][]' id='thuoc_id'>";
                        test += txt;

                        test += "</select>";

                        test += "<a  href='javascript:void(0)' class='nut2 btn btn-default xoacon" + i + " ' >-</a>";

                        test += "<script>";

                        test += " $('.xoacon" + i + "').on('click',function () {";
                        test += " $('." + clas + "').remove(); ";
                        test += "});";
                        test += "$('." + a + "_" + id_ga + "_" + ngay + "_" + ngay + "').on('change', function() {";
                        test += "var j = 0 ;";
                        test += "var b = $(this).val();";
                        test += " $('.thuoc_" + id_ga + "_" + ngay + "_" + ngay +"').each(function() { ";
                        test += " if(b == $(this).val() ) {"
                        test += "j++;";
                        test += "}";
                        test += "});";

                        test += "if(j > 1){";
                        test += "alert('Thuốc này đã tồn tại');";
                        test += "$(this).children('option:selected').removeAttr('selected') ;";
                        test += "}";

                        test += "});";

                        test += "<\/script>";
                        test += "</div>";

                        var test1 = "<div class='" + clas + "'> <input name='data_" + id_ga + "_" + ngay + "[lieu_luong][]' class='khungvien1' type='text'><span class='troll" + ngay + "'></span> </div>";
                        if (a <= (count - 2)) {
                            $("#testthuoc_" + testid).append(test);
                            $("#testll" + testid).append(test1);
                        } else {
                            alert('Thuốc trong kho chỉ có ' + count + ' loại!');
                        }
                    }

                });


            });
        </script>
        <?php
        return ob_get_clean();
    }
    public static function getJSChiphi(){
        ob_start();
        ?>
        <script>
            $(document).ready(function(){
                $('#id_thang').change(function(){

                    $('.errornganh').hide();
                    var thang = $(this).val();
                    var nam = $('#id_nam').val();
                    var url = '/quan-tri/chi-phi-chung/ktra-date';
                    if (nam != 0) {
                        var data = {
                            'thang': thang,
                            'nam' : nam
                        };
                        var id = $('input[name="id"]').val();

                        if (!id) {
                            $.post(url, data, function (response) {
                                if (response == 1) {
                                    $('.errordate').show();
                                    $('.errornam').hide();
                                    $('.btn-success').attr('disabled', true);
                                    $('#example').html('');
                                } else {
                                    $('.errordate').hide();
                                    $('.btn-success').attr('disabled', false);
                                    var songay =  new Date(nam, thang, 0).getDate();
                                    var text = '<thead style="table-layout: fixed;display:block;">';
                                    text += '<tr class="headings">';
                                    text += '<th><div class="qt_ngay1">Ngày thanh toán</div></th>';
                                    text += '<th><div class="qt_thucan1">Loại chi phí</div></th>';
                                    text += '<th><div class="qt_cp">Tên chi phí</div></th>';
                                    text += '<th><div class="qt_dl1">Đơn vị tính</div></th>';
                                    text += '<th><div class="qt_dl1">Đơn giá (vnd)</div></th>';
                                    text += '<th><div class="qt_dl1">Số lượng</div></th>';
                                    text += '<th><div class="qt_dlt">Thành tiền (vnd)</div></th>';
                                    text += '<th><div class="qt_note1">Ghi chú</div></th>';  
                                    text += '</tr>';
                                    text += '</thead>';
                                    text += '<tbody class="table-qt">';
                                    text += '<tr style="display:none">';
                                    text += '<td style="text-align:center;"> Ngày  </td>';
                                    text += '<td><select id="select" class="khungvien3 uitip">';
                                    text += '<option value="0">Loại chi phí</option>';
                                    text += '<option value="1">Nhân công</option>';
                                    text += '<option value="2">Điện</option>';
                                    text += '<option value="3">Nước</option>';
                                    text += '<option value="4">Vật liệu</option>';

                                    text += '</select><a href="#" class="id" title="Thêm">+</a></td>';
                                    text += '<td><input  style="width:80px;"  name="" class="khungvien1" value="" type="text"></td>';
                                    text += '<td style="text-align:center">< input name="" class="khungvien1" value="" type="text"></td>';
                                    text += '<td style="text-align:center"><input style="width: 80px;" name="" class="khungvien1" value="" type="text"></td>';
                                    text += '<td style="text-align:center"><input name="" class="khungvien1" value="" type="text"></td>'
                                    text += '<td style="width:80px;">100.000 </td>';
                                    text += '<td> <input style="width:200px;" class="khungvien2"/></td>'
                                    text += '</tr>';
                                    for (i=1 ; i <= songay ; i++) {
                                        text += '<tr>';
                                        text += '<td  style="width:55px;text-align:center;"> Ngày '+i+' </td>';
                                        text += '<td style="width:180px;" class="loai_'+i+'"><select class="khungvien3 uitip" name="data_'+thang+'_'+i+'[loai_cp][]">';
                                        text += '<option value="0">Loại chi phí</option>';
                                        text += '<option value="1">Nhân công</option>';
                                        text += '<option value="2">Điện</option>';
                                        text += '<option value="3">Nước</option>';
                                        text += '<option value="4">Vật tư</option>';

                                        text += '</select><a href="javascript:void(0)" class="nut1 btn btn-primary them" ngay="'+i+'"  title="Thêm">+</a></td>';
                                        text += '<td style="width:150px;" class="ten_'+i+'"><input style="width:135px;"  name="data_'+thang+'_'+i+'[ten_cp][]"  class="khungvien1" value="" type="text"></td>';
                                        text += '<td style="width:85px;" class="donvi_'+i+'" style="text-align:center"><input name="data_'+thang+'_'+i+'[donvi_tinh][]" class="khungvien1" value="" type="text"></td>';
                                        text += '<td  class="dongia_'+i+'" style="text-align:center;width:85px;"><input style="width: 70px;" name="data_'+thang+'_'+i+'[don_gia][]" class="khungvien1 dongia don_gia_'+i+' dongia_'+i+'_1" ngay="'+i+'" thang="'+thang+'" ngay="dongia_" value="" type="text"></td>';
                                        text += '<td class="soluong_'+i+'" style="text-align:center;width:85px;"><input name="data_'+thang+'_'+i+'[so_luong][]" class="khungvien1 soluong so_luong_'+i+' soluong_'+i+'_1" ngay="'+i+'" thang="'+thang+'" value="" type="text"></td>'
                                        text += ' <td class="thanhtien_'+i+'" style="width:90px;"><input style="display:none;" name="data_'+thang+'_'+i+'[tien]" class="khungvien1 thanh_tien_'+i+'" value="" id="tien_'+i+'" type="text"><span class="tongtien_'+i+'"></span></td>';
                                        text += '<td style="width:278px"> <input name="data_'+thang+'_'+i+'[note]" style="width:180px;"  class="khungvien2"/></td>'
                                        text += '</tr>';
                                    }
                                    text += '</tbody>';
                                    text += '<input type="hidden" name="so_ngay" id="so_ngay" value="'+songay+'" />';
                                    $('#example').html(text);

                                }
                            });
                        }
                        
                    }
                })

            //Năm 
            $('#id_nam').change(function(){
                    $('.errornam').hide();
                    var nam = $(this).val();
                    var thang = $('#id_thang').val();
                    var url = '/quan-tri/chi-phi-chung/ktra-date';
                    if (thang != 0) {
                        var data = {
                            'nam': nam,
                            'thang' : thang
                        };

                        var id = $('input[name="id"]').val();

                        if (!id) {
                            $.post(url, data, function (response) {
                                if (response == 1) {
                                    $('.errordate').show();
                                    $('.errornam').hide();
                                    $('.btn-success').attr('disabled', true);
                                    $('#example').html('');
                                } else {
                                    $('.errordate').hide();
                                    $('.btn-success').attr('disabled', false);
                                    var songay =  new Date(nam, thang, 0).getDate();
                                    var text = '<thead style="table-layout: fixed;display:block;">';
                                    text += '<tr class="headings">';
                                    text += '<th><div class="qt_ngay1">Ngày thanh toán</div></th>';
                                    text += '<th><div class="qt_thucan1">Loại chi phí</div></th>';
                                    text += '<th><div class="qt_cp">Tên chi phí</div></th>';
                                    text += '<th><div class="qt_dl1">Đơn vị tính</div></th>';
                                    text += '<th><div class="qt_dl1">Đơn giá (vnd)</div></th>';
                                    text += '<th><div class="qt_dl1">Số lượng</div></th>';
                                    text += '<th><div class="qt_dlt">Thành tiền (vnd)</div></th>';
                                    text += '<th><div class="qt_note1">Ghi chú</div></th>';  
                                    text += '</tr>';
                                    text += '</thead>';
                                    text += '<tbody class="table-qt">';
                                    text += '<tr id="hidden" style="display:none">';
                                    text += '<td style="text-align:center;"> Ngày  </td>';
                                    text += '<td><select id="select" class="khungvien3 uitip">';
                                    text += '<option value="0">Loại chi phí</option>';
                                    text += '<option value="1">Nhân công</option>';
                                    text += '<option value="2">Điện</option>';
                                    text += '<option value="3">Nước</option>';
                                    text += '<option value="4">Vật liệu</option>';

                                    text += '</select><a href="#" class="id" title="Thêm">+</a></td>';
                                    text += '<td><input  style="width:80px;"  name="" class="khungvien1" value="" type="text"></td>';
                                    text += '<td style="text-align:center">< input name="" class="khungvien1" value="" type="text"></td>';
                                    text += '<td style="text-align:center"><input style="width: 80px;" name="" class="khungvien1" value="" type="text"></td>';
                                    text += '<td style="text-align:center"><input name="" class="khungvien1" value="" type="text"></td>'
                                    text += '<td style="width:80px;">100.000 </td>';
                                    text += '<td> <input style="width:200px;" class="khungvien2"/></td>'
                                    text += '</tr>';
                                    for (i=1 ; i <= songay ; i++) {
                                        text += '<tr id="hidden">';
                                        text += '<td style="width:55px;" style="text-align:center;"> Ngày '+i+' </td>';
                                        text += '<td style="width:180px;" class="loai_'+i+'"><select class="khungvien3 uitip" name="data_'+thang+'_'+i+'[loai_cp][]">';
                                        text += '<option value="0">Loại chi phí</option>';
                                        text += '<option value="1">Nhân công</option>';
                                        text += '<option value="2">Điện</option>';
                                        text += '<option value="3">Nước</option>';
                                        text += '<option value="4">Vật tư</option>';

                                        text += '</select><a href="javascript:void(0)" class="nut1 btn btn-primary them" ngay="'+i+'"  title="Thêm">+</a></td>';
                                        text += '<td style="width:150px;" class="ten_'+i+'"><input style="width:135px;"  name="data_'+thang+'_'+i+'[ten_cp][]"  class="khungvien1" value="" type="text"></td>';
                                        text += '<td style="width:85px;" class="donvi_'+i+'" style="text-align:center"><input name="data_'+thang+'_'+i+'[donvi_tinh][]" class="khungvien1" value="" type="text"></td>';
                                        text += '<td style="width:85px;" class="dongia_'+i+'" style="text-align:center"><input style="width: 70px;" name="data_'+thang+'_'+i+'[don_gia][]" class="khungvien1 dongia don_gia_'+i+' dongia_'+i+'_1" ngay="'+i+'" thang="'+thang+'" ngay="dongia_" value="" type="text"></td>';
                                        text += '<td style="width:85px;" class="soluong_'+i+'" style="text-align:center"><input name="data_'+thang+'_'+i+'[so_luong][]" class="khungvien1 soluong so_luong_'+i+' soluong_'+i+'_1" ngay="'+i+'" thang="'+thang+'" value="" type="text"></td>'
                                        text += ' <td  class="thanhtien_'+i+'" style="width:90px;"><input style="display:none;" name="data_'+thang+'_'+i+'[tien]" class="khungvien1 thanh_tien_'+i+'" value="" id="tien_'+i+'" type="text"><span class="tongtien_'+i+'"></span></td>';
                                        text += '<td style="width:278px;"> <input name="data_'+thang+'_'+i+'[note]" style="width:180px;"  class="khungvien2"/></td>'
                                        text += '</tr>';
                                    }
                                    text += '</tbody>';
                                    text += '<input type="hidden" name="so_ngay" id="so_ngay" value="'+songay+'" />';
                                    $('#example').html(text);
                                }
                            });
                        }

                        
                    }
                })       
            
            })
        </script>
        <?php
        return ob_get_clean();
    }
    public static function getJSUpdate()
    {
        ob_start();
        ?>

        <script>
            $(document).ready(function () {
                // $("select.uitip").change(function () {
                //     var slecttitle = $(this).find("option:selected").attr("title");
                //     var slecttitle1 = $(this).attr("title");
                //     slecttitle1 = slecttitle;
                //     $(this).attr("title", slecttitle);
                //     document.getElementById("thucan").title = slecttitle1;
                //     for (var i = 1; i <= 100; i++) {
                //         document.getElementById("thucan_id" + i).title = slecttitle1;
                //     }
                // });
                // $("select.uitit").on("change", function () {
                //     var itle1 = $(this).find("option:selected").attr("title");
                //     var itle = $(this).attr("title");
                //     itle = itle1;
                //     $(this).attr("title", itle);

                // });

                var i = 1;
                 $(".xoa2").on('click', function() {
                    $(this).parent('div').remove();
                 })
                $(".them").on('click', function () {
                    i++;

                    var parent = $(this).closest('td');

                    var thucan = parent.find('select').val();

                    var parent  = $(this).closest('td');
                    var thucan  = parent.find('select').val();
                    var count   = $('.xyz').attr('count');
                    var id_ga = $(this).attr('id_thucan');
                    var ngay = $(this).attr('ida');
                    var clas = id_ga+"_"+ngay+"_"+i;
                    var clas1 = id_ga+"-"+ngay;
                    var a = $('.'+id_ga+'_'+ngay).length;

                    if (thucan != 0) {

                        var testid = $(this).attr('ida');
                        var txt = $(".html"+ testid).html();

                        var test = "<div class='"+clas+" "+id_ga+"_"+ngay+"'>";

                        test += txt;



                        test += "<a  href='javascript:void(0)' class='nut2 btn btn-default xoa"+i+"' >-</a>";

                        test += "<script>";


                        test += " $('.xoa"+i+"').on('click',function () {";
                        test += " $('."+clas+"').remove(); ";
                        test += "});";
                        test += "$('.thucan_"+id_ga+"_"+ngay+"').on('change', function() {";
                        test += "var j = 0 ;";
                        test += "var b = $(this).val();";
                        test += " $('.thucan_"+id_ga+"_"+ngay+"').each(function() { ";
                        test += " if(b == $(this).val() ) {"
                        test += "j++;";
                        test += "}";
                        test += "});";

                        test += "if(j > 1){";
                        test += "alert('Thức ăn này đã tồn tại');";
                        test += "$(this).children('option:selected').removeAttr('selected') ;";
                        test += "}";

                        test += "});";

                        test += "<\/script>";
                        test += "</div>";

                        var test1 = "<div class='"+clas+"'> <input name='data_"+id_ga+"_"+ngay+"[dinh_luong][]' class='khungvien1' type='text'> </div>";


                        $("#testselect_" + testid).append(test);
                        $("#testdl" + testid).append(test1);




                    }
                    $("."+clas).children().children().removeAttr('selected') ;
                });
                });


         $(document).ready(function () {
                var i=1;
                $(".themcon").click(function () {
                    i++;
                    var parent = $(this).closest('td');
                    var thucan = parent.find('select').val();
                    if (thucan != 0) {
                        var testid = $(this).attr('ida');
                        // var test = $('#default').html();
                        var id_ga = $(this).attr('id_thuoc');
                        var  ngay= $(this).attr('ida');
                        var clas = id_ga+"-"+ngay+"-"+ngay+"-"+i;
                        var clas1 = id_ga+"-"+ngay+"-"+ngay;
                        var txt = $('.thuochtml'+testid).html();
                        var test = "<div class='"+clas+"'>";
                        var namecheck = 'thuoc_id'+ngay;

                        test += txt;

                        test += "<a  href='javascript:void(0)' class='nut2 btn btn-default xoacon"+i+" ' >-</a>";

                        test += "<script>";
                        test += " $('.xoacon"+i+"').on('click',function () {";
                        test += " $('."+clas+"').remove(); ";
                        test += "});";
                       

                        test += "$('."+clas+"').children().on('change', function() {";
                        //test += "$('.thuoc"+id_ga+"_"+ngay+"').on('change', function() {";

                        test += "var j = 0 ;";
                        test += "var b = $(this).val(); ";

                        test += ' var qty = document.querySelectorAll("#'+namecheck+'"); ';
                        test += " for(var k = 0; k < qty.length; ++k) { ";
                        test += " if(b == qty[k].value )";
                        test += "j++";
                        test += "}";
                        test += "if(j > 1){";
                        test += "alert('Thuốc này đã tồn tại');";
                        test += "$(this).children('option:selected').removeAttr('selected') ;";
                        test += "} ";
                        test += "});";
                        test += "<\/script>";
                        test += "</div>";

                        var test1 = "<div class='"+clas+"'> <input name='data_"+id_ga+"_"+ngay+"[lieu_luong][]' class='khungvien1' type='text'><span class='troll"+ngay+"'></span> </div>";
                        //alert(test);
                        $("#selectthuoc" +testid).append(test);
                        $("#testt" +testid).append(test1);

                    }
                    $("."+clas).children().children().removeAttr('selected') ;

                });


            });
        </script>
        <?php
        return ob_get_clean();
    }



    public static function getAjax()
    {
        ob_start();
        ?>

        <script>
            $(document).ready(function () {
                $('select.selec').on('change', function () {


                   

                    var idcua = $(this).attr('idcon');
                    var quycach = $(this).find('option:selected').attr('quy_cach');
                    if (quycach == 1 || quycach == 2) {


                        $(".lieu_luong" + idcua).html('(g)');
                    } else if (quycach == 3 || quycach == 4) {
                        $(".lieu_luong" + idcua).html('(ml)');
                    }
                    else {
                        $(".lieu_luong" + idcua).html('');
                    }
                });



                $(document).on('change', 'select.selectt', function () {

                    var idcua = $(this).attr('idcon');
                    var class_t = $(this).parent('div').attr('tt');
                    var cai_cach = $(this).find('option:selected').attr('quy_cach');

                    if (cai_cach == 1 || cai_cach == 2) {
                        $('.' + class_t).children('.troll' + idcua).html('(g)');

                    } else if (cai_cach == 3 || cai_cach == 4) {
                        $('.' + class_t).children('.troll' + idcua).html('(ml)');
                    }
                    else {
                        $('.' + class_t).children('.troll' + idcua).html('');

                    }

                });
            });
        </script>
        <?php
        return ob_get_clean();
    }

    public static function layTenQuyCach($id){
        $ten='';
        if($id == 1){
            $ten = '(g)';
        }else if($id == 2){
            $ten='(g)';
        }else if($id == 3){
            $ten='(ml)';
        }else if($id == 4){
            $ten='(ml)';
        }
        return $ten;

    }
    public static function tinhchiphi($id){
         $chuong = ChuongTrai::join('giongga', 'giongga.id', '=', 'chuong.id_giongga')->select('chuong.thoigian_nuoi as tgn', 'giongga.id', 'giongga.ten_giongga', 'giongga.thoi_giannuoi', 'chuong.id_giongga', 'chuong.so_luong', 'chuong.ten_chuong')->where('chuong.id', $id)->first();

        $giong_ga = ChuongTrai::join('giongga', 'giongga.id', '=', 'chuong.id_giongga')->select('giongga.thoi_giannuoi')->where('chuong.id', $id)->first();

        $db = Update::join('chuong', 'chuong.id', '=', 'update.id_chuong')->select('chuong.*','update.*')->where('chuong.id',$id)->first()->toArray();
        // dd($db);
        $sol = update::join('chuong', 'chuong.id', '=', 'update.id_chuong')->select('update.so_luong', 'update.id_chuong', 'chuong.thoigian_ban as tgb')->where('update.id_chuong', $id)->first();
        $mucluong = ChuongTrai::select('id', 'so_luong')->where('id', $id)->first()->toArray();

        $sl = json_decode($sol->so_luong, true);
// dd($sl);
        $thucantest = '';
        $thuoc1 = '';
        $update = Update::where('id_chuong', $id)->select('thuoc_thucte')->first();
        $loaithai = json_decode($update['thuoc_thucte']);
        $soluong = array();


        if (count($loaithai)) {
            $sl_loaithai = 0;
            foreach ($loaithai as $key => $s) {
                foreach ($s[0][0] as $val) {
                    $sl_loaithai = $sl_loaithai + $val;
                }
            }
        }
        $ga_hientai = isset($sl_loaithai) ? $chuong['so_luong'] - $sl_loaithai : $chuong['so_luong'];
        $date_now = date("Y-m-d H:i:s");
        $date_nows = date_create(date('Y-m-d H:i:s'));

        $startTimeStamp = strtotime($date_now);

        $endTimeStamp = strtotime($chuong['tgn']);
        $ketthuc = date_create($sol['tgb']);
        $timeDiffs = date_diff($ketthuc, $date_nows);
        $ngayhientai = $timeDiffs->format("%R%a");


        $timeDiff = abs($endTimeStamp - $startTimeStamp);


        $numberDays = intval(ceil($timeDiff / 86400));


        if (isset($mucluong) && $mucluong['so_luong'])
            $capnhap = str_replace(' ', '', $mucluong['so_luong']);
        else
            $capnhap = 1;

        $id_thucan = array();
        $id_thuoc = array();
        $luong_thucan = array();
        $dh = json_decode($db['thucan_thucte'], true);
        $dinhluong = array();
        $thuoc = array();
        $thucan = array();
        $thucancon=array();
        $thuoccon=array();
        $donvithucan=array();
        $donvithuoc=array();
        $quycach=array();


         foreach ($dh as $val) {

                 foreach ($val as $k => $item3) {
                            $date_now = date("Y-m-d H:i:s");
                    $startTimeStamp = strtotime($date_now);

                    $endTimeStamp = strtotime($chuong['tgn']);

                    $timeDiff = abs($endTimeStamp - $startTimeStamp);

                    $numberDays = intval(ceil($timeDiff / 86400));
                        if($k > $numberDays) {
                        break;
                        }

                        foreach ($item3[0] as $key => $item4) {

                        $id_thucan = str_replace(' ', '', $item4[0]);
                         $tien_thucan = Thucan::select('id', 'ten_thucan', 'gia_nhap_thucan', 'khoi_luong_tinh')->get()->toArray();
                            foreach ($tien_thucan as $v) {
                                if (isset($id_thucan) && $id_thucan == $v['id']) {
                                    if ($sl == null) {
                                        if (isset($dinhluong[$id_thucan])) {
                                            $dinhluong[$id_thucan] += (str_replace(' ', '', $item4[1])*$capnhap)*($v['gia_nhap_thucan'] / ($v['khoi_luong_tinh'] * 1000));
                                        } else 

                                        {
                                            $dinhluong[$id_thucan] = (str_replace(' ', '', $item4[1])*$capnhap)*($v['gia_nhap_thucan'] / ($v['khoi_luong_tinh'] * 1000));
                                            $query = DB::table('thucan')->where('id', $id_thucan)->select('ten_thucan')->first();
                                            if (isset($query) && $query) {
                                            $namethucan[$id_thucan]['name'] = $query->ten_thucan;

                                            }
                                        }
                                    }else{
                                        if (isset($dinhluong[$id_thucan])) {
                                        $dinhluong[$id_thucan] += (str_replace(' ', '', $item4[1])*$sl[$k][0])*($v['gia_nhap_thucan'] / ($v['khoi_luong_tinh'] * 1000));
                                         } else {
                                            $dinhluong[$id_thucan] = (str_replace(' ', '', $item4[1])*$sl[$k][0])*($v['gia_nhap_thucan'] / ($v['khoi_luong_tinh'] * 1000));
                                            $query = DB::table('thucan')->where('id', $id_thucan)->select('ten_thucan')->first();
                                            if (isset($query) && $query) {
                                                $namethucan[$id_thucan]['name'] = $query->ten_thucan;

                                             }
                                        }
                                    }
                                }
                            }
                        }
                        
                        foreach ($item3[1] as $key1 => $item5) {
                            $id_thuoc = str_replace('', '', $item5[0]);

                        $tien_thuoc = Thuoc::select('id', 'gia_nhap_thuoc', 'ten_thuoc', 'don_vi','quy_cach_dong_goi')->get()->toArray();

                            foreach ($tien_thuoc as $va) {
                                if (isset($id_thuoc) && $id_thuoc == $va['id']) {
                                    if ($sl == null) {
                                        if (isset($thuoc[$id_thuoc])) {
                                             $thuoc[$id_thuoc] += (str_replace(' ', '', $item5[1])*$capnhap) * ($va['gia_nhap_thuoc'] / $va['don_vi']);


                                        } else {
                                            $thuoc[$id_thuoc] = (str_replace(' ', '', $item5[1])*$capnhap) * ($va['gia_nhap_thuoc'] / $va['don_vi']);

                                            $query1 = DB::table('thuoc')->where('id', $id_thuoc)->select('ten_thuoc', 'quy_cach_dong_goi')->first();
                                            if (isset($query1) && $query1) {
                                                $namethucan1[$id_thuoc]['name1'] = $query1->ten_thuoc;
                                                $namethucan1[$id_thuoc]['donvi'] = $query1->ten_thuoc;

                                            }


                                        }
                                    }else{
                                        if (isset($thuoc[$id_thuoc])) {
                                        $thuoc[$id_thuoc] += (str_replace(' ', '', $item5[1])*$sl[$k][0]) * ($va['gia_nhap_thuoc'] / $va['don_vi']);


                                        } else {
                                        $thuoc[$id_thuoc] = (str_replace(' ', '', $item5[1])*$sl[$k][0]) * ($va['gia_nhap_thuoc'] / $va['don_vi']);

                                        $query1 = DB::table('thuoc')->where('id', $id_thuoc)->select('ten_thuoc', 'quy_cach_dong_goi')->first();
                                            if (isset($query1) && $query1) {
                                            $namethucan1[$id_thuoc]['name1'] = $query1->ten_thuoc;
                                            $namethucan1[$id_thuoc]['donvi'] = $query1->ten_thuoc;

                                            }


                                        }
                                    }
                                }
                            }  
                        }

            }}
            
        

    $tong_thucan = 0;
      foreach ($dinhluong as $valu1) {
            $tong_thucan += $valu1;
        }
 

      
       
        $tong_thuoc = 0;
        foreach ($thuoc as $ky => $valu) {
            $tong_thuoc += $valu;
        }
        

        // if ($numberDays == 0) {
          
                
        //         foreach ($dinh_luong as $key => $value1) {
        //         $thucantest .= self::getTenThucAn($key) . ':0<br>';
            
        //     }
           
            

        //     foreach ($thuoc as $key => $value2) {
        //         $thuoc1 .= self::getTenThuoc($key) . ':0<br>';
        //     }
        // } else if ($numberDays <= $giong_ga['thoi_giannuoi'] && $numberDays > 0) {
          
            
        //     foreach ($dinh_luong as $key => $value1) {
        //         $thucantest .= self::getTenThucAn($key).':'.$thucancon[$key].'g - '.round($thucancon[$key]/($donvithucan[$key]*1000),3).'bao - $' . number_format($value1,0,'.','.')  . ' (vnd)<br>';
                

        //     }
            
        //     foreach ($thuoc as $key => $value2) {
        //         if(isset($quycach[$key])&&$quycach[$key]==1||$quycach[$key]==2){
        //                 $donvi='g';
        //                 if($quycach[$key]==1){
        //                    $a='gói' ;
        //                 }elseif ($quycach[$key]==2) {
        //                     $a='hộp';
        //                 }
        //         }
        //         else{
        //             $donvi='ml';
        //             if($quycach[$key]==3){
        //                 $a='chai';
        //             }elseif ($quycach[$key]==4) {
        //                 $a='lọ';
        //             }
        //         }
        //         $thuoc1 .= self::getTenThuoc($key) . ':'.$thuoccon[$key].' '.$donvi.' - '.round($thuoccon[$key]/($donvithuoc[$key]),3).' '.$a.' - $' . number_format($value2,0,'.','.') . ' (vnd)<br>';
        //     }
         
        // }
        $soluong_ga = ChuongTrai::join('giongga', 'giongga.id', '=', 'chuong.id_giongga')->select('giongga.id', 'giongga.ten_giongga', 'chuong.id_giongga', 'chuong.so_luong', 'chuong.id', 'chuong.gia_nhap_ga')->where('chuong.id', $id)->first()->toArray();


        $tien_ga = $soluong_ga['so_luong'] * $soluong_ga['gia_nhap_ga'];


       
        // if ($ngayhientai > 0) {
        //     foreach ($sl as $khoa => $ketqua) {
        //         $so_luong_con = $ketqua;
        //     }
           
        //     $kg = ChuongTrai::join('giongga', 'giongga.id', '=', 'chuong.id_giongga')->select('giongga.trong_luong_xuat_ban as tlb', 'chuong.gia_xuat as gi', 'chuong.id')->where('chuong.id', $id)->first()->toArray();
        //     if (isset($so_luong_con) && $so_luong_con) {
        //         $loi_nhuan = $so_luong_con[0] * ($kg['tlb']) * ($kg['gi']);
                
                
        //     }
        //     $result['loinhuan'] = $loi_nhuan;
        // }
        //     $re = ' <tr class="headings">
        //         <td>' . $sl[1][0] . '</td>
        //         <td> ' . $thucantest . '</td>

        //         <td>' . $thuoc1 . '</td>
               
                        
        //         </tr>';

        
        $result['tien_ga'] = $tien_ga;
        $result['tong_thuoc'] = $tong_thuoc;

        $result['tong_thucan'] = $tong_thucan;
        $result['tong_chiphi'] = $tong_thucan + $tong_thuoc + $tien_ga;
        

        return $result;

    }

    static function getTenThucAn($id_thucan)
    {
        $query = Thucan::where('id', $id_thucan)->select('ten_thucan')->first();
        $namethucan = $query->ten_thucan;
        return $namethucan;
    }

    static function getTenThuoc($id_thuoc)
    {
        $query = Thuoc::where('id', $id_thuoc)->select('ten_thuoc')->first();
        $namethucan = $query->ten_thuoc;
        return $namethucan;
    }
}

?>