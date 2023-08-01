<script setup>
import Icon from '@/Icons/Icon.vue';
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import SidebarLeft from './Posts/Components/Sidebar/SidebarLeft.vue';
const center = ref(null)
const emit = defineEmits(['refetch-post'])
defineProps({
	posts: Array,
	title: String
})
onMounted(() => {
	center.value.addEventListener('scroll', (ev) => {
		const scrollTopsInScrollHeight = Math.round(center.value.scrollHeight / center.value.scrollTop)
		if (scrollTopsInScrollHeight <= 1) {
			emit('refetch-post')
		}
	})
})
</script>
<template>
	<Head :title="title" />
	<main class="main p-0 m-0">
		<div class="main-left m-0 p-2 border-end">
			<sidebar-left :posts-resents="posts" />
		</div>
		<div ref="center" class="m-0 p-0 main-center scroller">
			<div class="menu border-bottom">
				<h1 class="d-flex p-3 h4">
					<span v-if="title == 'Home'">
						<icon name="Home" />
					</span>
					<span class="mx-2">{{ title }}</span>
				</h1>
				<nav class="row main__center-header__nav">
					<div class="col-6 text-center text-primary p-2">
						<Link class="text-decoration-none text-bold" href="/home">Home</Link>
					</div>
					<div class="col-6 text-center text-primary p-2 ">
						<Link class="text-decoration-none" href="/posts">My posts</Link>
					</div>
				</nav>
			</div>
			<div class="main_content">
				<slot name="main"></slot>
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
.icon {
	fill: rgb(var(--bs-primary-rgb));
}

.main-left {
	height: 100vh !important;
	margin-left: auto !important;
}


.menu {
	position: sticky;
	background: white;
	top: 0;
	z-index: 99;
	background-color: #ffffff0f;
	backdrop-filter: blur(20px);
}

.main {
	display: grid;
	grid-template-columns: 3.5rem 1fr 1fr;
	overflow: hidden;
	height: 100vh;
}

.main-center {
	grid-column: 2/4;
}

.scroller {
	overflow: auto;
	overflow-x: hidden;
	max-height: 100vh;
}

.scroller::-webkit-scrollbar {
	width: .5rem;
	background: transparent;
}

.scroller::-webkit-scrollbar-thumb {
	background: rgb(var(--bs-primary-rgb));
	border-radius: 999px;
}

@media (min-width: 768px) {
	.main-left {
		width: 100% !important;
		max-width: 15rem !important;
	}

	.main {
		grid-template-columns: 1fr 1fr 1fr;
	}
}

@media (min-width: 992px) {
	.main {
		grid-template-columns: 1fr 1fr 1fr 1fr;
	}
}
</style>