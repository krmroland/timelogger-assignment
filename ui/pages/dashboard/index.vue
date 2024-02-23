<template>
  <main-layout>
    <log-entry-modal v-model="isCreating" @created="handleCreated" />
    <v-container>
      <h3>Time Entries</h3>
      <header class="tw-flex tw-items-center tw-mt-5">
        <v-responsive max-width="160px">
          <v-autocomplete
            :prepend-inner-icon="mdiCalendarFilterOutline"
            :items="[
              { value: 'daily', title: 'Daily' },
              { value: 'monthly', title: 'Monthly' },
            ]"
            v-model="mode"
          ></v-autocomplete>
        </v-responsive>
        <v-spacer></v-spacer>

        <v-menu transition="slide-y-transition" :close-on-content-click="false">
          <template v-slot:activator="{ props }">
            <v-responsive class="tw-ml-3" max-width="240px">
              <v-text-field
                v-bind="props"
                :value="formattedDate"
                clearable
                @click:clear="date = null"
                hide-details
                placeholder="Filter date"
                :prepend-inner-icon="mdiCalendarBlankOutline"
                :append-inner-icon="mdiFilterVariant"
              >
              </v-text-field>
            </v-responsive>
          </template>
          <v-date-picker v-model="date" elevation="24" title="Filter Entries"></v-date-picker>
        </v-menu>

        <v-spacer></v-spacer>
        <export-button :user-id="store.userId" />
        <v-btn color="primary" @click="isCreating = true" class="tw-ml-2">
          <template #prepend>
            <v-icon>{{ mdiTimerPlusOutline }}</v-icon>
          </template>

          Add Entry
        </v-btn>
      </header>
      <entries-table ref="tableRef" :mode="mode" :date="date"></entries-table>
    </v-container>
  </main-layout>
</template>
<script setup>
  import MainLayout from '@/components/layouts/main';
  import { ref, computed, onMounted } from 'vue';
  import LogEntryModal from '@/components/time/log-entry-modal';
  import EntriesTable from '@/components/time/entries-table';
  import ExportButton from '@/components/time/export-button';
  import store from '@/utils/store';

  import { capitalize } from 'lodash-es';
  import {
    mdiTimerPlusOutline,
    mdiCalendarBlankOutline,
    mdiCalendarFilterOutline,
    mdiFilterVariant,
  } from '@mdi/js';

  import dayjs from 'dayjs';

  const isCreating = ref(false);

  const date = ref(null);

  const tableRef = ref(null);

  const mode = ref('daily');

  const formattedDate = computed(() => {
    if (!date.value) {
      return;
    }
    const d = dayjs(date.value || '');
    console.log(mode.value);
    return d.format(mode.value === 'monthly' ? 'MMM-YYYY' : 'DD-MMM-YYYY');
  });

  function handleCreated(entry) {
    isCreating.value = false;
    tableRef.value.fetchEntries();
  }
</script>
