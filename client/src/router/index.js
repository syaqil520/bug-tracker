import { createRouter, createWebHistory } from 'vue-router'
import middleware from './middleware/index'

const routes = [
  {
    path: '/',
    name: "HomeGuest",
    component: () => import('../views/Authentication.vue'),
    beforeEnter: middleware.guest
  },
  {
    path: '/Home',
    name: 'Home',
    component: () => import('../views/Dashboard.vue'),
    beforeEnter: middleware.user,
  },
  {
    path: '/project/:id',
    name: 'ProjectDashboard',
    component: () => import('../views/ProjectDashboard.vue'),
    beforeEnter: middleware.user
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
