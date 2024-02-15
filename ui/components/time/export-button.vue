<template>
  <v-btn variant="outlined" :href="`/users/${userId}/export-time-entries`" target="_blank">
    <template #prepend>
      <v-icon>{{ mdiExport }}</v-icon>
    </template>
    Export
  </v-btn>
</template>
<script setup>
  import { mdiExport } from '@mdi/js';

  defineProps({ userId: [String, Number], date: [Date, String] });
</script>
