<template>
  <Card class="flex flex-col items-center justify-center" style="height: 80vh;">
    <div class="px-3 py-3">
      <h1 class="text-center text-3xl text-gray-500 font-light mb-4 highlighted">Zdravo, svijete!</h1>

      <p class="text-center text-2xl">
        Moje ime je <span class="highlighted">Ognjen</span>. <br>

        Radim kao web developer u <span class="highlighted"> System Studio-u.</span> <br>
        Sa <span class="highlighted">Laravelom</span> se aktivno družim skoro 5 godina, a sa <span class="highlighted">Vue.js</span>-om malo duže.<br>

        Vrijeme provodim u <span class="highlighted">Herceg Novom</span> i <span class="highlighted">Beogradu</span>. <br> 


        Volim da pred sobom vidim stazu (pogotovo ako je pored mora), a kada je pređem, da pogledam u nazad. <br>
        Trčim polumaratone i poneki maraton.
        <br class="mb-4">

        
          <span class="highlighted">Uživam u kodiranju.</span><br>
          <a style='color: purple;' href="https://atos.bapp.menu" target="_blank">BUON APP </a> - kul stvar koju sam napravio u slobodno vrijeme sa drugarom.<br>
          Nadam se da ćete imati priliku da je koristite! 
      </p>

    </div>
  </Card>
</template>

<script>
export default {
  props: [
    'card',

    // The following props are only available on resource detail cards...
    // 'resource',
    // 'resourceId',
    // 'resourceName',
  ],

  mounted() {
    //
  },
}
</script>

<style scoped>
.highlighted{
  color: purple;
}
</style>
