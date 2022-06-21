<template>
    <div class="activities-map__holder flex flex-wrap items-start">

        <MapHeader 
        :cities="cities" 
        :active-city="activeCity"
        @setActiveCity="setActiveCity"
        />

        <!--  MAP WITH ACTIVE ACTIVITY WINDOW -->
        <div class="activities-map__the-map-holder relative  w-8/12">
            
            
            <!--  THE MAP -->
            <div class="activities-map__the-map w-full h-full" id="the-map"></div>

            <!--  ACTIVE ACTIVITY WINDOW -->
            <Transition name="fade">
                <ActiveActivityWindow
                v-if="activeActivity"
                :active-activity="activeActivity"
                @unsetActiveActivity="unsetActiveActivity"
                />
            </Transition>

        </div>

        <!-- ASIDE -->
        <div class="activities-map__aside w-4/12 h-full flex">

            <!-- ASIDE : CITIES -->
            <TransitionGroup tag="div" name="fade" class="w-1/2 flex flex-col">

                <h2 
                v-if="cities" 
                class="activities-map__aside-title text-purple"
                :class="{'font-bold' : !activeCity && !activeActivity}"
                >
                Odaberite grad...
                </h2>

                <!-- ALL THE CITIES LISTED... -->
                <div 
                class=""
                v-for="(city, i) in cities"
                :key="'city-'+i"
                >
                    <p 
                    class=" activities-map__aside-city-title"
                    :class="{'activities-map__aside-city-title--active' : city.id == activeCityId}"
                    @click="setActiveCity(city)"
                    >
                    <span class="activities-map__aside-entity-title relative">
                        {{city.name}}
                    </span>
                    </p>
                </div>

            </TransitionGroup>


            <!-- ASIDE : ACTIVITIES -->
            <TransitionGroup tag="div" name="fade" class="w-1/2 flex flex-col">
                <h2 v-if="activeCity" class="activities-map__aside-title text-purple font-bold">...i zabavite se:</h2>


                <!-- ALL THE CITIES LISTED... -->
                <template v-if="activeCity">
                    <div 
                    class=""
                    v-for="(activity, j) in activeCity.activities"
                    :key="'city-activity-'+ j"
                    >
                        <p 
                        class="activities-map__aside-activity-title"
                        :class="{'activities-map__aside-activity-title--active' : activeActivityId == activity.id}"
                        @click="setActiveActivity(activity)"
                        >
                        <span class="activities-map__aside-entity-title relative">
                            {{activity.title}}
                        </span>
                        </p>
                    </div>
                </template>
            </TransitionGroup>
        </div>


        <MapFooter />


    </div>
</template>

