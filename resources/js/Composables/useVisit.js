import { router } from "@inertiajs/vue3";

export default function useVisit() {
  const goTo = (url) => {
    router.visit(url, { method: "get" });
  };

  return {
    goTo,
  };
}
