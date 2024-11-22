<template>
  <div id="app" class="flex flex-col h-screen justify-between">
    <header class="px-6 py-10 sm:py-12 lg:px-8">
      <div class="mx-auto max-w-2xl text-center">
        <h1 class="text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl">AmoCrm Integration</h1>
      </div>
      <Tabs/>
    </header>
    <main class="mb-auto">
      <router-view></router-view> <!-- Здесь будет отображаться компонент в зависимости от маршрута -->
    </main>
    <footer class="bg-gray-900">
      <p class="mt-10 text-center text-sm/6 text-gray-400">© 2024 AmoCrm Integration</p>
    </footer>
  </div>
</template>

<script>
import Tabs from './components/Tabs.vue';

export default {
  name: 'AmoApp',
  components: {Tabs},
}
</script>

<style>
</style>
