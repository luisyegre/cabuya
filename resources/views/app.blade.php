<!DOCTYPE html>
<html data-bs-theme="dark" lang="en">
<head>
	<meta charset="UTF-8">
	@if(config('APP_ENV') == 'production')
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
	@endif
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	@vite('resources/js/app.js')
	@inertiaHead
</head>
<body>
	@inertia
</body>
</html>