import config from "@/config";
import UserLayout from './Layouts/UserLayout';
require('./bootstrap');

import { createApp, h } from 'vue';
import {createInertiaApp, usePage} from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {

        const page = require(`./Pages/${name}.vue`).default;
        page.layout = [];
        let layout = UserLayout;

        try {
            layout = usePage().props.value?.user? UserLayout : null;
        } catch(error) {}

        if(!config.layout.exclude.includes(name)){
            page.layout.push(layout ?? UserLayout);
            if (name.startsWith('/')){
                page.layout.push(UserLayout);
            }
        }

        return page;


    },    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
