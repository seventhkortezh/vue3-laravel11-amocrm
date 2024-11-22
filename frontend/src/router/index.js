import { createRouter, createWebHistory } from 'vue-router';
import DealsTable from '../components/DealsTable.vue';
import ContactForm from '../components/ContactForm.vue';
import HistoryTable from '../components/HistoryTable.vue';

const routes = [
    { path: '/', component: DealsTable },
    { path: '/contact/:dealId', component: ContactForm },
    { path: '/history', component: HistoryTable },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
