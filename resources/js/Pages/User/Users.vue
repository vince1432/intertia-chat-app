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
            <div class="flex gap-5">
              <!-- name -->
              <span class="text-4xl font-bold">Users</span>
              <!-- search -->
              <form class="flex items-center max-w-sm mx-auto">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                  <div
                    class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none"
                  >
                    <svg
                      class="w-4 h-4"
                      aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 20 20"
                    >
                      <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                      />
                    </svg>
                  </div>
                  <input
                    v-model="search"
                    type="text"
                    id="simple-search"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required
                  />
                </div>
              </form>
            </div>

            <button
              type="button"
              class="text-white bg-green-400 hover:bg-green-300 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 flex gap-3"
              @click="goTo(route('users.create'))"
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
            v-for="(user, index) in users"
            :key="index"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
          >
            <th
              scope="row"
              class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white"
            >
              {{ user.id }}
            </th>
            <td class="px-6 py-2">
              {{ user.first_name }}
            </td>
            <td class="px-6 py-2">
              {{ user.last_name }}
            </td>
            <td class="px-6 py-2">
              {{ user.email }}
            </td>
            <td class="px-6 py-2">
              {{ user.created_at }}
            </td>
            <td class="px-6 py-2 text-right flex">
              <svg
                class="w-6 h-6 text-gray-800 dark:text-white"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                fill="#31C48D"
                viewBox="0 0 24 24"
              >
                <path
                  fill-rule="evenodd"
                  d="M5 8a4 4 0 1 1 7.796 1.263l-2.533 2.534A4 4 0 0 1 5 8Zm4.06 5H7a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h2.172a2.999 2.999 0 0 1-.114-1.588l.674-3.372a3 3 0 0 1 .82-1.533L9.06 13Zm9.032-5a2.907 2.907 0 0 0-2.056.852L9.967 14.92a1 1 0 0 0-.273.51l-.675 3.373a1 1 0 0 0 1.177 1.177l3.372-.675a1 1 0 0 0 .511-.273l6.07-6.07a2.91 2.91 0 0 0-.944-4.742A2.907 2.907 0 0 0 18.092 8Z"
                  clip-rule="evenodd"
                />
              </svg>
              <button @click="deleteUser(index)">
                <svg
                  class="w-6 h-6 text-gray-800 dark:text-white"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  fill="#E02424"
                  viewBox="0 0 24 24"
                >
                  <path
                    fill-rule="evenodd"
                    d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                    clip-rule="evenodd"
                  />
                </svg>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <Pagination
        :total="pagination.total"
        :current-page="pagination.current_page"
        :per_page="pagination.per_page ?? 10"
        :links="pagination.links"
        :next_page="pagination.next_page_url"
        :prev_page="pagination.prev_page_url"
        :first_page="pagination.first_page_url"
        :last_page="pagination.last_page_url"
        :total_page="pagination.last_page"
        :query_string="`&search=${search}`"
        @update:data="refreshData"
      />
    </div>
  </div>
</template>

<script setup>
import Pagination from "@components/Pagination.vue";
import useVisit from "@composables/useVisit";
import { router, usePage } from "@inertiajs/vue3";
import ManageLayout from "@layouts/ManageLayout.vue";
import { debounce } from "lodash";
import { onMounted, ref, watch } from "vue";
import { toast } from "vue3-toastify";

const page = usePage();
const { goTo } = useVisit();

const search = ref("");
const old_search = ref("");
const users = ref(page.props.data);
const pagination = ref(page.props.pagination);

defineOptions({
  layout: ManageLayout,
});

onMounted(() => {
  let params = new URLSearchParams(window.location.search);
  if (params.get("search")) {
    search.value = params.get("search");
    old_search.value = params.get("search");
  }
});
// search
watch(
  search,
  debounce(function (value) {
    if (search.value === old_search.value) return;

    old_search.value = search.value;
    const path = pagination.value.path;
    const per_page = pagination.value.per_page;
    const url = `${path}?per_page=${per_page}&page=1&search=${search.value}`;

    router.get(
      url,
      { search: value },
      {
        preserveState: true,
        replace: true,
        onSuccess: ({ props }) => {
          users.value = props.data;
          pagination.value = props.pagination;
        },
        onError: (errors) => {
          for (var error in errors) {
            if (Object.prototype.hasOwnProperty.call(errors, error))
              toast.error(errors[error]);
          }
        },
      }
    );
  }, 1000)
);

const refreshData = (value) => {
  console.log("refreshData");

  const url = `${page.props.pagination.path}?per_page=${value}&page=1&search=${search.value}`;
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

const deleteUser = (index) => {
  const id = users.value[index].id;
  const url = route("users.destroy", id);

  router.delete(url, {
    preserveState: true,
    onSuccess: () => {
      toast.success(`User #${id} deleted`);
      removeFromList(index);
    },
  });
};

const removeFromList = (index) => {
  users.value.splice(index, 1);
};
</script>

<style lang="scss" scoped></style>
