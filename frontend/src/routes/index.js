import { createWebHistory, createRouter } from "vue-router";
import ItemMaintenance from "@/views/ItemMaintenance.vue";

const routes = [
  {
    path: "/item-entry",
    name: "Item",
    component: ItemMaintenance,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;