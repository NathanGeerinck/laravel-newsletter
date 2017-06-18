<script>
    import { Bar } from 'vue-chartjs'

    export default Bar.extend({
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