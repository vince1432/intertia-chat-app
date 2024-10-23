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
    <div class="border-b border-gray-200 dark:border-gray-700">
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
        class="hidden rounded-lg bg-gray-50 dark:bg-gray-800"
        id="styled-profile"
        role="tabpanel"
        aria-labelledby="profile-tab"
      >
        <ul
          v-if="chats.length"
          class="max-w-md divide-y divide-gray-200 dark:divide-gray-700"
        >
          <ChatItem v-for="chat in chats" :key="chat.id" :chat="chat" />
        </ul>
        <div v-else class="flex justify-center">
          <span class="font-bold">No chat history</span>
        </div>
      </div>
      <div
        class="hidden rounded-lg bg-gray-50 dark:bg-gray-800"
        id="styled-dashboard"
        role="tabpanel"
        aria-labelledby="dashboard-tab"
      >
        <!-- groups -->
        <ul
          v-if="groups.length"
          class="max-w-md divide-y divide-gray-200 dark:divide-gray-700"
        >
          <GroupItem v-for="group in groups" :key="group.id" :group="group" />
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
import ChatItem from "@components/SideNav/ChatItem.vue";
import GroupItem from "@components/SideNav/GroupItem.vue";
import { defineProps } from "vue";

const props = defineProps({
  chats: Array,
  groups: Array,
});
</script>

<style lang="scss" scoped></style>
