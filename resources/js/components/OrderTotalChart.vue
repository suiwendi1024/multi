<template>
    <div :id="id" style="min-width: 600px; min-height:400px;"></div>
</template>

<script>
import * as echarts from "echarts";

export default {
    name: "OrderTotalChart",
    props: {
        chart: { type: Object, required: true },
    },
    data() {
        return {
            id: 'chart-' + this.chart.title,
        }
    },
    mounted() {
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById(this.id));

        // 指定图表的配置项和数据
        var option = {
            title: {
                text: this.chart.title
            },
            tooltip: {},
            legend: {
                data:['销售额']
            },
            xAxis: {
                data: this.chart.date,
            },
            yAxis: {},
            series: [{
                name: '销售额',
                type: 'line',
                data: this.chart.total
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    }
}
</script>

<style scoped>

</style>
