<template>
  <div>
    <div
      @click="goTo(route('users.index'))"
      class="max-w-sm px-4 py-3 bg-white border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700 font-semibold flex hover:cursor-pointer hover:bg-violet-200"
    >
      <svg
        class="w-6 h-6 text-gray-800 dark:text-white mr-4"
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="24"
        fill="none"
        viewBox="0 0 24 24"
      >
        <path
          stroke="currentColor"
          stroke-width="2"
          d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
        />
      </svg>
      Users
    </div>
    <div
      class="max-w-sm px-4 py-3 bg-white border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700 font-semibold flex hover:cursor-pointer hover:bg-violet-200"
    >
      <svg
        class="w-6 h-6 text-gray-800 dark:text-white mr-4"
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
          d="M21 13v-2a1 1 0 0 0-1-1h-.757l-.707-1.707.535-.536a1 1 0 0 0 0-1.414l-1.414-1.414a1 1 0 0 0-1.414 0l-.536.535L14 4.757V4a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v.757l-1.707.707-.536-.535a1 1 0 0 0-1.414 0L4.929 6.343a1 1 0 0 0 0 1.414l.536.536L4.757 10H4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h.757l.707 1.707-.535.536a1 1 0 0 0 0 1.414l1.414 1.414a1 1 0 0 0 1.414 0l.536-.535 1.707.707V20a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-.757l1.707-.708.536.536a1 1 0 0 0 1.414 0l1.414-1.414a1 1 0 0 0 0-1.414l-.535-.536.707-1.707H20a1 1 0 0 0 1-1Z"
        />
        <path
          stroke="currentColor"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
        />
      </svg>

      Settings
    </div>
  </div>
</template>

<script setup>
import useVisit from "@composables/useVisit";

const { goTo } = useVisit();
</script>

<style lang="scss" scoped></style>
