<script setup>
import { onMounted, ref } from 'vue';
import Layout from '../Layout.vue';
import FullViewPost from './Components/FullViewPost.vue';
const { postId, user } = defineProps({
	postId: Number,
	user: Object
})
const post = ref(null)
const postAsTitle = () => {
	return props.post.body.split('').splice(0, 10).join('')
}
const fetchPost = async () => {
	try {
		const resp = await fetch('/posts/' + postId)
		const data = await resp.json()
		post.value = data
	} catch (err) {
		console.log(err)
	}
}
onMounted(() => {
	fetchPost()
})
</script>
<template>
	<Layout :title="'Publicacion de ' + post?.user?.name">
		<template #main v-if="post != null">
			<full-view-post :post="post" :user="user" />
		</template>
	</Layout>
</template>