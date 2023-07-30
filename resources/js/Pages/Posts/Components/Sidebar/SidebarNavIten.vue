<script setup>
import Icon from '@/Icons/Icon.vue';
import { defineProps } from 'vue';
const { icon } = defineProps({ icon: String })
</script>
<template>
	<div class="p-2 h4">
		<div class="hover rounded-3 d-flex align-items-center justify-content-center" style="width: 2.5rem;height: 2.5rem;">
			<icon :name="icon" />
			<span class="d-none ">
				<slot></slot>
			</span>
		</div>
	</div>
</template>
<style scoped>
.hover:hover {
	cursor: pointer;
	background: rgb(var(--bs-primary-rgb));
}
</style>