import './bootstrap';
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import 'vuetify/styles'
import '@mdi/font/css/materialdesignicons.css'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { VDataTable } from 'vuetify/labs/VDataTable'

const vuetify = createVuetify({
    components,
    directives,
  })
  

createInertiaApp({
    resolve: name => {
      const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
      return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
      let app = createApp({ render: () => h(App, props) })
        app.component("v-data-table",VDataTable)
        app.component('VueDatePicker',VueDatePicker)
        
        app.use(plugin)
        app.use(vuetify)
        
        app.mount(el)
    },
  })