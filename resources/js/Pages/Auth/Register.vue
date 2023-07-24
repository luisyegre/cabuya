<script setup>
import { Link, usePage } from '@inertiajs/vue3';
const { props: { errors } } = usePage()

</script>
<template>
	<div class="login-container">
		<div class="login-form">
			<h2>Login</h2>
			<form class="form" method="POST">
				<input type="text" placeholder="Introduce tu nombre completo" name="name" />
				<p class="form-input-error" v-if="errors">{{ errors.name }}</p>
				<input type="email" placeholder="Introduce tu email" name="email" />
				<p class="form-input-error" v-if="errors">{{ errors.email }}</p>
				<input type="password" placeholder="Introduce tu contraseña" name="password" />
				<p class="form-input-error" v-if="errors">{{ errors.password }}</p>
				<button class="button">Registrarse</button>
			</form>
			<Link class="link-form" href="\login">Ya tengo una cuenta.</Link>
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

.form-input-error {
	color: red;
	/*	font-weight: bold;*/
	letter-spacing: 1px;
	margin-top: .2em;
	margin-left: .2em;
	font-size: .5em;
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