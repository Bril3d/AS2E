<script setup>
import TableDataCell from '@/Components/TableDataCell.vue';

const props = defineProps({
  section: String,
})

</script>

<template>
  <tr>
    <TableDataCell colspan="100%" class="text-center">No {{ section }} found!</TableDataCell>
  </tr>
</template>