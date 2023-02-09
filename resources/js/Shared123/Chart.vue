<template>
  <div>
    <apexchart :width="chart.width" :height="chart.height" :type="chart.type" :options="chart.options" :series="chart.series" />
  </div>
</template>

<script>
export default {
  props: {
    chart: Object,
  },
}
</script>
