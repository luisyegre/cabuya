<script setup>
import HeartIcon from '@/Icons/Heart.vue';
import { router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import Layout from '../Layout.vue';
const { posts, user } = defineProps({
	user: Object,
	posts: Array
})
watch(posts, (v) => { console.log(v) })
function parseName(postUser) {
	return postUser.user.id == user.id ?
		'Tú' : postUser.user.name
}
const postBody = ref()
function postear() {
	router.post('/posts', { body: postBody.value.value })
}
</script>

<template>
	<Layout title="Home" :posts="posts">
		<template #main>
			<div class="p-3 border-bottom">
				<p class="my-2 h4"><span class="bg-primary badge rounded-3 ">Tú</span></p>
				<form @submit.prevent="postear" class=" form d-flex flex-column gap-2">
					<div class="form-floating">
						<textarea style="height: 60px;" id="formPublish" class="form-control form-control-lg"
							ref="postBody"></textarea>
						<label for="formPublish">En que piensas?</label>
					</div>
					<button class="btn btn-primary rounded-3" type="submit">Publicar</button>
				</form>
			</div>
			<div class="post-container">
				<div class="border-bottom p-3">
					<div class="header d-flex justify-content-between align-items-center ">
						<p class="my-2 h5"><span class="bg-primary rounded-3 badge">{{ parseName(posts[0]) }}</span></p>
						<span class="my-2 segundary">{{ new Date(posts[0].created_at).toDateString()
						}}</span>
					</div>
					<div>
						<p class="h4">{{ posts[0].body }}</p>
					</div>
					<div class="footer">
						<div class="reactions d-flex align-items-center">
							<button style="display: grid;place-items: center;padding:.5rem .5rem .4rem .5rem !important;"
								class="btn btn-outline-danger p-0 btn-md rounded-pill">
								<heart-icon color="rgb(var(--bs-danger-rgb))" />
								<!-- <heart-crack-icon color="red" /> -->
							</button>
							<span class="reactions-count h5 mx-2">{{
								posts[0].reactions_count
							}}</span>
						</div>
					</div>
				</div>
			</div>
			<!-- <template v-for="post in posts">
				<div class="post-container">
					<div class="border-bottom p-3">
						<div class="header d-flex align-items-center items-center">
							<p class="my-2"><span class="bg-primary badge">{{ parseName(post) }}</span></p>
							<span class="my-2 mr-auto text-segundary">{{ new Date(post.created_at).toDateString() }}</span>
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
			</template> -->
		</template>
	</Layout>
</template>
<style>
/*.create {
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
	margin-top:.5em;
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
}*/
</style>