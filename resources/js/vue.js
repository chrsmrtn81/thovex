import { createApp } from 'vue';

import MapComponent from './components/MapComponent.vue';

const app = createApp({
    components: {
        MapComponent,
    },
});

app.mount('#app');
