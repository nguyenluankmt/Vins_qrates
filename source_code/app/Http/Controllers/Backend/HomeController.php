<?php  
	namespace App\Http\Controllers\Backend;
	use App\Http\Controllers\Controller;
	use Illuminate\Support\Facades\Auth;
	use DB;
	use App\User;
	use App\Giongga;
	use App\ChuongTrai;
	use App\Update;
	use App\Thucan;
	use App\Thuoc;

	class HomeController extends Controller {
		public function getIndex() {
			$data = [
				'title' => 'Gà đồi sóc sơn | Trang quản trị',
				'sidebar' => 'Backend.Layout.sidebar',
				'infoSidebar' => [
					'menuExpanded' => 'index',
					'current' => 'index'
				],
				'user' => Auth::User()->fullname,
//				

			];
			$data['totalUser'] = User::count();

			$soluong_tong = DB::table('chuong')
                     ->select(DB::raw('sum(so_luong) as tong_cong'))
                    
                     ->get();
                 
		foreach ($soluong_tong as $key => $value) {
		foreach ($value as $key) {
			$sl=$key;
			
		}
			
			
		}
		$data['chuongluong']=$sl;

			$data['totalChuong'] = ChuongTrai::count();

			$galoaithai= Update::select('id','thuoc_thucte')->get();


			$db= json_decode($galoaithai);
	
			
			$tong = 0;
			foreach ($db as $key=>$value) {
					//echo $value->thuoc_thucte.'<br>';
				if($value->thuoc_thucte){
					$arr = json_decode($value->thuoc_thucte, true);

					// $tong = $tong + array_sum($arr[1][0][0]);

				}
				

			}
			
			// $data['gachet']=$tong;
			
			$data['totalthucan'] = Thucan::select('ten_thucan')->count();
			$data['totalthuoc'] = Thuoc::count('ten_thuoc');

			if  (Auth::User()->role == 1 || Auth::User()->role == 5 ) {
				return view("Backend.index", ['data' => $data]);
			}else{
				if (Auth::User()->trangthai == 2 ) {
					return view("Backend.404");
				}else{
					if (Auth::User()->role == 2) {
						return \Redirect::to('quan-tri/update/');
					}elseif(Auth::User()->role == 3){
						return redirect('khach-hang');
					}
					else{
						return view("Backend.index", ['data' => $data]);
					}
				}
			}
			
			
		}
		public function trangchu() {
		return	redirect('quan-tri/');
		}
		


	}
?>