import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import RegisterView from '@/views/RegisterView.vue'
import LoginView from '@/views/LoginView.vue'
import IndexView from '@/views/products/IndexView.vue'
import ProductSearchView from '@/views/ProductSearchView.vue'
import UserEditView from '@/views/UserEditView.vue'
import MypageView from '@/views/MypageView.vue'
import AdminProductListView from '@/views/AdminProductListView.vue'
import AdminProductDetailView from '@/views/AdminProductDetailView.vue'

import PurchaseHistoryView from '@/views/PurchaseHistoryView.vue'

import AdminProductCreateView from '@/views/AdminProductCreateView.vue'
import CartView from '@/views/CartView.vue'
import OrderView from '@/views/OrderView.vue'
import ProductDetailView from '@/views/products/ProductDetailView.vue'
import AdminProductEditView from '@/views/AdminProductEditView.vue'

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
      meta: { requiresAuth: true },
    },
    {
      path: '/admin/products/:id',
      name: 'AdminProductDetail',
      component: AdminProductDetailView,
      meta: { requiresAuth: true },
    },
    {
      path: '/admin/product/create',
      name: 'AdminProductCreate',
      component: AdminProductCreateView,
      meta: { requiresAuth: true },
    },
    {
      path: '/admin/products/:id/edit',
      name: 'AdminProductsEdit',
      component: AdminProductEditView,
      meta: { requiresAuth: true },
    },
    {
      path: '/cart',
      name: 'Cart',
      component: CartView,
      meta: { requiresAuth: true },
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
      component: () => import('@/views/OrderView.vue')
    },
    // {
    //   path: '/admin/products/:id/stock',
    //   name: 'AdminProductStock',
    //   component: AdminProductStockView,
    //   meta: { requiresAuth: true },
    // }
    {
      path: '/products/productdetail/:id',
      name: 'productDetail',
      component: ProductDetailView,
      // meta: { requiresAuth: true },
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
