<template>
  <div class="mt-8 flow-root">
    <div class="">
      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
        <table class="min-w-full divide-y divide-gray-300">
          <thead>
          <tr>
            <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">ID</th>
            <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Название</th>
            <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Дата создания</th>
            <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Есть контакт</th>
            <th class="relative py-3.5 pl-3 pr-4 sm:pr-0">Действия</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="deal in deals" :key="deal.id">
            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ deal.id }}</td>
            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ deal.name }}</td>
            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ deal.date }}</td>
            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ deal.contact_id ? 'Да' : 'Нет' }}</td>
            <td class="whitespace-nowrap py-4 py-4 text-right text-sm sm:pr-0">
              <button :disabled="deal.contact_id" @click="bindContact(deal.id)" :class="deal.contact_id ? 'disabled' : 'text-indigo-600 hover:text-indigo-900'">Привязать контакт</button>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import {ref, onMounted} from 'vue';
import {useRouter} from 'vue-router';
import axios from 'axios';

export default {
  setup() {
    const router = useRouter();
    const deals = ref([]);

    const fetchDeals = async () => {
      const response = await axios.get('/api/deals');
      deals.value = response.data;
    };

    const bindContact = (dealId) => {
      router.push({path: `/contact/${dealId}`});
    };

    onMounted(fetchDeals);

    return {
      deals,
      bindContact
    };
  }
};
</script>

<style scoped>

</style>
