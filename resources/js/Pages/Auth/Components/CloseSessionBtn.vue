<script setup>
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import Modal from '../../../Components/Modal.vue';
import Icon from '../../../Icons/Icon.vue';
const hide = ref(true)
function toggleModal() {
	hide.value = !hide.value
}
function closeSession() {
	router.post('logout')
}
</script>
<template>
	<modal :hide="hide">
		<p>¿Enserio deseas cerrar sesion?</p>
		<template #footer>
			<button class="button btn-si" @click="closeSession">Si.</button>
			<button @click="toggleModal" class="button btn-no">NOOO</button>
		</template>
	</modal>
	<button @click="toggleModal" class="button">
		<icon name="Close" />
		<span class="button-text">cerrar sesion</span>
	</button>
</template>
<style>
.button-text {
	display: none;
}

.close-icon {
	fill: black !important;
}

.btn-si,
.btn-no {
	padding-left: 1em !important;
	padding-right: 1em !important;
}

.btn-si {
	border: 1.5px solid var(--primary) !important;
	background-color: transparent !important;
	color: var(--primary) !important;
}

@media (min-width: 700px) {
	.button-text {
		display: inline;
	}

	.button {
		display: flex !important;
		align-items: center !important;
		flex-direction: row !important;
		gap: .5em;
		padding-left: .8em !important;
	}
}
</style>