 @extends('Frontend.Layout.layout')
@section('title', $data['title'])
@section('content')
	<div class="user__configuration_container">
		<div class="user__configuration_wrap">
			<div class="user__configuration_heading">
				<h2 class="user__configuration_title">Create Account</h2>
			</div>
			<div class="user__btn__table">
				<p class="user__common__label">Login With</p>
				<div class="btn__login--facebook">
					<a href="https://qrates.com/auth/facebook">
						<div class="btn__click_area__icon">
							<i class="qs qs_facebook"></i>
							Facebook
						</div>
					</a>
				</div>
				<div class="btn__login--twitter">
					<a href="https://qrates.com/auth/twitter">
						<div class="btn__click_area__icon">
							<i class="qs qs_twitter"></i>
							Twitter
						</div>
					</a>
				</div>
				<div class="btn__login--sound_cloud">
					<a href="https://qrates.com/auth/soundcloud">
						<div class="btn__click_area__icon">
							<i class="qs qs_soundcloud"></i>Soundcloud
						</div>
					</a>
				</div>
			</div>
			<div class="user__common__form">
				<form accept-charset="UTF-8" action="https://qrates.com/user/login" class="new_user" id="new_user" method="post">
					<div style="display:none">
						<input name="utf8" type="hidden" value="✓">
						<input name="authenticity_token" type="hidden" value="ZeKwdhhvtzlYjgw1gMnwlMD45KLZB5Aqyal7BcsiZlw=">
					</div>
					<input id="user_requested_path" name="user[requested_path]" type="hidden">
					<input id="modal" name="modal" type="hidden" value="false">
					<div class="user__common__field">
						<label class="user__common__label" for="user_email">Email Address</label>
						<input autofocus="autofocus" class="user__common__input" id="user_email" name="user[email]" type="email" value="">
					</div>
					<div class="user__common__field">
						<label class="user__common__label" for="user_password">Password</label>
						<input autocomplete="off" class="user__common__input" id="user_password" name="user[password]" type="password">
					</div>
					<div class="btn__login">
						<input class="input__click_area" name="commit" type="submit" value="Create Account">
					</div>
				</form>
			</div>
			<p class="user__new__create">If you already have an account,&nbsp;
				<a href="{{URL('/')}}/login">please login</a>
			</p>
		</div>
	</div>
@endsection