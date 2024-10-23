<template>
  <div>
    <li>
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
          <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
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
            group.last_message ? timeDisplay(group.last_message.created_at) : ""
          }}
        </div>
      </div>
    </li>
  </div>
</template>

<script setup>
defineProps({
  group: Object,
});
import useChatDate from "@composables/useChatDate.js";
const { timeDisplay } = useChatDate();
</script>

<style lang="scss" scoped></style>
