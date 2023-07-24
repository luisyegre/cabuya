<script setup>
import { Link } from '@inertiajs/vue3';

</script>
<template>
	<div class="login-container">
		<div class="login-form">
			<h2>Login</h2>
			<form class="form" method="POST">
				<input type="email" placeholder="Introduce tu email" name="email" />
				<input type="password" placeholder="Introduce tu contraseña" name="password" />
				<button class="button">Login</button>
			</form>
			<Link class="link-form" href="\register">Aun no me registro.</Link>
			<div v-if="$page?.props?.flash?.message" class="errormsg">
				{{ $page.props.flash.message }}
			</div>
		</div>
	</div>
</template>
<style>
.login-container {
	width: 100vw;
	height: 100vh;
	display: grid;
	font-size: 1.5rem;
	place-items: center;
	color: var(--text-color);
}

.login-form {
	border: 1.5px solid var(--primary);
	border-radius: 0.8em;
	padding: 1em;
	width: 80%;
	max-width: 18em;
}

.form {
	display: flex;
	flex-direction: column;
}

.form input {
	border: 1.5px solid var(--primary);
	margin-top: 0.5em;
	padding: 0.4em;
	font-size: 0.8em;
	background: transparent;
	color: var(--text-color);
	border-radius: 0.8em;
}

.link-form {
	color: var(--primary);
	font-size: 0.5em;
	margin: auto;
}
</style>