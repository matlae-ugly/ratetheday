<template>
    <div class="font-secondary">
        <div class="attributes-add">
            <i class="fa fa-plus" @click="inputActive = !inputActive"></i>
        </div>
        <div class="attributes-header">
            <h1>Your attribues</h1>
        </div>
        <ul class="px-5 mt-3">
            <li v-for="attr in attributes">
                <div class="attribute-li">
                    <h3>{{ attr.attribute_name }}</h3>
                    <i @click="deleteAttribute(attr.id)" class="fa fa-times"></i>
                </div>
            </li>
        </ul>
        <div class="attributes-input-wrapper px-5 mt-3" v-if="inputActive">
            <input class="attributes-input w-50 mr-3" v-model="newAttributeName" type="text">
            <span @click="addAttribute()">Add</span>
        </div>
        <div class="text-center color-red" v-if="error && inputActive">
            {{ errorMessage }}
        </div>
    </div>
</template>

<script>
export default {
    name: 'attributes',
    data() {
        return {
            attributes: [],
            newAttributeName: '',
            inputActive: false,
            error: false,
            errorMessage: ''
        }
    },
    mounted(){
        this.loadData();
    },
    methods: {
        loadData: function() {
            axios.get('/api/api-attributes').then(res => {
                if(res.status==200){
                    this.attributes=res.data;
                }
            }).catch(err=>{
                console.log(err)
            });
        },
        addAttribute: function() {
            if (this.newAttributeName == '0') {
                this.error = true;
                this.errorMessage = 'Attribute name cannot be empty';
            } else {
                this.error = false;
                axios.post('/api/api-attributes', {
                    attribute_name: this.newAttributeName
                }).then(res => {
                    if(res.status==200){
                        this.loadData();
                        this.inputActive = false;
                        this.newAttributeName = '';
                    }
                }).catch(err=>{
                    console.log(err)
                });
            }
        },
        deleteAttribute: function(id) {
            axios.delete(`/api/api-attributes/${id}`).then(res => {
                if (res.status == 200) {
                    this.loadData();
                }
            }).catch(err => {
                console.log(err)
            });
        }
    }
}

</script>
