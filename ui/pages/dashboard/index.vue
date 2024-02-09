<template>
  <main-layout>
    <log-entry-modal v-model="isCreating" />
    <v-container>
      <header class="tw-flex tw-items-center">
        <h1 class="tw-font-bold tw-text-lg">Time Entries</h1>
        <v-spacer></v-spacer>
        <v-btn color="primary" @click="isCreating = true">Log Time</v-btn>
      </header>
    </v-container>
  </main-layout>
</template>
<script setup>
import MainLayout from "@/components/layouts/main";
import { ref } from "vue";
import LogEntryModal from "@/components/times/log-entry-modal";

const isCreating = ref(false);
</script>
