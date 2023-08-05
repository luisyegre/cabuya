<script setup>
import Icon from '@/Icons/Icon.vue';
import { Link } from '@inertiajs/vue3';
import { onMounted, reactive, ref } from 'vue';
import Layout from '../Layout.vue';
import Post from './Components/Post.vue';
const { user } = defineProps({
	user: Object
})
// const posts = ref([])
const obtaining = ref(false)
const counting = ref(false)
const page = ref(0)
const count = ref(0)
const lastFetchCount = ref(0)
const form = reactive({ body: '' })
const posts = ref([])
// const { posts, error } = useFecth(`/posts${page ? '?page=' + page : ''} `)
onMounted(async () => {
	await fetchPosts()
	setInterval(async () => {
		await checkNewPosts()
	}, 5000)
})

const createPost = async () => {
	const body = new FormData()
	body.append('body', form.body)
	const resp = await fetch('/posts', {
		method: 'POST',
		body
	})
	const json = await resp.json()
	posts.value = []
	form.body = ''
	await fetchPosts({ page: 0 })
}
const fetchPosts = async (params = {}) => {
	const { page } = params
	const resp = await fetch('/posts')
	const json = await resp.json()
	lastFetchCount.value = json.count
	posts.value = [...posts.value, ...json.posts]
}
const handleRefecth = async () => {
	console.log("fetch post")
	obtaining.value = true
	await fetchPosts({ page: page.value })
	page.value++
	obtaining.value = false
}
const checkNewPosts = async () => {
	if (counting.value)
		return
	obtaining.value = true
	try {
		const resp = await fetch('/post-count')
		const json = await resp.json()
		count.value = json.count
		counting.value = false
	} catch (err) {
		console.log(err)
	}
}
function postsUpload() {
	return count.value - lastFetchCount.value
}
</script>
<template>
	<Layout @refetch-post="() => { if (!obtaining) handleRefecth() }" title="Home" :posts="posts">
		<template #main>
			<div class=" p-3 ">
				<p class="my-2 h5">Publica algo</p>
				<div class="form d-flex flex-column gap-2">
					<div class="form-floating">
						<textarea style="height: 60px;" id="formPublish" class="form-control form-control-lg"
							v-model="form.body"></textarea>
						<label for="formPublish">¿En que piensas?</label>
					</div>
					<button class="d-flex align-items-center gap-2 btn btn-primary px-3 rounded-pill" @click="createPost()"
						style="width:fit-content;">
						<icon name="Write" color="var(--bs-light)" /><span>Publicar</span>
					</button>
				</div>
			</div>
			<div class="border-bottom border-top text-center p-2">
				<Link class="h6 pt-2">{{ postsUpload() }} posts nuevos
				</Link>
			</div>
			<div v-for=" post, i  in  posts " class="post-container">
				<post :post="post" :user="user" :index="i" />
			</div>
		</template>
	</Layout>
</template>
<style scoped></style>