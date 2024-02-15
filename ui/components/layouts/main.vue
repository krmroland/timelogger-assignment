<template>
  <v-app>
    <v-app-bar flat class="tw-white" v-bind="$attrs">
      <template v-slot:prepend>
        <v-icon color="primary" size="x-large">
          {{ mdiClipboardTextClock }}
        </v-icon>
      </template>

      <v-app-bar-title class="tw-text-xl tw-font-bold tw-flex-none"> Time logger </v-app-bar-title>

      <v-spacer> </v-spacer>

      <v-badge content="2" bordered color="primary" rounded>
        <v-icon>{{ mdiBellOutline }}</v-icon>
      </v-badge>

      <v-menu>
        <template #activator="{ props }">
          <v-btn v-bind="props" size="large" class="tw-mx-5" variant="text" rounded>
            <template #prepend>
              <v-avatar size="30">
                <v-img
                  src="https://cdn.vuetifyjs.com/images/john.jpg"
                  alt="John"
                ></v-img> </v-avatar
            ></template>

            {{ user?.name }}

            <template #append>
              <v-icon>{{ mdiChevronDown }}</v-icon>
            </template>
          </v-btn>
        </template>
        <v-list class="tw-w-full">
          <v-list-item @click="handleLogout" :disabled="isLoggingOut">
            <v-list-item-title>Logout</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>

    <v-main class="tw-bg-zinc-100 tw-pb-8">
      <app-notifications></app-notifications>
      <slot />
    </v-main>
  </v-app>
</template>

<script setup>
  import { computed, ref } from 'vue';
  import { mdiBellOutline, mdiChevronDown, mdiClipboardTextClock } from '@mdi/js';
  import store from '@/utils/store';
  import AppNotifications from './notifications';

  defineProps({ noContainer: Boolean, title: String });

  const user = computed(() => store.auth.user || {});

  const isLoggingOut = ref(false);

  async function handleLogout() {
    isLoggingOut.value = true;
    const { default: http } = await import('@/utils/http');

    http
      .post('/auth/logout')
      .then(() => {
        window.location.reload();
      })
      .finally(() => {
        isLoggingOut.value = false;
      });
  }
</script>
