<template>
  <div class="flex items-center justify-between w-full px-2">
    <!-- Help text -->
    <span class="text-sm text-gray-700 dark:text-gray-400">
      Showing
      <span class="font-semibold text-gray-900 dark:text-white">
        {{ showTag.from }}
      </span>
      to
      <span class="font-semibold text-gray-900 dark:text-white">
        {{ showTag.to }}
      </span>
      of
      <span class="font-semibold text-gray-900 dark:text-white">
        {{ showTag.total }}
      </span>
      Entries
    </span>
    <!-- pagination button -->
    <div class="flex items-center gap-6">
      <!-- Max Item -->
      <div class="my-2">
        <select
          id="small"
          v-model="pagination.perPage"
          class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          @change="updatePerPage"
        >
          <option
            v-for="(option, index) in ITEMS_PER_PAGE_OPTION"
            :value="option.value"
            :key="index"
          >
            {{ option.value }}
          </option>
        </select>
      </div>
      <!-- Buttons -->
      <div class="inline-flex">
        <nav aria-label="Page navigation example">
          <ul class="flex items-center -space-x-px h-10 text-base">
            <!-- first page button -->
            <li>
              <Link
                :href="pagination.first_page"
                class="flex items-center justify-center px-3 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                :class="{
                  'link-disabled ': pagination.currentPage === 1,
                }"
              >
                <span class="sr-only">First</span>
                <svg
                  class="w-2 h-2 rtl:rotate-180"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 6 10"
                >
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 1 1 5l4 4"
                  />
                </svg>
                <svg
                  class="w-2 h-2 rtl:rotate-180"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 6 10"
                >
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 1 1 5l4 4"
                  />
                </svg>
              </Link>
            </li>
            <!-- previous page -->
            <li>
              <Link
                :href="pagination.prev_page"
                class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 r hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                :class="{ 'link-disabled ': pagination.prev_page === '#' }"
              >
                <span class="sr-only">Previous</span>
                <svg
                  class="w-2 h-2 rtl:rotate-180"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 6 10"
                >
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 1 1 5l4 4"
                  />
                </svg>
              </Link>
            </li>
            <!-- number pages -->
            <li v-for="(link, index) in visiblePages" :key="index">
              <Link
                :href="finalLink(link.url)"
                :only="['data', 'pagination']"
                class="flex items-center justify-center px-4 h-10 leading-tight"
                :class="{
                  ' text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white':
                    !link.active,
                  'link-disabled  text-blue-500 bg-blue-100 border border-blue-300 hover:bg-blue-100 hover:text-blue-700 dark:bg-blue-800 dark:border-blue-700 dark:text-blue-400 dark:hover:bg-blue-700 dark:hover:text-white':
                    link.active,
                  'link-disabled': link.label === '...',
                }"
              >
                {{ link.label }}
              </Link>
            </li>
            <!-- next page -->
            <li>
              <Link
                :href="pagination.next_page"
                class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                :class="{ 'link-disabled ': pagination.next_page === '#' }"
              >
                <span class="sr-only">Next</span>
                <svg
                  class="w-2 h-2 rtl:rotate-180"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 6 10"
                >
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m1 9 4-4-4-4"
                  />
                </svg>
              </Link>
            </li>
            <!-- last page -->
            <li>
              <Link
                :href="pagination.last_page"
                class="flex items-center justify-center px-3 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                :class="{
                  'link-disabled ':
                    pagination.links.length === pagination.currentPage,
                }"
              >
                <span class="sr-only">Last</span>
                <svg
                  class="w-2 h-2 rtl:rotate-180"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 6 10"
                >
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m1 9 4-4-4-4"
                  /></svg
                ><svg
                  class="w-2 h-2 rtl:rotate-180"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 6 10"
                >
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m1 9 4-4-4-4"
                  />
                </svg>
              </Link>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import { ITEMS_PER_PAGE_OPTION, MAX_VISIBLE_PAGE } from "../conststants";

const emit = defineEmits(["update:data"]);

const props = defineProps({
  total: {
    type: Number,
    default: 10,
  },
  currentPage: {
    type: Number,
    default: 1,
  },
  per_page: {
    type: Number,
    default: 10,
  },
  links: {
    type: Array,
    default: [],
  },
  next_page: {
    type: [String, null],
    default: null,
  },
  prev_page: {
    type: [String, null],
    default: null,
  },
  first_page: {
    type: [String, null],
    default: null,
  },
  last_page: {
    type: [String, null],
    default: null,
  },
  total_page: {
    type: Number,
    default: 0,
  },
  query_string: {
    type: String,
    default: "",
  },
});

const visiblePages = ref([]);
const showTag = ref({ from: 1, to: 2, total: 2 });

const pagination = ref({
  total: props.total,
  currentPage: props.currentPage,
  perPage: props.per_page ?? 10,
  links: props.links,
  next_page: props.next_page ?? "#",
  prev_page: props.prev_page ?? "#",
  first_page: props.first_page ?? "#",
  last_page: props.last_page ?? "#",
  total_page: props.total_page,
});

onMounted(() => {
  shortenPagination();
  calcuTag();
});

const shortenPagination = () => {
  const paginationData = pagination.value;
  const visibleLinkCount = MAX_VISIBLE_PAGE * 2 + 1;

  // find page link start and end
  let pageStart =
    paginationData.currentPage > MAX_VISIBLE_PAGE + 1
      ? paginationData.currentPage - MAX_VISIBLE_PAGE + 1
      : 0;
  let pageLast =
    paginationData.currentPage + MAX_VISIBLE_PAGE > paginationData.total_page
      ? paginationData.total_page
      : paginationData.currentPage + MAX_VISIBLE_PAGE;

  // adjust page offset
  const totalPage = Math.abs(pageStart - pageLast);

  if (totalPage < visibleLinkCount) {
    if (pageStart === 0) {
      pageLast = visibleLinkCount;
    } else {
      pageStart = pageLast - visibleLinkCount;
    }
  }

  visiblePages.value = paginationData.links.slice(pageStart, pageLast);

  // display ... for hidden page
  if (pageStart !== 0 && paginationData.total_page > visibleLinkCount) {
    visiblePages.value.unshift({
      active: false,
      label: "...",
      url: "#",
    });
  }

  if (
    pageLast !== paginationData.total &&
    paginationData.total_page > visibleLinkCount
  ) {
    visiblePages.value.push({
      active: false,
      label: "...",
      url: "#",
    });
  }
};

const calcuTag = () => {
  let from = 1;
  let to = 2;
  const paginationData = pagination.value;
  from =
    paginationData.perPage * paginationData.currentPage -
    paginationData.perPage +
    1;
  to = paginationData.perPage * paginationData.currentPage;

  // console.log(paginationData.total, from, to, 1234214);

  // adjust to
  to = to > paginationData.total ? paginationData.total : to;

  showTag.value.from = from;
  showTag.value.to = to;
  showTag.value.total = paginationData.total;
};

const updatePerPage = () => {
  emit("update:data", pagination.value.perPage);
};

const finalLink = (link) => {
  return link + props.query_string;
};
</script>

<style lang="scss" scoped>
.link-disabled {
  pointer-events: none;
  cursor: default;
  text-decoration: none;
}
</style>
