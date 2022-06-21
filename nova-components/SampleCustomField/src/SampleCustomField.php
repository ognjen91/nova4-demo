<?php

namespace Nova4Demo\SampleCustomField;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class SampleCustomField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'sample-custom-field';

    public function toVue($foo){
        return $this->withMeta([

        ]);
    }


    protected function fillAttributeFromRequest(NovaRequest $request,
    $requestAttribute,
    $model,
    $attribute)
    {
        $model->update([

        ]);
    }
}
