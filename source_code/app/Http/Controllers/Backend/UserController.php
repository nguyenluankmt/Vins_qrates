<?php  
	namespace App\Http\Controllers\Backend;
	use App\Http\Controllers\Controller;
	use App\Http\Controllers\FunctionController;
	use App\User, App\City, DB;
	use Illuminate\Support\Facades\Auth;

	class UserController extends Controller {
		public function getIndex() {
			if (Auth::User()->role != 1) {
				return \Redirect::to('/');
			}else{
				$data = [
				'title' => 'Gà đồi sóc sơn | Người dùng',
				'sidebar' => 'Backend.Layout.sidebar',
				'infoSidebar' => [
					'menuExpanded' => 'list-user',
					'current' => 'list-user'
				],
				'user' => Auth::User()->fullname,
			];
			
			if (isset($_GET['hien_thi']) && ($_GET['hien_thi'])) {
	            $item_per_page = $_GET['hien_thi'];
	        } else {
	            if(isset($per_page)){
	                $item_per_page = $per_page;
	            }else{
	                $item_per_page = 10;
	            }
	        }

			if ($_GET) {
				$queryString = array();

				foreach ($_GET as $key => $value) {
					if ($value) {
						switch ($key) { 
							case 'email':
								$queryString[] = 'email LIKE "%'.$value.'%"';
								break;

							case 'ten':
								$queryString[] = 'fullname LIKE "%'.$value.'%"';
								break;
							case 'status':
								$queryString[] = 'trangthai LIKE "%' . $value.'%"';
								break;
						}
					}
				}

				if (count($queryString) > 0) {
					$queryString = implode(' AND ', $queryString);
					$allUsers = User::whereRaw($queryString)->where('trangthai', '!=', 4)->orderBy('created_at', 'desc')->paginate($item_per_page);
				} else 
					$allUsers = User::where('trangthai', '!=', 4)->orderBy('created_at', 'desc')->paginate($item_per_page);
			} else {
		        $allUsers = User::where('trangthai', '!=', 4)->orderBy('created_at', 'desc')->paginate($item_per_page);
			}
			//die;
			$appends = FunctionController::appendToPaginate(array('page'));
	        $allUsers->setPath('/quan-tri/nguoi-dung/');
	        $allUsers->appends($appends);
	        $data['results'] = $allUsers;
	        $data['display'] = FunctionController::displaySearchCounter($data['results']->currentPage(), $item_per_page, $data['results']->total());
	        return view('Backend.User.user', ['data' => $data]);
			}
			
		}

		public function getAddNew() {
			if (Auth::User()->role != 1) {
				return \Redirect::to('/');
			}else{
				$data = [
					'title' => 'Gà đồi sóc sơn | Thêm người dùng',
					'sidebar' => 'Backend.Layout.sidebar',
					'infoSidebar' => [
						'menuExpanded' => 'list-user',
						'current' => 'add-user'
					],
					'user' => Auth::User()->fullname,
				];

				if (isset($_GET['id']) && $_GET['id']) {
					$userInfo = User::where('id', $_GET['id'])->get()->toArray();
					if ($userInfo[0]['trangthai'] != 4) {
						$data['userDetail'] = $userInfo[0];	
					}
				}

				return view('Backend.User.addUser', ['data' => $data]);
			}
			
		}

		public function postAddNew() {
			if (Auth::User()->role != 1) {
				return \Redirect::to('/');
			}else{
				extract($_POST);

				//dd($_POST);
				$emailExist = User::where('email', $email)->get()->toArray();
				
				if (isset($id) && $id && count($emailExist) > 0) {

					if (isset($password) && $password != "") {
						User::where('email', $email)->update([
							'fullname' => $fullname,
							'user_name'=>$user_name,
							'role' => $role,
							'diachi' => $diachi,
							'phone' => $phone,
							'trangthai' => $trangthai,
							'remember_token'=>$_token,
							'password' => bcrypt($password),
							'created_at' => $emailExist[0]['created_at']
						]);
					}else{
							User::where('email', $email)->update([
							'fullname' => $fullname,
							'user_name'=>$user_name,
							'role' => $role,
							'diachi' => $diachi,
							'phone' => $phone,
							'trangthai' => $trangthai,
							'remember_token'=>$_token,
							'created_at' => $emailExist[0]['created_at']
						]);
					}
					


				} elseif (count($emailExist) == 0) {
					$addUser = new User;
					$addUser->fullname = $fullname;
					$addUser->user_name = $user_name;
					$addUser->email = $email;
					$addUser->role = $role;
					$addUser->remember_token = $_token;
					$addUser->diachi = $diachi;
					$addUser->phone = $phone;
					$addUser->password = bcrypt($password);
					$addUser->created_at = date('Y-m-d h:i:sa');
					$addUser->trangthai = $trangthai;
					$addUser->save();
				}

				return \Redirect::to('/quan-tri/nguoi-dung/');
			}
			
		}

		public function postCheckExistEmail() {
			extract($_POST);

			$emailExist = User::where('email', $email)->get()->toArray();

			if (count($emailExist) > 0) {
				return 1;
			} else {
				return 0;
			}
		}

		public function postDelUser() {
			if (Auth::User()->role != 1) {
				return \Redirect::to('/');
			}else{
				extract($_POST);
				$user = User::where('id', $id)->get()->toArray();
				User::where('id', $id)->delete();
				//User::where('id', $id)->update(['status' => 3, 'created_at' => $user[0]['created_at']]);

				return 1;
			}
			
		}

	}
?>