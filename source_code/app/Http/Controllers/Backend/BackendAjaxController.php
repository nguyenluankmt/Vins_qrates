<?php
namespace App\Http\Controllers\Backend;

use App\University;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Giongga;
use App\Lichthuan;
use App\LichTiemThuoc;
use App\Thucan, App\Thuoc;
use App\Update;
use App\ChuongTrai;
use App\Galoai;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class BackendAjaxController extends Controller
{
    /**
     * @return array|mixed|object
     */
    public function postThucAnThucTe()
    {
        extract($_POST);
        //dd($_POST);

        ///hien thi ajax
        $chuong = ChuongTrai::join('giongga', 'giongga.id', '=', 'chuong.id_giongga')->select('chuong.thoigian_nuoi as tgn', 'giongga.id', 'giongga.ten_giongga', 'giongga.thoi_giannuoi', 'chuong.id_giongga', 'chuong.so_luong', 'chuong.ten_chuong')->where('chuong.id', $id)->first();

        $giong_ga = ChuongTrai::join('giongga', 'giongga.id', '=', 'chuong.id_giongga')->select('giongga.thoi_giannuoi','gia_nhap_ga','so_luong')->where('chuong.id', $id)->first();


        $db = Lichthuan::join('thucan', 'thucan.id', '=', 'luong_thuc_an.id_thucan')->select('thucan.id', 'thucan.ten_thucan', 'luong_thuc_an.id_thucan', 'luong_thuc_an.dinh_luong')->where('luong_thuc_an.id_giong_ga', $chuong['id_giongga'])->first()->toArray();
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
        $dh = json_decode($db['dinh_luong'], true);
        $dinhluong = array();
        $thuoc = array();
        $thucan = array();
        $thucancon=array();
        $thuoccon=array();
        $donvithucan=array();
        $donvithuoc=array();
        $quycach=array();


        foreach ($dh as $keyt => $val) {


            if ($numberDays <= $giong_ga['thoi_giannuoi']) {


                for ($i = 1; $i <= $numberDays; $i++) {


                    foreach ($val[$i][0][0] as $key3 => $val1) {
                    $replace_thucan = str_replace(' ', '', $val1);

                        //$replace_thucan = str_replace(' ', '', $val[$i][0][0][0]);
                        $tien_thucan = Thucan::select('id', 'ten_thucan', 'gia_nhap_thucan', 'khoi_luong_tinh')->get()->toArray();
                        
                      

                        foreach ($tien_thucan as $v) {


                           
                            if ($sl == null) {
                                if (isset($replace_thucan) && $replace_thucan == $v['id']) {

                                    if (array_key_exists($replace_thucan, $thucan) == true) {
                                        $thucan[$replace_thucan] += ($capnhap * $val[$i][0][1][$key3]) * ($v['gia_nhap_thucan'] / ($v['khoi_luong_tinh'] * 1000));
                                        $thucancon[$replace_thucan] += ($capnhap * $val[$i][0][1][$key3]);
                                       $donvithucan[$replace_thucan]=$v['khoi_luong_tinh'];
                                        
                                    } else {
                                        $thucan[$replace_thucan] = ($capnhap * $val[$i][0][1][$key3]) * ($v['gia_nhap_thucan'] / ($v['khoi_luong_tinh'] * 1000));
                                        $thucancon[$replace_thucan] = ($capnhap * $val[$i][0][1][$key3]);
                                        $donvithucan[$replace_thucan]=$v['khoi_luong_tinh'];

                                    }

                                }

                            } else {
                                if (isset($replace_thucan) && $replace_thucan == $v['id']) {

                                    if (array_key_exists($replace_thucan, $thucan) == true) {
                                        $thucan[$replace_thucan] += ($sl[$i][0] * $val[$i][0][1][$key3]) * ($v['gia_nhap_thucan'] / ($v['khoi_luong_tinh'] * 1000));
                                        $thucancon[$replace_thucan] += ($sl[$i][0] * $val[$i][0][1][$key3]);
                                         $donvithucan[$replace_thucan]=$v['khoi_luong_tinh'];
                                    } else {
                                        $thucan[$replace_thucan] = ($sl[$i][0] * $val[$i][0][1][$key3]) * ($v['gia_nhap_thucan'] / ($v['khoi_luong_tinh'] * 1000));
                                         $thucancon[$replace_thucan] = ($sl[$i][0] * $val[$i][0][1][$key3]);
                                          $donvithucan[$replace_thucan]=$v['khoi_luong_tinh'];
                                    }


                                }
                            }
                        }
                    }
                }

                for ($k = 1; $k <= $numberDays; $k++) {
                    foreach ($val[$k][1][0] as $key4 => $val2) {

                        $tien_thuoc = Thuoc::select('id', 'gia_nhap_thuoc', 'ten_thuoc', 'don_vi','quy_cach_dong_goi')->get()->toArray();

                        foreach ($tien_thuoc as $va) {
                            $replace_thuoc = str_replace(' ', '', $val2);
                            if ($sl == null) {
                                if (isset($replace_thuoc) && $replace_thuoc == $va['id']) {

                                    if ($replace_thuoc != '' || $replace_thuoc != null) {
                                        if (array_key_exists($replace_thuoc, $thuoc) == true) {
                                            //var_dump($thuoc[$replace_thuoc]);
                                            $thuoc[$replace_thuoc] += ($capnhap * $val[$k][1][1][$key4]) * ($va['gia_nhap_thuoc'] / $va['don_vi']);
                                            $thuoccon[$replace_thuoc] += ($capnhap * $val[$k][1][1][$key4]);
                                            $donvithuoc[$replace_thuoc]=$va['don_vi'];
                                            $quycach[$replace_thuoc]=$va['quy_cach_dong_goi'];
                                        } else {
                                            $thuoc[$replace_thuoc] = ($capnhap * $val[$k][1][1][$key4]) * ($va['gia_nhap_thuoc'] / $va['don_vi']);
                                            $thuoccon[$replace_thuoc] = ($capnhap * $val[$k][1][1][$key4]);
                                            $donvithuoc[$replace_thuoc]=$va['don_vi'];
                                            $quycach[$replace_thuoc]=$va['quy_cach_dong_goi'];
                                            //var_dump($thuoc[$replace_thuoc]);
                                        }
                                    }
                                }
                            } else {
                                if (isset($replace_thuoc) && $replace_thuoc == $va['id']) {

                                    if ($replace_thuoc != '' || $replace_thuoc != null) {
                                        if (array_key_exists($replace_thuoc, $thuoc) == true) {
                                            //var_dump($thuoc[$replace_thuoc]);
                                            $thuoc[$replace_thuoc] += ($sl[$k][0] * $val[$k][1][1][$key4]) * ($va['gia_nhap_thuoc'] / $va['don_vi']);
                                            $thuoccon[$replace_thuoc] += ($sl[$k][0] * $val[$k][1][1][$key4]);
                                            $donvithuoc[$replace_thuoc]=$va['don_vi'];
                                            $quycach[$replace_thuoc]=$va['quy_cach_dong_goi'];
                                        } else {
                                            $thuoc[$replace_thuoc] = ($sl[$k][0] * $val[$k][1][1][$key4]) * ($va['gia_nhap_thuoc'] / $va['don_vi']);
                                            $thuoccon[$replace_thuoc]= ($sl[$k][0] * $val[$k][1][1][$key4]);
                                            $donvithuoc[$replace_thuoc]=$va['don_vi'];
                                            $quycach[$replace_thuoc]=$va['quy_cach_dong_goi'];
                                            //var_dump($thuoc[$replace_thuoc]);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }


            } else {

                foreach ($val as $ke => $kqvalue) {


                    foreach ($kqvalue[0][0] as $key3 => $val1) {


                        //$replace_thucan = str_replace(' ', '', $val[$i][0][0][0]);
                        $tien_thucan = Thucan::select('id', 'ten_thucan', 'gia_nhap_thucan', 'khoi_luong_tinh')->get()->toArray();

                        foreach ($tien_thucan as $v) {


                            $replace_thucan = str_replace(' ', '', $val1);
                            if ($sl == null) {
                                if (isset($replace_thucan) && $replace_thucan == $v['id']) {

                                    if (array_key_exists($replace_thucan, $thucan) == true) {
                                        $thucan[$replace_thucan] += ($capnhap * $val[$ke][0][1][$key3]) * ($v['gia_nhap_thucan'] / ($v['khoi_luong_tinh'] * 1000));
                                         $thucancon[$replace_thucan] += ($capnhap * $val[$ke][0][1][$key3]);
                                          $donvithucan[$replace_thucan]=$v['khoi_luong_tinh'];
                                    } else {
                                        $thucan[$replace_thucan] = ($capnhap * $val[$ke][0][1][$key3]) * ($v['gia_nhap_thucan'] / ($v['khoi_luong_tinh'] * 1000));
                                         $thucancon[$replace_thucan] = ($capnhap * $val[$ke][0][1][$key3]);
                                          $donvithucan[$replace_thucan]=$v['khoi_luong_tinh'];

                                    }

                                }

                            } else {
                                if (isset($replace_thucan) && $replace_thucan == $v['id']) {

                                    if (array_key_exists($replace_thucan, $thucan) == true) {
                                        $thucan[$replace_thucan] += ($sl[$ke][0] * $val[$ke][0][1][$key3]) * ($v['gia_nhap_thucan'] / ($v['khoi_luong_tinh'] * 1000));
                                         $thucancon[$replace_thucan] += ($sl[$ke][0] * $val[$ke][0][1][$key3]);
                                          $donvithucan[$replace_thucan]=$v['khoi_luong_tinh'];
                                    } else {
                                        $thucan[$replace_thucan] = ($sl[$ke][0] * $val[$ke][0][1][$key3]) * ($v['gia_nhap_thucan'] / ($v['khoi_luong_tinh'] * 1000));
                                         $thucancon[$replace_thucan] = ($sl[$ke][0] * $val[$ke][0][1][$key3]);
                                          $donvithucan[$replace_thucan]=$v['khoi_luong_tinh'];
                                    }


                                }
                            }
                        }
                    }


                    foreach ($kqvalue[1][0] as $key4 => $val2) {

                        $tien_thuoc = Thuoc::select('id', 'gia_nhap_thuoc', 'ten_thuoc', 'don_vi')->get()->toArray();

                        foreach ($tien_thuoc as $va) {
                            $replace_thuoc = str_replace(' ', '', $val2);
                            if ($sl == null) {
                                if (isset($replace_thuoc) && $replace_thuoc == $va['id']) {

                                    if ($replace_thuoc != '' || $replace_thuoc != null) {
                                        if (array_key_exists($replace_thuoc, $thuoc) == true) {
                                            //var_dump($thuoc[$replace_thuoc]);
                                            $thuoccon[$replace_thuoc] += ($capnhap * $val[$ke][1][1][$key4]) * ($va['gia_nhap_thuoc'] / $va['don_vi']);
                                            $donvithuoc[$replace_thuoc]=$va['don_vi'];
                                        } else {
                                            $thuoc[$replace_thuoc] = ($capnhap * $val[$ke][1][1][$key4]) * ($va['gia_nhap_thuoc'] / $va['don_vi']);
                                             $thuoccon[$replace_thuoc] = ($capnhap * $val[$ke][1][1][$key4]);
                                            $donvithuoc[$replace_thuoc]=$va['don_vi'];
                                            //var_dump($thuoc[$replace_thuoc]);
                                        }
                                    }
                                }
                            } else {
                                if (isset($replace_thuoc) && $replace_thuoc == $va['id']) {

                                    if ($replace_thuoc != '' || $replace_thuoc != null) {
                                        if (array_key_exists($replace_thuoc, $thuoc) == true) {
                                            //var_dump($thuoc[$replace_thuoc]);
                                            $thuoc[$replace_thuoc] += ($sl[$ke][0] * $val[$ke][1][1][$key4]) * ($va['gia_nhap_thuoc'] / $va['don_vi']);
                                             $thuoccon[$replace_thuoc] += ($sl[$ke][0] * $val[$ke][1][1][$key4]);
                                            $donvithuoc[$replace_thuoc]=$va['don_vi'];
                                        } else {
                                            $thuoc[$replace_thuoc] = ($sl[$ke][0] * $val[$ke][1][1][$key4]) * ($va['gia_nhap_thuoc'] / $va['don_vi']);
                                             $thuoccon[$replace_thuoc] = ($sl[$ke][0] * $val[$ke][1][1][$key4]);
                                            $donvithuoc[$replace_thuoc]=$va['don_vi'];
                                            //var_dump($thuoc[$replace_thuoc]);
                                        }
                                    }
                                }
                            }
                        }
                    }

                }
            }

        }

        $tong_thucan = 0;
        foreach ($thucan as $valu1) {
            $tong_thucan += $valu1;
        }
        // dd($tong_thucan);
        $tong_thuoc = 0;
        foreach ($thuoc as $ky => $valu) {
            $tong_thuoc += $valu;
        }

        if ($numberDays == 0) {
          
                
                foreach ($thucan as $key => $value1) {
                $thucantest .= self::getTenThucAn($key) . ':0<br>';
            
            }
           
            

            foreach ($thuoc as $key => $value2) {
                $thuoc1 .= self::getTenThuoc($key) . ':0<br>';
            }
        } else if ($numberDays <= $giong_ga['thoi_giannuoi'] && $numberDays > 0) {
          
            
            foreach ($thucan as $key => $value1) {
                $thucantest .= self::getTenThucAn($key).':'.$thucancon[$key].'g - '.round($thucancon[$key]/($donvithucan[$key]*1000),3).'bao - $' . number_format($value1,0,'.','.')  . ' (vnd)<br>';
                

            }
            
            foreach ($thuoc as $key => $value2) {
                if(isset($quycach[$key])&&$quycach[$key]==1||$quycach[$key]==2){
                        $donvi='g';
                        if($quycach[$key]==1){
                           $a='gói' ;
                        }elseif ($quycach[$key]==2) {
                            $a='hộp';
                        }
                }
                else{
                    $donvi='ml';
                    if($quycach[$key]==3){
                        $a='chai';
                    }elseif ($quycach[$key]==4) {
                        $a='lọ';
                    }
                }
                $thuoc1 .= self::getTenThuoc($key) . ':'.$thuoccon[$key].' '.$donvi.' - '.round($thuoccon[$key]/($donvithuoc[$key]),3).' '.$a.' - $' . number_format($value2,0,'.','.') . ' (vnd)<br>';
            }
         
        }
        $soluong_ga = ChuongTrai::join('giongga', 'giongga.id', '=', 'chuong.id_giongga')->select('giongga.id', 'giongga.ten_giongga', 'chuong.id_giongga', 'chuong.so_luong', 'chuong.id', 'chuong.gia_nhap_ga')->where('chuong.id', $id)->first()->toArray();


        $tien_ga = $soluong_ga['so_luong'] * $soluong_ga['gia_nhap_ga'];


       
        if ($ngayhientai > 0) {
            foreach ($sl as $khoa => $ketqua) {
                $so_luong_con = $ketqua;
            }
           
            $kg = ChuongTrai::join('giongga', 'giongga.id', '=', 'chuong.id_giongga')->select('giongga.trong_luong_xuat_ban as tlb', 'chuong.gia_xuat as gi', 'chuong.id')->where('chuong.id', $id)->first()->toArray();
            if (isset($so_luong_con) && $so_luong_con) {
                $loi_nhuan = $so_luong_con[0] * ($kg['tlb']) * ($kg['gi']);
                
                
            }
            $result['loinhuan'] = $loi_nhuan;
        }
            $re = ' <tr class="headings">
                <td>' . $sl[1][0] . '</td>
                <td> ' . $thucantest . '</td>

                <td>' . $thuoc1 . '</td>
               
                        
                </tr>';

        $result['re'] = $re;
        $result['tien_ga'] = $tien_ga;
        $result['tong_thuoc'] = $tong_thuoc;

        $result['tong_thucan'] = $tong_thucan;
        $result['tong_chiphi'] = $tong_thucan + $tong_thuoc + $tien_ga;
        $results = json_encode($result);

        return $results;

    }


    public function postThucAn()
    {
        extract($_POST);
        $tatca = Thucan::select('id', 'ten_thucan', 'nsx')->get()->toArray();
//        $thuc_an=Thucan::select('id','ten_thucan','nsx')->where('id',$id)->get()->toArray();

        $results = "<option value=''>-- Hãy chọn thức ăn --</option>";
        foreach ($tatca as $value) {
            if ($id == $value['id']) {
                $results .= '<option title="' . $value['ten_thucan'] . ' - ' . $value['nsx'] . '" selected  value="' . $value['id'] . '">' . $value['ten_thucan'] . '</option>';
            }
            $results .= '<option title="' . $value['ten_thucan'] . ' - ' . $value['nsx'] . '"  value="' . $value['id'] . '">' . $value['ten_thucan'] . '</option>';
        }
        echo $results;
    }

    public function postViewloaithai()
    {
        extract($_POST);

        $update = Update::where('id_chuong', $id_chuong)->select('thuoc_thucte')->first();
        $loaithai = json_decode($update->thuoc_thucte);
        if (count($loaithai)) {
            foreach ($loaithai as $key => $item) {
                if ($ngay == $key) {
                    $soluong = $item[0][0];
                    $nguyennhan = $item[0][1];
                }
            }
        }
        $i = 1;
        $html = '';
        // dd($soluong);
        foreach ($soluong as $key1 => $item1) {
            $html .= '<div class="form-group" id="group' . $i . '">';
            $html .= ' <label>số lượng&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>';
            $html .= '<input id="loai-thai-ngay" style="width:60px" class="khungvien4" type="text" value="' . $item1 . '" name="data_' . $id_chuong . '_' . $ngay . '[loai_thai][]">';
            $html .= ' <label>&nbsp;&nbsp;&nbsp;Nguyên nhân&nbsp;&nbsp;&nbsp;</label>';
            $html .= '<input id="nguyen-nhan-ngay" class="khungvien4" type="text" value="' . $nguyennhan[$key1] . '" name="data_' . $id_chuong . '_' . $ngay . '[nguyen_nhan][]">&nbsp;&nbsp;&nbsp;';
            $html .= '<a style="height:30px;margin-top: 5px;" group-xoa="' . $i . '" href="javascript:void(0)"';
            $html .= 'class="nut5 btn btn-default ">-</a> ';
            $html .= '<script>';
            $html .= '$(".nut5").on("click", function () {';
            $html .= 'var xoa = $(this).attr("group-xoa");';
            $html .= '$(this).remove();';
            $html .= '$("#group"+xoa).remove();';
            $html .= ' });';
            $html .= "</script></div>";
            $i++;
        }
        return $html;
    }
    public function postViewimage(){
        extract($_POST);
        $update = Update::where('id_chuong', $id_chuong)->select('thucan_dukien')->first();
        $loaithai = json_decode($update->thucan_dukien);
        if (count($loaithai)) {
            foreach ($loaithai as $key => $item) {
                if ($ngay == $key) {
                    $image = $item;
                }
            }
        }
        if(isset($image)){
            $link = Config::get('app.url') . '/uploads/update/medium/' . $image;
            $data['link'] = $link;
            $data['image'] = $image;
            return $data;
        }else{
            return 0;
        }


    }
    public function postLoadimage(){
        extract($_POST);
        $dulieu = Update::where('id_chuong', $id_chuong)->select('thucan_dukien')->first();
        $album = json_decode($dulieu->thucan_dukien);
        $check = false;
        if(count($album)){
            foreach ($album as $key => $item) {
                if ($ngay == $key) {
                    $update[$ngay] = $image;
                    $check = true;
                } else {
                    $update[$key] = $item;
                }
            }

            if (!$check) {
                $update[$ngay] = $image;
            }
        }else {
            $update[$ngay] = $image;
        }

        Update::where('id_chuong', $id_chuong)->update([
            'thucan_dukien' => json_encode($update,JSON_UNESCAPED_UNICODE),
        ]);

        return 1;

    }
    public function postUpdateloaithai()
    {
        extract($_POST);
        $dulieu = Update::where('id_chuong', $id_chuong)->select('thuoc_thucte')->first();
        $loaithai = json_decode($dulieu->thuoc_thucte);
        $count = 0;
        foreach ($soluong as $item) {
            $count += $item;
        }
        //dd($soluong);
        $check = false;
        if (count($loaithai)) {
            foreach ($loaithai as $key => $item) {
                //dd($item);
                if ($ngay == $key) {
                    $update[$ngay][] = array(
                        $soluong,
                        $nguyennhan,
                    );
                    $check = true;
                } else {
                    $update[$key][] = array(
                        $item[0][0],
                        $item[0][1],
                    );
                }
            }
            if (!$check) {
                $update[$ngay][] = array(
                    $soluong,
                    $nguyennhan,
                );
            }

        } else {
            $update[$ngay][] = array(
                $soluong,
                $nguyennhan,
            );
        }


        Update::where('id_chuong', $id_chuong)->update([
            'thuoc_thucte' => json_encode($update,JSON_UNESCAPED_UNICODE),
        ]);
        return $count;
    }

    public function postChuong()
    {
        extract($_POST);
        //dd($_POST);

        ///hien thi ajax
        $chuong = ChuongTrai::join('giongga', 'giongga.id', '=', 'chuong.id_giongga')->select('chuong.thoigian_nuoi as tgn', 'giongga.id', 'giongga.ten_giongga', 'giongga.thoi_giannuoi', 'chuong.id_giongga', 'chuong.so_luong', 'chuong.ten_chuong')->where('chuong.id', $id)->first();

        $giong_ga = ChuongTrai::join('giongga', 'giongga.id', '=', 'chuong.id_giongga')->select('giongga.thoi_giannuoi')->where('chuong.id', $id)->first();

        $db = Lichthuan::join('thucan', 'thucan.id', '=', 'luong_thuc_an.id_thucan')->select('thucan.id', 'thucan.ten_thucan', 'luong_thuc_an.id_thucan', 'luong_thuc_an.dinh_luong')->where('luong_thuc_an.id_giong_ga', $chuong['id_giongga'])->first()->toArray();

        $mucluong = ChuongTrai::select('id', 'so_luong')->where('id', $id)->first()->toArray();

        $sl_bandau = ChuongTrai::where('id', $id)->first();

        $update = Update::where('id_chuong', $id)->select('thuoc_thucte')->first();
        $loaithai = json_decode($update['thuoc_thucte']);
        $soluong = array();


        if (count($loaithai)) {
            $sl_loaithai = 0;
            foreach ($loaithai as $key => $sl) {
                foreach ($sl[0][0] as $val) {
                    $sl_loaithai = $sl_loaithai + $val;
                }
            }
        }

        $ga_loaithai = isset($sl_loaithai) ? $sl_loaithai . ' con' : "Đang cập nhật";
        $ga_hientai = isset($sl_loaithai) ? $chuong['so_luong'] - $sl_loaithai . ' con' : $chuong['so_luong'] . ' con';
        // dd($ga_hientai);
        $thucantest = '';
        $thuoc1 = '';
        $date_now = date("Y-m-d H:i:s");
        $startTimeStamp = strtotime($date_now);

        $endTimeStamp = strtotime($chuong['tgn']);

        $timeDiff = abs($endTimeStamp - $startTimeStamp);

        $numberDays = intval(ceil($timeDiff / 86400));


        if (isset($mucluong) && $mucluong['so_luong'])
            $capnhap = str_replace(' ', '', $mucluong['so_luong']);
        else
            $capnhap = 1;

        $id_thucan = array();
        $id_thuoc = array();
        $luong_thucan = array();
        $dh = json_decode($db['dinh_luong'], true);

        $dinhluong = array();
        $thuoc = array();
        $thucan = array();
        $donvithucan = array();
        $donvithuoc=array();
        $thucancon=array();
        $thuoccon=array();


        foreach ($dh as $val) {


            if ($numberDays <= $giong_ga['thoi_giannuoi']) {

                for ($i = 1; $i <= $numberDays; $i++) {
                     $tien_thucan = Thucan::select('id', 'ten_thucan', 'gia_nhap_thucan', 'khoi_luong_tinh')->get()->toArray();

                    foreach ($tien_thucan as $v) {


                        foreach ($val[$i][0][0] as $key3 => $val1) {

                            $replace_thucan = str_replace(' ', '', $val1);
                            if (isset($replace_thucan) && $replace_thucan == $v['id']) {

                                    if (array_key_exists($replace_thucan, $thucan) == true) {
                                        $thucancon[$replace_thucan] += ($capnhap * $val[$i][0][1][$key3]) * ($v['gia_nhap_thucan'] / ($v['khoi_luong_tinh'] * 1000));
                                       $thucan[$replace_thucan] += $capnhap * $val[$i][0][1][$key3];
                                       $donvithucan[$replace_thucan]=$v['khoi_luong_tinh'];
                                        
                                    } else {
                                        $thucancon[$replace_thucan] = ($capnhap * $val[$i][0][1][$key3]) * ($v['gia_nhap_thucan'] / ($v['khoi_luong_tinh'] * 1000));
                                       
                                         $thucan[$replace_thucan] = $capnhap * $val[$i][0][1][$key3];
                                        $donvithucan[$replace_thucan]=$v['khoi_luong_tinh'];

                                    }

                                }

                        }
                    }
                }

                for ($k = 1; $k <= $numberDays; $k++) {

                    foreach ($val[$k][1][0] as $key4 => $val2) {
                        $tien_thuoc = Thuoc::select('id', 'gia_nhap_thuoc', 'ten_thuoc', 'don_vi')->get()->toArray();
                         foreach ($tien_thuoc as $va) {
                        $replace_thuoc = str_replace(' ', '', $val2);
                            if (isset($replace_thuoc) && $replace_thuoc == $va['id']) {

                                if ($replace_thuoc != '' || $replace_thuoc != null) {
                                    if (array_key_exists($replace_thuoc, $thuoc) == true) {
                                        $thuoc[$replace_thuoc] += $capnhap * $val[$k][1][1][$key4];
                                        $thuoccon[$replace_thuoc] += ($capnhap * $val[$k][1][1][$key4]) * ($va['gia_nhap_thuoc'] / $va['don_vi']);
                                        $donvithuoc[$replace_thuoc]=$va['don_vi'];
                                    } else {
                                        $thuoccon[$replace_thuoc] = ($capnhap * $val[$k][1][1][$key4]) * ($va['gia_nhap_thuoc'] / $va['don_vi']);
                                         $thuoc[$replace_thuoc] = ($capnhap * $val[$k][1][1][$key4]);
                                        $donvithuoc[$replace_thuoc]=$va['don_vi'];
                                        //var_dump($thuoc[$replace_thuoc]);
                                    }
                                }
                            }
                        }
                    }   
                }


            }
        }

     
        if ($numberDays == 0) {
            foreach ($thucan as $key => $value1) {
                $thucantest .= self::getTenThucAn($key) . ':0<br>';
            }
            // dd($thuoc);
            foreach ($thuoc as $key => $value2) {
                $thuoc1 .= self::getTenThuoc($key) . ':0<br>';
            }
        } else if ($numberDays <= $giong_ga['thoi_giannuoi'] && $numberDays > 0) {
            foreach ($thucan as $key => $value1) {
                $thucantest .= self::getTenThucAn($key) . ':' . $value1 . '<br>';
            }
            //dd($thuoc);
            foreach ($thuoc as $key => $value2) {
                $thuoc1 .= self::getTenThuoc($key) . ':' . $value2 . '<br>';
            }

        }
           



        $resul = ' <tr class="headings">
                       
                <td>' . $chuong['ten_chuong'] . '</td>
                <td>' . $chuong['ten_giongga'] . '</td>
                <td>Đang cập nhật</td>  
                <td style="text-indent:5px;">' . $ga_hientai . '</td>
                <td style="text-indent:5px;">' . $ga_loaithai . '</td>
                <td> ' . $thucantest . '(gam)</td>
                <td>' . $thuoc1 . '(ml)</td>
                        
                </tr>';
                   $tongtienthucan=0;
        foreach ($thucancon as $thuc => $an) {
            $tongtienthucan +=$an;
        }
        $result['tongtienthucan']=$tongtienthucan;
     $tongtienthuoc=0;
     foreach ($thuoccon as $thuoc => $con) {
        $tongtienthuoc+=$con;
     }
     $result['tongtienthuoc']=$tongtienthuoc;
     $soluong_ga = ChuongTrai::join('giongga', 'giongga.id', '=', 'chuong.id_giongga')->select('giongga.id', 'giongga.ten_giongga', 'chuong.id_giongga', 'chuong.so_luong', 'chuong.id', 'chuong.gia_nhap_ga')->where('chuong.id', $id)->first()->toArray();


          $tien_ga = $soluong_ga['so_luong'] * $soluong_ga['gia_nhap_ga'];

           $result['tien_ga']=$tien_ga;  

        $result['resul']=$resul;  
        
        $results=json_encode($result,true);
 
        echo $results;
// 
    }

    public function getTenThucAn($id_thucan)
    {
        $query = Thucan::where('id', $id_thucan)->select('ten_thucan')->first();
        $namethucan = $query->ten_thucan;
        return $namethucan;
    }

    public function getTenThuoc($id_thuoc)
    {
        $query = Thuoc::where('id', $id_thuoc)->select('ten_thuoc')->first();
        $namethucan = $query->ten_thuoc;
        return $namethucan;
    }
    public function postLoadngay(){
        extract($_POST);
        $quytrinh = Lichthuan::where('id', $id_quytrinh)->first();
        $html = '<option value="">Chọn độ tuổi</option>';
        for($i = $number+1; $i <= $quytrinh->do_tuoi; $i++){
            $html .= '<option value="'.$i.'">' . $i . '</option>';
        }
        return $html;
    }
    public function postCapnhap()
    {
        extract($_POST);
        $update = Update::where('id', $id)->first();
        $data_update = json_decode($update->thucan_thucte);
        $quytrinh = Lichthuan::where('id', $id_quytrinh)->first();
        $data_quytrinh = json_decode($quytrinh->dinh_luong);

        $time = ChuongTrai::where('id',$update->id_chuong)->first();
            $ngaynuoi = $time->thoigian_nuoi;
            $ngayban = $time->thoigian_ban;
            $songaynuoi_cu =  intval(ceil(strtotime($ngayban) - strtotime($ngaynuoi)) / 86400);
            $songaynuoi_moi = $quytrinh->do_tuoi;
        $i = 0;
        Session::put('id_quytrinh', $id_quytrinh);
        Session::put('ngay_nuoi', $dotuoi);
        foreach ($data_quytrinh as $value_) {

            foreach ($value_ as $key1_ => $val_) {
                $i++;
                if($key1_ > $quytrinh->do_tuoi){
                    break;
                }
                $thuc_an = array();
                $note = '';
                $thuoc = array();
                $kl_loaithai = '';
                $trongluong_tb = '';
                if ($key1_ >= $dotuoi) {
                    // dd($val_);
                    foreach ($val_[0][0] as $key2_ => $val1_) {
                        //dd($val_[0][1]);
                        $thuc_an[] = [$val1_, $val_[0][1][$key2_]];
                    }
                    foreach ($val_[1][0] as $key2__ => $val1__) {
                        //dd($val_[0][1]);
                        $thuoc[] = [$val1__, $val_[1][1][$key2__]];
                    }
                } else {
                    foreach ($data_update as $check => $value) {

                        foreach ($value as $key => $val) {
                            //dd($val[0]);
                            if ($key == $key1_) {
                                foreach ($val[0] as $key1 => $val1) {
                                    $thuc_an[] = [$val1[0], $val1[1]];
                                }
                                foreach ($val[1] as $key2 => $val2) {
                                    $thuoc[] = [$val2[0], $val1[1]];
                                }
                                $note = $val[2];
                                if(isset($val[3])){
                                    $kl_loaithai = $val[3];
                                }

                                if(isset($val[4])){
                                    $trongluong_tb = $val[4];
                                }
                            }
                        }
                    }
                }
                $quytrinhnuoi[$update->id_chuong][$i] = array(
                    $thuc_an,
                    $thuoc,
                    $note,
                    $kl_loaithai,
                    $trongluong_tb
                );
            }

        }
        $update->thucan_thucte = json_encode($quytrinhnuoi);
        // $time = ChuongTrai::
        $update->do_tuoi = $quytrinh->do_tuoi;
        if($update->save()){

            if ($songaynuoi_cu != $songaynuoi_moi) {
                $ngayban_ud =  date("Y-m-d H:i", strtotime("$ngaynuoi +$songaynuoi_moi day"));
                ChuongTrai::where('id', $update->id_chuong)->update([
                    'thoigian_ban'=> $ngayban_ud,
                ]);
                
            }
            return 1;
            
        }else{
            return 0;
        }
        /*Update::where('id', $id)->update([
            'thucan_thucte' => json_encode($quytrinhnuoi),
            'do_tuoi' => $quytrinh->do_tuoi,
        ]);*/


    }

    public function postCap()
    {
        extract($_POST);
        $data['thucan'] = Thucan::select('id', 'ten_thucan', 'nsx')->get();
        $data['thuoc'] = Thuoc::all();
        $chuong = ChuongTrai::join('giongga', 'giongga.id', '=', 'chuong.id_giongga')->select('chuong.thoigian_nuoi as tgn', 'giongga.id', 'giongga.ten_giongga', 'giongga.thoi_giannuoi', 'chuong.id_giongga', 'chuong.so_luong', 'chuong.ten_chuong')->where('chuong.id', $id)->first();
        $db = Lichthuan::join('thucan', 'thucan.id', '=', 'luong_thuc_an.id_thucan')->select('thucan.id', 'thucan.ten_thucan', 'luong_thuc_an.id_thucan', 'luong_thuc_an.dinh_luong')->where('luong_thuc_an.id_giong_ga', $chuong['id_giongga'])->first();
        $dh = json_decode($db['dinh_luong'], true);
        $date_now = date("Y-m-d H:i:s");
        $startTimeStamp = strtotime($date_now);
        $endTimeStamp = strtotime($chuong['tgn']);
        $timeDiff = abs($endTimeStamp - $startTimeStamp);
        $numberDays = intval(ceil($timeDiff / 86400));
        $giong_ga = ChuongTrai::join('giongga', 'giongga.id', '=', 'chuong.id_giongga')->select('giongga.id', 'giongga.ten_giongga', 'giongga.thoi_giannuoi', 'chuong.id_giongga')->where('chuong.id', $id)->get()->toArray();
        $results = $giong_ga[0]['thoi_giannuoi'];
        $results1 = $id;


        echo '<table class="table table-striped table-bordered dataTable no-footer"  border="" cellpadding="5">';
        echo '<thead style="table-layout: fixed;display:block;">';
        echo ' <tr class="headings">';
        echo '  <th><div class="add_ud_ngay">Độ tuổi \(ngày)</div></th>';
        echo '  <th><div class="add_ud_ta" >Thức ăn</div></th>';
        echo '  <th><div class="add_ud_dl" >Định lượng</div></th>';
        echo '  <th><div class="add_ud_thuoc">Thuốc </div></th>';
        echo '  <th><div class="add_ud_ll" >Liều lượng </div></th>';
        echo '  <th><div class="add_ud_note">Chú ý</div></th>';
        echo '</tr>';
        echo '  </thead>';
        echo '  <tbody class="table-qt">';
        foreach ($dh as $value) {
            foreach ($value as $key => $val) {

                if ($key > $numberDays) {
                    echo '<tr style="opacity:0.4" data-id="' . $key . '"><td style="width:60px;"><input type="hidden" class="khungvien" name="data_' . $results1 . '_' . $key . '[do_tuoi]" value="' . $key . '"/><span >' . $key . '</span></td><td style="width:220px;" id="testselect_' . $key . '"><div class="html' . $key . '">';
                } else {
                    echo '<tr  data-id="' . $key . '"><td style="width:60px;" ><input type="hidden" class="khungvien" name="data_' . $results1 . '_' . $key . '[do_tuoi]" value="' . $key . '"/><span >' . $key . '</span></td><td style="width:220px;  " id="testselect_' . $key . '"><div class="html' . $key . '">';
                }


                $y = 0;

                foreach ($val[0][0] as $key0 => $val_thucan) {
                    $y++;
                    if ($key > $numberDays) {
                        echo ' <input type="hidden"  value="' . $val_thucan . '" name="data_' . $results1 . '_' . $key . '[thucan_id][]">';
                        echo '<select  disabled class="khungvien3 uitip abc" name="data_' . $results1 . '_' . $key . '[thucan_id][]" id="thucan_id' . $key . '">';
                    } else {
                        echo '<select   class="khungvien3 uitip abc thucan_' . $results1 . '_' . $key . '" name="data_' . $results1 . '_' . $key . '[thucan_id][]" id="thucan_id' . $key . '">';
                    }


                    echo '<option value="0">Chọn thức ăn</option>';

                    foreach ($data['thucan'] as $item) {

                        if ($val_thucan == $item['id']) {
                            echo ' <option selected value="' . $item['id'] . '">' . $item['ten_thucan'] . '</option>';
                        } else {
                            echo ' <option value="' . $item['id'] . '">' . $item['ten_thucan'] . '</option>';
                        }


                    }


                    if ($key > $numberDays) {

                        echo '</select></div><a disabled href="javascript:" id_thucan="' . $results1 . '" class="nut1 btn btn-primary them" ida="' . $key . '" >+</a></div>';
                    } else {
                        if ($y == 1) {
                            echo '</select></div><a style="margin-top:5px;" href="javascript:" id_thucan="' . $results1 . '" class="nut1 btn btn-primary them" ida="' . $key . '" >+</a>';

                        } else {
                            echo '</select><a href="javascript:void(0)" class="nut2 btn btn-default xoa2">-</a>';
                        }

                    }

                }
                echo '</td><td style="width:100px;" id="testdl' . $key . '">';

                foreach ($val[0][1] as $key0 => $val_dinhluong) {

                    if ($key > $numberDays) {
                        echo '<input type="hidden" value="' . $val_dinhluong . '" name="data_' . $results1 . '_' . $key . '[dinh_luong][]" class="khungvien1" type="text"/>';
                        echo '<input disabled value="' . $val_dinhluong . '" name="data_' . $results1 . '_' . $key . '[dinh_luong][]" class="khungvien1" type="text"/>';
                    } else {
                        echo '<input value="' . $val_dinhluong . '" name="data_' . $results1 . '_' . $key . '[dinh_luong][]" class="khungvien1" type="text"/>';
                    }


                }

                ///thuoc
                echo '</td><td style="width:220px;" id="selectthuoc' . $key . '"> <div class="thuochtml' . $key . '">';
                $j = 0;
                foreach ($val[1][0] as $key1 => $val_thuoc) {
                    $j++;
                    if ($key > $numberDays) {
                        echo ' <input type="hidden"  value="' . $val_thuoc . '" name="data_' . $results1 . '_' . $key . '[thuoc][]">';
                        echo '<select disabled class="khungvien3" name="data_' . $results1 . '_' . $key . '[thuoc][]" id="thuoc' . $key1 . '">';
                    } else {
                        echo '<select class="khungvien3 thuoc_' . $results1 . '_' . $key . '" name="data_' . $results1 . '_' . $key . '[thuoc][]" id="thuoc' . $key . '">';
                    }

                    echo '<option value="0">Chọn thuốc</option>';
                    foreach ($data['thuoc'] as $ite) {
                        if ($val_thuoc == $ite['id']) {
                            echo ' <option selected value="' . $ite['id'] . '">' . $ite['ten_thuoc'] . '</option>';
                        } else {
                            echo ' <option value="' . $ite['id'] . '">' . $ite['ten_thuoc'] . ' </option>';
                        }

                    }
                    if ($key > $numberDays) {
                        echo '</select></div><a disabled href="javascript:" id_thuoc="' . $results1 . '" class="nut1 btn btn-primary themcon" ida="' . $key . '" >+</a>';
                    } else {

                        if ($j == 1) {
                            echo '</select></div><a style="margin-top:5px;" href="javascript:" id_thuoc="' . $results1 . '" class="nut1 btn btn-primary themcon" ida="' . $key . '" >+</a>';

                        } else {
                            echo '</select><a href="javascript:void(0)" class="nut2 btn btn-default xoacon">-</a>';
                        }
                    }

                }


                echo '</td><td style="width:100px;" id="testt' . $key . '">';
                foreach ($val[1][1] as $key0 => $val_lieuluong) {
                    if ($key > $numberDays) {
                        echo '<input disabled value="' . $val_lieuluong . '" name="data_' . $results1 . '_' . $key . '[lieu_luong][]" class="khungvien1" type="text"/>';
                        echo '<input type="hidden" value="' . $val_lieuluong . '" name="data_' . $results1 . '_' . $key . '[lieu_luong][]" class="khungvien1" type="text"/>';
                    } else {
                        echo '<input value="' . $val_lieuluong . '" name="data_' . $results1 . '_' . $key . '[lieu_luong][]" class="khungvien1" type="text"/>';
                    }


                }


                //echo '</td><td>';

                echo '<td style="width:300px;"><input style="width:250px;" value="' . $val[2] . '" class="khungvien2" name="data_' . $results1 . '_' . $key . '[note]" type="text"/></td>';
                echo '<input name="test" type="hidden" value="' . $chuong['thoi_giannuoi'] . '"/>';

                echo '</tr>';


            }


            echo '</tbody>';
            echo '</table>';
            echo FunctionController::getJSUpdate();
        }
    }

    /// hien thi giong ga
    public
    function postGiongGa()
    {
        extract($_POST);
        $data['users'] = Thucan::select('id', 'ten_thucan', 'nsx')->get();
        $data['thuoc'] = Thuoc::all();
        $dem = count($data['thuoc']);
        $giong_ga = Giongga::select('id', 'ten_giongga', 'thoi_giannuoi')->where('id', $id)->get()->toArray();
        $results = $giong_ga[0]['thoi_giannuoi'];
        $results1 = $giong_ga[0]['id'];


        echo '<table class="table table-striped table-bordered dataTable no-footer"  border="" cellpadding="5" >';
        echo '<thead style="table-layout: fixed;display:block;">';
        echo ' <tr class="headings">';
        echo '  <th><div class="qt_add_ngay">Ngày</div></th>';
        echo '  <th><div class="qt_add_ta">Thức ăn</div></th>';
        echo '  <th><div class="qt_add_dl">Định lượng (g)</div></th>';
        echo '  <th><div class="qt_add_thuoc">Thuốc </div></th>';
        echo '  <th><div class="qt_add_ll">Liều lượng </div></th>';
        echo '  <th><div class="qt_add_kl">Khối lượng </div></th>';
        echo '  <th><div class="qt_add_note">Chú ý</div></th>';
        echo '</tr>';
        echo '</thead>';
        echo '  <tbody class="table-qt">';


        for ($i = 1; $i <= $results; $i++) {

            echo '<tr style="display: none;"><td id="default"><div class="col-xs-12 ' . $results1 . '-' . $i . ' " style="padding: 0px;"><option selected value="">Chọn thức ăn</option>';
            foreach ($data['users'] as $item) {
                echo ' <option class="thucan" title="' . $item['ten_thucan'] . ' - ' . $item['nsx'] . '" value="' . $item['id'] . '">' . $item['ten_thucan'] . '</option>';
            }
            echo '</div></td>';
            echo '</tr>';
            echo '<tr style="display: none;"><td id="de_fault"><div id="test_thuoc" class="col-xs-12 ' . $results1 . '-' . $i . '-' . $i . ' " style="padding: 0px;"><option id="thuoc_id" selected value="">Chọn thuốc </option>';
            foreach ($data['thuoc'] as $ite) {
                echo ' <option quy_cach="' . $ite['quy_cach_dong_goi'] . '" title="' . $ite['ten_thuoc'] . ' - ' . $ite['nsx'] . '" value="' . $ite['id'] . '">' . $ite['ten_thuoc'] . '</option>';
            }
            echo '</div></td>';
            echo '</tr>';
            echo '<tr data-id="' . $i . '"><td style="width:55px;"><input type="hidden" class="khungvien" name="data_' . $results1 . '_' . $i . '[do_tuoi]" value="' . $i . '"/><span >' . $i . '</span></td>';

            echo '<td style="width: 205px" id="testselect_' . $i . '"><div id="dulieu' . $i . '"><select  class="khungvien3 uitip abc thucan_' . $results1 . '_' . $i . '" title="" name="data_' . $results1 . '_' . $i . '[thucan_id][]" id="thucan_id">';
            echo '<option value="0">Chọn thức ăn</option>';
            foreach ($data['users'] as $item) {
                echo ' <option class="op_thucan" title="' . $item['ten_thucan'] . ' - ' . $item['nsx'] . '" value="' . $item['id'] . '">' . $item['ten_thucan'] . '</option>';
            };
            echo '</select></div><a style="margin-top:5px;" href="javascript:" id_ga="' . $results1 . '" ngay="' . $i . '" class="nut1 btn btn-primary them" ida="' . $i . '" >+</a></td><td style="width:85px;" id="testdl' . $i . '"><div id="dinhluong' . $i . '"><input  name="data_' . $results1 . '_' . $i . '[dinh_luong][]" class="khungvien1" id="' . $results1 . "-" . $i . '" id_ga="' . $results1 . '" ngay="' . $i . '" type="text"/></div></td>';

            echo '<td style="width: 205px " id="testthuoc_' . $i . '"><div id="thuoc' . $i . '"><select title="" ngaycon="' . $i . '" idga="' . $results1 . '"idcon="' . $i . '" dem="' . $dem . '" class="khungvien3 uitit selec thuoc_' . $results1 . '_' . $i . '_' . $i . '"  name="data_' . $results1 . '_' . $i . '[thuoc][]" id="thuoc_id' . $i . '">';
            echo '<option value="">Chọn thuốc </option>';
            foreach ($data['thuoc'] as $ite) {
                echo ' <option quy_cach="' . $ite['quy_cach_dong_goi'] . '" title="' . $ite['ten_thuoc'] . ' - ' . $ite['nsx'] . '" value="' . $ite['id'] . '">' . $ite['ten_thuoc'] . '</option>';

            }
            echo '</select></div><a style="margin-top:5px;" href="javascript:" id_gacon="' . $results1 . '" ngaycon="' . $i . '" idacon="' . $i . '"class="nut1 btn btn-primary themcon" >+</a></td><td style="width:85px;"id="testll' . $i . '"><div id="lieuluong' . $i . '"><input class="khungvien1" name="data_' . $results1 . '_' . $i . '[lieu_luong][]" type="text"/><span  class="lieu_luong' . $i . '"></span></div></td>';
            echo '<td style="width:85px;"><input  name="data_' . $results1 . '_' . $i . '[khoiluong]" class="khungvien1"  type="text"></td>';
            echo '<td  style="width:320px;" ><textarea style="width:250px;" class="khungvien2" name="data_' . $results1 . '_' . $i . '[note]"/></textarea></td>';
            echo '<input name="test" type="hidden" value="' . $results . '"/>';
            echo '</tr>';
        }


        echo '</tbody>';
        echo '</table>';
        echo FunctionController::getJS();
        echo FunctionController::getAjax();
    }

    public function postLayQuyCach()
    {
        extract($_POST);
        $ten = '';
        if ($id == 1) {
            $ten = '(g)';
        } else if ($id == 2) {
            $ten = '(g)';
        } else if ($id == 3) {
            $ten = '(ml)';
        } else if ($id == 4) {
            $ten = '(ml)';
        }
        return $ten;
    }
}
?>

