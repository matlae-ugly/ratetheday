<template>
    <div class="container">
        <div class="calendar-title my-2 text-center" @click="changeMode()">
            <span v-bind:class="{'cursor-pointer' : mode!==3}">{{ mode===1 ? this.monthNames[this.selectedMonth]+' '+this.selectedYear : mode==2 ? this.selectedYear : '' }}</span>
        </div>
        <div class="days" v-if="this.mode==1">
            <div class="d-flex selector-flex" >
                <div class="selector-item" v-bind:class="{todayborder : day.today}" v-for="day in daysArray" >
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span>{{day.day}}</span>
                        </button>
                        <div class="dropdown-menu bg-color-additional-blue" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item bg-color-secondary-green color-primary-blue green-hover" @click="buildUrlRateDay(day.day)">Rate/Show day</a>
                        </div>
                        <i class="fa fa-rocket color-secondary-green rocket-font" v-show="day.filled"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="months" v-if="this.mode==2">
            <div class="d-flex selector-flex color-primary-green" >
                <div class="selector-item" style="padding: 15px;"  @click="changeMonth(month)" v-for="month in monthsArray" :key="month">
                    {{month}}
                </div>
            </div>
        </div>
        <div class="years" v-if="this.mode==3">
            <div class="d-flex selector-flex color-primary-green"  >
                <div class="selector-item" style="padding: 15px;" @click="changeYear(year)" v-for="year in yearsArray" :key="year">
                    {{year}}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Selector',
        props: ['month', 'year'],
        data() {
            return {
                // mode 1 - days, mode 2 - months, mode 3 - years
                mode: 1,
                selectedMonth: this.month,
                selectedYear: this.year,
                daysArray: [],
                monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            }
        },
        mounted() {
            this.loadDays();
            this.filterDays();
        },
        methods: {
            filterDays() {
              this.daysArray.sort();
            },
            loadDays() {
                let filled;
                let arr = [];
                for (let i = 1; i <= this.daysCount; i++) {
                    let month = this.selectedMonth + 1;
                    let day = i;
                    if (month.toString().length < 2) {
                        month = '0' + month;
                    }
                    if (day.toString().length < 2) {
                        day = '0' + day;
                    }
                    let date = this.selectedYear + '-' + month + '-' + day;
                    axios.post('/api/api-checkday', {date: date}).then(res => {
                        if (res.data.result == 'true') {
                            filled = false;
                        } else {
                            filled = true;
                        }
                        if (new Date().getDate() == res.data.day) {
                            arr.push({day: res.data.day, filled: filled, today: true});
                        } else {
                            arr.push({day: res.data.day, filled: filled, today: false});
                        }

                    }).finally(() => {
                        arr = arr.sort( (a,b) => (a.day > b.day) ? 1 : -1 );
                        this.daysArray = arr;
                    });
                }

            },
            buildUrlRateDay(day) {
              let url = `/ratetheday?day=${day}&month=${this.selectedMonth+1}&year=${this.selectedYear}`;
              location.href= url;
            },
            changeMonth(month) {
               this.selectedMonth = this.monthNames.indexOf(month);
               this.mode = 1;
               this.loadDays();
            },
            changeDaysToMonths() {
                this.mode = 2;
            },
            changeYear(year) {
                this.mode = 2;
                this.selectedYear = year;
            },
            changeMode() {
                this.mode = this.mode===1 ? this.mode = 2 : this.mode = 3;
            },
            showDay(day) {
                let url = '/ratetheday?day='+day+'&month='+this.selectedMonth+'&year='+this.selectedYear;
            }
        },
        computed: {
            daysCount: function() {
                return new Date(this.selectedYear, this.selectedMonth+1, 0).getDate();
            },
            monthsArray: function() {
                let arr = [ "January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December" ];
                return arr;
            },
            yearsArray: function() {
                let max = new Date().getFullYear()
                let min = max - 9
                let years = []

                for (let i = max; i >= min; i--) {
                    years.push(i)
                }
                return years
            }
        }
    }
</script>
