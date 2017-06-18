<script>
    import { Pie } from 'vue-chartjs'

    export default Pie.extend({
        props: ['keys', 'values'],

        mounted () {
            this.renderChart({
                labels: this.keys,
                datasets: [
                    {
                        data: this.values
                    }
                ]
            })
        }
    })
</script>