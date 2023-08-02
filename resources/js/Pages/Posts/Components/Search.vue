<script setup>
import Icon from '@/Icons/Icon.vue';
</script>
<template>
	<button class="btn btn-link btn-lg">
		<icon name="Magnify" color="rgb(var(--bs-primary-rgb))" />
	</button>
	<div class="d-none form-floating">
		<input class="form-control shadow-none" id="search-input" type="text">
		<label for="search-input">
			<icon name="Magnify" />
			<span>Tipea para buscar</span>
		</label>
	</div>
</template>