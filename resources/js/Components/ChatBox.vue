<template>
  <div>
    <form @submit.prevent="send" class="flex">
      <textarea
        v-model="form.message"
        name="chatbox"
        rows="5"
        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
      />
      <div class="send-icon">
        <button type="submit" :disabled="!form.message.length">
          <svg
            class="w-6 h-6 text-gray-800 dark:text-white rotate-[90deg] hover:cursor-pointer"
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
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";

const props = defineProps({
  selected: {
    type: Object,
    default: {
      id: 0,
      type: "CHAT",
    },
  },
});

const form = useForm({
  send_to: null,
  type: null,
  message: "",
});

const emit = defineEmits(["add:message"]);

const send = () => {
  form["send_to"] = props.selected.id;
  form["type"] = props.selected.type;
  form.post("/send", {
    onSuccess: ({ props }) => {
      form.reset();
      emit("add:message", props.data.message);
    },
    onError: (errors) => {
      for (var error in errors) {
        if (Object.prototype.hasOwnProperty.call(errors, error))
          toast.error(errors[error]);
      }
    },
  });
};
</script>

<style lang="scss" scoped>
.send-icon {
  align-self: flex-end;
}
</style>
