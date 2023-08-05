<script setup>
import Icon from '@/Icons/Icon.vue';
import { Head, Link } from '@inertiajs/vue3';
import { reactive, ref } from 'vue';


import { useScroll } from '@/Composables/useScroll.js';
import Messages from './Posts/Components/Nav/Messages.vue';
import Notifications from './Posts/Components/Nav/Notifications.vue';
import Profile from './Posts/Components/Nav/Profile.vue';
import Search from './Posts/Components/Nav/Search.vue';

const emit = defineEmits(['refetch-post'])
defineProps({
	posts: Array,
	title: String
})

const center = ref(null)
useScroll(center, (result) => {
	if (result.nearOfEnd)
		emit('refetch-post')
})
const menu = reactive({
	notification: false,
	search: true,
	profile: false,
	messages: false
})

const menuClosed = () => !(
	menu.notification ||
	menu.search ||
	menu.profile ||
	menu.messages
)
const loadNav = (nav) => {
	closeNav()
	menu[nav] = true
}
const closeNav = () => {
	menu.notification = false
	menu.profile = false
	menu.messages = false
	menu.search = false
}

</script>
<template>
	<Head :title="title" />
	<main class="main p-0 m-0">
		<!-- <div>
			<sidebar-left :posts-resents="posts" />
		</div> -->
		<div ref="center" class="m-0 p-0 main-center border-end scroller">
			<div class="menu border-bottom row ">
				<div class="d-flex px-2 justify-content-between align-items-center">
					<div class="dropdown d-sm-none">
						<!-- 
						<button data-bs-toggle="offcanvas" data-bs-target="#sidebar-left"
							class="btn p-0 ms-4 me-2 btn-link">
							<icon size="2rem" name="Bars" />
						</button> -->
						<button data-bs-toggle="dropdown" data-bs-target="#dropdown-nav" class="btn p-0 ms-4 me-2 btn-link "
							aria-expanded="false" data-bs-auto-close="outside">
							<icon size="2rem" name="Bars" />
						</button>
						<div id="dropdown-nav " class="dropdown-menu">
							<div class="mx-2 d-flex align-items-center gap-3">

								<button @click="loadNav('notification')" class="btn p-0 icon-btn btn-dark">
									<icon size="1.3rem" name="Bell" />
								</button>
								<button @click="loadNav('search')" class="btn p-0 icon-btn btn-dark">
									<icon size="1.3rem" name="Magnify" />
								</button>
								<button @click="loadNav('profile')" class="btn p-0 icon-btn btn-dark">
									<icon size="1.3rem" name="Profile" />
								</button>
								<button @click="loadNav('messages')" class="btn p-0 icon-btn btn-dark">
									<icon size="1.3rem" name="Message" />
								</button>
							</div>
						</div>
					</div>

					<h1 class="d-flex p-3 h4">
						<span v-if="title == 'Home'">
							<icon name="Home" />
						</span>
						<span class="mx-2">{{ title }}</span>
					</h1>
					<div class="d-none me-3 d-sm-flex align-items-center gap-2">
						<button @click="loadNav('notification')" class="icon-btn btn btn-dark p-1 btn-link">
							<icon size="1.5rem" :color="menu.notification ? 'var(--bs-primary)' : 'var(--bs-secondary)'"
								name="Bell" />
						</button>
						<button @click="loadNav('search')" class="icon-btn btn btn-dark p-1 btn-link">
							<icon size="1.5rem" :color="menu.search ? 'var(--bs-primary)' : 'var(--bs-secondary)'"
								name="Magnify" />
						</button>
						<button @click="loadNav('profile')" class="icon-btn btn btn-dark p-1 btn-link">
							<icon size="1.5rem" :color="menu.profile ? 'var(--bs-primary)' : 'var(--bs-secondary)'"
								name="Profile" />
						</button>
					</div>
				</div>
				<nav v-if="menuClosed()" class="row main__center-header__nav">
					<div class="col-6 text-center text-primary p-2">
						<Link :class="[
							$page.url == '/' ? 'text-primary border-primary' : 'text-secondary',
							'h6',
							'border-3',
							'border-bottom',
							'text-decoration-none',
							'text-bold'
						]" href="/">Home
						</Link>
					</div>
					<div class="col-6 text-center text-primary p-2 ">
						<Link :class="[
							$page.url == '/posts' ? 'text-primary border-primary' : 'text-secondary',
							'h6',
							'border-3',
							'border-bottom',
							'text-decoration-none',
							'text-bold'
						]" href="/posts">My
						posts
						</Link>
					</div>
				</nav>
			</div>
			<div class="main_content">
				<slot v-if="menuClosed()" name="main"></slot>
				<div class="card border-0" v-if="!menuClosed()">
					<div class="card-header bg-dark ">
						<button class="icon-btn rounded-pill btn-dark btn " @click="closeNav()">
							<icon name="LeftArrow" />
						</button>
					</div>
					<div class="card-body">
						<notifications v-if="menu.notification" />
						<search v-if="menu.search" />
						<profile v-if="menu.profile" />
						<messages v-if="menu.messages" />
					</div>
				</div>
			</div>
		</div>
		<div class="d-none d-lg-block message">
			<!-- <div class="d-flex ">
				<magnify-icon />
				<icon name="Magnify" />
				<input class="sidebar-right__search-input" type="text" />
			</div> -->
			<!-- <label for="searchMessagesInput" type="button"
				class="btn d-flex align-items-center btn-link-secondary border border-1 border-end-0">
				<icon name="Magnify" />
			</label> -->
			<div class="form-floating m-3">
				<input id="searchMessagesInput" class="shadow-none form-control">
				<label class="d-flex align-items-center" for="searchMessagesInput">
					<icon name="Magnify" /><span class="mx-2">introduce un texto</span>
				</label>
			</div>
			<ul class="search-results-list">
				<!-- <li class="search-results" v-for="(post, i) in posts" :key="i">
					<post-preview :post="post" />
				</li> -->
			</ul>
		</div>
	</main>
</template>
<style scoped>
.main-left {
	height: 100vh !important;
	margin-left: auto !important;
}

.main-content {}

.icon-btn {
	width: 2.5rem;
	height: 2.5rem;
	display: grid;
	place-items: center;
	border-radius: 50%;
}

.menu {
	position: sticky;
	top: 0;
	z-index: 99;
	backdrop-filter: blur(20px);
}

.main {
	display: grid;
	grid-template-columns: 3.5rem 1fr 1fr;
	overflow: hidden;
	height: 100vh;
}

.main-center {
	grid-column: 1/4;
}

.scroller {
	overflow: auto;
	overflow-x: hidden;
	max-height: 100vh;
	scroll-behavior: smooth;
}

.scroller::-webkit-scrollbar {
	width: .5rem;
	background: transparent;
}

.scroller::-webkit-scrollbar-thumb {
	background: rgb(var(--bs-primary-rgb));
	border-radius: 999px;
}

@media (min-width: 576px) {
	.main-left {
		width: 100% !important;
		max-width: 15rem !important;
	}

	.main {
		grid-template-columns: 1fr 1fr 1fr 1fr;
	}
}

@media (min-width: 992px) {
	.main {
		grid-template-columns: 1fr 1fr 1fr 1fr;
	}
}
</style>