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
            aria-hidden="true"
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
        <div
            class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800"
        >
            <ul class="space-y-2 font-medium">
                <ChatItem v-for="chat in chats" :chat="chat" />
            </ul>
        </div>
    </aside>

    <div class="sm:ml-64">
        <slot />
    </div>
</template>

<script setup>
import ChatItem from "@components/ChatItem.vue";
import { reactive } from "vue";
const chats = reactive([
    {
        id: 1,
        type: "user",
        name: "User 1",
        image: null,
        recent: "this a recent message",
        time: "12-12-24 11:11:11",
        unread: 1,
    },
    {
        id: 2,
        type: "user",
        name: "User 2",
        image: null,
        recent: "this a recent message",
        time: "12-12-24 12:13:13",
        unread: 4,
    },
    {
        id: 3,
        type: "user",
        name: "User 3",
        image: null,
        recent: "this a recent message",
        time: "12-12-24 12:13:13",
        unread: 2,
    },
]);
</script>

<style lang="scss" scoped></style>
