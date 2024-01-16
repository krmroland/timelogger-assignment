export default [
  {
    path: "/",
    component: () => import("@/pages/dashboard/index"),
  },
  {
    path: "/auth/register",
    component: () => import("@/pages/auth/register"),
  },
];
