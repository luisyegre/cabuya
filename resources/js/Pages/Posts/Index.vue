<script setup>
import { onMounted, reactive, ref } from 'vue';
import Layout from '../Layout.vue';
import Post from './Components/Post.vue';
const { user } = defineProps({
	user: Object
})
const posts = ref([])
const obtaining = ref(false)
const page = ref(0)
const form = reactive({ body: '' })

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
const fetchPosts = async (params = {}) => {
	const { page } = params
	const resp = await fetch(`/posts${page ? '?page=' + page : ''} `)
	const json = await resp.json()
	posts.value = [...posts.value, ...json]
}
const handleRefecth = async () => {
	console.log("fetch post")
	obtaining.value = true
	await fetchPosts({ page: page.value })
	page.value++
	obtaining.value = false
}
</script>
<template>
	<Layout @refetch-post="() => { if (!obtaining) handleRefecth() }" title="Home" :posts="posts">
		<template #main>
			<div class="p-3 border-bottom">
				<p class="my-2 h4"><span class="bg-primary badge rounded-3 ">Tú</span></p>
				<div class=" form d-flex flex-column gap-2">
					<div class="form-floating">
						<textarea style="height: 60px;" id="formPublish" class="form-control form-control-lg"
							v-model="form.body"></textarea>
						<label for="formPublish">En que piensas?</label>
					</div>
					<button class="btn btn-primary rounded-3" @click="createPost()">Publicar</button>
				</div>
			</div>
			<div v-for=" post, i  in  posts " class="post-container">
				<post :post="post" :user="user" :index="i" />
			</div>
		</template>
	</Layout>
</template>
<style scoped></style>