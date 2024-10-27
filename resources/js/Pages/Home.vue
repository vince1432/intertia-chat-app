<template>
  <div class="container h-full w-full">
    <!-- Head -->
    <ChatHeader />
    <!-- <hr /> -->
    <!-- Content -->
    <div class="messages column overflow-y-auto text-nowrap border-t-2">
      <ChatMessage
        v-for="message in messages"
        class="message flex flex-col"
        :message="message.message"
        :name="message.sender.full_name"
        :key="message.id"
      />
    </div>
    <!-- Chat Box -->
    <ChatBox class="footer" />
  </div>
</template>

<script setup>
import ChatBox from "@components/ChatBox.vue";
import ChatHeader from "@components/ChatHeader.vue";
import ChatMessage from "@components/ChatMessage.vue";
import { usePage } from "@inertiajs/vue3";
import { computed, ref, watch } from "vue";

const page = usePage();

const messages = ref([]);
const propMessages = computed(() => {
  return page.props.data.messages;
});

watch(
  propMessages,
  async (newVal, oldVal) => {
    messages.value = newVal;
  },
  { deep: true }
);
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
