<script setup>
import CloseSessionBtn from '@/Pages/Auth/Components/CloseSessionBtn.vue';
import PostPreview from '@/Pages/Posts/Components/PostPreview.vue';
import { defineProps, ref } from 'vue';
import SidebarNavIten from './SidebarNavIten.vue';

const dropdown = ref(null)
const dropdownButton = ref(null)

defineProps({
	postsResents: Array
})
function toggleDropDown(ev) {
	// console.log(dropdownButton.value.offsetTop)
	// dropdown.value.offsetTop  = dropdownButton.value.offsetTop
	// dropdown.value.offsetLeft = dropdownButton.value.offsetLeft
	// console.log(dropdownButton)
	// console.log('TOGGLE_FROP_DOWN',dropdown)
	dropdown.value.classList.toggle('hide')

}

</script>

<template>
	<!-- <div>
		<div class="offcanvas-header">
			<h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<div class="offcanvas-body">
			<div>
				Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists,
				etc.
			</div>
			<div class="dropdown mt-3">
				<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
					Dropdown button
				</button>
				<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="#">Action</a></li>
					<li><a class="dropdown-item" href="#">Another action</a></li>
					<li><a class="dropdown-item" href="#">Something else here</a></li>
				</ul>
			</div>
		</div>
	</div> -->
	<div class="offcanvas offcanvas-start w-100 m-0 p-0" tabindex="-1" id="sidebar-left" aria-labelledby="offcanvas">
		<div class="offcanvas-header">
			<div class="logo"></div>
			<!-- <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5> -->
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<nav class="nav d-flex text-center flex-column gap-3">
			<sidebar-nav-iten icon="Magnify">Buscar</sidebar-nav-iten>
			<sidebar-nav-iten icon="Bell">Notificaciones</sidebar-nav-iten>
			<sidebar-nav-iten icon="Profile">Perfil</sidebar-nav-iten>
			<close-session-btn />
			<ul ref="dropdown" class="d-none dropdown resents hide">
				<li v-for="(post, i) in postsResents" :key="i">
					<post-preview :post="post" />
				</li>
			</ul>
		</nav>

	</div>
</template>
<style>
.logo {
	width: 2em;
	height: 2em;
	background-color: rgb(var(--bs-primary-rgb));
	border-radius: 0.6em;
	margin-top: 0.2em;
	margin-bottom: 0.5em;
	margin-left: auto;
	margin-right: auto;
}

@media (min-width:768px) {
	.logo {
		margin-left: 0;
		margin-right: 0;

	}
}
</style>