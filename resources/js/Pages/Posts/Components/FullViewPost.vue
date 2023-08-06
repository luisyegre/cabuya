<script setup>
import Icon from '@/Icons/Icon.vue';
import { reactive, ref } from 'vue';
import IconBtn from './IconBtn.vue';
const emit = defineEmits(['like'])
const props = defineProps({
	post: Object,
	index: Number,
	user: Object
})
const { user, index } = props
const post = reactive(props.post)
const commentText = ref('')
const userName = (postUser) => (
	postUser?.user?.id == user.id ? 'Tú' : postUser.user?.name
)

const likePost = async (postToLike) => {
	try {
		const resp = await fetch('/posts/' + postToLike.id + '/like', { method: 'POST' });
		const json = await resp.json()
		if (resp.status == 200 && json.message == 'like')
			postToLike.reactions_count++
		else if (resp.status == 200)
			postToLike.reactions_count--
	} catch (err) {
		console.log(err)
	}
}
const commentPost = async () => {
	try {
		const form = new FormData()
		form.append('body', commentText.value)
		const resp = await fetch('/posts/' + post.id + '/comment', { method: 'POST', body: form });
		const { comment } = await resp.json()
		// console.log(json)
		post.comments.push(comment)
	} catch (err) {

		console.log(err)
	}
}

</script>
<template>
	<div class="card rounded-3 m-2 p-3">
		<div class="header d-flex justify-content-between align-items-center ">
			<p class="my-2 h6">{{ userName(post) }}</p>
			<span class="my-2 text-segundary " style="font-size: .8rem;">
				{{ new Date(post.created_at).toDateString() }}
			</span>
		</div>
		<div class="my-2">
			<p class="h5">{{ post.body }}</p>
		</div>
		<div class="footer border-top border-bottom py-1 d-flex align-items-center gap-4">
			<div class="reactions d-flex gap-1 align-items-center">
				<icon-btn @click="likePost(post)" color="var(--bs-danger)" icon="Heart">{{ post.reactions_count
				}}</icon-btn>
			</div>
			<div class="reactions d-flex gap-1 align-items-center">
				<icon-btn color="var(--bs-light)" icon="Message">{{ post.comments_count || 0 }}</icon-btn>
			</div>
		</div>
		<div class="mt-4">
			<div>
				<p class="h6">Deja un comentario.</p>
				<div class="form-floating">
					<textarea id="comment" class="form-control shadow-none rounded-3" v-model="commentText"></textarea>
					<label for="comment">Comentario</label>
				</div>
				<button @click="commentPost()"
					class="d-flex align-items-center px-3 gap-2 btn btn-primary rounded-pill mt-2">
					<icon color="var(--bs-light)" name="Write" />
					Comentar
				</button>
			</div>
			<div v-if="post?.comments?.length > 0" class="border-start border-2 mt-3 p-2">
				<div v-for="comment in post?.comments">
					<p class="h6 ">{{ userName(comment) }}</p>
					<p class="ms-2 mb-0">{{ comment.body }}</p>
					<div class="footer border-bottom py-1 pt-0 d-flex align-items-center gap-4">
						<div class="reactions d-flex gap-1 align-items-center">
							<icon-btn @click="likePost(comment)" color="var(--bs-danger)" icon="Heart">{{
								comment.reactions_count
							}}</icon-btn>
						</div>
						<!-- 	<div class="reactions d-flex gap-1 align-items-center">
							<icon-btn color="var(--bs-light)" icon="Message">{{ post.comments_count || 0 }}</icon-btn>
						</div>
						<div v-if="comment.comments_count > 0">
							<button class="btn btn-link">cargar respuesta</button>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</template>