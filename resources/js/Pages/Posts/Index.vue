<script setup>
import HeartIcon from '@/Icons/Heart.vue';
import { onMounted, reactive, ref } from 'vue';
import Layout from '../Layout.vue';
const { user } = defineProps({
	user: Object
})
const posts = ref([])
const form = reactive({ body: '' })
const userName = (postUser) => (
	postUser.user.id == user.id ? 'Tú' : postUser.user.name
)

onMounted(async () => {
	await fetchPosts()
})
const createPost = async () => {
	const body = new FormData()
	body.append('body', form.body)
	const resp = await fetch('/posts', {
		method: 'POST',
		body
	})
	const json = await resp.json()

	await fetchPosts()
}
const fetchPosts = async () => {
	const resp = await fetch('/posts')
	const json = await resp.json()
	posts.value = json
}
</script>
<template>
	<Layout title="Home" :posts="posts">
		<template #main>
			<div class="p-3 border-bottom">
				<p class="my-2 h4"><span class="bg-primary badge rounded-3 ">Tú</span></p>
				<div class=" form d-flex flex-column gap-2">
					<div class="form-floating">
						<textarea style="height: 60px;" id="formPublish" class="form-control form-control-lg"
							v-model="form.body"></textarea>
						<label for="formPublish">En que piensas?</label>
					</div>
					<button class="btn btn-primary rounded-3" @click="createPost">Publicar</button>
				</div>
			</div>
			<div v-for="post in posts" class="post-container">
				<div class="border-bottom p-3">
					<div class="header d-flex justify-content-between align-items-center ">
						<p class="my-2 h5"><span class="bg-primary rounded-3 badge">{{ userName(post) }}</span></p>
						<span class="my-2 segundary">{{ new Date(post.created_at).toDateString()
						}}</span>
					</div>
					<div>
						<p class="h4">{{ post.body }}</p>
					</div>
					<div class="footer">
						<div class="reactions d-flex align-items-center">
							<button style="display: grid;place-items: center;padding:.5rem .5rem .4rem .5rem !important;"
								class="btn btn-outline-danger p-0 btn-md rounded-pill">
								<heart-icon color="rgb(var(--bs-danger-rgb))" />
								<!-- <heart-crack-icon color="red" /> -->
							</button>
							<span class="reactions-count h5 mx-2">{{
								post.reactions_count
							}}</span>
						</div>
					</div>
				</div>
			</div>
		</template>
	</Layout>
</template>
<style scoped></style>