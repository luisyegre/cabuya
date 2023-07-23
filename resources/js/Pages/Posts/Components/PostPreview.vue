<script setup>
const props = defineProps({ post: Object })
console.log(props.post)
</script>
<template>
	<div class="post__preview">
		<p class="post__preview-body"><span>{{ props.post.body }}</span>
		</p>
		<p>❤ {{ props.post.reactions_count }} | {{post.created_at}}</p>
	</div>
</template>
<style>
.post__preview {
	background-color:#212130;
/*	background-color: rgba(0, 0, 0, .8);*/
	color: #aaa;
	border-radius:.6em;
	padding: .6em;
	font-size: .6em;
	max-width: calc(calc( .6em * 25) + 1.2em);
}

</style>