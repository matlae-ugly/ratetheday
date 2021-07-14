<template>
    <div class="font-secondary">
        <div v-for="(attribute,index) in attributes">
            <div class="stars custom-textarea">
                <span>{{ attribute.attribute_name }}</span>
                <div class="d-flex justify-content-center">
                    <star-rating
                        v-model="ratings[attribute.id]"
                        v-bind:increment="0.5"
                        v-bind:max-rating="5"
                    ></star-rating>
                </div>
                <textarea placeholder="Some additional notes about attribute" class="w-100 px-4 mt-3" v-model="notes[attribute.id]"></textarea>
            </div>
        </div>
        <div class="ratetheday-footer custom-textarea">
            <span>Day overall</span>
            <textarea v-model="overall" class="w-100 px-4 mt-3" placeholder="Some notes about your day"></textarea>
        </div>
        <div class="d-flex justify-content-center">
            <button @click="rateDay()" class="btn custom-btn w-50 mx-auto bg-color-primary-green mt-3">Submit</button>
        </div>
    </div>
</template>

<script>
import StarRating from 'vue-star-rating'

export default {
    name: 'RateTheDay',
    data() {
        return {
           attributes: [],
           ratings: {},
           notes: {},
           overall: ''
        }
    },
    components: {
        StarRating
    },
    mounted() {
        this.loadAttributes()
        this.checkIfFilled();
    },
    methods: {
        checkIfFilled: function () {
            let url_string = window.location.href;
            let url = new URL(url_string);
            let day = url.searchParams.get("day");
            let month = url.searchParams.get('month');
            let year = url.searchParams.get('year');
            if (month.length < 2) {
                month = '0' + month;
            }
            if (day.length < 2) {
                day = '0' + day;
            }
            let date = year+'-'+month+'-'+day;
            axios.post('/api/api-checkday', {
                date: date
            }).then(res => {
                if (res.status == 200) {
                    if (res.data.result != 'true') {
                        let data = JSON.parse(res.data.result);
                        this.ratings = data.ratings;
                        this.notes = data.notes;
                        this.overall = data.overall
                    }
                }
            })
        },
        loadAttributes: function() {
            axios.get('/api/api-attributes').then(res => {
                if(res.status==200){
                    this.attributes=res.data;
                }
            }).catch(err=>{
                console.log(err)
            });
        },
        rateDay: function() {
            let url_string = window.location.href;
            let url = new URL(url_string);
            let day = url.searchParams.get("day");
            let month = url.searchParams.get('month');
            let year = url.searchParams.get('year');
            if (month.length < 2) {
                month = '0' + month;
            }
            if (day.length < 2) {
                day = '0' + day;
            }
            let date = year+'.'+month+'.'+day;
            let json = {ratings: this.ratings, notes: this.notes, overall: this.overall};
            json = JSON.stringify(json);
            axios.post('/api/api-ratetheday', {
                day: date, attributes: json
            }).then(res => {
                if (res.status == 200) {
                    window.location.href = "/home";
                }
            }).catch(err => {
                console.log(err);
            });
        }
    }
}
</script>
