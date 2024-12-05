<template>
  <div>
    <div
      class="relative overflow-x-auto shadow-md sm:rounded-lg container mx-auto mt-20 h-full"
    >
      <table
        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
      >
        <caption
          class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800"
        >
          <div class="flex justify-between">
            <span class="text-4xl font-bold">Users</span>

            <button
              type="button"
              class="text-white bg-green-400 hover:bg-green-300 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 flex gap-3"
            >
              <svg
                class="w-5 h-5"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                fill="none"
                viewBox="0 0 24 24"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M5 12h14m-7 7V5"
                />
              </svg>
              <span class="text-sm">Add</span>
            </button>
          </div>
        </caption>
        <thead
          class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th scope="col" class="px-6 py-3">ID</th>
            <th scope="col" class="px-6 py-3">First Name</th>
            <th scope="col" class="px-6 py-3">Last Name</th>
            <th scope="col" class="px-6 py-3">Email</th>
            <th scope="col" class="px-6 py-3">Created At</th>
            <th scope="col" class="px-6 py-3">
              <span class="sr-only">Edit</span>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="user in users"
            :key="user.id"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
          >
            <th
              scope="row"
              class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
            >
              {{ user.id }}
            </th>
            <td class="px-6 py-4">
              {{ user.first_name }}
            </td>
            <td class="px-6 py-4">
              {{ user.last_name }}
            </td>
            <td class="px-6 py-4">
              {{ user.email }}
            </td>
            <td class="px-6 py-4">
              {{ user.created_at }}
            </td>
            <td class="px-6 py-4 text-right">
              <a
                href="#"
                class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
              >
                Edit
              </a>
            </td>
          </tr>
        </tbody>
      </table>
      <Pagination
        :total="pagination.total"
        :current-page="pagination.current_page"
        :per_page="pagination.per_page"
        :links="pagination.links"
        :next_page="pagination.next_page_url"
        :prev_page="pagination.prev_page_url"
        :first_page="pagination.first_page_url"
        :last_page="pagination.last_page_url"
        :total_page="pagination.last_page"
        @update:data="refreshData"
      />
    </div>
  </div>
</template>

<script setup>
import Pagination from "@components/Pagination.vue";
import { router, usePage } from "@inertiajs/vue3";
import ManageLayout from "@layouts/ManageLayout.vue";
import { ref } from "vue";

defineOptions({
  layout: ManageLayout,
});

const page = usePage();

const users = ref(page.props.data);
const pagination = ref(page.props.pagination);

const refreshData = (value) => {
  const url = `${page.props.pagination.path}?per_page=${value}&page=1`;
  pagination.value.per_page = value;

  router.visit(
    url,
    {
      only: ["data", "pagination"],
    },
    {
      preserveState: true,
    }
  );
};
</script>

<style lang="scss" scoped></style>
