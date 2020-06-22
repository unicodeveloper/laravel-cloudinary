@php
 echo cloudinary()->getVideoTag("{$publicId}")->setAttributes(['controls', 'loop', 'preload', 'style' => 'border: 1px;'])->fallback('Your browser does not support HTML5 video tagsssss.');
@endphp