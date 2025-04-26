
import { createRouter, createWebHistory } from 'vue-router'
import ThemeSelect from '../components/ThemeSelect.vue'
import ItemList from '../components/ItemList.vue'
import AdminForm from '../components/AdminForm.vue'
import AdminItemList from '../components/AdminItemList.vue'
import AdminThemeForm from '../components/AdminThemeForm.vue'
import AdminThemeList from '../components/AdminThemeList.vue'

const routes = [
  {
    path: '/admin/themes',
    component: AdminThemeForm
  },
  {
    path: '/admin/themes/manage',
    component: AdminThemeList
  },
  {
    path: '/admin/items/manage',
    component: AdminItemList
  },
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
