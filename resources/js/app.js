import './bootstrap';
import { createApp } from 'vue'
import $ from 'jquery'
// import { store } from './store'

// import Alpine from 'alpinejs';
// window.Alpine = Alpine;
// Alpine.start();


import Map from '@/components/Map.vue'
const app = createApp({})

app.component('activities-map', Map)


// app.use(store)
app.mount('#app')