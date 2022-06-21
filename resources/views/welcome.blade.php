<x-layout-base>
    @section('seo_title' , 'Things to do in...')
    @if(isset($seo_description))
        @section('seo_description', $seo_description)
    @endif
    
    <activities-map></activities-map>


</x-layout-base>