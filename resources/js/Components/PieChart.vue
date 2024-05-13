<script setup>
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
import { Pie } from 'vue-chartjs'

const props = defineProps({
  chartData: {
    type: Object,
    required: true
  },
})

const options = {
  responsive: true,
  maintainAspectRatio: false
}

ChartJS.register(ArcElement, Tooltip, Legend)

</script>

<template>
  <div>
    <Pie :data="chartData" :options="options" />
  </div>
</template>