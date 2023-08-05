<script setup>
import { useFetch } from '@/Composables/useFetch.js';
import Icon from '@/Icons/Icon.vue';
import PostPreview from '../PostPreview.vue';
// import Post from '../PostPreview.vue';

import { onUpdated, reactive, ref } from 'vue';

const query = reactive({
	page: 0,
	q: '',
	search: 'post'
})
const inputValue = ref('')

const toQueryParam = (obj) => {
	return new URLSearchParams(obj).toString()
}

const queryUrl = () => {
	return `/posts?${toQueryParam(query)}`
}
const searching = (modelSearch) => {
	return { 'user': 'usuarios', 'post': 'publicaciones' }[query.search]
}
const url = ref(queryUrl())
const {
	data,
	error,
	fetching
} = useFetch(url)


//mientras se buscan los datos, lo que halla escrito el usuario se encola en un aux,
//luego de que se obtiene los datos, la query seria lo que este encolado.  

onUpdated(() => {
	if (!fetching.value) {
		query.q = inputValue.value
		url.value = queryUrl()
	}
})
</script>
<template>
	<div class="mb-3 form-floating">
		<input id="searchMessagesInput" class="shadow-none form-control" v-model="inputValue">
		<label class="d-flex align-items-center" for="searchMessagesInput">
			<icon name="Magnify" color="var(--bs-light)" /><span class="mx-2">Buscador</span>
		</label>
	</div>
	<div class="dropdown">
		<button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown"
			aria-expanded="false">
			Buscando {{ searching(query.search) }}
		</button>
		<ul class="dropdown-menu">
			<li class="mx-2"><button @click="query.search = 'user'" class="btn btn-dark w-100">Buscar
					usuarios</button></li>
			<li class="mx-2"><button @click="query.search = 'post'" class="btn btn-dark w-100">Buscar
					publicaciones</button></li>
		</ul>
	</div>
	<div class="mt-4">
		<h2>Resultados</h2>
	</div>
	<div class="results card">
		<p v-if="!data || !data.posts" class="text-secondary text-center ">colocar un texto para buscar</p>
		<div class="center">
			<div v-if="fetching" class="spinner-border" role="status">
				<span class="visually-hidden">Loading...</span>
			</div>
			<template v-else>
				<template v-for="post in data.posts">
					<post-preview :post="post" />
				</template>
			</template>
		</div>
	</div>
</template>
<style>
.center {
	display: grid;
	place-items: center;
}
</style>