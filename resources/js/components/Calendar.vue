<template>
    <div class="container">
        <Selector v-bind:month="this.month" v-bind:year="this.year"/>
    </div>
</template>

<script>
import Selector from './Selector'

export default {
    name: 'Calendar',
    components: {
       Selector
    },
    data() {
        return {
            month: new Date().getMonth(),
            year: new Date().getFullYear()
        }
    }
}
</script>
