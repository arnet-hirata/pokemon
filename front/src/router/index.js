import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import RegisterView from '@/views/RegisterView.vue'
import LoginView from '@/views/LoginView.vue'
import IndexView from '@/views/products/IndexView.vue'
import ProductSearchView from '@/views/ProductSearchView.vue'
import UserEditView from '@/views/UserEditView.vue'
import MypageView from '@/views/MypageView.vue'
import AdminProductListView from '@/views/AdminProductListView.vue'
import PurchaseHistoryView from '@/views/PurchaseHistoryView.vue'

import AdminProductCreateView from '@/views/AdminProductCreateView.vue'
import CartView from '@/views/CartView.vue'
import OrderView from '@/views/OrderView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue'),
    },

    {
      path: '/login',
      name: 'login',
      component: LoginView,
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView,
    },
    {
      path: '/products/index',
      name: 'index',
      component: IndexView,
    },
    {
      path: '/products/search',
      name: 'ProductSearch',
      component: ProductSearchView,
    },
    {
      path: '/user/edit',
      name: 'edit',
      component: UserEditView,
      meta: { requiresAuth: true },
    },
    {
      path: '/mypage',
      name: 'mypage',
      component: MypageView,
      meta: { requiresAuth: true },
    },
    {
      path: '/admin/products',
      name: 'AdminProductsList',
      component: AdminProductListView,
    },
    {
      path: '/admin/products/:id',
      name: 'AdminProductsDetail',
      component: MypageView,
    },
    {
      path: '/admin/product/create',
      name: 'AdminProductCreate',
      component: AdminProductCreateView,
    },
    {
      path: '/admin/products/:id/edit',
      name: 'AdminProductsEdit',
      component: MypageView,
    },
    {
      path: '/cart',
      name: 'Cart',
      component: CartView,
    },
    {
      path: '/order/detail/:id',
      name: 'orderDetail',
      component: PurchaseHistoryView,
      meta: { requiresAuth: true },
    },
    {
      path: '/order',
      name: 'Order',
      component: OrderView,
    },
  ]
})


router.beforeEach((to) => {
  // ログイン時に localStorage.setItem('token', '...') してある前提
  const isLoggedIn = !!localStorage.getItem('token')

  if (to.meta.requiresAuth && !isLoggedIn) {
    return { name: 'login', query: { redirect: to.fullPath } }
  }
})
export default router
