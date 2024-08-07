<template>
    <div class="m-1">
        <div class="flex items-center">
            <!-- avatar -->
            <div class="p-1">
                <div
                    class="relative w-8 h-8 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600"
                >
                    <svg
                        class="absolute w-12 h-12 text-gray-400 -left-1"
                        fill="currentColor"
                        viewBox="0 0 25 25"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </div>
            </div>
            <!-- message -->
            <div class="flex flex-col">
                <span>
                    <strong>{{ name }}</strong>
                </span>
                <span>{{ message }}</span>
            </div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    message: String,
    name: String,
});
</script>

<style lang="scss" scoped></style>
