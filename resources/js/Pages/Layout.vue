<script setup>
import Icon from '@/Icons/Icon.vue';
import { Head, Link } from '@inertiajs/vue3';
import SidebarLeft from './Posts/Components/Sidebar/SidebarLeft.vue';
// import PostPreview from './Posts/Components/PostPreview.vue';
defineProps({
	title: String,
	posts: Array
})
</script>
<template>
	<Head :title="title" />
	<main class="container-fluid row m-0 p-0">
		<div class="col-2 m-0 p-0 border-end" style="width: 3.5rem; height: 100vh!important;">
			<sidebar-left :posts-resents="posts.splice(0, 4)" />
		</div>
		<div class="col-10 m-0 p-0 main-center ">
			<div class="border-bottom">
				<h1 class="d-flex p-3 h4">
					<span v-if="title == 'Home'">
						<icon name="Home" />
					</span>
					<span class="mx-2">{{ title }}</span>
				</h1>
				<nav class="row main__center-header__nav">
					<div class="col-6 text-center text-primary p-2 col-6">
						<Link class="text-decoration-none" href="/home">Home</Link>
					</div>
					<div class="col-6 text-center text-primary p-2 col-6">
						<Link class="text-decoration-none" href="/posts">My posts</Link>
					</div>
				</nav>
			</div>
			<div class="main_content">
				<slot name="main"></slot>
			</div>
		</div>
		<div class="col-3 d-none">
			<div class="sidebar-right__search">
				<!-- <magnify-icon /> -->
				<icon name="Magnify" />
				<input class="sidebar-right__search-input" type="text" />
			</div>
			<ul class="search-results-list">
				<!-- <li class="search-results" v-for="(post, i) in posts" :key="i">
					<post-preview :post="post" />
				</li> -->
			</ul>
		</div>
	</main>
</template>