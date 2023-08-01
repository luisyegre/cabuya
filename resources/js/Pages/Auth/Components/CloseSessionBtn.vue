<script setup>
import { router } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import Icon from '../../../Icons/Icon.vue';
function closeSession() {
	router.post('logout')
}
onMounted(() => {
	// const modal = new bootstrap.Modal(document.getElementById('closeSessionModal'))
})
</script>
<template>
	<div class="modal" tabindex="-1" id="closeSesionModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content border border-0" style="width:fit-content !important;">
				<div class="modal-body text-center">
					<p class="h6">¿Seguro que deseas cerrar sesion?</p>
					<p class="h6">Te vamos a extrañar :(</p>
				</div>
				<div class="p-3 d-flex justify-content-center align-items-center gap-2">
					<button data-bs-dismiss="modal" type="button" @click="closeSession"
						class="rounded-3 btn btn-outline-secondary">Si
						perdon...</button>
					<button type="button" data-bs-dismiss="modal" class="btn btn-primary rounded-3 ">No, solo
						bromeo</button>
				</div>
			</div>
		</div>
	</div>
	<button data-bs-toggle="modal" data-bs-target="#closeSesionModal"
		class="p-2 close-btn d-flex align-items-center border-2 btn btn-outline-warning btn-lg">
		<icon name="Close" />
		<span class="d-none d-md-inline mx-2 text-warning">cerrar sesion</span>
	</button>
</template>
<style scoped>
/*.button-text {
	display: none;
}
*/
.close-btn {
	height: 2.5rem;
	width: 2.5rem;
}

.icon {
	fill: rgb(var(--bs-warning-rgb)) !important;
}

@media (min-width:768px) {
	.close-btn {
		width: 100%;
	}
}
</style>