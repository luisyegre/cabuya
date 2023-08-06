<script setup>
import HeartIcon from '@/Icons/Heart.vue';
import MessageIcon from '@/Icons/Message.vue';
import { Link } from '@inertiajs/vue3';
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
	<div class="card rounded-3 m-2 p-3">
		<div class="header d-flex justify-content-between align-items-center ">
			<p class="h6">
				<span class="border px-2 rounded-pill ">{{ userName(post) }}</span>
			</p> <span class="my-2 text-segundary " style="font-size: .8rem;">{{ new Date(post.created_at).toDateString()
			}}</span>
		</div>
		<div class="my-2">
			<p class="h5">{{ post.body }}</p>
		</div>
		<div class="footer border-top border-bottom py-1 d-flex align-items-center gap-4">
			<div class="reactions d-flex gap-2 align-items-center">
				<button @click="likePost" style="
					display: grid;
					place-items: center;
					width: 1.5rem;
					height:1.5rem;
					" class="btn btn-outline-danger p-0 btn-sm rounded-pill">
					<heart-icon color="rgb(var(--bs-danger-rgb))" />
					<!-- <heart-crack-icon color="red" /> -->
				</button>
				<span class="reactions-count h6 mt-1 ">{{
					post.reactions_count
				}}</span>
			</div>
			<div class="reactions d-flex gap-2 align-items-center">
				<Link as="button" :href="'/posts/' + post.id + '/show'" style="
					display: grid;
					place-items: center;
					width: 1.5rem;
					height:1.5rem;
					" class="btn btn-dark p-0 btn-sm rounded-pill">
				<message-icon color="var(--bs-light)" />
				<!-- <heart-crack-icon color="red" /> -->
				</Link>
				<span class="reactions-count h6 mt-1 ">{{
					post?.comments_count || 0
				}}</span>
			</div>
		</div>
	</div>
</template>