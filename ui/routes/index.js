export default [
  {
    path: "/",
    component: () => import("@/pages/dashboard/index"),
  },
  {
    path: "/auth/register",
    component: () => import("@/pages/auth/register"),
    name: "auth.register",
  },

  {
    path: "/auth/login",
    component: () => import("@/pages/auth/login"),
    name: "auth.login",
  },
];
