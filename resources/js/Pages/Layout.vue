<script setup>
import PostPreview from './Posts/Components/PostPreview.vue'
import BellIcon from '../Icons/Bell.vue'
import MagnifyIcon from '../Icons/Magnify.vue'
import HomeIcon from '../Icons/Home.vue'
import ProfileIcon from '../Icons/Profile.vue'
import NewsIcon from '../Icons/News.vue'
import {ref} from 'vue'
import { Head, Link } from '@inertiajs/vue3'
defineProps({ 
	title:String, 
	posts:Object 
})
</script>
<template>
	<Head :title="title"/>
	<main class="main">
		<nav class="main__sidebar-left">	
			<div class="logo"></div>				
			<ul class="sidebar__nav">
				<li class="sidebar__nav__iten"><b class="iten-icon"><magnify-icon/></b> 
					<span class="sidebar__nav__iten-text">Explore</span>
				</li>
				<li class="sidebar__nav__iten"><b class="iten-icon"><bell-icon/></b> 
					<span class="sidebar__nav__iten-text">Notifications</span>
				</li>
				<li class="sidebar__nav__iten"><b class="iten-icon"><profile-icon/></b> 
					<span class="sidebar__nav__iten-text">Profile</span>
				</li>
				<li class="sidebar__nav__iten">
					<div>
						<div class="flexible">
							<b class="iten-icon"><news-icon/></b> 
							<span class="sidebar__nav__iten-text">Recents</span>
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
				<h1 class="main__center-header__title">
					<span v-if="title == 'Home'">
						<home-icon/>
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
				<magnify-icon/>
				<input class="sidebar-right__search-input" type="text">
			</div>
			<ul class="search-results-list">
				<li class="search-results"><post-preview :post="posts[0]"/></li>
				<li class="search-results"><post-preview :post="posts[0]"/></li>
				<li class="search-results"><post-preview :post="posts[0]"/></li>
				<li class="search-results"><post-preview :post="posts[0]"/></li>
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
:root{
	--primary: orange;
	--segundary:#2f2f20;
	--text-color:#ccc;
}
html{
	font-family: Arial;
}
.flexible {
	display: flex;
	align-items: center;
}
.search-icon {

}
.main {
	font-size: 1.4rem;
	display: grid;
	grid-template-columns:1fr 1fr 1fr;
	background-color:#000;
	color: var(--text-color);
	width: 100vw;
	height: 100vh;
}
.child-block{
	display: block;
}
.resents,.search-results-list {
/*	background-color:var(--segundary);*/
	border-radius: .8em;
	padding-top:.05em;
	padding-bottom:.05em;

}
.resents>li{
	list-style: none;
	margin: .5em;
}

.logo {
	width: 3em;
	height: 3em;
	background-color:var(--primary);
	border-radius: .6em;
	margin-top:.2em;
	margin-bottom:.5em;
}
.iten-icon {
	width: 2em;
	height: 2em;
	border-radius: .6em;
/*	background-color:var(--segundary);*/
	display: grid;
	place-items: center;
	text-shadow: 0px 0px 5px gray;
	color: white;

}

.sidebar__nav__iten {
	display: flex;
	align-items: center;
}
.main__sidebar-left {
	padding: .6em;
	border-right:1.5px solid var(--primary);
	justify-self: right;
	padding: 1em;
/*	max-width: fit-content;*/
}
.main__center-header {
	padding: .6em;
/*	border-bottom:1.5px solid #0000005f;*/
	border-bottom:1.5px solid var(--primary);
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
.main__center-header__nav > div {
	padding: .2em;
	display: grid;
	text-align: center;
	place-items: center;
}
.main__center-header__nav > div > a {
	text-decoration: none;
	color:var(--primary);
/*	font-weight: bold;*/
	text-shadow: 0px 0px 5px gray;
}
.main__center-header__nav > div > a.active {
	text-decoration: none;
	color:var(--primary);
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
	padding: 1em;
	border-left:1.5px solid var(--primary);
	justify-self: left;
	min-width: calc(calc( 1em * 10) + 1.2em);
	width: calc(calc( 1em * 12) + 1.2em);
}
.sidebar-right__search {
	display: flex;
	padding: .5em;
	outline: 1.5px solid var(--primary);
	border-radius: .9em;
}
.sidebar-right__search-input {
	width: 100%;
	border:none;
	color: var(--text-color);
	outline: none;
	font-size: .8em;
	background-color:transparent;
	margin-left:1em;
}

.search-results-list {
	list-style: none;
	display: flex;
	flex-direction: column;
	gap: .5em;
	margin-top:1em;
	width: 100%;
}
.search-results{
	margin: auto;

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