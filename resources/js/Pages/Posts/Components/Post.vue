<script setup>
import HeartIcon from '@/Icons/Heart.vue';
const emit = defineEmits(['like'])
const { user, post, index } = defineProps({
	post: Object,
	index: Number,
	user: Object
})
const userName = (postUser) => (
	postUser.user.id == user.id ? 'Tú' : postUser.user.name
)
const likePost = async () => {
	try {
		const resp = await fetch('posts/' + post.id + '/like', { method: 'POST' });
		const json = await resp.json()
		if (resp.status == 200 && json.message == 'like')
			post.reactions_count++
		else if (resp.status == 200)
			post.reactions_count--
	} catch (err) {
		console.log(err)
	}
}
</script>
<template>
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
				<button @click="likePost"
					style="display: grid;place-items: center;padding:.5rem .5rem .4rem .5rem !important;"
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
</template>