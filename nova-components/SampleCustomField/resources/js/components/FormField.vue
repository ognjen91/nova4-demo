<template>
  <DefaultField :field="field" :errors="errors" :show-help-text="showHelpText">
    <template #field>

    <select v-model="selectedCityId">
      <option
      v-for="city in cities"
      :key="city.id"
      :value="city.id"
      >{{city.name}}</option>
    </select>

    <input placeholder="G.S." v-model="lat" />
    <input placeholder="G.D." v-model="lng" />

    </template>
  </DefaultField>
</template>

<script>
import { Loader } from '@googlemaps/js-api-loader';
import { FormField, HandlesValidationErrors } from 'laravel-nova'
import axios from 'axios'

export default {
  mixins: [FormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'field'],

  data(){
    return {
      cities : [],
      selectedCityId : null,
      lat : null,
      lng : null,
    }
  },

  methods: {
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      this.value = this.field.value || ''
      this.cities = this.field.cities || []
      this.selectedCityId = this.field.selected_city_id || null
      if(this.selectedCityId){
        this.lat = this.selectedCity.lat
        this.lng = this.selectedCity.lng
      }
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      formData.append('city_id', this.selectedCityId)
      formData.append('lat', this.lat)
      formData.append('lng', this.lng)
    },

  },

  computed : {
    selectedCity(){
      if(!this.selectedCityId) return null
      return this.cities.find(city => city.id == this.selectedCityId)
    }
  },

  watch : {
    selectedCityId(newVal){
      if(newVal){
        this.lat = this.selectedCity.lat
        this.lng = this.selectedCity.lng
      }
    }
  }


}
</script>


