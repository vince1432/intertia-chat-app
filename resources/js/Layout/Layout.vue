<template>
  <SideNav :chats="chats" :groups="groups">
    <slot />
  </SideNav>
</template>

<script setup>
import SideNav from "@components/SideNav/SideNav.vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();
const chats = page.props.data.user_messages;
const groups = page.props.data.groups;
</script>

<style lang="scss" scoped></style>
