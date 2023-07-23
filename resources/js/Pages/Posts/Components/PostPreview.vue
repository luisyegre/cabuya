<script setup>
const props = defineProps({ post: Object })
</script>
<template>
	<div class="post__preview">
		<p class="post__preview-body"><span>{{ props.post.body.split('').splice(0,25).join('') }}</span>
		</p>
		<p>❤ {{ props.post.reactions_count }} | {{post.created_at}}</p>
	</div>
</template>
<style>

.post__preview-body{
	margin-bottom: .5em;
}
.post__preview {
/*	background-color: rgba(0, 0, 0, .8);*/
	border:1.5px solid var(--primary);
	color: #aaa;
	border-radius:.6em;
	padding: 1em;
	font-size: .65em;
	width: calc(calc( 1em * 15) + 1.2em);
	min-width: calc(calc( 1em * 10) + 1.2em);
}
.post__preview:hover{
	font-weight: bold;
/*	opacity: 20%;*/
	cursor: pointer;
}

</style>