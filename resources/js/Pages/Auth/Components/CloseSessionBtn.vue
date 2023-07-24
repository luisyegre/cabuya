<script setup>
import { ref } from 'vue';
import Modal from '../../../Components/Modal.vue';
const hide = ref(true)
function toggleModal(){
	hide.value = !hide.value
}
</script>
<template>
	<modal :hide="hide">
		<p>¿Enserio deseas cerrar sesion?</p>
		<template #footer>
			<button class="button btn-si">Si.</button>
			<button @click="toggleModal" class="button btn-no">NOOO</button>
		</template>
	</modal>
	<button @click="toggleModal" class="button">cerrar sesion</button>
</template>
<style>
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
</style>