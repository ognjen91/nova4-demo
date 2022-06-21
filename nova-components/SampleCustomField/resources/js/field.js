import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-sample-custom-field', IndexField)
  app.component('detail-sample-custom-field', DetailField)
  app.component('form-sample-custom-field', FormField)
})
