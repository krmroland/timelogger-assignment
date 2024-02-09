<template>
  <main-layout>
    <log-entry-modal v-model="isCreating" @created="handleCreated" />
    <v-container>
      <header class="tw-flex tw-items-center">
        <h1 class="tw-font-bold tw-text-lg">Time Entries</h1>
        <v-spacer></v-spacer>
        <v-btn color="primary" @click="isCreating = true">Log Time</v-btn>
      </header>

      <pre>
          <code>{{ entries }}</code>
      </pre>
    </v-container>
  </main-layout>
</template>
<script setup>
import MainLayout from "@/components/layouts/main";
import { ref, onMounted } from "vue";
import LogEntryModal from "@/components/times/log-entry-modal";
import http from "@/utils/http";
import notify from "@/utils/notify";
import store from "@/utils/store";

const isCreating = ref(false);

const entries = ref({});
const isLoading = ref(false);

function fetchEntries() {
  isLoading.value = true;

  http
    .get(`/api/v1/users/${store.userId}/time-entries`)
    .then(({ data }) => {
      entries.value = data;
    })
    .catch(() => {
      notify.error("Something went wrong while fetching user entries");
    })
    .finally(() => {
      isLoading.value = false;
    });
}

onMounted(fetchEntries);

function handleCreated(entry) {
  isCreating.value = false;
  fetchEntries();
}
</script>
