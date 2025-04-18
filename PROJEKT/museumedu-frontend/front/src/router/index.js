
import { createRouter, createWebHistory } from 'vue-router'
import ThemeSelect from '../components/ThemeSelect.vue'
import ItemList from '../components/ItemList.vue'
import AdminForm from '../components/AdminForm.vue'
import AdminThemeForm from '../components/AdminThemeForm.vue'

const routes = [
  {
    path: '/',
    component: ThemeSelect
  },
  {
    path: '/theme/:theme',
    component: ItemList
  },
  {
    path: '/admin',
    component: AdminForm
  },
  {
    path: '/admin/themes',
    component: AdminThemeForm
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
