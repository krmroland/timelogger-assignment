<template>
    <v-card>
        <v-data-table> </v-data-table>
    </v-card>
</template>

<script setup>
import { ref, onMounted } from "vue";
import store from "@/utils/store";
import http from "@/utils/http";
import notify from "@/utils/notify";

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
</script>
