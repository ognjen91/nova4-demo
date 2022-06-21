<template>
  <PanelItem :index="index" :field="field">
    <template #value>

      <h1>Foo</h1>

    </template>
  </PanelItem>
</template>

<script>
export default {
  props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],
}
</script>