<script>
import axios from 'axios'
import { Loader } from '@googlemaps/js-api-loader';
import MapHeader from '@/components/MapHeader'
import ActiveActivityWindow from '@/components/ActiveActivityWindow'
import MapFooter from '@/components/MapFooter'
export default{
    components : {
        MapHeader,
        ActiveActivityWindow,
        MapFooter,
    },

    props : {
        city_id : {
            Type : Number,
            required : false,
            default : 0,
        }
    },

    data(){
        return{
            apiKey : process.env.MIX_GOOGLE_MAPS_API_KEY,
            cities : [],
            activeEntity : 'cities',
            activeCity : null,
            activeActivity : null,
            loader : null,
            map : null,
            mapCenter : {
                lat: 44.786568, lng: 20.448922 //Belgrade
            },
            defaulMapCenter : {
                lat: 44.786568, lng: 20.448922 //Belgrade
            },
            mapZoom : 9,
            defaultMapZoom : 9,
            mapZoomForCities : 12,
            mapZoomForActivities : 14,
            minMapZoom : 4,
            cityChangeTimeout : null,
            activityChangeTimeout : null,
            markers : []
        }
    },

    computed : {
        activeActivityId(){
            if(!this.activeActivity) return null
            return this.activeActivity.id
        },
        activeCityId(){
            if(!this.activeCity) return null
            return this.activeCity.id
        },
    },

    methods : {
        setActiveCity(city){
            if(this.activeCity){
                if(this.activeCity.id == city.id){
                    this.activeCity = null
                    this.activeActivity = null
                    return
                }
            }

            this.activeCity = city
   
        },

        setActiveActivity(activity){
            this.activeActivity = activity
            this.activeEntity = 'activities'
        },

        unsetActiveActivity(){
            this.activeActivity = null
        },

        initMap(){

                if(!this.loader){
                    this.loader = new Loader({
                    apiKey: this.apiKey,
                    version: "weekly",
                    });
                }


                this.loader.load().then(() => {
                            this.map = new google.maps.Map(document.getElementById("the-map"), {
                                zoom: this.mapZoom,
                                center: this.mapCenter,
                            });


                            if(!this.infoWindow) this.infoWindow = new google.maps.InfoWindow({});

                            
                            if(this.activeEntity == 'cities'){
                                if(!this.activeCity){
                                    this.cities.forEach(city => {
                                        let marker = new google.maps.Marker({
                                            position: {
                                                lat : city.lat,
                                                lng : city.lng,
                                            },
                                            map: this.map,
                                        });

                                        var contentString = `<div class="gmap-info-window">
                                        <div class="gmap-info-window__text" class='w-full flex flex-col'>
                                            <p class='gmap-info-window__title text-purple'>${city.name}</p>
                                        </div>`

                                        marker.addListener("click", (e) => {
                                            this.infoWindow.setContent(contentString)
                                            this.infoWindow.open({
                                                anchor: marker,
                                                map: this.map,
                                                shouldFocus: false,
                                            });

                                            
                                            this.activeCity = city
                                            
                                        });



                                    })
                                }
                            } else {
                                    this.activeCity.activities.forEach(activity => {
                                        let marker = new google.maps.Marker({
                                            position: {
                                                lat : activity.lat,
                                                lng : activity.lng,
                                            },
                                            map: this.map,
                                        });

                                        var contentString = `<div class="gmap-info-window">
                                        <div class="gmap-info-window__text" class='w-full flex flex-col'>
                                            <p class='gmap-info-window__title text-purple'>${activity.title}</p>
                                        </div>`

                                        marker.addListener("click", (e) => {
                                            this.infoWindow.setContent(contentString)
                                            this.infoWindow.open({
                                                anchor: marker,
                                                map: this.map,
                                                shouldFocus: false,
                                            });

                                            
                                            this.activeActivity = activity
                                        });
                                    })

                                }

                });
        }
    },

    watch : {
        activeCity(newVal){
            if(!newVal){
                this.mapZoom = this.defaultMapZoom
                this.mapCenter = this.defaulMapCenter
                this.activeEntity = 'cities'
                this.cityChangeTimeout = setTimeout(()=>{
                    this.initMap()
                }, 200)
                return
            }


            this.mapZoom = this.mapZoomForCities
            this.mapCenter = {
                lat : newVal.lat,
                lng : newVal.lng,
            }
            this.activeEntity = 'activities'

            if(this.cityChangeTimeout){
                clearTimeout(this.cityChangeTimeout)
                this.cityChangeTimeout = null
            }
            this.cityChangeTimeout = setTimeout(()=>{
                this.initMap()
            }, 200)
        },
        activeActivity(newVal){
                if(!newVal){
                    this.mapZoom = this.mapZoomForCities
                    this.map.setZoom(this.mapZoom);

                    this.mapCenter = this.activeCity? {
                        lat : this.activeCity.lat,
                        lng : this.activeCity.lng,
                    } : this.defaulMapCenter

                    this.initMap()
                    return
                }

                var laLatLng = new google.maps.LatLng(newVal.lat, newVal.lng);
                this.map.panTo(laLatLng);
                this.mapZoom = this.mapZoomForActivities
                this.map.setZoom(this.mapZoom);

                this.mapCenter = {
                    lat : newVal.lat,
                    lng : newVal.lng,
                }
                this.activeEntity = 'activities'

            setTimeout(()=>{
                // this.initMap()
            }, 1500)
        }
    },

    async mounted(){
        await axios.get('/api/v1/cities')
        .then(({data}) => {
            // handle success
            this.cities = data.cities
            // this.setActiveCity(this.cities[0])
        })
        .catch((error) => {
            // handle error
            console.log(error);
        })
        .then(function () {
            // always executed
        });

        this.initMap()
    }
}


</script>