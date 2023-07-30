<script setup>
import CloseSessionBtn from '@/Pages/Auth/Components/CloseSessionBtn.vue';
import PostPreview from '@/Pages/Posts/Components/PostPreview.vue';
import { defineProps, ref } from 'vue';
import SidebarNavIten from './SidebarNavIten.vue';

import Icon from '@/Icons/Icon.vue';
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
	<nav class="offcanvas offcanvas-start col col-3" tabindex="-1" id="offcanvasExample"
		aria-labelledby="offcanvasExampleLabel">
		<div class="logo"></div>
		<div class="offcanvas-body">

			<ul class="sidebar__nav">
				<sidebar-nav-iten icon="Magnify">Buscar</sidebar-nav-iten>
				<sidebar-nav-iten icon="Bell">Notificaciones</sidebar-nav-iten>
				<sidebar-nav-iten icon="Profile">Perfil</sidebar-nav-iten>
				<sidebar-nav-iten icon="News">
					<button ref="dropdownButton" @click="toggleDropDown" class="nav-iten-button">
						<icon name="news" />
						<span class="sidebar__nav__iten-text">Recents</span>
					</button>
				</sidebar-nav-iten>
				<close-session-btn />
			</ul>
			<ul ref="dropdown" class="dropdown resents hide">
				<li v-for="(post, i) in postsResents" :key="i">
					<post-preview :post="post" />
				</li>
			</ul>
		</div>

	</nav>
</template>
<style>
/*.hide {
	display: none;
}

.nav-iten-button {
	border: none;
	outline: none;
	background: transparent;
	font-size: 1em;
	cursor: pointer;
}

.main__sidebar-left {
	border-right: 1.5px solid var(--primary);
	padding: 0.7em;
	width: 3.4em;
}

.logo {
	width: 2em;
	height: 2em;
	background-color: var(--primary);
	border-radius: 0.6em;
	margin-top: 0.2em;
	margin-bottom: 0.5em;
}

.sidebar__nav__iten {
	list-style: none;
	background: red;
	display: grid;
	border-radius: 0.5em;
	place-items: center;
	padding: 0.4em 0.5em;
	cursor: pointer;
}

.sidebar__nav__iten:hover {
	background: #ffa50030;
}

.sidebar__nav {
	display: flex;
	flex-direction: column;
	justify-content: center;
	gap: 0.5em;
}

.resents {
	background-color:var(--segundary);
	border-top-right-radius: 0.8em;
	border-bottom-right-radius: 0.8em;
	padding-top: 0.05em;
	padding-bottom: 0.05em;
	background: black;
	border: 1.5px solid orange;
}

.sidebar__nav__iten-text {
	display: none;
}

.dropdown {
	position: absolute;
	left: 3.4em;
	top: 9.5em;
}

@media (min-width: 700px) {
	.main__sidebar-left {
		width: 10em;
		margin-left: auto;
	}

	.sidebar__nav__iten-text {
		display: block;
		margin-left: 0.5em;
		color: var(--text-color);
	}

	.sidebar__nav__iten,
	.nav-iten-button {
		display: flex;
		align-items: center;
	}

	.dropdown {
		left: 9.95em;
	}
}

@media (min-width: 990px) {
	.main__sidebar-left {
		width: 14em;
		margin-left: auto;
	}
}*/
</style>