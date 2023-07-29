<script setup>
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import HeartIcon from '../../Icons/Heart.vue';
import HeartCrackIcon from '../../Icons/HeartCrack.vue';
import Layout from '../Layout.vue';
const { posts, user } = defineProps({
	user: Object,
	posts: Array
})

function parseName(name) {
	return name.split(' ')[0]
}
const postBody = ref()
function postear() {
	router.post('/posts', { body: postBody.value.value })
}
</script>

<template>
	<Layout title="Home" :posts="posts">
		<template #main>
			<div class="create">
				<span class="post-username">{{ parseName(user.name) }}</span>
				<form @submit.prevent="postear" class="form-publish">
					<textarea class="create-input" placeholder="¿En que piensas?" ref="postBody"></textarea>
					<button class="button" type="submit">Publicar</button>
				</form>
			</div>
			<div v-for="(post, i) in posts" :key="i" class="post-container">
				<div class="post">
					<div class="header">
						<span class="post-username">{{ post.user_id == user.id ? 'Tú' : parseName(post.user.name) }}</span>
						<span class="post-date">{{ new Date(post.created_at).toDateString() }}</span>
					</div>
					<div class="body">{{ post.body }}</div>
					<div class="footer">
						<div class="reactions">
							<button class="react-button">
								<heart-icon color="red" />
								<heart-crack-icon color="red" />
							</button>
							<span class="reactions-count">{{
								post.reactions_count
							}}</span>
						</div>
					</div>
				</div>
			</div>
		</template>
	</Layout>
</template>
<style>
.create {
	border-bottom: 1.5px solid var(--primary);
	padding: 0.5em;
}

.form-publish {
	margin-top: 1em;
	display: flex;
	flex-direction: column;
}

.form-publish .create-input {
	background-color: transparent;
	font-size: 0.8em;
	color: var(--text-color);
	border: none;
	outline: none;
	width: 100%;
	border-bottom: 1.5px solid var(--primary);
}

.form-publish button {
	width: 40%;
	max-width: 10em;
	margin-top: 0.5em;
	margin-left: auto;
}

.post {
	margin: 0.5em;
}

.header {
	display: flex;
	flex-direction: row;
	align-items: center;
	justify-content: space-between;
}

.post-date {
	opacity: 30%;
	font-size: 0.6em;
}

.post-username {
	font-weight: bold;
	font-size: 0.8em;
	color: var(--primary);
	padding: 0.2em 0.5em;
	border-radius: 0.8em;
	border: 1.5px solid var(--primary);
}

.post .body {
	margin: 1em;
}

.post-container {
	border-bottom: 1.5px solid var(--primary);
}

.reactions {
	/*    margin-top:.5em;*/
	display: flex;
	align-items: center;
	gap: 0.5em;
	margin-left: 1em;
}

.react-button {
	border: none;
	background-color: transparent;
	font-size: 1em;
	cursor: pointer;
}
</style>