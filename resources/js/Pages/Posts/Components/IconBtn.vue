<script setup>
import Icon from '@/Icons/Icon.vue';
defineProps({
	icon: String,
	color: String,
	customClass: String
})
defineEmits(['click'])
</script>
<template>
	<button @click="$emit('click')" style="
					display: grid;
					place-items: center;
					width: 1.5rem;
					height:1.5rem;
					" :class="'btn p-0 btn-sm rounded-pill'
						+ customClass">
		<icon :name="icon" :color="color" />
		<!-- <heart-crack-icon color="red" /> -->
	</button>
	<span class="reactions-count h6 mt-1 ">
		<slot></slot>
	</span>
</template>