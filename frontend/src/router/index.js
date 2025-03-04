import { createRouter, createWebHistory } from 'vue-router';
import DeviceView from '../views/DeviceView.vue';
import NotFound from '../views/NotFound.vue';
import QRGeneratorView from '../views/QRGeneratorView.vue';

const routes = [
  {
    path: '/',
    name: 'generator',
    component: QRGeneratorView,
  },
  {
    path: '/qr',
    name: 'home',
    component: DeviceView,
  },
  {
    path: '/qr/:code',
    name: 'device',
    component: DeviceView,
  },
  {
    path: '/:pathMatch(.*)*',
    name: 'not-found',
    component: NotFound,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
