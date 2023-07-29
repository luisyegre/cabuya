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
	<main class="row">
		<SidebarLeft :posts-resents="posts.splice(0, 4)" />
		<div class="col-6">
			<div class="main__center-header">
				<h1 class="main__center-header__title">
					<span v-if="title == 'Home'">
						<icon name="Home" />
					</span>
					{{ title }}
				</h1>
				<nav class="main__center-header__nav">
					<div>
						<Link :class="'active'" href="/home">Home</Link>
					</div>
					<div>
						<Link href="/posts">My posts</Link>
					</div>
				</nav>
			</div>
			<div class="main_content">
				<slot name="main"></slot>
			</div>
		</div>
		<div class="col-3">
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