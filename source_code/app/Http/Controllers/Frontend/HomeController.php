<?php  
	namespace App\Http\Controllers\Frontend;
	use App\Http\Controllers\Controller;
	use Illuminate\Support\Facades\Auth;

	class HomeController extends Controller {
		public function getIndex() {
			$data['title'] = "QRates";
			return view("Frontend.post-blog",['data' => $data]);
		}
		public function getIndex1() {
			$data['title'] = "QRates user";
			return view("Frontend.index1",['data' => $data]);
		}
		public function getlogin() {
			$data['title'] = "QRates login";
			return view("Frontend.login",['data' => $data]);
		}
		public function getregister() {
			$data['title'] = "QRates register";
			return view("Frontend.register",['data' => $data]);
		}
	}
?>