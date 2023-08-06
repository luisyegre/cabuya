<script setup>
import Icon from '@/Icons/Icon.vue';
import { Link } from '@inertiajs/vue3';
const props = defineProps({ post: Object })
</script>
<template>
	<Link as="div" :href="'/posts/' + props.post.id + '/show'"
		class="post__preview card w-100 border-0 border-bottom rounded-0 pt-2 pe-2 ps-2">
	{{ post.user.name }}
	<p class="post__preview-body"><span>{{ props.post.body.split('').splice(0, 100).join('') }}...</span>
	</p>
	<p class="d-flex align-items-center gap-2">
		<icon name="Heart" color="var(--bs-danger)" /> {{ props.post.reactions_count }} | {{ new
			Date(post.created_at).toDateString() }}
	</p>
	</Link>
</template>
<style>
.post__preview {
	/*	background-color: rgba(0, 0, 0, .8);*/
}

.post__preview:hover {
	font-weight: bold;
	/*	opacity: 20%;*/
	cursor: pointer;
}
</style>