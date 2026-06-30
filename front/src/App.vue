<script setup>
import { RouterLink, RouterView, useRoute } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'

// const user = JSON.parse(localStorage.getItem('user'));
// console.log(user.role);
</script>

<template>
  <header>
    <div class="wrapper">
      <h1>ポケマート</h1>
      <nav>
        <RouterLink to="/products/index">トップページ</RouterLink>
        <!-- <RouterLink to="/category">カテゴリー</RouterLink> -->
        <RouterLink to="/cart">カート</RouterLink>
        <RouterLink to="/products/search">検索</RouterLink>
        <RouterLink to="/mypage">マイページ</RouterLink>
        <RouterLink to="/admin/products">在庫管理</RouterLink>
      </nav>
    </div>
  </header>
<RouterView />
</template>

<style scoped>

h1{
  text-align: center;

}

header {
  line-height: 1.5;
  max-height: 100vh;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

nav {
  width: 100%;
  font-size: 12px;
  text-align: center;
  margin-top: 2rem;
}

nav a.router-link-exact-active {
  color: var(--color-text);
}

nav a.router-link-exact-active:hover {
  background-color: transparent;
}

nav a {
  display: inline-block;
  padding: 0 1rem;
  border-left: 1px solid var(--color-border);
}

nav a:first-of-type {
  border: 0;
}


</style>
