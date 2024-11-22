<template>
  <div>
    <form @submit.prevent="saveContact" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
      <input v-model="dealId" type="hidden" />
      <div class="px-4 py-6 sm:p-8">
        <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-3">
            <label for="name" class="block text-sm/6 font-medium text-gray-900">Имя контакта</label>
            <div class="mt-2">
              <input type="text" v-model="name" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" />
            </div>
          </div>

          <div class="sm:col-span-3">
            <label for="phone" class="block text-sm/6 font-medium text-gray-900">Номер телефона</label>
            <div class="mt-2">
              <input type="tel" v-model="phone" required v-mask="'+7(###)-###-##-##'" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" />
            </div>
          </div>

          <div class="col-span-full">
            <label for="comment" class="block text-sm/6 font-medium text-gray-900">Комментарий</label>
            <div class="mt-2">
              <textarea v-model="comment" required rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" />
            </div>
          </div>
        </div>
      </div>
      <div class="flex items-center gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Привязать</button>
      </div>
    </form>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';
import {mask} from 'vue-the-mask'

export default {
  setup() {
    const router = useRouter();
    const name = ref('');
    const phone = ref('');
    const comment = ref('');
    const dealId = ref('');

    onMounted(() => {
      dealId.value = router.currentRoute.value.params.dealId;
    });


    const saveContact = async () => {
      try {
        await axios.post('/api/contact', {
          name: name.value,
          phone: phone.value,
          comment: comment.value,
          deal_id: dealId.value,
        });

        await router.push('/');
      } catch (error) {
        console.error('Ошибка при привязке контакта:', error);
      }
    };

    return {
      name,
      phone,
      comment,
      saveContact
    };
  },
  directives: {mask}
};
</script>

<style scoped>
</style>
