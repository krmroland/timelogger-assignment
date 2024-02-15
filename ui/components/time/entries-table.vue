<template>
  <v-card>
    <v-data-table :headers="headers" :items="entries?.data || []" :loading="isLoading">
      <template #item.date="{ item }">
        {{ dayjs(item.date).format('DD-MMM-YYYY') }}
      </template>
      <template #item.month="{ item }">
        {{ dayjs(item.date).format('MMM-YYYY') }}
      </template>
      <template #item.categories="{ item }">
        <div>
          <v-chip
            v-for="chip in item.categories"
            label
            class="tw-ml-1"
            density="compact"
            variant="outlined"
          >
            {{ chip }}
          </v-chip>
        </div>
      </template>
    </v-data-table>
  </v-card>
</template>

<script setup>
  import { ref, onMounted, watch, computed } from 'vue';
  import store from '@/utils/store';
  import http from '@/utils/http';
  import notify from '@/utils/notify';
  import dayjs from 'dayjs';

  const props = defineProps({
    mode: String,
    date: [String, Date],
  });

  const headers = computed(() => {
    if (props.mode === 'monthly') {
      return [
        { title: 'Month', value: 'month' },
        { title: 'Time', value: 'time.formatted' },
      ];
    }
    return [
      { title: 'Date', value: 'date' },
      { title: 'Categories', value: 'categories' },
      { title: 'Description', value: 'description' },
      { title: 'Time', value: 'time.formatted' },
    ];
  });

  const isLoading = ref(false);

  const entries = ref({});

  function fetchEntries() {
    isLoading.value = true;

    http
      .get(`/api/v1/users/${store.userId}/time-entries`, {
        params: {
          mode: props.mode,
          date: props.date,
        },
      })
      .then(({ data }) => {
        entries.value = data;
      })
      .catch(() => {
        notify.error('Something went wrong while fetching user entries');
      })
      .finally(() => {
        isLoading.value = false;
      });
  }

  onMounted(fetchEntries);

  defineExpose({ fetchEntries });

  watch(props, fetchEntries);
</script>
