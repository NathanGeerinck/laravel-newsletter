<script>
    import { Line } from 'vue-chartjs'

    export default ({
        extends: Line,
        props: ['label', 'color', 'min', 'max', 'step', 'values', 'labels', 'options'],

        data() {
            return {
                datacollection: {
                    labels: this.labels,
                    datasets: [
                        {
                            label: this.label,
                            fill: false,
                            borderColor: this.color,
                            lineTension:0.1,
                            data: this.values,
                        }
                    ]
                }
            }
        },

        mounted() {
            this.renderChart(this.datacollection, {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                min: this.min,
                                max: this.max,
                                beginAtZero: false,
                                stepSize: this.step
                            }
                        }
                    ]
                }
            })
        }
    })
</script>