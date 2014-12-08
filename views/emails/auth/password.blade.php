<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset</h2>

		<div>
			To reset your password, complete this form: {{ url( Config::get('app.locale_prefix') ? '/'.Config::get('app.locale_prefix') : '' .'password/reset', [$token]) }}.<br><br>

			This link will expire in {{ config('auth.reminder.expire', 60) }} minutes.
		</div>
	</body>
</html>
