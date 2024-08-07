<template>
    <div class="flex">
        <textarea
            name="chatbox"
            rows="5"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        />
        <div class="send-icon">
            <svg
                class="w-6 h-6 text-gray-800 dark:text-white rotate-[270deg]"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                fill="red"
                viewBox="0 0 24 24"
            >
                <path
                    fill-rule="evenodd"
                    d="M12 2a1 1 0 0 1 .932.638l7 18a1 1 0 0 1-1.326 1.281L13 19.517V13a1 1 0 1 0-2 0v6.517l-5.606 2.402a1 1 0 0 1-1.326-1.281l7-18A1 1 0 0 1 12 2Z"
                    clip-rule="evenodd"
                />
            </svg>
        </div>
    </div>
</template>

<script setup></script>

<style lang="scss" scoped>
.send-icon {
    align-self: flex-end;
}
</style>
