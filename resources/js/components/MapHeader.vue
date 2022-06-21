<template>
        <div class="activities-map__header bg-purple text-white w-full flex justify-center items-center">
            <template v-if="cities.length">
                <div>

                    <!-- MAIN TITLE -->
                    <h1 class="flex items-center">
                        <span class="pre">
                            Događanja | 
                        </span>

                        <!-- IF CITY IS  NOT SELECTED, SHOW LIST -->
                        <template v-if="!activeCity">
                            <span 
                            v-for="(city, i) in cities"
                            :key="'header-city-'+city.id"
                            class="header-city"
                            :class="{'header-city--active' : activeCityId == city.id}"
                            @click="$emit('setActiveCity', city)"
                            >
                                <span class="px-3">{{city.name}}</span>
                            <span v-if="i !== cities.length - 1" class=""> | </span>
                            </span>
                        </template>

                        <!-- IF CITY ISSELECTED, SHOW NAME OF THE SELECTED CITY WITH CLOSE BTN -->
                        <span v-else class="header-city header-city--active flex items-center pl-3">
                            {{activeCity.name}}
                            <span 
                            class="header-city--unset"
                            @click="$emit('setActiveCity', activeCity)"
                            >
                            <IconTimes/>
                            </span>
                        </span>
                    </h1>
                </div>
            </template>
        </div>
</template>
<script>
import IconTimes from '@/components/icons/IconTimes'


    export default{
    components : {
        IconTimes
    },
    props : {
        cities : {
            Type : Array,
            required : true
        },
        activeCity : {
            Type : Object,
            required : false,
            default : null
        }
    }
}
</script>