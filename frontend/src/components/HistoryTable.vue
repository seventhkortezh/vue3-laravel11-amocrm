<template>
  <div class="mt-8 flow-root">
    <div class="">
      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
        <table class="min-w-full divide-y divide-gray-300">
      <thead>
      <tr>
        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Дата и время</th>
        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Действие</th>
        <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Результат</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="entry in history" :key="entry.id">
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ entry.date }}</td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ entry.action }} "{{ entry.entity_name }}"</td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ entry.result }}</td>
      </tr>
      </tbody>
    </table>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
  setup() {
    const history = ref([]);

    const fetchHistory = async () => {
      const response = await axios.get('/api/history');
      history.value = response.data;
    };

    onMounted(fetchHistory);

    return {
      history
    };
  }
};
</script>

<style scoped>
</style>
