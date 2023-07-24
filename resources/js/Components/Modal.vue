<script setup>
const props = defineProps({
	hide:Boolean
})
</script>
<template>
	<div v-show="!hide" class="modal-bg">
		<div class="modal">
			<slot></slot>
			<div class="modal-footer">
				<slot name="footer"></slot>
			</div>
		</div>
	</div>
</template>
<style>
.modal-bg {
	background: rgba(0, 0, 0, 0.5);
	backdrop-filter: blur(5px);
	position: absolute;
	top: 0;
	left: 0;
	width: 100vw;
	height: 100vh;
	display: grid;
	place-items: center;
}
.modal {
	color: var(--text-color);
	background: black;
	padding: 1em;
	border: 1.5px solid var(--primary);
	border-radius: 0.8em;
}
.modal-footer {
	display: flex;
	gap: 10px;
}
</style>