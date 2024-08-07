<template>
    <div class="container h-full">
        <!-- Head -->
        <ChatHeader />
        <!-- <hr /> -->
        <!-- Content -->
        <div class="messages column overflow-y-auto text-nowrap border-y-2">
            <ChatMessage
                v-for="message in messages"
                class="message flex flex-col"
                :message="message"
                name="John Doe"
            />
            <!-- <div v-for="message in message">
                {{ message }}
            </div> -->
        </div>
        <!-- Chat Box -->
        <ChatBox class="footer" />
    </div>
</template>

<script setup>
import ChatBox from "@components/ChatBox.vue";
import ChatHeader from "@components/ChatHeader.vue";
import ChatMessage from "@components/ChatMessage.vue";

const messages = [
    "message 1",
    "message 2",
    "message 3",
    "message 4",
    "message 5",
    "message 6",
    "message 7",
    "message 8",
    "message 9",
    "message 10",
    "message 11",
    "message 12",
    "message 13",
];
</script>

<style lang="scss" scoped>
.container {
    display: flex;
    flex-direction: column;
    height: 100vh;
}

.column {
    flex-grow: 1;
}
</style>
