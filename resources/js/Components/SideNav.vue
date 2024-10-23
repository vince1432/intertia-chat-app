<template>
  <!-- open button -->
  <button
    data-drawer-target="default-sidebar"
    data-drawer-toggle="default-sidebar"
    aria-controls="default-sidebar"
    type="button"
    class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
  >
    <span class="sr-only">Open sidebar</span>
    <svg
      class="w-6 h-6"
      fill="currentColor"
      viewBox="0 0 20 20"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        clip-rule="evenodd"
        fill-rule="evenodd"
        d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
      ></path>
    </svg>
  </button>
  <!-- Nav content -->
  <aside
    id="default-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar"
  >
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
      <ul
        class="flex -mb-px text-sm font-medium text-center"
        id="default-styled-tab"
        data-tabs-toggle="#default-styled-tab-content"
        data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500"
        data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
        role="tablist"
      >
        <li class="grow" role="presentation">
          <button
            class="p-4 w-full border-b-2 rounded-t-lg"
            id="profile-styled-tab"
            data-tabs-target="#styled-profile"
            type="button"
            role="tab"
            aria-controls="profile"
            aria-selected="false"
          >
            Chats
          </button>
        </li>
        <li class="grow" role="presentation">
          <button
            class="p-4 w-full border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
            id="dashboard-styled-tab"
            data-tabs-target="#styled-dashboard"
            type="button"
            role="tab"
            aria-controls="dashboard"
            aria-selected="false"
          >
            Groups
          </button>
        </li>
      </ul>
    </div>
    <div id="default-styled-tab-content">
      <!-- chats -->
      <div
        class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800"
        id="styled-profile"
        role="tabpanel"
        aria-labelledby="profile-tab"
      >
        <ul
          v-if="chats.length"
          class="max-w-md divide-y divide-gray-200 dark:divide-gray-700"
        >
          <li v-for="chat in chats" :key="chat.id">
            <div class="flex items-center space-x-4 rtl:space-x-reverse">
              <div class="flex-shrink-0">
                <svg
                  class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                  <path
                    d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"
                  />
                </svg>
              </div>
              <div class="flex-1 min-w-0">
                <p
                  class="text-sm font-medium text-gray-900 truncate dark:text-white"
                >
                  {{ chat.chat_title }}
                </p>
                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                  {{ chat.message }}
                </p>
              </div>
              <div
                class="inline-flex items-center text-xs text-gray-900 dark:text-white"
              >
                {{ timeDisplay(chat.created_at) }}
              </div>
            </div>
          </li>
        </ul>
        <div v-else class="flex justify-center">
          <span class="font-bold">No chat history</span>
        </div>
      </div>
      <div
        class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800"
        id="styled-dashboard"
        role="tabpanel"
        aria-labelledby="dashboard-tab"
      >
        <!-- groups -->
        <ul
          v-if="groups.length"
          class="max-w-md divide-y divide-gray-200 dark:divide-gray-700"
        >
          <li v-for="group in groups" :key="group.id">
            <div class="flex items-center space-x-4 rtl:space-x-reverse">
              <div class="flex-shrink-0">
                <svg
                  class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                  <path
                    d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"
                  />
                </svg>
              </div>
              <div class="flex-1 min-w-0">
                <p
                  class="text-sm font-medium text-gray-900 truncate dark:text-white"
                >
                  {{ group.name }}
                </p>
                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                  {{
                    group.last_message
                      ? `${group.last_message.sender.first_name}: ${group.last_message.message}`
                      : "No Message"
                  }}
                </p>
              </div>
              <div
                class="inline-flex items-center text-xs text-gray-900 dark:text-white"
              >
                {{
                  group.last_message
                    ? timeDisplay(group.last_message.created_at)
                    : ""
                }}
              </div>
            </div>
          </li>
        </ul>
        <div v-else class="flex justify-center">
          <span class="font-bold">No chat history</span>
        </div>
      </div>
    </div>
  </aside>

  <div class="sm:ml-64">
    <slot />
  </div>
</template>

<script setup>
import { defineProps } from "vue";

const props = defineProps({
  chats: Array,
  groups: Array,
});

const timeDisplay = (date) => {
  const now = new Date();
  const past = new Date(date);
  const diffInSeconds = Math.floor((now - past) / 1000); // Difference in seconds

  if (diffInSeconds < 86400) {
    const hour = past.getHours();
    const minutes = past.getMinutes();
    // Less than a minute
    return `${hour}:${minutes}`;
  }

  const diffInMinutes = Math.floor(diffInSeconds / 60);
  const diffInHours = Math.floor(diffInMinutes / 60);
  const diffInDays = Math.floor(diffInHours / 24);
  if (diffInDays < 7) {
    // Less than a week
    return `${diffInDays}d`;
  }

  // Otherwise, return the date in 'y-m-d' format
  const year = past.getFullYear();
  const month = String(past.getMonth() + 1).padStart(2, "0"); // Months are 0-indexed
  const day = String(past.getDate()).padStart(2, "0");

  return `${year}-${month}-${day}`;
};
</script>

<style lang="scss" scoped></style>
