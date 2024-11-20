import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'create',
      component: HomeView,
    },
    {
      path: '/patient',
      name: 'patients',
      component: () => import('../views/PatientView.vue'),
    },
  ],
})

export default router
