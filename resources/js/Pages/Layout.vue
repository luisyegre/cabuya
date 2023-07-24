<script setup>
import Icon from '@/Icons/Icon.vue';
import { Head, Link } from '@inertiajs/vue3';
import SidebarLeft from './Posts/Components/Sidebar/SidebarLeft.vue';
defineProps({
	title: String,
	posts: Array
})
</script>
<template>
	<Head :title="title" />
	<main class="main">
		<SidebarLeft :posts-resents="posts.splice(0, 4)" />
		<div class="main__center">
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
		<div class="main__sidebar-right">
			<div class="sidebar-right__search">
				<!-- <magnify-icon /> -->
				<icon name="Magnify" />
				<input class="sidebar-right__search-input" type="text" />
			</div>
			<ul class="search-results-list">
				<li class="search-results">
					<post-preview :post="posts[0]" />
				</li>
				<li class="search-results">
					<post-preview :post="posts[0]" />
				</li>
				<li class="search-results">
					<post-preview :post="posts[0]" />
				</li>
				<li class="search-results">
					<post-preview :post="posts[0]" />
				</li>
			</ul>
		</div>
	</main>
</template>
<style>
* {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
}

:root {
	--primary: darkorange;
	--segundary: #2f2f20;
	--text-color: #ccc;
}

.button {
	border: none;
	outline: none;
	color: black;
	background-color: var(--primary);
	color: black;
	border-radius: 1em;
	font-size: 0.8em;
	padding: 0.4em;
	margin-top: 0.5em;
	display: grid;
	place-items: center;
	cursor: pointer;
}

.button:hover {
	background: #ffa50030;
}

html {
	font-family: Arial;
}

.flexible {
	display: flex;
	align-items: center;
}

body {
	background-color: #000;
}

.main {
	font-size: 1.4rem;
	display: grid;
	grid-template-columns: 3.4em calc(100% - 4.8em);
	background-color: #000;
	color: var(--text-color);
	width: 100vw;
	height: 100vh;
	max-width: 1320px;
	max-height: 920px;
	margin: auto;
}

.child-block {
	display: block;
}

.search-results-list {
	/*	background-color:var(--segundary);*/
	border-radius: 0.8em;
	padding-top: 0.05em;
	padding-bottom: 0.05em;
}

.resents>li {
	list-style: none;
	margin: 0.5em;
}

.main__center-header {
	padding: 0.6em;
	/*	border-bottom:1.5px solid #0000005f;*/
	border-bottom: 1.5px solid var(--primary);
	padding: 1em;

	display: flex;
	flex-direction: column;
}

.main__center-header__nav {
	display: flex;
	flex-direction: row;
	align-items: center;
	justify-content: space-around;
}

.main__center-header__nav>div {
	padding: 0.2em;
	display: grid;
	text-align: center;
	place-items: center;
}

.main__center-header__nav>div>a {
	text-decoration: none;
	color: var(--primary);
	/*	font-weight: bold;*/
	text-shadow: 0px 0px 5px gray;
}

.main__center-header__nav>div>a.active {
	text-decoration: none;
	color: var(--primary);
	text-shadow: 0px 0px 5px gray;
}

.main__center-header__title {
	font-size: 1em;
	font-weight: normal;
	display: flex;
	gap: 0.2em;
}

.main__sidebar-right {
	display: none;
	width: 100%;
	padding: 1em;
	border-left: 1.5px solid var(--primary);
	justify-self: left;
	min-width: calc(calc(1em * 10) + 1.2em);
	width: calc(calc(1em * 12) + 1.2em);
}

.sidebar-right__search {
	display: flex;
	padding: 0.5em;
	outline: 1.5px solid var(--primary);
	border-radius: 0.9em;
}

.sidebar-right__search-input {
	width: 100%;
	border: none;
	color: var(--text-color);
	outline: none;
	font-size: 0.8em;
	background-color: transparent;
	margin-left: 1em;
}

.search-results-list {
	list-style: none;
	display: flex;
	flex-direction: column;
	gap: 0.5em;
	margin-top: 1em;
	width: 100%;
}

.search-results {
	margin: auto;
}

@media (min-width: 700px) {
	.main {
		grid-template-columns: 10em calc(100% - 10em);
	}
}

@media (min-width: 990px) {
	.main {
		grid-template-columns: 14em calc(100% - 28em) 14em;
	}

	.main__sidebar-right {
		display: block;
	}
}</style>