<template>
    <v-card>
        <v-data-table :headers="headers" :items="entries?.data || []">
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
import { ref, onMounted } from "vue";
import store from "@/utils/store";
import http from "@/utils/http";
import notify from "@/utils/notify";

const headers = [
    { title: "Date", value: "date" },
    { title: "Categories", value: "categories" },
    { title: "Description", value: "description" },
    { title: "Time", value: "time.formatted" },
];

const isLoading = ref(false);

const entries = ref({});

function fetchEntries() {
    isLoading.value = true;

    http.get(`/api/v1/users/${store.userId}/time-entries`)
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

defineExpose({ fetchEntries });
</script>
