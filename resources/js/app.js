import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { createPinia } from 'pinia';
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

import moment from 'moment/moment';
import * as icons from '@/icons';

library.add(icons);

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

const pinia = createPinia();

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const myApp = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy, pinia)
            .component("font-awesome-icon", FontAwesomeIcon);

            myApp.config.globalProperties.moment = moment
            myApp.config.globalProperties.$globals = {
                formatDate: (value, format = 'DD/MM/YYYY HH:mm') => {
                    return value ? moment(value).format(format) : ''
                },
                formatTel: (value) => {
                    let formated;
                    if(value.includes('+')){
                        formated = value.replace(/\D+/g, '').replace(/(\d{3})(\d{3})(\d{2})(\d{2})(\d{2})/, '(+$1) $2 $3 $4 $5');
                    }else formated = value.replace(/(\d{4})(\d{2})(\d{2})(\d{2})/, '$1 $2 $3 $4'); 
                    return formated;
                }
            };
            return myApp.mount(el);
    },
    progress: {
        color: '#52b8e3',
    },
});
