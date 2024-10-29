<template>
  <SideNav :chats="chats" :groups="groups" @update:chats="updateMessages">
    <slot>
      No Message
    </slot>
  </SideNav>
</template>

<script setup>
import SideNav from "@components/SideNav/SideNav.vue";
import { router, usePage } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";

const page = usePage();
const chats = page.props.data.user_messages;
const groups = page.props.data.groups;

const updateMessages = ({ id, type }) => {
  // TODO - preserve displayed
  console.log(id, type);
  router.remember({ id, type }, "display-message");
  page.props.data.messages = [];
  router.post(
    "/messages",
    { id: id, type: type },
    {
      preserveState: true,
      preserveScroll: true,
      onError: (errors) => {
        for (var error in errors) {
          if (Object.prototype.hasOwnProperty.call(errors, error))
            toast.error(errors[error]);
        }
      },
    }
  );
};
</script>

<style lang="scss" scoped></style>
