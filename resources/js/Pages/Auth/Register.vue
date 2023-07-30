<script setup>
import { Link, useForm } from '@inertiajs/vue3';
defineProps({
	errors: Object,
	flash: Object
})
const form = useForm({
	email: null,
	name: null,
	password: null,
})

</script>
<template>
	<div class="back">
		<div class="form-floating shadow rounded-4 p-4 text-center">
			<h2>
				Hola, bienvenido!
				<!-- <profile-icon /> -->
			</h2>
			<h2 class="h6 p-2">Hey!, ¿ Ya tienes una cuenta ? Pues entra
				<Link href="\login">aqui.</Link>
			</h2>
			<form @submit.prevent="form.post('register')">
				<div class="form-floating mb-3">
					<input :class="`shadow-sm form-control form-control-lg ${errors.mame ? 'is-invalid' : ''}`"
						id="name-input" v-model="form.name">
					<label for="name-input">
						<span class="text-danger" v-if="errors.name">{{ errors.name
						}}</span>
						<span v-else>Name</span>
					</label>
					<div class="invalid-feedback"></div>
				</div>
				<div class="form-floating mb-3">
					<input :class="`shadow-sm form-control form-control-lg ${errors.email ? 'is-invalid' : ''}`"
						id="email-input" v-model="form.email">
					<label for="email-input">
						<span class="text-danger" v-if="errors.email">{{ errors.email
						}}</span>
						<span v-else>Email</span>
					</label>
					<div class="invalid-feedback"></div>
				</div>

				<div class="form-floating">
					<input type="password"
						:class="`shadow-sm form-control form-control-lg ${errors.password ? 'is-invalid' : ''}`"
						id="password-input" v-model="form.password">
					<label for="password-input">
						<span class="text-danger" v-if="errors.password">{{ errors.password
						}}</span>
						<span v-else>Password</span>
					</label>
					<div class="invalid-feedback"></div>
				</div>
				<button :disabled="form.processing" type="submit"
					class="rounded-3 shadow btn btn-primary w-100 mt-3 btn-lg">Login</button>
			</form>
			<div v-show="flash?.message" class="alert  alert-danger mt-3">{{ flash?.message }}</div>
		</div>
	</div>
</template>
<style scoped>
.back {
	display: grid;
	place-items: center;
	width: 100vw;
	height: 100vh;
}
</style>
