<template>
  <div class="container h-full w-full">
    <!-- Head -->
    <ChatHeader :chatName="messageHeader.name" />
    <!-- <hr /> -->
    <!-- Content -->
    <div
      v-if="messages.length"
      class="messages column overflow-y-auto text-nowrap border-t-2"
    >
      <ChatMessage
        v-for="message in messages"
        class="message flex flex-col"
        :message="message.message"
        :name="message.sender.full_name"
        :key="message.id"
      />
    </div>
    <div v-else class="flex justify-center grow">
      <span class="self-center">No messages</span>
    </div>
    <!-- Chat Box -->
    <ChatBox
      class="footer"
      :selected="messageHeader"
      @add:message="addNewMessage"
    />
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
const messageHeader = ref({});

const propData = computed(() => {
  return page.props.data;
});

watch(
  propData,
  async (newVal) => {
    if (newVal.messages) {
      messages.value = newVal.messages;
    }
    if (newVal.header) {
      messageHeader.value = newVal.header;
    }
  },
  { deep: true }
);

const addNewMessage = (message) => {
  messages.value.push(message);
};
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
