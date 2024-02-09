<template>
  <v-alert
    v-if="notify.text"
    :type="notify.type"
    v-bind="notify.props"
    :text="notify.text"
    closable
    variant="flat"
    rounded="0"
    position="fixed"
    class="tw-z-[2500] tw-top-0 tw-left-0 tw-right-0 tw-opacity-95"
    @update:model-value="!$event && notify.close()"
  >
  </v-alert>

  <v-dialog
    :model-value="!!notify.confirmation.message"
    :max-width="350"
    persistent
    @update:model-value="notify.handleConfirm($event)"
  >
    <v-card rounded="0">
      <v-card-title>{{
        notify.confirmation.options?.title || "Are you sure?"
      }}</v-card-title>
      <v-card-text>{{ notify.confirmation.message }}</v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn
          color="primary-darken-1"
          variant="text"
          @click="notify.handleConfirm(true)"
          >Yes</v-btn
        >
        <v-btn color="grey" variant="text" @click="notify.handleConfirm(false)"
          >Cancel</v-btn
        >
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script setup>
import notify from "@/utils/notify";
</script>
