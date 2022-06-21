<template>
            <div class="activities-map__the-map-active-activity">
            <!-- CLOSE WINDOW -->
            <div 
            class="activities-map__the-map-active-activity-close"
            @click="$emit('unsetActiveActivity')"
            >
                <IconTimes />
            </div>

                    <!-- TITLE,DESC -->
                    <h1 class="activities-map__the-map-active-activity-title text-purple font-bold">{{activeActivity.title}}</h1>
                    <p class="activities-map__the-map-active-activity-desc" v-html="activeActivity.description"></p>

                    <!-- CATEGORIES -->
                    <div class="activities-map__the-map-active-activity-categories flex flex-wrap">
                        <span 
                        v-for="(cateogory, i) in activeActivity.categories"
                        :key="cateogory.id"
                        class="activities-map__the-map-active-activity-category bg-purple text-white rounded-full"
                        >
                        {{cateogory.title}}
                        </span>
                    </div>

            </div>
</template>
<script>
import IconTimes from '@/components/icons/IconTimes'


    export default{
        components : {
            IconTimes
        },

        props : {
            activeActivity : {
                Type : Object,
                required : false,
                default : null
            }
        }
    }
</script>