<script setup>
import Icon from '@/Icons/Icon.vue';
import { defineProps } from 'vue';
const { icon } = defineProps({ icon: String })
</script>
<template>
	<li class="d-flex align-items-center p-2 m-3 rounded-3 hover">
		<icon :name="icon" />
		<span class="px-3">
			<slot></slot>
		</span>
	</li>
</template>
<style scoped lang="scss">
.hover:hover {
	background: red;
}
</style>