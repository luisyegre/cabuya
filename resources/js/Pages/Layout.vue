<script setup>
import PostPreview from './Posts/Components/PostPreview.vue'
import {ref} from 'vue'
import { Head, Link } from '@inertiajs/vue3'
const { title } = defineProps(['title'])
const posts = ref([
	{
		body:"Lorem, ipsum, dolor dolores ajaja.",
		reactions_count:10,
		user:{
			name: "Pepe"
		},
		created_at:new Date().toDateString()
	},
	{
		body:"Lorem, ipsum, dolor dolores ajaja.",
		reactions_count:5,
		user:{
			name: "Pepe"
		},
		created_at:new Date().toDateString()
	},
	{
		body:"Lorem, ipsum, dolores ajaja.dolores ajaja.",
		reactions_count:0,
		user:{
			name: "Lolo"
		},
		created_at:new Date().toDateString()
	}
])
</script>
<template>
	<Head :title="title"/>
	<main class="main">
		<nav class="main__sidebar-left">	
			<div class="logo"></div>				
			<ul class="sidebar__nav">
				<li class="sidebar__nav__iten"><b class="iten-icon">🔍</b> <span class="sidebar__nav__iten-text">Explore</span></li>
				<li class="sidebar__nav__iten"><b class="iten-icon">🔔</b> <span class="sidebar__nav__iten-text">Notifications</span></li>
				<li class="sidebar__nav__iten"><b class="iten-icon">🧑</b> <span class="sidebar__nav__iten-text">Profile</span></li>
				<li class="sidebar__nav__iten">
					<div>
						<div class="flexible">
							<b class="iten-icon">📅</b> <span class="sidebar__nav__iten-text">Recents</span>
						</div>
						<ul class="resents">
							<li v-for="post,i in posts" :id="i">
								<post-preview :post ="post"/>		
							</li>
						</ul>
					</div>
				</li>
			</ul>
		</nav>
		<div class="main__center">
			<div class="main__center-header">
				<h1 class="main__center-header__title">{{ title }}</h1>
				<nav class="main__center-header__nav">
					<div>
						<Link :class="'active'" href="/home">Home</Link>
					</div>
					<div>
						<Link href="/posts">My Posts</Link>
					</div>
				</nav>
			</div>
			<div class="main_content">
				<slot name="main"></slot>
			</div>
		</div>
		<div class="main__sidebar-right">
			<div class="sidebar-right__search">
				<input class="sidebar-right__search" type="text">
			</div>
			<ul>
				<li>Lorem, ipsum, dolor.</li>
				<li>Eligendi, recusandae, optio.</li>
				<li>Et, autem, labore.</li>
				<li>Facere, reiciendis. Ratione!</li>
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
html{
	font-family: Arial;
}
.flexible {
	display: flex;
	align-items: center;
}
.main {
	font-size: 1.4rem;
	display: grid;
	grid-template-columns:1fr 1fr 1fr;
	background-color:#0f0f00;
	color: #ccc;
	width: 100vw;
	height: 100vh;
}
.child-block{
	display: block;
}
.resents>li{
	list-style: none;
	margin: .5em;
}

.logo {
	width: 3em;
	height: 3em;
	background-color:#212130;
	border-radius: .6em;
	margin-top:.2em;
	margin-bottom:.5em;
}
.iten-icon {
	width: 2em;
	height: 2em;
	border-radius: .6em;
/*	background-color:#212130;*/
	display: grid;
	place-items: center;
	text-shadow: 0px 0px 5px gray;

}

.sidebar__nav__iten {
	display: flex;
	align-items: center;

}
.main__sidebar-left {
	padding: .6em;
	border-right:2px solid #ffffff5f;
	justify-self: right;
/*	max-width: fit-content;*/
}
.main__center-header {
	padding: .6em;
/*	border-bottom:1.5px solid #0000005f;*/
	border-bottom:2px solid #ffffff5f;

	display: flex;
	flex-direction: column;
}
.main__center-header__nav {
	display: flex;
	flex-direction: row;
	align-items: center;
	justify-content: space-around;
}
.main__center-header__nav > div {
	height: 2em;
	display: grid;
	text-align: center;
	place-items: center;
}
.main__center-header__nav > div > a {
	text-decoration: none;
	color:yellow;
/*	font-weight: bold;*/
	text-shadow: 0px 0px 5px gray;
}
.main__center-header__nav > div > a.active {
	text-decoration: none;
	color:yellow;
	text-shadow: 0px 0px 5px gray;
}
.main__center {
	grid-column:2/4;
	grid-row:1;
/*	background-color: red;*/
}
.main__center-header__title {
	font-size: 1em;
	font-weight: normal;
}
.main__sidebar-right {
	display: none;
	width: 100%;
}
@media screen and (min-width:630px) {
	.main__sidebar-right {
		display: block;
	}
	.main {
		grid-template-columns: .8fr 1.4fr .8fr;
	}
	.main__center {
		grid-column: 2/2;
	}
}
</style>