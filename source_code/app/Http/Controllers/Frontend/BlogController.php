<?php  
	namespace App\Http\Controllers\Frontend;
	use App\Http\Controllers\Controller;
	use Illuminate\Support\Facades\Auth;

	class BlogController extends Controller {
		public function getIndex() {
			$data['title'] = "QRates Blog";
			return view("Frontend.blog",['data' => $data]);
		}
		public function getBloglat() {
			$data['title'] = "QRates Blog";
			return view("Frontend.blog-latest",['data' => $data]);
		}
		public function getFeature() {
			$data['title'] = "QRates Blog";
			return view("Frontend.feature",['data' => $data]);
		}
	}
?>