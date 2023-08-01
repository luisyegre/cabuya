<script setup>
import Icon from '@/Icons/Icon.vue';
import { defineProps } from 'vue';
const { icon } = defineProps({ icon: String })
</script>
<template>
	<div class="p-0 h4">
		<div class="hover justify-content-center justify-content-md-start rounded-3 d-flex align-items-center">
			<icon :name="icon" />
			<span class="d-none text-secondary d-md-inline mx-2">
				<slot></slot>
			</span>
		</div>
	</div>
</template>
<style scoped>
.hover {
	height: 2.5rem;
	width: 2.5rem;
}

.hover:hover {
	cursor: pointer;
	background: rgb(var(--bs-secondary-rgb));

}

.icon {
	fill: rgb(var(--bs-secondary-rgb));
}

@media (min-width:768px) {
	.hover {
		width: 100%;
	}
}
</style>